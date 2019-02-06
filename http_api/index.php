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

    $Configuration = verifyRequest();

    if($Configuration->API->Available == false)
    {
        unavailableError($Configuration->API->UnavailableMessage);
    }

    $AccessKey = null;
    $ModularAPI = new \ModularAPI\ModularAPI();

    if($Configuration->Policies->AuthenticatedRequired == true)
    {
        $AccessKey = verifyAuthentication($ModularAPI, $Configuration->Policies->ForceCertificate);

        if($AccessKey->Usage->expired() == true)
        {
            keyExpiredError();
        }
    }

    $Query = \ModularAPI\HTTP\Request::parseQuery();
    if($Configuration->moduleExists($Query->Module) == false)
    {
        invalidModuleError();
    }

    $Module = $Configuration->getModule($Query->Module);

    if($Module->RequireAuthentication == true)
    {
        if($AccessKey == null)
        {
            $AccessKey = verifyAuthentication($ModularAPI, false);

            if($AccessKey->Usage->expired() == true)
            {
                keyExpiredError();
            }
        }

        if($AccessKey->Permissions->AllowAll == false)
        {
            if($AccessKey->Permissions->hasPermission($Module->Name) == false)
            {
                invalidPermissionError();
            }
        }

        if($Module->RequireUsage == true)
        {
            if($AccessKey->Usage->usageExceeded() == true)
            {
                usageExceededError();
            }
        }
    }

    $SafeVersion = str_ireplace('/', '_', $Query->Version);
    $SafeVersion = str_ireplace('\\', '_', $SafeVersion);
    $ModuleFile = __DIR__ . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $SafeVersion . DIRECTORY_SEPARATOR . $Module->ScriptName . '.php';

    if(file_exists($ModuleFile) == false)
    {
        moduleScriptNotFoundError();
    }

    try
    {
        $Parameters = ModularAPI\HTTP\Request::getParameters($Module->Parameters);
    }
    catch(\ModularAPI\Exceptions\MissingParameterException $missingParameterException)
    {
        missingParamerter($missingParameterException->ParamerterName);
    }

    try
    {
        /** @noinspection PhpIncludeInspection */
        include($ModuleFile);
        Module($AccessKey, $Parameters);
    }
    catch(Exception $exception)
    {
        internalServerError($exception);
    }