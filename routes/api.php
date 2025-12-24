<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CatController;
use App\Http\Controllers\Api\CatRequestController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::prefix('cats/{cat:slug}/request')
        ->name('cats.request')
        ->controller(CatRequestController::class)
        ->group(function () {
            Route::get('/', 'show')->name('show');
            Route::post('/', 'store')->name('store');
            Route::post('/cancel', 'cancel')->name('cancel');
        });

    Route::post('/cats/{cat:slug}/reviews', [ReviewController::class, 'store'])
        ->name('cats.reviews.store');
});

Route::prefix('cats')
    ->name('cats.')
    ->controller(CatController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::prefix('get')
            ->name('get.')
            ->group(function () {
                Route::get('/filters', 'getFilters')->name('filters');
                Route::get('/breeds', 'getBreeds')->name('breeds');
            });

        Route::get('/{cat:slug}', 'show')->name('show');
    });

Route::get('/cats/{cat:slug}/reviews', [ReviewController::class, 'index'])
    ->name('cats.reviews.index');

Route::prefix('posts')
    ->name('posts.')
    ->controller(PostController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{post:slug}', 'show')->name('show');
    });
