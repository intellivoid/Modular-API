<?php
    include_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ModularAPI' . DIRECTORY_SEPARATOR . 'ModularAPI.php');
    // Modular API HTTP Handler

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