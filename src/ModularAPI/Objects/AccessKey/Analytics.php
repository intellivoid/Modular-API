<?php

    namespace ModularAPI\Objects\AccessKey;

    /**
     * Class Analytics
     * @package ModularAPI\Objects\AccessKey
     */
    class Analytics
    {
        /**
         * The ID of the last month
         *
         * @var string
         */
        public $LastMonthID;

        /**
         * The usage from the last month
         *
         * @var array
         */
        public $LastMonthUsage;

        /**
         * The ID of this month
         *
         * @var string
         */
        public $CurrentMonthID;

        /**
         * The usage for this month
         *
         * @var array
         */
        public $CurrentMonthUsage;

        /**
         * Converts the object to an array
         *
         * @return array
         */
        public function toArray(): array
        {
            return array(
                'last_month' => array(
                    'id' => $this->LastMonthID,
                    'usage' => $this->LastMonthUsage
                ),
                'current_month' => array(
                    'id' => $this->CurrentMonthID,
                    'usage' => $this->CurrentMonthUsage
                )
            );
        }

        /**
         * Creates object from array
         *
         * @param array $data
         * @return Analytics
         */
        public static function fromArray(array $data): Analytics
        {
            $AnalyticsObject = new Analytics();

            if(isset($data['last_month']))
            {
                $AnalyticsObject->LastMonthID = $data['last_month']['id'];
                $AnalyticsObject->LastMonthUsage = $data['last_month']['usage'];
            }

            if(isset($data['current_month']))
            {
                $AnalyticsObject->LastMonthID = $data['current_month']['id'];
                $AnalyticsObject->LastMonthUsage = $data['current_month']['usage'];
            }

            return $AnalyticsObject;
        }
    }