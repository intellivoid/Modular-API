<?php

    namespace ModularAPI\Objects\AccessKey;
    use ModularAPI\Abstracts\UsageType;
    use ModularAPI\Exceptions\AccessKeyExpiredException;
    use ModularAPI\Exceptions\UsageExceededException;

    /**
     * Class Usage
     * @package ModularAPI\Objects\AccessKey
     */
    class Usage
    {
        /**
         * The usage limit
         *
         * @var int
         */
        public $Limit;

        /**
         * The usage type
         *
         * @var UsageType
         */
        public $UsageType;

        /**
         * The current usage
         *
         * @var int
         */
        public $CurrentUsage;

        /**
         * The interval that the limit rests to
         *
         * @var int
         */
        public $ResetInterval;

        /**
         * The next interval when the current usage resets
         *
         * @var int
         */
        public $NextInterval;

        /**
         * The Unix Timestamp of the expiry
         *
         * @var int
         */
        public $Expires;

        /**
         * Sets the current usage configuration
         *
         * @param array $configuration
         */
        public function loadConfiguration(array $configuration)
        {
            switch($configuration['type'])
            {
                case UsageType::Unlimited:
                    $this->UsageType = UsageType::Unlimited;
                    $this->Limit = 0;
                    $this->CurrentUsage = 0;
                    $this->ResetInterval = 0;
                    $this->NextInterval = 0;
                    $this->Expires = 0;
                    break;

                case UsageType::UsageLimit:
                    $this->UsageType = UsageType::UsageLimit;
                    $this->Limit = (int)$configuration['limit'];
                    $this->CurrentUsage = 0;
                    $this->ResetInterval = 0;
                    $this->NextInterval = 0;
                    $this->Expires = 0;
                    break;

                case UsageType::DateIntervalLimit:
                    $this->UsageType = UsageType::DateIntervalLimit;
                    $this->Limit = (int)$configuration['limit'];
                    $this->CurrentUsage = 0;
                    $this->ResetInterval = (int)$configuration['reset_interval'];
                    $this->NextInterval = time() + $this->ResetInterval;
                    $this->Expires = 0;
                    break;

                case UsageType::ExpiryLimit:
                    $this->UsageType = UsageType::ExpiryLimit;
                    $this->Limit = 0;
                    $this->CurrentUsage = 0;
                    $this->ResetInterval = 0;
                    $this->NextInterval = 0;
                    $this->Expires = time() + (int)$configuration['expires'];
                    break;

            }
        }


        /**
         * Determines if the usage limit has exceeded
         *
         * @return bool
         */
        public function usageExceeded(): bool
        {
            switch($this->UsageType)
            {
                case UsageType::UsageLimit:
                    if($this->CurrentUsage == $this->Limit)
                    {
                        return true;
                    }
                    break;

                case UsageType::DateIntervalLimit:
                    if(time() > $this->NextInterval)
                    {
                        $this->NextInterval = time() + $this->ResetInterval;
                        $this->CurrentUsage = 0;
                    }

                    if($this->CurrentUsage == $this->Limit)
                    {
                        return true;
                    }
                    break;

            }

            return false;
        }

        /**
         * Determines if the key has expired
         *
         * @return bool
         */
        public function expired(): bool
        {
            if($this->UsageType == UsageType::ExpiryLimit)
            {
                if(time() > $this->Expires)
                {
                    return true;
                }
            }

            return false;
        }

        /**
         * Tracks and checks usage, throws an exception if the key expired.
         * If TrackExceeding is set to true, checks if the usage has exceeded, if not it
         *
         * @param bool $trackExceeding
         * @throws AccessKeyExpiredException
         * @throws UsageExceededException
         */
        public function trackUsage(bool $trackExceeding = true)
        {
            switch($this->UsageType)
            {
                case UsageType::ExpiryLimit:
                    if($this->expired() == true)
                    {
                        throw new AccessKeyExpiredException();
                    }
                    break;

                case UsageType::DateIntervalLimit:
                    if($trackExceeding == true)
                    {
                        if($this->usageExceeded() == true)
                        {
                            throw new UsageExceededException();
                        }

                        $this->CurrentUsage += 1;
                    }
                    break;

                case UsageType::UsageLimit:
                    if($trackExceeding == true)
                    {
                        if($this->usageExceeded() == true)
                        {
                            throw new UsageExceededException();
                        }

                        $this->CurrentUsage += 1;
                    }
                    break;
            }
        }
    }