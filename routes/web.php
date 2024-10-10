<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function (Request $request) {
    return view('dashboard',['user' => $request->user()]);
})->middleware(['logrequest','auth', 'verified'])->name('dashboard');


Route::middleware(['logrequest','auth'])->group(function () {
    Route::get('/users/{page?}', [UserController::class, 'list'])->middleware(IsAdmin::class)->name('user.list');
    Route::get('/user/create', [UserController::class, 'create'])->middleware(IsAdmin::class)->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->middleware(IsAdmin::class);
    Route::get('/edit/{user}', [UserController::class, 'edit'])->middleware(IsAdmin::class)->name('user.edit');
    Route::patch('/edit/{user}', [UserController::class, 'update'])->middleware(IsAdmin::class)->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'remove'])->middleware(IsAdmin::class)->name('user.delete');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
