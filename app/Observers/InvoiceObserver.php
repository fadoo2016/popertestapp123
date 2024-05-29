<?php

namespace App\Observers;

use App\Models\Course;
use App\Models\Invoice;
use Illuminate\Http\Response;

class InvoiceObserver
{
    /**
     * Handle the Course "created" event.
     */
    public function creating(Invoice $invoice): void
    {
        $course = Course::findOrFail($invoice->course_id);

        if ($course->invoice !== null) {
            abort(Response::HTTP_BAD_REQUEST, 'Invoice already created for this course.');
        }

        $userId = auth()->id();

        if ($course->teacher_user_id !== $userId) {
            abort(Response::HTTP_FORBIDDEN, 'You are not allowed to create invoice for this course.');
        }

        $invoice->teacher_user_id = $userId;
        $invoice->student_user_id = $course->student_user_id;
    }
}
