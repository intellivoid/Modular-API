<?php

    namespace ModularAPI\Managers;

    use ModularAPI\Abstracts\AccessKeyStatus;
    use ModularAPI\DatabaseManager\AccessKeys;
    use ModularAPI\Exceptions\InvalidAccessKeyStatusException;
    use ModularAPI\ModularAPI;
    use ModularAPI\Objects\AccessKey;
    use ModularAPI\Utilities\Builder;
    use ModularAPI\Utilities\Hashing;

    /**
     * Class AccessKeyManager
     * @package ModularAPI\Managers
     */
    class AccessKeyManager
    {
        /**
         * @var ModularAPI
         */
        private $modularAPI;

        /**
         * Manages objects in the Database
         *
         * @var AccessKeys
         */
        private $Manager;

        /**
         * AccessKeyManager constructor.
         * @param ModularAPI $modularAPI
         */
        public function __construct(ModularAPI $modularAPI)
        {
            $this->modularAPI = $modularAPI;
            $this->Manager = new AccessKeys($modularAPI);
        }

        /**
         *  Registers a new Access Key to the Database
         *
         * @param array $usageConfiguration
         * @param array $permissionsConfiguration
         * @param int|AccessKeyStatus $startingState
         * @return AccessKey
         * @throws InvalidAccessKeyStatusException
         */
        public function createKey(array $usageConfiguration, array $permissionsConfiguration, int $startingState = 0): AccessKey
        {
            $AccessKeyObject = new AccessKey();
            $AccessKeyObject->Analytics = new AccessKey\Analytics();
            $AccessKeyObject->Permissions = new AccessKey\Permissions();
            $AccessKeyObject->Signatures = new AccessKey\Signatures();
            $AccessKeyObject->Usage = new AccessKey\Usage();

            $Configuration = ModularAPI::getConfiguration();

            // Build the signatures
            $CurrentTime = time();

            $AccessKeyObject->Signatures->IssuerName = (string)$Configuration['ModularAPI_IssuerName'];

            $AccessKeyObject->Signatures->TimeSignature = Hashing::generateTimeSignature(
                $CurrentTime,
                $AccessKeyObject->Signatures->IssuerName
            );

            $AccessKeyObject->Signatures->PrivateSignature = Hashing::generatePrivateSignature(
                $AccessKeyObject->Signatures->TimeSignature,
                $AccessKeyObject->Signatures->IssuerName,
                $CurrentTime
            );

            $AccessKeyObject->Signatures->PublicSignature = Hashing::generatePublicSignature(
                $AccessKeyObject->Signatures->TimeSignature,
                $AccessKeyObject->Signatures->PrivateSignature
            );

            // Fill out the rest of the properties
            $AccessKeyObject->PublicID = Hashing::calculatePublicID($AccessKeyObject->Signatures->createCertificate());
            $AccessKeyObject->PublicKey = Hashing::calculatePublicKey(
                $AccessKeyObject->Signatures->PrivateSignature,
                $AccessKeyObject->Signatures->PublicSignature,
                $AccessKeyObject->Signatures->TimeSignature
            );

            // Build configuration
            $AccessKeyObject->Usage->loadConfiguration($usageConfiguration);
            $AccessKeyObject->Permissions->loadConfiguration($permissionsConfiguration);

            $AccessKeyObject->Analytics->LastMonthAvailable = false;
            $AccessKeyObject->Analytics->LastMonthID = null;
            $AccessKeyObject->Analytics->LastMonthUsage = [];

            $AccessKeyObject->Analytics->CurrentMonthAvailable = true;
            $AccessKeyObject->Analytics->CurrentMonthID = Hashing::calculateMonthID((int)date('n'), (int)date('Y'));
            $AccessKeyObject->Analytics->CurrentMonthUsage = Builder::createMonthArray();

            switch($startingState)
            {
                case AccessKeyStatus::Activated:
                    $AccessKeyObject->State = AccessKeyStatus::Activated;
                    break;

                case AccessKeyStatus::Suspended:
                    $AccessKeyObject->State = AccessKeyStatus::Suspended;
                    break;

                case AccessKeyStatus::Limited:
                    $AccessKeyObject->State = AccessKeyStatus::Limited;
                    break;

                default:
                    throw new InvalidAccessKeyStatusException();
            }

            $AccessKeyObject->CreationDate = time();

            return $this->Manager->register($AccessKeyObject);
        }
    }