<?php

    namespace ModularAPI\Objects;
    use ModularAPI\Abstracts\AccessKeyStatus;

    /**
     * Class AccessKey
     * @package ModularAPI\Objects
     */
    class AccessKey
    {
        /**
         * Database ID of the access key
         *
         * @var int
         */
        public $ID;

        /**
         * The Public ID of the access key
         *
         * @var string
         */
        public $PublicID;

        /**
         * The API Key
         *
         * @var string
         */
        public $PublicKey;

        /**
         * @var AccessKeyStatus
         */
        public $State;

        public $UsageData;
    }