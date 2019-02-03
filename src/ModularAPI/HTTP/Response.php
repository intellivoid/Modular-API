<?php

    namespace ModularAPI\HTTP;
    use ModularAPI\Abstracts\HTTP\ContentType;
    use ModularAPI\Abstracts\HTTP\FileType;
    use ModularAPI\Exceptions\UnsupportedClientException;
    use ModularAPI\Utilities\Checker;

    /**
     * Class ResponseContent
     * @package ModularAPI\HTTP
     */
    class Response
    {

        /**
         * Ends HTTP Request with JSON Response
         *
         * @param array $data
         * @param int $responseCode
         * @return bool
         * @throws UnsupportedClientException
         */
        public static function json(array $data, int $responseCode): bool
        {
            // TODO: Complete this method
            if(Checker::isWebRequest() == false)
            {
                throw new UnsupportedClientException();
            }

            try
            {
                $Response = json_encode($data, JSON_PRETTY_PRINT);
                Headers::setContentType(ContentType::application, FileType::json);
            }
            catch(\Exception $exception)
            {

            }
        }
    }