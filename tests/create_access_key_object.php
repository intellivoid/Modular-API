<?php
    define('SOURCE_DIRECTORY', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR);
    require SOURCE_DIRECTORY . 'ModularAPI' . DIRECTORY_SEPARATOR . 'ModularAPI.php';

    $AccessKey = new \ModularAPI\Objects\AccessKey();
    $AccessKey->ID = 'test';

    var_dump($AccessKey);