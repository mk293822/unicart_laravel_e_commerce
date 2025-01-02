<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect("/", "/dashboard")->name("dashboard");

Route::get("/about", function () {
    return view("about.index");
})->name("about.index");

Route::get("/contact", function () {
    return view("contact.index");
})->name("contact.index");

Route::middleware(["auth", "verified"])->group(function () {
    Route::get("/dashboard", [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get("/dashboard/{product}", [DashboardController::class, 'show'])->name('dashboard.show');
    Route::post("/dashboard/add_cart", [DashboardController::class, 'add_cart'])->name('dashboard.add_cart');
    Route::post("/dashboard", [DashboardController::class, 'store'])->name('dashboard.store');
});

Route::middleware(["auth", "verified"])->group(function () {
    Route::resource("/order", OrderController::class)->names(["index", "order"]);
});

Route::middleware(["auth", "verified"])->group(function () {
    Route::resource("/cart", CartController::class)->names(["index", "cart"]);
    Route::post("/cart", [CartController::class, "updateQuantity"])->name("cart.updateQuantity");
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
