<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public const USER_ID_ADMIN   = 1;
    public const USER_ID_TEACHER = 2;
    public const USER_ID_STUDENT = 3;

    public const PASSWORD_ADMIN   = 'Ne7V2j$Wgs&x';
    public const PASSWORD_TEACHER = '$2!TpCiRymGH';
    public const PASSWORD_STUDENT = 'hvA!pX6bH&b5';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $existingUsernames = DB::table('users')->pluck('username');

        $users = collect([
            [
                'teacher_user_id' => 0,
                'type'            => User::TYPE_DEFAULT,
                'username'        => 'admin',
                'password'        => Hash::make(static::PASSWORD_ADMIN),
                'name'            => 'Administrator',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'teacher_user_id' => 0,
                'type'            => User::TYPE_TEACHER,
                'username'        => 'teacher',
                'password'        => Hash::make(static::PASSWORD_TEACHER),
                'name'            => 'Teacher',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'teacher_user_id' => 2,
                'type'            => User::TYPE_STUDENT,
                'username'        => 'student',
                'password'        => Hash::make(static::PASSWORD_STUDENT),
                'name'            => 'Student',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'teacher_user_id' => 0,
                'type'            => User::TYPE_TEACHER,
                'username'        => 'teacher2',
                'password'        => Hash::make('HcJ%2P*7z^zC'),
                'name'            => 'Teacher2',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'teacher_user_id' => 4,
                'type'            => User::TYPE_STUDENT,
                'username'        => 'student2',
                'password'        => Hash::make('wvpL29qj#XqP'),
                'name'            => 'Student2',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ])->whereNotIn('username', $existingUsernames);

        foreach ($users as $user) {
            if ($existingUsernames->contains($user['username'])) {
                continue;
            }

            DB::table('users')->insert($user);
        }
    }
}
