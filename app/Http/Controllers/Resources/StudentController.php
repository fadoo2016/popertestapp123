<?php

declare(strict_types=1);

namespace App\Http\Controllers\Resources;

use App\Models\User;
use Baijunyao\LaravelRestful\Traits\Index;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder as SpatieQueryBuilder;

class StudentController extends Controller
{
    use Index;
    protected const PER_PAGE = 1000;

    protected function getResourceName(): string
    {
        return 'User';
    }

    /**
     * @param EloquentBuilder<User>|null $builder
     */
    protected function makeQueryBuilder(?EloquentBuilder $builder = null): SpatieQueryBuilder
    {
        $parentBuilder = parent::makeQueryBuilder($builder);

        $user = auth()->user();

        if ($user === null) {
            abort(Response::HTTP_UNAUTHORIZED, 'User is not authenticated.');
        }

        if ($user->isTeacher()) {
            $parentBuilder->where('teacher_user_id', $user->id);
        } else {
            abort(Response::HTTP_FORBIDDEN, 'User is not a teacher.');
        }

        return $parentBuilder;
    }
}
