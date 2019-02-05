<?php
    function invalidResourceError()
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_400,
            'message' => 'The requested resource is invalid/unavailable'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_400);
        exit();
    }

    function invalidModuleError()
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_400,
            'message' => 'The API Module is invalid'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_400);
        exit();
    }

    function invalidConfigurationError()
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ServerError::_500,
            'message' => 'The sever does not have a valid configuration file, if you are the administrator then please consult the documentation'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ServerError::_500);
        exit();
    }

    function invalidVersionError()
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_400,
            'message' => 'The API Version is not supported by the server'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_400);
        exit();
    }

    function authenticationRequiredError()
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_401,
            'message' => 'Authentication is required for this API, Please consult the documentation'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_401);
        exit();
    }

    function certificateRequiredError()
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_401,
            'message' => 'A Certificate is required for authentication, please consult the documentation'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_401);
        exit();
    }

    function invalidAuthenticationError()
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_401,
            'message' => 'Incorrect Authentication'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_401);
        exit();
    }