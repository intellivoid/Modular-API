<?php

    namespace ModularAPI\Abstracts;

    /**
     * Class AccessKeySearchMethod
     * @package ModularAPI\Abstracts
     */
    abstract class AccessKeySearchMethod
    {
        /**
         * Searches for Access Keys by Database ID
         */
        const byID = 'id';

        /**
         * Searches for Access Keys by Public ID's
         */
        const byPublicID = 'public_id';

        /**
         * Searches for Access Keys by Certificate
         */
        const byCertificate = 'certificate';
    }