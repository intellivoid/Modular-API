<?php

    namespace ModularAPI;

    define('MODULAR_API', __DIR__ . DIRECTORY_SEPARATOR);

    include_once(MODULAR_API . 'Abstracts' . DIRECTORY_SEPARATOR . 'AccessKeyStatus.php');
    include_once(MODULAR_API . 'Abstracts' . DIRECTORY_SEPARATOR . 'UsageType.php');
    include_once(MODULAR_API . 'Configurations' . DIRECTORY_SEPARATOR . 'UsageConfiguration.php');
    include_once(MODULAR_API . 'Objects' . DIRECTORY_SEPARATOR . 'AccessKey' . DIRECTORY_SEPARATOR . 'Usage.php');
    include_once(MODULAR_API . 'Objects' . DIRECTORY_SEPARATOR . 'AccessKey.php');

    /**
     * Main AutoLoader for ModularAPI
     *
     * Class ModularAPI
     * @package ModularAPI
     */
    class ModularAPI
    {
        /**
         * ModularAPI Library Configuration
         *
         * @var array|bool
         */
        public $Configuration;

        /**
         * Constructs ModularAPI Library
         *
         * ModularAPI constructor.
         * @param string $API_Configuration
         * @param string $ConfigurationFile
         * @param bool $EstablishDatabaseConnection
         * @internal param string $Modules
         */
        public function __construct(string $API_Configuration, string $ConfigurationFile = 'default', bool $EstablishDatabaseConnection = true)
        {
            if($ConfigurationFile == 'default')
            {
                $ConfigurationFile = __DIR__ . DIRECTORY_SEPARATOR . 'configuration.ini';
            }

            $this->Configuration = parse_ini_file($ConfigurationFile, true);

        }
    }