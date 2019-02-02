<?php

    namespace ModularAPI\Objects;
    use ModularAPI\Abstracts\AccessKeyStatus;
    use ModularAPI\Objects\AccessKey\Analytics;
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

        /**
         * The analytics data for this access key
         *
         * @var Analytics
         */
        public $Analytics;

        /**
         * Creates an array from the object
         *
         * @return array
         */
        public function toArray(): array
        {
            return array(
                'id' => $this->ID,
                'public_id' => $this->PublicKey,
                'state' => $this->State,
                'usage' => $this->Usage->toArray(),
                'analytics' => $this->Analytics->toArray()
            );
        }

        /**
         * Creates an object from array
         *
         * @param array $data
         * @return AccessKey
         */
        public static function fromArray(array $data): AccessKey
        {
            $AccessKeyObject = new AccessKey();

            if(isset($data['id']))
            {
                $AccessKeyObject->ID = (int)$data['id'];
            }

            if(isset($data['public_id']))
            {
                $AccessKeyObject->PublicID = (string)$data['public_id'];
            }

            if(isset($data['state']))
            {
                $AccessKeyObject->State = (int)$data['state'];
            }

            if(isset($data['usage']))
            {
                $AccessKeyObject->Usage = Usage::fromArray($data['usage']);
            }

            if(isset($data['analytics']))
            {
                $AccessKeyObject->Analytics = Analytics::fromArray($data['analytics']);
            }

            return $AccessKeyObject;
        }
    }