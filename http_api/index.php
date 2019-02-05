<?php
    /**
     * ModularAPI HTTP Handler File
     *
     * This file determines if the User is making a valid request, and if the authentication method used is valid and correct
     */

    include_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ModularAPI' . DIRECTORY_SEPARATOR . 'ModularAPI.php');

    if(isset($_GET['path']) == false)
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_400,
            'message' => 'The requested resource is invalid/unavailable'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_400);
        exit();
    }

    try
    {
        $Query = \ModularAPI\HTTP\Request::parseQuery($_GET['path']);
    }
    catch(Exception $exception)
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_400,
            'message' => 'The API Module is invalid'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_400);
        exit();
    }

    if(file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'configuration.json') == false)
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ServerError::_500,
            'message' => 'The sever does not have a configuration file, if you are the administrator then please consult the documentation'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ServerError::_500);
        exit();
    }

    try
    {
        $APIConfiguration = json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'configuration.json'), true);
    }
    catch(Exception $exception)
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ServerError::_500,
            'message' => 'There was an issue while trying to parse the server configuration file, please consult tue documentation'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ServerError::_500);
        exit();
    }

    // Determine if the version is available
    if(isset($APIConfiguration[strtolower($Query->Version)]) == false)
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_400,
            'message' => 'The API Version is not supported by the server'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_400);
        exit();
    }

    $API = \ModularAPI\Objects\Configuration::fromArray($APIConfiguration[strtolower($Query->Version)], $Query->Version);
    $Authentication = ModularAPI\HTTP\Request::parseAuthentication();