<?php

declare(strict_types=1);

namespace Commission\Calculation;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Application
{
    public function __construct() {
    }

    /**
     *
     * @throws Exception
     */
    public static function create(): Application
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '\config'));
        $loader->load('services.yaml');

        $container->compile();

        return $container->get(Application::class);
    }
}
