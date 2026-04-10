<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ClientOrderController;
use App\Http\Controllers\Customer\ClientDetailController;
use App\Http\Controllers\Customer\ClientListingController;
use App\Http\Controllers\Customer\ConfirmOrderController;
use App\Http\Controllers\Customer\CustomerOrderController;
use App\Http\Controllers\Customer\UserProfileController;
use App\Http\Controllers\Customer\CustomerReviewController;

Route::prefix('customers')->name('customers.')->group(function () {
    
    /* customer -- client listing */
    Route::prefix('clients')->name('clients.')->group(function () {
        Route::get('/', [ClientListingController::class, 'index'])->name('index');
        Route::get('filter/{id}', [ClientListingController::class, 'filter'])->name('filter');
        Route::get('{id}', [ClientDetailController::class, 'index'])->name('show');
    });

    Route::middleware('auth:customer')->group(function () {
        /* customer -- profile */
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [UserProfileController::class, 'index'])->name('show');
            Route::post('/', [UserProfileController::class, 'update'])->name('update');
        });

        /* customer -- orders */
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [CustomerOrderController::class, 'index'])->name('index');
            Route::post('update', [CustomerOrderController::class, 'update'])->name('update');
            Route::post('book/{id}', [ClientOrderController::class, 'store'])->name('book');
            Route::post('confirm/{id}', [ClientOrderController::class, 'create'])->name('confirm.store');
            Route::get('confirm/{id}', [ConfirmOrderController::class, 'index'])->name('confirm.show');

            Route::get('confirmed/{id}', function ($id) {
                return view('pages/client_user/user/confirm-msg', ['orderId' => $id]);
            })->name('confirm.success');
            
            Route::get('invoice/{order_id}', [ConfirmOrderController::class, 'getInvoice'])->name('invoice');
        });

        /* customer -- reviews */
        Route::prefix('reviews')->name('reviews.')->group(function () {
            Route::get('{id}', [CustomerReviewController::class, 'index'])->name('show');
            Route::post('{id}', [CustomerReviewController::class, 'submit'])->name('store');
            Route::post('{id}/update', [CustomerReviewController::class, 'update'])->name('update');
        });
    });
});
