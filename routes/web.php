<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReasonController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear', function() {\Illuminate\Support\Facades\Artisan::call('cache:clear');return "Cache is cleared";});
Route::get('/clear-route', function() {\Illuminate\Support\Facades\Artisan::call('route:clear');return "Route is cleared";});
Route::get('/config-cache', function() {\Illuminate\Support\Facades\Artisan::call('config:cache');    return "Cache is Configed";});

Route::get('/migrate', function() {\Illuminate\Support\Facades\Artisan::call('migrate');return "migration is done";});
Route::get('/optimize', function() {\Illuminate\Support\Facades\Artisan::call('optimize');return "optimization is done";});

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('login/to/admin',[AuthController::class,'adminLogin'])->name('admin.login');
Route::get('admin/login', [AuthController::class, 'adminView'])->name('admin-login');
Route::get('forget/password', [AuthController::class, 'forgetView'])->name('forget-password');

Route::middleware('auth')->group(function () {
	//language change
    Route::get('en', [UserController::class, 'english'])->name('en');
    Route::get('vie', [UserController::class, 'vietnam'])->name('vie');

	Route::get('welcome', [UserController::class, 'welcome'])->name('welcome');
	Route::get('detail-view/{type}', [UserController::class, 'detail_view'])->name('detail.view');

	Route::get('bank-view', [UserController::class, 'bank_view'])->name('bank.view');

	Route::get('payment-page/{variable?}', [UserController::class, 'payment_page'])->name('payment.page');


	Route::get('send-form-view', [UserController::class, 'send_form_view'])->name('send.form.view');

	Route::get('send-form/{type}', [UserController::class, 'send_form'])->name('send.form');

	Route::get('check-receiver', [UserController::class, 'check_receiver'])->name('check.receiver');

	Route::get('status-view', [UserController::class, 'status_view'])->name('status.view');

	Route::get('setting-view', [UserController::class, 'setting_view'])->name('setting.view');
	
	Route::get('profile-view', [UserController::class, 'profile_view'])->name('profile.view');

	Route::get('language-view', [UserController::class, 'language_view'])->name('language.view');

	Route::get('currency-exchange', [UserController::class, 'currency_exchange'])->name('currency.exchange');

	Route::post('currency-buy', [UserController::class, 'currency_buy'])->name('currency.buy');

	Route::post('profile-update', [UserController::class, 'profile_update'])->name('profile.update');

	Route::post('send-confirm', [UserController::class, 'send_confirm'])->name('send.confirm');

	Route::get('withdraw-form', [UserController::class, 'withdraw_form'])->name('withdraw.form');
	Route::post('withdraw.confirm', [UserController::class, 'withdraw_confirm'])->name('withdraw.confirm');

	Route::get('deposit-form', [UserController::class, 'deposit_form'])->name('deposit.form');
	Route::post('bank.confirm', [UserController::class, 'bank_confirm'])->name('bank.confirm');
	Route::post('deposit.confirm', [UserController::class, 'deposit_confirm'])->name('deposit.confirm');
	Route::post('deposit-confirm-done', [UserController::class, 'deposit_confirm_done'])->name('deposit.confirm.done');

	Route::view('barcode', 'barcode');

	// Auth Routes
	
	Route::get('admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

	Route::get('settings/profile', [DashboardController::class, 'profileIndex'])->name('admin.settings.profile');
	Route::post('profile/update', [DashboardController::class, 'updateProfile'])->name('admin.update.profile');

	//notifications Routes
	Route::get('updated_notification', [UserController::class, 'updated_notification']);
});

// Sign Up
Route::get('admin-signup', [AuthController::class, 'admin_signup'])->name('admin.signup');
Route::post('admin_register',[AuthController::class,'register'])->name('admin.register');
Route::get('/logout' , function (){
    \Illuminate\Support\Facades\Auth::logout();
    return view('login');
})->name('logout');
