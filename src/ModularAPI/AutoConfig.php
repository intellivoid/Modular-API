<?php

    use acm\acm;
    use acm\Objects\Schema;

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