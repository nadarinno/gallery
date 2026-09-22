<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('gallery.index')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {

    Route::get('/gallery', [GalleryController::class, 'index'])
        ->name('gallery.index');

    Route::post('/gallery/single', [GalleryController::class, 'storeSingle'])
        ->name('gallery.single');

    Route::post('/gallery/multiple', [GalleryController::class, 'storeMultiple'])
        ->name('gallery.multiple');

    Route::get('/gallery/{id}', [GalleryController::class, 'show'])
        ->name('gallery.show');

    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])
        ->name('gallery.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});