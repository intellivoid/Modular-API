<?php

    namespace ModularAPI\Objects;

    /**
     * Class Policies
     * @package ModularAPI\Objects
     */
    class Policies
    {
        /**
         * Indicates if authentication is required throughout the whole API
         *
         * @var bool
         */
        public $AuthenticatedRequired;

        /**
         * Indicates if when authentication is required, the user must use a certificate instead of a API Key
         *
         * @var bool
         */
        public $ForceCertificate;
    }