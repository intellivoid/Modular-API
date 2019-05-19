<?php
    define('SOURCE_DIRECTORY', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR);
    require SOURCE_DIRECTORY . 'ModularAPI' . DIRECTORY_SEPARATOR . 'ModularAPI.php';

    $Issuer = 'Example Company';

    $FirstGeneration = \ModularAPI\Utilities\Hashing::generateTimeSignature(time(), $Issuer);
    $SecondGeneration = \ModularAPI\Utilities\Hashing::generateTimeSignature(time(), $Issuer);
    $ThirdGeneration = \ModularAPI\Utilities\Hashing::generateTimeSignature(time(), $Issuer);

    print("First Generation: $FirstGeneration\r\n");
    print("Second Generation: $SecondGeneration\r\n");
    print("Third Generation: $ThirdGeneration\r\n");