<?php

namespace Tests;


use Hyperf\Context\ApplicationContext;

trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication()
    {
        ApplicationContext::setContainer(app()->getContainer());
    }
}
