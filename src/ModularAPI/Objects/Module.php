<?php

    namespace ModularAPI\Objects;

    /**
     * Class Module
     * @package ModularAPI\Objects
     */
    class Module
    {
        /**
         * The name of the module
         *
         * @var string
         */
        public $Name;

        /**
         * Indicates if this module requires authentication to utilize
         *
         * @var bool
         */
        public $RequireAuthentication;

        /**
         * Indicates if the POST Method is allowed within the request
         *
         * @var bool
         */
        public $PostMethodAllowed;

        /**
         * Indicates if the GET Method is allowed within the request
         *
         * @var bool
         */
        public $GetMethodAllowed;

        /**
         * List of expected parameters
         *
         * @var array
         */
        public $Parameters;
    }