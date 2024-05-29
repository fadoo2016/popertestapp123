<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\User;
use Database\Seeders\InvoiceSeeder;
use Database\Seeders\UserSeeder;
use Laravel\Passport\Passport;
use Mockery;
use OmiseCharge;

class OmiseControllerTest extends TestCase
{
    public function testCheckout(): void
    {
        Passport::actingAs(User::findOrFail(UserSeeder::USER_ID_STUDENT));

        $omiseToken    = 'tokn_test_123';
        $omiseChargeId = 'chrg_test_456';

        $omiseCharge = Mockery::mock('overload:' . OmiseCharge::class);
        $omiseCharge->shouldReceive('create')->andReturn([
            'status' => 'successful',
            'id'     => $omiseChargeId,
        ]);

        $this->assertDatabaseHas(
            'invoices',
            [
                'id'              => InvoiceSeeder::INVOICE_ID_PENDING_PAYMENT,
                'status'          => Invoice::STATUS_PENDING_PAYMENT,
                'omise_charge_id' => '',
            ]
        );

        $this->postJson(
            '/api/omise/checkout',
            [
                'invoice_id' => InvoiceSeeder::INVOICE_ID_PENDING_PAYMENT,
                'token'      => $omiseToken,
            ]
        )->assertStatus(200);

        $this->assertDatabaseHas(
            'invoices',
            [
                'id'              => InvoiceSeeder::INVOICE_ID_PENDING_PAYMENT,
                'status'          => Invoice::STATUS_PAID,
                'omise_charge_id' => $omiseChargeId,
            ]
        );
    }
}
