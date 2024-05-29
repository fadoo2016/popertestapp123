<?php

declare(strict_types=1);

namespace App\Models\Scopes;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Http\Response;

class InvoiceScope implements Scope
{
    /**
     * @param Builder<Invoice> $builder
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = auth()->user();

        if ($user === null) {
            abort(Response::HTTP_UNAUTHORIZED, 'User is not authenticated.');
        }

        if ($user->isTeacher()) {
            $builder->where('teacher_user_id', $user->id);
        } elseif ($user->isStudent()) {
            $builder->where('student_user_id', $user->id);
        } else {
            abort(Response::HTTP_FORBIDDEN, 'User is not a teacher or a student.');
        }
    }
}
