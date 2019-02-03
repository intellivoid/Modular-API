<?php

    namespace ModularAPI\Objects;
    use ModularAPI\Abstracts\HTTP\ResponseCode\ClientError;
    use ModularAPI\Abstracts\HTTP\ResponseCode\Information;
    use ModularAPI\Abstracts\HTTP\ResponseCode\Redirect;
    use ModularAPI\Abstracts\HTTP\ResponseCode\ServerError;
    use ModularAPI\Abstracts\HTTP\ResponseCode\Successful;

    /**
     * Class HTTPResponse
     * @package ModularAPI\Objects
     */
    class HTTPResponse
    {
        /**
         * @var string
         */
        public $ContentType;

        /**
         * @var int
         */
        public $ContentLength;

        /**
         * @var int|ClientError|Information|Redirect|ServerError|Successful
         */
        public $ResponseCode;

        /**
         * @var mixed
         */
        public $Content;

    }