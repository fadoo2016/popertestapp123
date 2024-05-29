<?php

declare(strict_types=1);

namespace Tests\Feature\Resources\Student;

use Baijunyao\LaravelTestSupport\Restful\TestIndex;
use Database\Seeders\CourseSeeder;
use Database\Seeders\InvoiceSeeder;
use PHPUnit\Framework\Attributes\DataProvider;

class InvoiceControllerTest extends TestCase
{
    use TestIndex;

    #[DataProvider('courseIdProvider')]
    public function testStoreForbidden($courseId): void
    {
        $this->postJson(
            route('invoices.store'),
            [
                'course_id' => $courseId,
            ]
        )
            ->assertStatus(403)
            ->assertJsonFragment([
                'message' => 'This action is unauthorized.',
            ]);
    }

    public static function courseIdProvider(): array
    {
        return [
            [CourseSeeder::COURSE_ID_INVOICE_PAID],
            [CourseSeeder::COURSE_ID_INVOICE_PENDING_PAYMENT],
            [CourseSeeder::COURSE_ID_INVOICE_CREATED],
            [CourseSeeder::COURSE_ID_INVOICE_NOT_CREATE],
        ];
    }

    #[DataProvider('invoiceIdProvider')]
    public function testUpdateForbidden($invoiceId): void
    {
        $this->postJson(
            route('invoices.store'),
            [
                'status' => $invoiceId,
            ]
        )
            ->assertStatus(403)
            ->assertJsonFragment([
                'message' => 'This action is unauthorized.',
            ]);
    }

    public static function invoiceIdProvider(): array
    {
        return [
            [InvoiceSeeder::INVOICE_ID_PAID],
            [InvoiceSeeder::INVOICE_ID_PENDING_PAYMENT],
            [InvoiceSeeder::INVOICE_ID_CREATED],
        ];
    }
}
