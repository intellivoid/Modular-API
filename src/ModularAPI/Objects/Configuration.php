<?php

    namespace ModularAPI\Objects;

    /**
     * Class Configuration
     * @package ModularAPI\Objects
     */
    class Configuration
    {
        /**
         * The API Configuration
         *
         * @var API
         */
        public $API;

        /**
         * Policies for the API
         *
         * @var Policies
         */
        public $Policies;

        /**
         * List of Modules that are configured for this API
         * These arrays can be converted to Module Object
         *
         * @var array
         */
        public $Modules;
    }