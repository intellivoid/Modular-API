<?php

    namespace ModularAPI\DatabaseManager;
    use ModularAPI\ModularAPI;

    /**
     * Class Requests
     * @package ModularAPI\DatabaseManager
     */
    class Requests
    {
        /**
         * @var ModularAPI
         */
        private $modularAPI;

        /**
         * Requests constructor.
         * @param ModularAPI $modularAPI
         */
        public function __construct(ModularAPI $modularAPI)
        {
            $this->modularAPI = $modularAPI;
        }
    }