<?php
    function Module(\ModularAPI\Objects\AccessKey $accessKey, array $Parameters)
    {
        print(json_encode($Parameters));
        exit();
    }