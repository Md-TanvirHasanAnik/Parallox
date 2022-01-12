<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/', [HomeController::class , 'index'])->name('index');

Route::middleware(['auth:sanctum', 'verified', 'active'])->group(function () {
    Route::get('/dashboard', [HomeController::class , 'dashboard'])->name('dashboard');
    Route::resource('posts', PostController::class);

    
});

Route::middleware(['auth:sanctum', 'verified', 'admin.staff'])->group(function () {
    Route::post('posts/make-active/{id}', [PostController::class , "makeActive"])->name('posts.active');
    Route::post('posts/make-inactive/{id}', [PostController::class , "makeInactive"])->name('posts.inactive');
});    

