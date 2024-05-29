<?php

declare(strict_types=1);

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class OauthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('oauth_clients')->insert([
            [
                'name'                   => 'Laravel Password Grant Client',
                'secret'                 => '',
                'provider'               => 'users',
                'redirect'               => 'http://localhost',
                'personal_access_client' => 0,
                'password_client'        => 1,
                'revoked'                => 0,
                'created_at'             => now(),
                'updated_at'             => now(),
            ],
        ]);
    }
}
