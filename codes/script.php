<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

if (!isset($argv[1])) {
    die("you are missing to pass first argument which is csv file location.");
};
