<?php

    namespace ModularAPI\Utilities;

    /**
     * Class Hashing
     * @package ModularAPI\Utilities
     */
    class Hashing
    {
        /**
         * Peppers a hash using whirlpool
         *
         * @param string $Data The hash to pepper
         * @param int $Min Minimal amounts of executions
         * @param int $Max Maximum amount of executions
         * @return string
         */
        public static function pepper(string $Data, int $Min = 100, int $Max = 1000): string
        {
            $n = rand($Min, $Max);
            $res = '';
            $Data = hash('whirlpool', $Data);
            for ($i=0,$l=strlen($Data) ; $l ; $l--)
            {
                $i = ($i+$n-1) % $l;
                $res = $res . $Data[$i];
                $Data = ($i ? substr($Data, 0, $i) : '') . ($i < $l-1 ? substr($Data, $i+1) : '');
            }
            return($res);
        }


        /**
         * Constructs a unique month ID
         *
         * @param int $month
         * @param int $year
         * @return string
         */
        public static function createMonthID(int $month, int $year): string
        {
            $c_month = hash('sha256', $month);
            $c_year = hash('sha256', $year);

            return hash('haval256,3', "s_month=$c_month/$c_year");
        }

        public static function buildCertificateKey(string $IssuerName, string $PrivateSignature, string $PublicSignature): string
        {
            $KeyPart1 = hash('whirlpool', hash('haval256,4', $IssuerName) . hash('sha256', $PrivateSignature));
            $KeyPart2 = hash('whirlpool', hash('haval256,3', $IssuerName) . hash('sha256', $PublicSignature));
            $KeyPart3 = hash('whirlpool', $KeyPart1);
            $KeyPart4 = hash('whirlpool', $KeyPart2);
            $KeyPart5 = hash('haval128,4', hash('haval192,5', $KeyPart1) . hash('haval224,5', $KeyPart2));
            $KeyPart6 = hash('crc32b', hash('haval192,5', $KeyPart3) . hash('sha256', $KeyPart1));

            return("$KeyPart1$KeyPart2($KeyPart3$KeyPart4)^$KeyPart5-$KeyPart6/$IssuerName");
        }
    }