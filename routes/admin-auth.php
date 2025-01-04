<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UtilitiesController;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('admin.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('admin.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/table', function () {
        return view('admin.datatable.index');
    })->name('admin.datatable.index');

    Route::get('/chart', function () {
        return view('admin.chart.index');
    })->name('admin.chart.index');

    Route::get('/components/buttons', function () {
        return view('admin.components.buttons');
    })->name('admin.components.buttons');

    Route::get('/components/cards', function () {
        return view('admin.components.cards');
    })->name('admin.components.cards');

    Route::get('/utilities/animation', [UtilitiesController::class, 'animation'])->name('admin.utilities.animation');
    Route::get('/utilities/border', [UtilitiesController::class, 'border'])->name('admin.utilities.border');
    Route::get('/utilities/color', [UtilitiesController::class, 'color'])->name('admin.utilities.color');
    Route::get('/utilities/other', [UtilitiesController::class, 'other'])->name('admin.utilities.other');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});
