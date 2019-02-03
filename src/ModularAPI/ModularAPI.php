<?php

    namespace ModularAPI;

    use ModularAPI\Managers\AccessKeyManager;

    define('MODULAR_API', __DIR__ . DIRECTORY_SEPARATOR);

    include_once(MODULAR_API . 'Abstracts' . DIRECTORY_SEPARATOR . 'AccessKeySearchMethod.php');
    include_once(MODULAR_API . 'Abstracts' . DIRECTORY_SEPARATOR . 'AccessKeyStatus.php');
    include_once(MODULAR_API . 'Abstracts' . DIRECTORY_SEPARATOR . 'ExceptionCodes.php');
    include_once(MODULAR_API . 'Abstracts' . DIRECTORY_SEPARATOR . 'UsageType.php');
    include_once(MODULAR_API . 'Configurations' . DIRECTORY_SEPARATOR . 'PermissionsConfiguration.php');
    include_once(MODULAR_API . 'Configurations' . DIRECTORY_SEPARATOR . 'UsageConfiguration.php');
    include_once(MODULAR_API . 'DatabaseManager' . DIRECTORY_SEPARATOR . 'AccessKeys.php');
    include_once(MODULAR_API . 'Exceptions' . DIRECTORY_SEPARATOR . 'AccessKeyExpiredException.php');
    include_once(MODULAR_API . 'Exceptions' . DIRECTORY_SEPARATOR . 'AccessKeyNotFoundException.php');
    include_once(MODULAR_API . 'Exceptions' . DIRECTORY_SEPARATOR . 'DatabaseException.php');
    include_once(MODULAR_API . 'Exceptions' . DIRECTORY_SEPARATOR . 'DatabaseNotEstablishedException.php');
    include_once(MODULAR_API . 'Exceptions' . DIRECTORY_SEPARATOR . 'InvalidAccessKeyStatusException.php');
    include_once(MODULAR_API . 'Exceptions' . DIRECTORY_SEPARATOR . 'NoResultsFoundException.php');
    include_once(MODULAR_API . 'Exceptions' . DIRECTORY_SEPARATOR . 'UnsupportedSearchMethodException.php');
    include_once(MODULAR_API . 'Exceptions' . DIRECTORY_SEPARATOR . 'UsageExceededException.php');
    include_once(MODULAR_API . 'Managers' . DIRECTORY_SEPARATOR . 'AccessKeyManager.php');
    include_once(MODULAR_API . 'Objects' . DIRECTORY_SEPARATOR . 'AccessKey' . DIRECTORY_SEPARATOR . 'Analytics.php');
    include_once(MODULAR_API . 'Objects' . DIRECTORY_SEPARATOR . 'AccessKey' . DIRECTORY_SEPARATOR . 'Permissions.php');
    include_once(MODULAR_API . 'Objects' . DIRECTORY_SEPARATOR . 'AccessKey' . DIRECTORY_SEPARATOR . 'Signatures.php');
    include_once(MODULAR_API . 'Objects' . DIRECTORY_SEPARATOR . 'AccessKey' . DIRECTORY_SEPARATOR . 'Usage.php');
    include_once(MODULAR_API . 'Objects' . DIRECTORY_SEPARATOR . 'AccessKey.php');
    include_once(MODULAR_API . 'Utilities' . DIRECTORY_SEPARATOR . 'Builder.php');
    include_once(MODULAR_API . 'Utilities' . DIRECTORY_SEPARATOR . 'Hashing.php');

    /**
     * Main AutoLoader for ModularAPI
     *
     * Class ModularAPI
     * @package ModularAPI
     */
    class ModularAPI
    {
        /**
         * The Database connection, null if Database connection isn't established
         *
         * @var null|\mysqli
         */
        public $Database;

        /**
         * @var AccessKeyManager
         */
        private $AccessKeyManager;

        /**
         * Constructs ModularAPI Library
         *
         * ModularAPI constructor.
         * @param string $API_Configuration
         * @param bool $EstablishDatabaseConnection
         * @internal param string $ConfigurationFile
         * @internal param string $Modules
         */
        public function __construct(string $API_Configuration, bool $EstablishDatabaseConnection = true)
        {
            $Configuration = self::getConfiguration();

            if($EstablishDatabaseConnection == true)
            {
                $this->Database = new \mysqli(
                    $Configuration['ModularAPI_DatabaseHost'],
                    $Configuration['ModularAPI_DatabaseUsername'],
                    $Configuration['ModularAPI_DatabasePassword'],
                    $Configuration['ModularAPI_DatabaseName'],
                    $Configuration['ModularAPI_DatabasePort']
                );
            }
            else
            {
                $this->Database = null;
            }

            $this->AccessKeyManager = new AccessKeyManager($this);

        }

        /**
         * Manages Access Keys
         *
         * @return AccessKeyManager
         */
        public function AccessKeys(): AccessKeyManager
        {
            return $this->AccessKeyManager;
        }

        /**
         * Get configuration
         *
         * @return array
         */
        public static function getConfiguration(): array
        {
            return parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . 'configuration.ini', false);
        }
    }