<?php

declare(strict_types=1);

use Commission\Calculation\Application;
use Commission\Calculation\Exceptions\InputValidationException;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Receive csv file location argument
 */
if (!isset($argv[1])) {
    die("you are missing to pass first argument which is csv file location.");
}

try {
    /**
     * print a string from application
     */
    echo Application::create(false)
        ->parse($argv[1]);
} catch (InputValidationException $e) {
    die("Please check csv file contents properly, invalid data found.");
} catch (Exception $e) {
    die(sprintf('Unexpected error: "%s".', $e->getMessage()));
}
