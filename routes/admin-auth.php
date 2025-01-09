<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedAdminSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\UtilitiesController;
use Illuminate\Support\Facades\Route;





Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('/register', [RegisteredAdminController::class, 'create'])
        ->name('admin.auth.register');

    Route::post('/register', [RegisteredAdminController::class, 'store']);

    Route::get('/login', [AuthenticatedAdminSessionController::class, 'create'])
        ->name('admin.auth.login');

    Route::post('/login', [AuthenticatedAdminSessionController::class, 'store']);
});


Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::redirect("/admin", "/admin/dashboard");


    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/table', function () {
        return view('admin.datatable.index');
    })->name('admin.datatable.index');

    Route::get('/chart', function () {
        return view('admin.chart.index');
    })->name('admin.chart.index');

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/show/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::post('/products/update/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::post('/products/destroy/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/404', function () {
        return view('admin.pages.404');
    })->name('admin.pages.404');

    Route::get('/utilities/animation', [UtilitiesController::class, 'animation'])->name('admin.utilities.animation');
    Route::get('/utilities/border', [UtilitiesController::class, 'border'])->name('admin.utilities.border');
    Route::get('/utilities/color', [UtilitiesController::class, 'color'])->name('admin.utilities.color');
    Route::get('/utilities/other', [UtilitiesController::class, 'other'])->name('admin.utilities.other');

    Route::post('/logout', [AuthenticatedAdminSessionController::class, 'destroy'])->name('admin.logout');
});
