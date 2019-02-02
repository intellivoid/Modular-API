<?php

    namespace ModularAPI\Utilities;

    /**
     * Class Hashing
     * @package ModularAPI\Utilities
     */
    class Hashing
    {
        /**
         * Constructs a unique month ID
         *
         * @param int $month
         * @param int $year
         * @return string
         */
        public static function createMonthID(int $month, int $year): string
        {
            $c_month = hash('sha256', $month);
            $c_year = hash('sha256', $year);

            return hash('haval256,3', "s_month=$c_month/$c_year");
        }
    }