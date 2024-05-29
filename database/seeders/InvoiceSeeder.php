<?php

declare(strict_types=1);

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public const INVOICE_ID_PAID            = 2;
    public const INVOICE_ID_PENDING_PAYMENT = 3;
    public const INVOICE_ID_CREATED         = 4;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('invoices')->insert([
            [
                'teacher_user_id' => 4,
                'student_user_id' => 5,
                'course_id'       => 1,
                'status'          => 100,
                'omise_charge_id' => '',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'teacher_user_id' => 2,
                'student_user_id' => 3,
                'course_id'       => 2,
                'status'          => 300,
                'omise_charge_id' => 'charge_id_1',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'teacher_user_id' => 2,
                'student_user_id' => 3,
                'course_id'       => 3,
                'status'          => 200,
                'omise_charge_id' => '',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'teacher_user_id' => 2,
                'student_user_id' => 3,
                'course_id'       => 4,
                'status'          => 100,
                'omise_charge_id' => '',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}
