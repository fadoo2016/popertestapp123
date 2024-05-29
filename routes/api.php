<?php

declare(strict_types=1);

use App\Http\Controllers\OmiseController;
use App\Http\Controllers\Resources\CourseController;
use App\Http\Controllers\Resources\InvoiceController;
use App\Http\Controllers\Resources\StudentController;
use App\Http\Controllers\Resources\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::resource('/users', UserController::class)->only('show');
    Route::resource('courses', CourseController::class)->only('index', 'store');
    Route::resource('invoices', InvoiceController::class)->only('index', 'store', 'update');
    Route::resource('students', StudentController::class)->only('index');
    Route::post('omise/checkout', [OmiseController::class, 'checkout']);
});
