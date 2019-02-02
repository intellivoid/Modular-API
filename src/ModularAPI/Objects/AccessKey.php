<?php

    namespace ModularAPI\Objects;
    use ModularAPI\Abstracts\AccessKeyStatus;
    use ModularAPI\Objects\AccessKey\Usage;

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
         * The status of this access key
         *
         * @var AccessKeyStatus
         */
        public $State;

        /**
         * The usage and validation for this access key
         *
         * @var Usage
         */
        public $Usage;
    }