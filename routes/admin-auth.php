<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedAdminSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\admin\UserController;
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

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/show/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/update/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::post('/users/destroy/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/show/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/update/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::post('/products/destroy/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/404', function () {
        return view('admin.errors.404');
    })->name('admin.errors.404');

    Route::post('/logout', [AuthenticatedAdminSessionController::class, 'destroy'])->name('admin.logout');
});
