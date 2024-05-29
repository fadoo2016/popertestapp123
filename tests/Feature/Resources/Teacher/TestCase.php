<?php

declare(strict_types=1);

namespace Tests\Feature\Resources\Teacher;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Laravel\Passport\Passport;

abstract class TestCase extends \Tests\Feature\Resources\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Passport::actingAs(User::findOrFail(UserSeeder::USER_ID_TEACHER));
    }
}
