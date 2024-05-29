<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OmiseCharge;
use Throwable;

class OmiseController extends Controller
{
    public function checkout(Request $request): JsonResponse
    {
        /** @var \App\Models\Invoice $invoice */
        $invoice = Invoice::findOrFail($request->input('invoice_id'));

        if ($invoice->status !== Invoice::STATUS_PENDING_PAYMENT) {
            abort(Response::HTTP_BAD_REQUEST, 'Invalid invoice status.');
        }

        /** @var \App\Models\Course $course */
        $course = $invoice->course;

        try {
            /** @var string|null $publicKey */
            $publicKey = config('services.omise.public_key');

            /** @var string|null $secretKey */
            $secretKey = config('services.omise.secret_key');

            $charge = OmiseCharge::create(
                [
                    'amount'   => $course->amount * 100,
                    'currency' => 'JPY',
                    'card'     => $request->input('token'),
                    'metadata' => [
                        'invoice_id' => $invoice->id,
                    ],
                ],
                $publicKey,
                $secretKey
            );

            if ($charge['status'] === 'successful') {
                $invoice->update([
                    'status'          => Invoice::STATUS_PAID,
                    'omise_charge_id' => $charge['id'],
                ]);
            } else {
                $failureMessage = $charge['failure_message'] ?? '';

                assert(is_string($failureMessage));

                abort(Response::HTTP_BAD_REQUEST, $failureMessage);
            }
        } catch (Throwable $throwable) {
            abort(Response::HTTP_BAD_REQUEST, $throwable->getMessage());
        }

        return response()->json([
            'data' => $invoice->refresh(),
        ]);
    }
}
