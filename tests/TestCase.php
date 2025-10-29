<?php

namespace Tests;

require_once __DIR__ . '/../app.php';

use Hyperf\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->createApplication();
    }
}
