<?php

declare(strict_types=1);

namespace Tests\Feature\Passport;

use Database\Seeders\UserSeeder;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Feature\Resources\TestCase;

class AccessTokenControllerTest extends TestCase
{
    public function testAdminLogin(): void
    {
        $this->postJson(
            '/oauth/token',
            [
                'grant_type'    => 'password',
                'client_id'     => 1,
                'scope'         => '',
                'username'      => 'admin',
                'password'      => UserSeeder::PASSWORD_ADMIN,
            ]
        )
            ->assertStatus(403)
            ->assertJsonFragment([
                'message' => 'Just teacher and student are allowed to login.',
            ]);
    }

    public static function userProvider(): array
    {
        return [
            ['teacher', UserSeeder::PASSWORD_TEACHER],
            ['student', UserSeeder::PASSWORD_STUDENT],
        ];
    }

    #[DataProvider('userProvider')]
    public function testLogin(string $username, string $password): void
    {
        $this->postJson(
            '/oauth/token',
            [
                'grant_type'    => 'password',
                'client_id'     => 1,
                'scope'         => '',
                'username'      => $username,
                'password'      => $password,
            ]
        )
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'token_type',
                    'expires_in',
                    'access_token',
                    'refresh_token',
                ]
            );
    }
}
