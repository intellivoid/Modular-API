<?php

    namespace ModularAPI\HTTP;
    use ModularAPI\Abstracts\HTTP\ContentType;
    use ModularAPI\Abstracts\HTTP\FileType;
    use ModularAPI\Abstracts\HTTP\ResponseCode\ServerError;
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
                Headers::setResponseCode($responseCode);
                Headers::setContentLength(strlen($Response));
                print($Response);
                return true;
            }
            catch(\Exception $exception)
            {
                $Payload = array(
                    'status' => false,
                    'code' => ServerError::_500,
                    'message' => 'There was an error while trying to build the response'
                );
                $Response = json_encode($Payload, JSON_PRETTY_PRINT);
                Headers::setContentType(ContentType::application, FileType::json);
                Headers::setResponseCode(ServerError::_500);
                Headers::setContentLength(strlen($Response));
                print($Response);
            }

            return false;
        }
    }