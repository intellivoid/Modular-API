<?php

    use acm\acm;
    use acm\Objects\Schema;

    if(class_exists('acm\acm') == false)
    {
        include_once(__DIR__ . DIRECTORY_SEPARATOR . 'acm' . DIRECTORY_SEPARATOR . 'acm.php');
    }

    $acm = new acm(__DIR__, 'ModularAPI');

    $DatabaseSchema = new Schema();
    $DatabaseSchema->setDefinition('Host', 'localhost');
    $DatabaseSchema->setDefinition('Port', '3306');
    $DatabaseSchema->setDefinition('Username', 'root');
    $DatabaseSchema->setDefinition('Password', '');
    $DatabaseSchema->setDefinition('Name', 'api');

    $ModularApiSchema = new Schema();
    $ModularApiSchema->setDefinition('IssuerName', 'example');

    $acm->defineSchema('Database', $DatabaseSchema);
    $acm->defineSchema('ModularAPI', $ModularApiSchema);

    $acm->processCommandLine();