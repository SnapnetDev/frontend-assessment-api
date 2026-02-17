<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->prefix('v1')->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employee/{id}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.show');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
