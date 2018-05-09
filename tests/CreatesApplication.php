<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Faker\Generator as Faker;

trait CreatesApplication
{
    /**
     * The faker generator instance
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $this->faker = $app->make(Faker::class);

        return $app;
    }
}
