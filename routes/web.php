<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/', [HomeController::class , 'index'])->name('index');

Route::middleware(['auth:sanctum', 'verified', 'active'])->group(function () {
    Route::get('/dashboard', [HomeController::class , 'dashboard'])->name('dashboard');
    Route::post('posts', [PostController::class , 'store'])->name('posts.store');
    Route::post('comment/{id}', [CommentController::class , 'comment'])->name('comment');
    Route::post('reply/{id}', [CommentController::class , 'reply'])->name('reply');
});

Route::middleware(['auth:sanctum', 'verified', 'active', 'admin.staff'])->group(function () {
    Route::get('staff/dashboard', [StaffController::class , 'dashboard'])->name('staff.dashboard');

    Route::prefix('posts')->as('posts.')->group( function() {
        Route::get('/', [PostController::class , "index"])->name('index');
        Route::delete('/{id}', [PostController::class , "destroy"])->name('destroy');
        Route::post('/make-active/{id}', [PostController::class , "makeActive"])->name('active');
        Route::post('/make-inactive/{id}', [PostController::class , "makeInactive"])->name('inactive');
    });
});    

