<?php
    /**
     * ModularAPI HTTP Handler File
     *
     * This file determines if the User is making a valid request, and if the authentication method used is valid and correct
     */

    include_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'ModularAPI' . DIRECTORY_SEPARATOR . 'ModularAPI.php');
    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'authentication.php');
    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'generic_responses.php');
    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'request.php');

    $API = verifyRequest();
    $AccessKey = null;

    $ModularAPI = new \ModularAPI\ModularAPI();

    if($API->Policies->AuthenticatedRequired == true)
    {
        $AccessKey = verifyAuthentication($ModularAPI, $API->Policies->ForceCertificate);
    }

    $Query = \ModularAPI\HTTP\Request::parseQuery($_GET['path']);
    if($API->moduleExists($Query->Module) == false)
    {
        invalidModuleError();
    }