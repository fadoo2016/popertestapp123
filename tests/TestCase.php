<?php

declare(strict_types=1);

namespace Tests;

use Baijunyao\LaravelTestSupport\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
