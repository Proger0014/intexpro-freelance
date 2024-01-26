<?php

namespace Tests;

use Database\Seeders\Tests\DatabaseSeederDefault as TestDatabaseSeederDefault;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected bool $seed = true;

    /**
     * @var class-string
     */
    protected string $seeder = TestDatabaseSeederDefault::class;
}
