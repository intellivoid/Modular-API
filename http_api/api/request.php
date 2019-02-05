<?php
    function verifyRequest(): \ModularAPI\Objects\Configuration
    {
        if(isset($_GET['path']) == false)
        {
            invalidResourceError();
        }

        $Query = null;

        try
        {
            $Query = \ModularAPI\HTTP\Request::parseQuery($_GET['path']);
        }
        catch(Exception $exception)
        {
            invalidModuleError();
        }

        if(file_exists(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'configuration.json') == false)
        {
            invalidConfigurationError();
        }

        try
        {
            $APIConfiguration = json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'configuration.json'), true);
        }
        catch(Exception $exception)
        {
            invalidConfigurationError();
        }

        // Determine if the version is available
        if(isset($APIConfiguration[strtolower($Query->Version)]) == false)
        {
            invalidVersionError();
        }

        return \ModularAPI\Objects\Configuration::fromArray($APIConfiguration[strtolower($Query->Version)], $Query->Version);
    }