<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected function initDatabase(): void
    {
        Artisan::call('migrate');
        Artisan::call('db:seed'); // --class=...Seeder
    }

    protected function resetDatabase(): void
    {
        Artisan::call('migrate:reset');
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->initDatabase();
    }

    protected function tearDown(): void
    {
        $this->resetDatabase();
        parent::tearDown();
    }
}
