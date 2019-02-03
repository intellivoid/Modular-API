<?php

    namespace ModularAPI\HTTP;
    use ModularAPI\Exceptions\InvalidRequestQueryException;
    use ModularAPI\Exceptions\UnsupportedClientException;
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
                $RequestQuery = new RequestQuery();
                $RequestQuery->Version = $QueryParts[0];
                $RequestQuery->Module = $QueryParts[1];
                $RequestQuery->RequestMethod = strtoupper($_SERVER['REQUEST_METHOD']);

                return $RequestQuery;
            }

            throw new InvalidRequestQueryException();
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