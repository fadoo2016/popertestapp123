<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Laravel\Passport\Passport;

class UserControllerTest extends TestCase
{
    public function testShowTeacher(): void
    {
        Passport::actingAs(User::findOrFail(UserSeeder::USER_ID_TEACHER));

        $this->assertResponse($this->getJson(route('users.show', ['user' => 'me'])));
    }

    public function testShowStudent(): void
    {
        Passport::actingAs(User::findOrFail(UserSeeder::USER_ID_STUDENT));

        $this->assertResponse($this->getJson(route('users.show', ['user' => 'me'])));
    }

    public function testShowOtherUserForbidden()
    {
        Passport::actingAs(User::findOrFail(UserSeeder::USER_ID_STUDENT));

        $this->getJson(route('users.show', ['user' => 1]))
            ->assertStatus(403)
            ->assertJsonFragment([
                'message' => 'You are not authorized to access this resource.',
            ]);
    }

    public function testShowGuestError()
    {
        $this->getJson(route('users.show', ['user' => 1]))
            ->assertStatus(401)
            ->assertJsonFragment([
                'message' => 'Unauthenticated.',
            ]);
    }
}
