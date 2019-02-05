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
            'message' => 'Authentication is required'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_401);
        exit();
    }

    function certificateRequiredError()
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_401,
            'message' => 'A Certificate is required for authentication'
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

    function invalidPermissionError()
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_403,
            'message' => 'You don\'t have the required permissions to use this API Module'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_403);
        exit();
    }

    function unavailableError(string $Message)
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ServerError::_503,
            'message' => $Message
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ServerError::_503);
        exit();
    }

    function keyExpiredError()
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_403,
            'message' => 'The Key/Certificate has expired'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_403);
        exit();
    }

    function usageExceededError()
    {
        $Payload = array(
            'status' => false,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_429,
            'message' => 'Usage limit has exceeded'
        );
        \ModularAPI\HTTP\Response::json($Payload, \ModularAPI\Abstracts\HTTP\ResponseCode\ClientError::_429);
        exit();
    }