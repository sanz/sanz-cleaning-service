<?php

/******************
 *   ADMIN
 ******************/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiceOrderController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceCatalogController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServicePriceController;
use App\Http\Controllers\Admin\ServiceReviewController;
use Illuminate\Support\Facades\Auth;

Route::prefix('admin')->group(function () {
    Auth::routes(['register' => false]);

    Route::get('dashboard', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard');
    Route::post('dashboard/order-details', [DashboardController::class, 'orderDetails'])->name('dashboard.order-details');

    /** Admin -- service-catalog */
    Route::get('service-catalog', [ServiceCatalogController::class, 'index'])->name('service-catalog');
    Route::post('service-store', [ServiceCatalogController::class, 'store'])->name('service-store');
    Route::post('service-update', [ServiceCatalogController::class, 'update'])->name('service-update');
    Route::post('service-destroy', [ServiceCatalogController::class, 'destroy'])->name('service-destroy');
    Route::post('service-retrieve', [ServiceCatalogController::class, 'retrieve'])->name('service-retrieve');
    Route::post('service-store-img', [ServiceCatalogController::class, 'saveImg']);

    /** Admin -- service-prices */
    Route::get('service-prices', [ServicePriceController::class, 'index']);
    Route::get('service-prices-show', [ServicePriceController::class, 'show']);
    Route::get('service-prices-update', [ServicePriceController::class, 'update']);
    Route::get('service-prices-edit/{id}', [ServicePriceController::class, 'edit']);

    /** Admin -- People -- client-manage */
    Route::get('client-manage', [ClientController::class, 'index']);
    Route::get('client-manage-show', [ClientController::class, 'show']);
    Route::post('show-client-data', [ClientController::class, 'showClientData']);
    Route::get('client-manage-store', [ClientController::class, 'store']);
    Route::get('client-manage-update', [ClientController::class, 'update']);

    /** Admin -- People -- user-manage */
    Route::get('user-manage', [CustomerController::class, 'index']);
    Route::get('user-manage-store', [CustomerController::class, 'store']);
    Route::get('user-manage-show', [CustomerController::class, 'show']);
    Route::post('show-user-data', [CustomerController::class, 'showUserData']);
    Route::get('user-manage-update', [CustomerController::class, 'update']);

    /** Admin -- services */
    Route::get('services', [ServiceController::class, 'index'])->name('services');
    Route::get('services-show', [ServiceController::class, 'show']);
    Route::post('show-service-list', [ServiceController::class, 'showServiceList']);
    Route::post('services-update', [ServiceController::class, 'update'])->name('services.update');

    /** Admin -- Booking Schedule */
    Route::get('booking-schedule', [ServiceOrderController::class, 'index']);
    Route::get('booking-schedule-show/{action}', [ServiceOrderController::class, 'show']);

    /** Admin -- Service Reviews */
    Route::get('review-order', [ServiceReviewController::class, 'index']);
    Route::get('review-order-show/{action}', [ServiceReviewController::class, 'show']);
    Route::get('review-order-search', [ServiceReviewController::class, 'search']);
});
