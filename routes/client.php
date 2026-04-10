<?php

/* CLIENT */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientDashboardController;
use App\Http\Controllers\Client\ClientOrderController;
use App\Http\Controllers\Client\ClientProfileController;
use App\Http\Controllers\Client\ClientReviewController;
use App\Http\Controllers\Client\ClientServiceController;

Route::prefix('clients')->name('clients.')->middleware('auth:client')->group(function () {
	/* client -- Dashboard */
	Route::get('dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');

	/* client -- profile */
	Route::prefix('profile')->name('profile.')->group(function () {
		Route::get('/', [ClientProfileController::class, 'index'])->name('index');
		Route::post('image', [ClientProfileController::class, 'saveImg'])->name('image.store');
		Route::post('{action}', [ClientProfileController::class, 'update'])->name('update');
		Route::get('password/check', [ClientProfileController::class, 'verifyPassword'])->name('password.check');
	});

	/* client -- service listing */
	Route::prefix('services')->name('services.')->group(function () {
		Route::get('/', [ClientServiceController::class, 'serviceListing'])->name('index');
		Route::get('list', [ClientServiceController::class, 'show'])->name('list');
		Route::get('{id}', [ClientServiceController::class, 'index'])->name('form');
		Route::post('/', [ClientServiceController::class, 'store'])->name('store');
		Route::post('update', [ClientServiceController::class, 'update'])->name('update');
		Route::post('image', [ClientServiceController::class, 'saveImg'])->name('image.store');
	});

	/* client -- reviews */
	Route::get('reviews', [ClientReviewController::class, 'index'])->name('reviews.index');

	/* client -- Manage Orders */
	Route::prefix('orders')->name('orders.')->group(function () {
		Route::get('/', [ClientOrderController::class, 'index'])->name('index');
		Route::get('list', [ClientOrderController::class, 'show'])->name('list');
	});
});
