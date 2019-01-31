<?php

    namespace ModularAPI;

    /**
     * Main AutoLoader for ModularAPI
     *
     * Class ModularAPI
     * @package ModularAPI
     */
    class ModularAPI
    {
        /**
         * Constructs ModularAPI Library
         *
         * ModularAPI constructor.
         * @param string $Modules
         * @param string $ConfigurationFile
         * @param bool $EstablishDatabaseConnection
         */
        public function __construct(string $Modules, string $ConfigurationFile = 'default', bool $EstablishDatabaseConnection = true)
        {
            if($ConfigurationFile == 'default')
            {
                $ConfigurationFile = __DIR__ . DIRECTORY_SEPARATOR . 'configuration.ini';
            }

            $this->Configuration = parse_ini_file($ConfigurationFile, true);
        }
    }