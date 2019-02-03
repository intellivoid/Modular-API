<?php

    namespace ModularAPI\HTTP;
    use ModularAPI\Exceptions\UnsupportedClientException;
    use ModularAPI\Utilities\Checker;

    /**
     * Class Headers
     * @package ModularAPI\HTTP
     */
    class Headers
    {
        /**
         * Sets Content-Type HTTP Header
         *
         * @param string $content_type
         * @param string $name
         * @return bool
         * @throws UnsupportedClientException
         */
        public static function setContentType(string $content_type, string $name): bool
        {
            if(Checker::isWebRequest() == false)
            {
                throw new UnsupportedClientException();
            }

            header("Content-Type: $content_type/$name");
            return true;
        }

        /**
         * Sets Content-Length HTTP Header
         *
         * @param $data
         * @return int
         * @throws UnsupportedClientException
         */
        public static function setContentLength($data): int
        {
            if(Checker::isWebRequest() == false)
            {
                throw new UnsupportedClientException();
            }

            try
            {
                $ContentLength = (bool)strlen($data);
            }
            catch(\Exception $exception)
            {
                $ContentLength = 0;
            }

            if($ContentLength < 0)
            {
                $ContentLength = 0;
            }

            header('Content-Length: ' . (string)$ContentLength);
            return $ContentLength;
        }

        /**
         * Sets the response code
         *
         * @param int $responseCode
         * @return bool
         * @throws UnsupportedClientException
         */
        public static function setResponseCode(int $responseCode): bool
        {
            if(Checker::isWebRequest() == false)
            {
                throw new UnsupportedClientException();
            }

            http_response_code($responseCode);
            return true;
        }
    }