<?php

declare(strict_types=1);

namespace App\Http\Controllers\Resources;

use Baijunyao\LaravelRestful\Traits\Index;
use Baijunyao\LaravelRestful\Traits\Store;

class CourseController extends Controller
{
    use Index;
    use Store;

    protected const RELATIONS = [
        'student',
        'invoice',
    ];

    protected const SORTS = [
        'id',
    ];

    protected const FIELDS = [
        'id',
        'name',
        'date',
        'amount',
        'student',
        'invoice',
    ];
}
