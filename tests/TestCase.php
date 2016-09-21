<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseCase;

abstract class TestCase extends BaseCase
{
    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        // TODO: Implement createApplication() method.
    }
}