<?php
    define('SOURCE_DIRECTORY', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR);
    require SOURCE_DIRECTORY . 'ModularAPI' . DIRECTORY_SEPARATOR . 'ModularAPI.php';

    $ModularAPI = new \ModularAPI\ModularAPI();

    $AccessKey = $ModularAPI->AccessKeys()->createKey(
        \ModularAPI\Configurations\UsageConfiguration::dateIntervalLimit(
            10, 60
        ),
        \ModularAPI\Configurations\PermissionsConfiguration::specifyPermissions(
            ['CurrentTime', 'Version', 'KittenPicture']
        ),
        \ModularAPI\Abstracts\AccessKeyStatus::Activated
    );

    var_dump($AccessKey);