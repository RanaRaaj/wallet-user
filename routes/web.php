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

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', function () {
    return view('login');
})->name('login');


Route::get('deposit-form', [UserController::class, 'deposit_form'])->name('deposit.form');
Route::post('deposit.confirm', [UserController::class, 'deposit_confirm'])->name('deposit.confirm');
Route::post('deposit-confirm-done', [UserController::class, 'deposit_confirm_done'])->name('deposit.confirm.done');

Route::view('barcode', 'barcode');

// Auth Routes
Route::post('admin_register',[AuthController::class,'register'])->name('admin.register');

Route::post('login/to/admin',[AuthController::class,'adminLogin'])->name('admin.login');
Route::get('admin/login', [AuthController::class, 'adminView'])->name('admin-login');
Route::get('forget/password', [AuthController::class, 'forgetView'])->name('forget-password');
Route::get('admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

// Sign Up
Route::get('admin-signup', [AuthController::class, 'admin_signup'])->name('admin.signup');


// index
Route::get('application', [ApplicationController::class, 'application'])->name('application');
Route::get('job', [JobController::class, 'job'])->name('job');
Route::get('event', [EventController::class, 'event'])->name('event');
Route::get('gallery', [GalleryController::class, 'gallery'])->name('gallery');
Route::get('slider', [DashboardController::class, 'slider'])->name('slider');
Route::get('users', [DashboardController::class, 'users'])->name('users');
Route::get('order_type', [OrderController::class, 'order_type'])->name('order_type');
Route::get('reason_type', [ReasonController::class, 'reason_type'])->name('reason_type');
Route::get('product', [ProductController::class, 'product'])->name('product');
Route::get('bin_card{id}', [ProductController::class, 'bin_card'])->name('bin_card');
Route::get('order', [OrderController::class, 'order'])->name('order');
Route::get('order_history', [OrderController::class, 'order_history'])->name('order_history');

//Reports
Route::get('order_report', [OrderController::class, 'order_report'])->name('order_report');
Route::post('get_order_report', [OrderController::class, 'get_order_report'])->name('get_order_report');
Route::get('product_report', [OrderController::class, 'product_report'])->name('product_report');
Route::get('low_stock_report', [OrderController::class, 'low_stock_report'])->name('low_stock_report');
Route::get('out_stock_report', [OrderController::class, 'out_stock_report'])->name('out_stock_report');

// create
Route::get('job-create', [JobController::class, 'jobCreate'])->name('job.create');
Route::get('event-create', [EventController::class, 'eventCreate'])->name('event.create');
Route::get('gallery-create', [GalleryController::class, 'galleryCreate'])->name('gallery.create');
Route::get('slider-create', [DashboardController::class, 'sliderCreate'])->name('slider.create');
Route::get('user/create', [DashboardController::class, 'userCreate'])->name('user.create');
Route::get('create_order_type', [OrderController::class, 'create_order_type'])->name('create_order_type');
Route::get('create_reason_type', [ReasonController::class, 'create_reason_type'])->name('create_reason_type');
Route::get('create_product', [ProductController::class, 'create_product'])->name('create_product');
Route::get('create_order', [OrderController::class, 'create_order'])->name('create_order');

// store
Route::post('job/store', [JobController::class, 'jobStore'])->name('job.store');
Route::post('event/store', [EventController::class, 'eventStore'])->name('event.store');
Route::post('gallery/store', [GalleryController::class, 'galleryStore'])->name('gallery.store');
Route::post('slider/store', [DashboardController::class, 'sliderStore'])->name('slider.store');
Route::post('user/store', [DashboardController::class, 'userStore'])->name('user.store');
Route::post('order_type', [OrderController::class, 'orderTypeStore'])->name('order.type.store');
Route::post('reason_type', [ReasonController::class, 'reasonTypeStore'])->name('reason.type.store');
Route::post('product', [ProductController::class, 'productStore'])->name('product.store');
Route::post('order', [OrderController::class, 'orderStore'])->name('order.store');

// delete
Route::post('delete_job', [JobController::class, 'jobDelete'])->name('delete_job');
Route::post('delete_event', [EventController::class, 'eventDelete'])->name('delete_event');
Route::post('delete_gallery', [GalleryController::class, 'galleryDelete'])->name('delete_gallery');
Route::post('delete_slider', [DashboardController::class, 'sliderDelete'])->name('delete_slider');
Route::post('delete_user', [DashboardController::class, 'userDelete'])->name('delete_user');
Route::post('delete_order_type', [OrderController::class, 'delete_order_type'])->name('delete_order_type');
Route::post('delete_reason_type', [ReasonController::class, 'delete_reason_type'])->name('delete_reason_type');
Route::post('delete_product', [ProductController::class, 'delete_product'])->name('delete_product');
Route::post('delete_order', [OrderController::class, 'delete_order'])->name('delete_order');

// edit
Route::get('edit_job{id}', [JobController::class, 'jobEdit'])->name('edit_job');
Route::get('edit_event{id}', [EventController::class, 'eventEdit'])->name('edit_event');
Route::get('edit_gallery{id}', [GalleryController::class, 'galleryEdit'])->name('edit_gallery');
Route::get('edit_slider{id}', [DashboardController::class, 'sliderEdit'])->name('edit_slider');
Route::get('edit_user{id}', [DashboardController::class, 'userEdit'])->name('edit_user');
Route::get('edit_order_type{id}', [OrderController::class, 'edit_order_type'])->name('edit_order_type');
Route::get('edit_reason_type{id}', [ReasonController::class, 'edit_reason_type'])->name('edit_reason_type');
Route::get('edit_product{id}', [ProductController::class, 'edit_product'])->name('edit_product');
Route::get('product_stack{id}', [ProductController::class, 'product_stack'])->name('product_stack');
Route::get('edit_order{id}', [OrderController::class, 'edit_order'])->name('edit_order');

//view
Route::get('view_product{id}', [ProductController::class, 'view_product'])->name('view_product');
Route::get('view_order{id}', [OrderController::class, 'view_order'])->name('view_order');
Route::get('view_application{id}', [ApplicationController::class, 'applicationView'])->name('view_application');

//active deactive
Route::post('act_deact', [ProductController::class, 'act_deact'])->name('act_deact');
Route::get('active_job/{id}', [JobController::class, 'active_job'])->name('active_job');
Route::get('inactive_job/{id}', [JobController::class, 'inactive_job'])->name('inactive_job');

//return
Route::post('/return/order', [OrderController::class, 'returnOrder'])->name('return.order');
//add note
Route::post('addNote', [OrderController::class, 'addNote'])->name('addNote');
//cancel order
Route::post('cancel_order', [OrderController::class, 'cancel_order'])->name('cancel_order');
//complete order
Route::post('complete_order', [OrderController::class, 'complete_order'])->name('complete_order');

// update
Route::post('job/update', [JobController::class, 'jobUpdate'])->name('job.update');
Route::post('event/update', [EventController::class, 'eventUpdate'])->name('event.update');
Route::post('gallery/update', [GalleryController::class, 'galleryUpdate'])->name('gallery.update');
Route::post('slider/update', [DashboardController::class, 'sliderUpdate'])->name('slider.update');
Route::post('user/update', [DashboardController::class, 'userUpdate'])->name('user.update');
Route::post('order_type/update', [OrderController::class, 'orderTypeUpdate'])->name('order_type.update');
Route::post('reason_type/update', [ReasonController::class, 'reasonTypeUpdate'])->name('reason_type.update');
Route::post('product/update', [ProductController::class, 'productUpdate'])->name('product.update');
Route::post('product_stack/update', [ProductController::class, 'productStackUpdate'])->name('product_stack.update');
Route::post('order/update', [OrderController::class, 'orderUpdate'])->name('order.update');


Route::get('settings/profile', [DashboardController::class, 'profileIndex'])->name('admin.settings.profile');
Route::post('profile/update', [DashboardController::class, 'updateProfile'])->name('admin.update.profile');

Route::get('/logout' , function (){
    \Illuminate\Support\Facades\Auth::logout();
    return view('login');
})->name('logout');
