<?php

    namespace ModularAPI\Utilities;

    /**
     * Class Checker
     * @package ModularAPI\Utilities
     */
    class Checker
    {
        /**
         * Determines if it's a web request
         *
         * @return bool
         */
        public static function isWebRequest(): bool
        {
            if(http_response_code() !== false)
            {
                return true;
            }

            return false;
        }
    }