<?php

declare(strict_types=1);

include __DIR__ . '/vendor/autoload.php';

$finder = \PhpCsFixer\Finder::create()
    ->in(['src'])
;

$config = new PhpCsFixer\Config();
    return $config->setRules([
        '@Symfony' => true,
        'no_alternative_syntax' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'declare_strict_types' => true,
        'yoda_style' => false,
    ])
    ->setFinder($finder)
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
;
