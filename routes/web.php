<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('home'))->name("index");

Route::middleware("guest")->group(function () {
    Route::get('/sign-in', fn() => view('sign-in'))->name("login");
    Route::post('/sign-in', [AuthController::class, "signIn"]);

    Route::get('/sign-up', fn() => view('sign-up'))->name("signup");
    Route::post('/sign-up', [AuthController::class, "signUp"]);
});

Route::middleware("auth")->group(function () {
    Route::get('/logout', [AuthController::class, "logout"])->name("logout");
    Route::get('/profile', fn() => view('profile'))->name("profile");
});