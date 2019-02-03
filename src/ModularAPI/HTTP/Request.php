<?php

    namespace ModularAPI\HTTP;
    use ModularAPI\Abstracts\AuthenticationType;
    use ModularAPI\Exceptions\InvalidRequestQueryException;
    use ModularAPI\Exceptions\UnsupportedClientException;
    use ModularAPI\Objects\RequestAuthentication;
    use ModularAPI\Objects\RequestQuery;
    use ModularAPI\Utilities\Checker;

    /**
     * Class Request
     * @package ModularAPI\HTTP
     */
    class Request
    {
        /**
         * Parses the request query
         *
         * @param string $Query
         * @return RequestQuery
         * @throws InvalidRequestQueryException
         * @throws UnsupportedClientException
         */
        public static function parseQuery(string $Query): RequestQuery
        {
            if(Checker::isWebRequest() == false)
            {
                throw new UnsupportedClientException();
            }

            $QueryParts = explode('/', $Query);
            if(count($QueryParts) == 2)
            {
                if(strlen($QueryParts[1]) > 0)
                {
                    $RequestQuery = new RequestQuery();
                    $RequestQuery->Version = $QueryParts[0];
                    $RequestQuery->Module = $QueryParts[1];
                    $RequestQuery->RequestMethod = strtoupper($_SERVER['REQUEST_METHOD']);

                    return $RequestQuery;
                }
            }

            throw new InvalidRequestQueryException();
        }

        /**
         * Parses the Authentication Method used
         *
         * @return RequestAuthentication
         * @throws UnsupportedClientException
         */
        public static function parseAuthentication(): RequestAuthentication
        {
            if(Checker::isWebRequest() == false)
            {
                throw new UnsupportedClientException();
            }

            $RequestAuthentication = new RequestAuthentication();

            if(isset($_GET['api_key']))
            {
                $RequestAuthentication->Type = AuthenticationType::APIKey;
                $RequestAuthentication->Key = $_GET['api_key'];
                $RequestAuthentication->Certificate = null;
                return $RequestAuthentication;
            }

            if(isset($_POST['api_key']))
            {
                $RequestAuthentication->Type = AuthenticationType::APIKey;
                $RequestAuthentication->Key = $_POST['api_key'];
                $RequestAuthentication->Certificate = null;
                return $RequestAuthentication;
            }

            if(isset($_GET['certificate']))
            {
                if(Checker::isBase64($_GET['certificate']) == false)
                {
                    $RequestAuthentication->Type = AuthenticationType::Certificate;
                    $RequestAuthentication->Certificate = 'INVALID';
                    $RequestAuthentication->Key = null;

                    return $RequestAuthentication;
                }

                $RequestAuthentication->Type = AuthenticationType::Certificate;
                $RequestAuthentication->Certificate = base64_decode($_GET['certificate'], true);
                $RequestAuthentication->Key = null;

                return $RequestAuthentication;
            }

            if(isset($_POST['certificate']))
            {
                if(Checker::isBase64($_POST['certificate']) == false)
                {
                    $RequestAuthentication->Type = AuthenticationType::Certificate;
                    $RequestAuthentication->Certificate = 'INVALID';
                    $RequestAuthentication->Key = null;

                    return $RequestAuthentication;
                }

                $RequestAuthentication->Type = AuthenticationType::Certificate;
                $RequestAuthentication->Certificate = base64_decode($_POST['certificate'], true);
                $RequestAuthentication->Key = null;

                return $RequestAuthentication;
            }

            $RequestAuthentication->Type = AuthenticationType::None;
            $RequestAuthentication->Certificate = null;
            $RequestAuthentication->Key = null;

            return $RequestAuthentication;
        }

        /**
         * Retrieves all parameters that are expected
         *
         * @param array $expectedParameters
         * @return array
         * @throws UnsupportedClientException
         */
        public static function getParameters(array $expectedParameters): array
        {
            if(Checker::isWebRequest() == false)
            {
                throw new UnsupportedClientException();
            }

            $requestParameters = array();

            if(isset($_GET))
            {
                foreach($expectedParameters as $parameter)
                {
                    if(isset($_GET[$parameter]))
                    {
                        $requestParameters[$parameter] = $_GET[$parameter];
                    }
                }
            }

            if(isset($_POST))
            {
                foreach($expectedParameters as $parameter)
                {
                    if(isset($_POST[$parameter]))
                    {
                        $requestParameters[$parameter] = $_POST[$parameter];
                    }
                }
            }

            return $requestParameters;
        }
    }