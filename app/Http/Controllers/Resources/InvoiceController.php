<?php

declare(strict_types=1);

namespace App\Http\Controllers\Resources;

use App\Models\Invoice;
use Baijunyao\LaravelRestful\Traits\Index;
use Baijunyao\LaravelRestful\Traits\Store;
use Baijunyao\LaravelRestful\Traits\Update;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder as SpatieQueryBuilder;

class InvoiceController extends Controller
{
    use Index;
    use Store;
    use Update;

    protected const RELATIONS = [
        'student',
        'course',
    ];

    protected const SORTS = [
        'id',
    ];

    protected const FIELDS = [
        'id',
        'teacher_user_id',
        'student_user_id',
        'course_id',
        'status',
        'student',
        'course',
    ];

    /**
     * @param EloquentBuilder<Invoice>|null $builder
     */
    protected function makeQueryBuilder(?EloquentBuilder $builder = null): SpatieQueryBuilder
    {
        $parentBuilder = parent::makeQueryBuilder($builder);

        $user = auth()->user();

        if ($user === null) {
            abort(Response::HTTP_UNAUTHORIZED, 'User is not authenticated.');
        }

        if ($user->isStudent()) {
            $parentBuilder->where('status', '!=', Invoice::STATUS_CREATED);
        }

        return $parentBuilder;
    }
}
