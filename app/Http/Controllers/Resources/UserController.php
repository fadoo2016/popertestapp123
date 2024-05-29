<?php

declare(strict_types=1);

namespace App\Http\Controllers\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function show(string|int $id): UserResource
    {
        if ($id === 'me') {
            return new UserResource(auth()->user(), __CLASS__);
        }

        abort(Response::HTTP_FORBIDDEN, 'You are not authorized to access this resource.');
    }
}
