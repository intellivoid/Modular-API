<?php
    function Module(\ModularAPI\Objects\AccessKey $accessKey, array $Parameters): \ModularAPI\Objects\Response
    {
        $Response = new \ModularAPI\Objects\Response();
        $Response->ResponseCode = \ModularAPI\Abstracts\HTTP\ResponseCode\Successful::_200;
        $Response->ResponseType = \ModularAPI\Abstracts\HTTP\ContentType::application . '/' . \ModularAPI\Abstracts\HTTP\FileType::json;
        $Response->Content = array(
            'status' => true,
            'code' => \ModularAPI\Abstracts\HTTP\ResponseCode\Successful::_200,
            'payload' => time()
        );

        return $Response;
    }