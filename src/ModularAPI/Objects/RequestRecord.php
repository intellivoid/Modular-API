<?php

    namespace ModularAPI\Objects;

    /**
     * Class RequestLog
     * @package ModularAPI\Objects
     */
    class RequestRecord
    {
        /**
         * The ID of the request
         *
         * @var int
         */
        public $ID;

        /**
         * The Unix Timestamp of this Request
         *
         * @var int
         */
        public $Timestamp;

        /**
         * The execution time for this request
         *
         * @var float|int
         */
        public $ExecutionTime;

        /**
         * The refrence ID of the request
         *
         * @var int
         */
        public $RefrenceID;

        /**
         * The version of the API
         *
         * @var string
         */
        public $Version;

        /**
         * The requested module for the request
         *
         * @var string
         */
        public $Module;

        /**
         * The request method that was used
         *
         * @var string
         */
        public $RequestMethod;

        /**
         * The parameters used in the request
         *
         * @var array
         */
        public $RequestParameters;

        /**
         * The response type given to the client
         *
         * @var string
         */
        public $ResponseType;

        /**
         * The response length
         *
         * @var int
         */
        public $ResponseLength;

        /**
         * The HTTP Response Code
         *
         * @var int
         */
        public $ResponseCode;

        /**
         * Indicates if the request was a fatal error
         *
         * @var bool
         */
        public $FatalError;

        /**
         * The exception details with further details
         *
         * @var ExceptionDetails
         */
        public $ExceptionDetails;

        /**
         * Converts object to array
         *
         * @return array
         */
        public function toArray(): array
        {
            return array(
                'id' => $this->ID,
                'timestamp' => $this->Timestamp,
                'execution_time' => $this->ExecutionTime,
                'refrence_id' => $this->RefrenceID,
                'version' => $this->Version,
                'module' => $this->Module,
                'request_method' => $this->RequestMethod,
                'request_parameters' => $this->RequestParameters,
                'response_type' => $this->ResponseType,
                'response_length' => $this->ResponseLength,
                'response_code' => $this->ResponseCode,
                'fatal_error' => $this->FatalError,
                'exception_details' => $this->ExceptionDetails->toArray()
            );
        }

        public static function fromArray(array $data): RequestRecord
        {
            $RequestRecordObject = new RequestRecord();

            if(isset($data['id']))
            {
                $RequestRecordObject->ID = (int)$data['id'];
            }
            else
            {
                $RequestRecordObject->ID = 0;
            }

            if(isset($data['timestamp']))
            {
                $RequestRecordObject->Timestamp = (int)$data['timestamp'];
            }
            else
            {
                $RequestRecordObject->Timestamp = 0;
            }

            if(isset($data['execution_time']))
            {
                $RequestRecordObject->ExecutionTime = (float)$data['execution_time'];
            }
            else
            {
                $RequestRecordObject->ExecutionTime = 0;
            }

            if(isset($data['reference_id']))
            {
                $RequestRecordObject->RefrenceID = (string)$data['reference_id'];
            }

            if(isset($data['version']))
            {
                $RequestRecordObject->Version = (string)$data['version'];
            }

            if(isset($data['module']))
            {
                $RequestRecordObject->Module = (string)$data['module'];
            }

            if(isset($data['request_method']))
            {
                $RequestRecordObject->RequestMethod = (string)$data['request_method'];
            }

            if(isset($data['request_parameters']))
            {
                $RequestRecordObject->RequestParameters = $data['request_parameters'];
            }
            else
            {
                $RequestRecordObject->RequestParameters = [];
            }

            if(isset($data['response_type']))
            {
                $RequestRecordObject->ResponseType = $data['response_type'];
            }

            if(isset($data['response_length']))
            {
                $RequestRecordObject->ResponseLength = (int)$data['response_length'];
            }

            if(isset($data['response_code']))
            {
                $RequestRecordObject->ResponseCode = (int)$data['response_code'];
            }

            if(isset($data['fatal_error']))
            {
                $RequestRecordObject->FatalError = (bool)$data['fatal_error'];
            }
            else
            {
                $RequestRecordObject->FatalError = false;
            }

            if(isset($data['exception_details']))
            {
                $RequestRecordObject->ExceptionDetails = ExceptionDetails::fromArray($data['exception_details']);
            }
            else
            {
                $RequestRecordObject->ExceptionDetails = ExceptionDetails::fromArray([]);
            }

            return $RequestRecordObject;
        }
    }