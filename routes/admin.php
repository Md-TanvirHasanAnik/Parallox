<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware(['auth:sanctum', 'verified', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class , 'dashboard'])->name('dashboard');

    Route::prefix('user')->as('user.')->group(function () {
        Route::post('make-active/{id}', [AdminController::class , 'makeActive'])->name('make.active');
        Route::post('make-inactive/{id}', [AdminController::class , 'makeInactive'])->name('make.inactive');
        Route::post('make-user/{id}', [AdminController::class , 'makeUser'])->name('make.user');
        Route::post('make-staff/{id}', [AdminController::class , 'makeStaff'])->name('make.staff');
    });
});
