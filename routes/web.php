<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Client\AboutUsController;
use App\Http\Controllers\Client\CaptchaController;
use App\Http\Controllers\Client\ContactsController;
use App\Http\Controllers\Client\IndexController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ResetPassword\Client\ForgotPasswordController as ClientForgotPasswordController;
use App\Http\Controllers\ResetPassword\Client\ResetPasswordController as ClientResetPasswordController;
use App\Http\Controllers\ResetPassword\Customer\ForgotPasswordController as CustomerForgotPasswordController;
use App\Http\Controllers\ResetPassword\Customer\ResetPasswordController as CustomerResetPasswordController;
use Illuminate\Support\Facades\Route;

/* FRONT_END */

Route::get('/', [IndexController::class, 'index']);
Route::get('home', [IndexController::class, 'index'])->name('home');
Route::get('about-us', [AboutUsController::class, 'index'])->name('pages.about');
Route::get('contacts', [ContactsController::class, 'index'])->name('pages.contact');
Route::post('contacts', [ContactsController::class, 'store'])->name('pages.contact.store');
Route::get('captcha/reload', [CaptchaController::class, 'reloadCaptcha'])->name('captcha.reload');

/* LOGIN */

Route::get('login', [LoginController::class, 'loginPageForm'])->name('auth.login');

/** Auth -- Client */
Route::prefix('auth/clients')->name('auth.clients.')->group(function () {
	Route::post('login', [LoginController::class, 'clientLogin'])->name('login');
	Route::get('register', [RegisterController::class, 'showClientRegisterForm'])->name('register');
	Route::post('register', [RegisterController::class, 'createClient'])->name('register.store');

	/** Reset Password -- Client */
	Route::get('forgot-password', [ClientForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
	Route::post('forgot-password', [ClientForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
	Route::get('reset-password/{token}', [ClientResetPasswordController::class, 'showResetForm'])->name('password.reset');
	Route::post('reset-password', [ClientResetPasswordController::class, 'reset'])->name('password.update');
});

/** Auth -- Customer */
Route::prefix('auth/customers')->name('auth.customers.')->group(function () {
	Route::post('login', [LoginController::class, 'customerLogin'])->name('login');
	Route::get('register', [RegisterController::class, 'showCustomerRegisterForm'])->name('register');
	Route::post('register', [RegisterController::class, 'createCustomer'])->name('register.store');

	/** Reset Password -- Customer */
	Route::get('forgot-password', [CustomerForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
	Route::post('forgot-password', [CustomerForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
	Route::get('reset-password/{token}', [CustomerResetPasswordController::class, 'showResetForm'])->name('password.reset');
	Route::post('reset-password', [CustomerResetPasswordController::class, 'reset'])->name('password.update');
});

/** locale */
Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('locale.swap');
