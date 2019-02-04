<?php

    namespace ModularAPI\Objects;

    /**
     * Class Paramerter
     * @package ModularAPI\Objects
     */
    class Paramerter
    {
        /**
         * The name of the Paramerter
         *
         * @var string
         */
        public $Name;

        /**
         * Indicates if this Parameter is required
         *
         * @var bool
         */
        public $Required;

        /**
         * The default value of this paramerter (If this paramerter is not required)
         *
         * @var string
         */
        public $Default;
    }