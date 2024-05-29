<?php

declare(strict_types=1);

namespace Tests\Feature\Resources\Teacher;

use App\Models\Invoice;
use Baijunyao\LaravelTestSupport\Restful\TestIndex;
use Baijunyao\LaravelTestSupport\Restful\TestStore;
use Baijunyao\LaravelTestSupport\Restful\TestUpdate;
use Database\Seeders\CourseSeeder;
use Database\Seeders\InvoiceSeeder;
use PHPUnit\Framework\Attributes\DataProvider;

class InvoiceControllerTest extends TestCase
{
    use TestIndex;
    use TestStore;
    use TestUpdate;

    public int $updateId = InvoiceSeeder::INVOICE_ID_CREATED;

    public array $storeData = [
        'course_id' => CourseSeeder::COURSE_ID_INVOICE_NOT_CREATE,
    ];

    public array $updateData = [
        'status' => Invoice::STATUS_PENDING_PAYMENT,
    ];

    #[DataProvider('courseIdProvider')]
    public function testCreateInvoiceStatusError($courseId): void
    {
        $this->postJson(
            route('invoices.store'),
            [
                'course_id' => $courseId,
            ]
        )
            ->assertStatus(400)
            ->assertJsonFragment([
                'message' => 'Invoice already created for this course.',
            ]);
    }

    public static function courseIdProvider(): array
    {
        return [
            [CourseSeeder::COURSE_ID_INVOICE_PAID],
            [CourseSeeder::COURSE_ID_INVOICE_PENDING_PAYMENT],
            [CourseSeeder::COURSE_ID_INVOICE_CREATED],
        ];
    }

    public function testCreateInvoiceForbidden(): void
    {
        $this->postJson(
            route('invoices.store'),
            [
                'course_id' => CourseSeeder::COURSE_ID_OTHER_TEACHER,
            ]
        )
            ->assertStatus(404);
    }
}
