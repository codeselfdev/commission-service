<?php

declare(strict_types=1);

namespace Commission\Calculation\Tests;

use Commission\Calculation\Application;
use Exception;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{

    /**
     * App instance
     *
     * @var Application
     */
    private Application $app;

    /**
     * Creating test app
     *
     * @throws Exception
     * @return Application
     */
    public function getApplication(): Application
    {
        if (!isset($this->app)) {
            $this->app = Application::create(true);
        }
        return $this->app;
    }
}
