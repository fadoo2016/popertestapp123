<?php

declare(strict_types=1);

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public const COURSE_ID_OTHER_TEACHER           = 1;
    public const COURSE_ID_INVOICE_PAID            = 2;
    public const COURSE_ID_INVOICE_PENDING_PAYMENT = 3;
    public const COURSE_ID_INVOICE_CREATED         = 4;
    public const COURSE_ID_INVOICE_NOT_CREATE      = 5;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'teacher_user_id' => 4,
                'student_user_id' => 5,
                'name'            => 'Course of teacher 4',
                'date'            => '2024-05-01',
                'amount'          => 202,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'teacher_user_id' => 2,
                'student_user_id' => 3,
                'name'            => 'Invoice paid',
                'date'            => '2024-06-01',
                'amount'          => 101,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'teacher_user_id' => 2,
                'student_user_id' => 3,
                'name'            => 'Invoice pending payment',
                'date'            => '2024-07-01',
                'amount'          => 303,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'teacher_user_id' => 2,
                'student_user_id' => 3,
                'name'            => 'Invoice created',
                'date'            => '2024-08-01',
                'amount'          => 303,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'teacher_user_id' => 2,
                'student_user_id' => 3,
                'name'            => 'Invoice not create',
                'date'            => '2024-08-01',
                'amount'          => 303,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}
