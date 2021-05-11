<?php

use Illuminate\Support\Facades\Route;

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


Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'loginView'])->name('admin.login');
Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login');
Route::get('forget-password-view', [\App\Http\Controllers\Admin\AuthController::class, 'forgetPasswordView'])->name('admin.forget-password-view');
Route::post('forget-password', [\App\Http\Controllers\Admin\AuthController::class, 'sendResetMail'])->name('administrator.password.email');
Route::get('reset-view/{id}', [\App\Http\Controllers\Admin\AuthController::class, 'resetView'])->name('admin.reset-view');
Route::post('reset-password', [\App\Http\Controllers\Admin\AuthController::class, 'resetPassword'])->name('administrator.password.request');
Route::get('city-by-region/{id}', [\App\Http\Controllers\Admin\RegionController::class, 'cityByRegion']);
Route::group(['middleware' => ['auth:admin','adminActive']], function () {
    Route::post('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');
//    Route::get('profile', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('user.profile');
    Route::get('edit-profile/{id}', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('users.edit');
    Route::get('home', [\App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');

    //Category
    Route::group(['middleware' => ['permission:add category|edit category|show category|delete category']], function () {
        Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
        Route::post('category/{id}/delete', [\App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('category.delete');
        Route::post('category/{id}/status', [\App\Http\Controllers\Admin\CategoryController::class, 'status'])->name('category.status');
    });

    //Product
    Route::group(['middleware' => ['permission:add product|edit product|show product|delete product']], function () {
        Route::resource('product', \App\Http\Controllers\Admin\ProductController::class);
        Route::post('product/{id}/delete', [\App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('product.delete');
        Route::post('product/{id}/empty', [\App\Http\Controllers\Admin\ProductController::class, 'changeEmpty'])->name('product.empty');
        Route::post('product/{id}/status', [\App\Http\Controllers\Admin\ProductController::class, 'status'])->name('product.status');
    });

    //Regions
    Route::group(['middleware' => ['permission:add region|edit region|show region|delete region']], function () {
        Route::resource('region', \App\Http\Controllers\Admin\RegionController::class);
        Route::post('region/{id}/delete', [\App\Http\Controllers\Admin\RegionController::class, 'delete'])->name('region.delete');
        Route::post('region/{id}/status', [\App\Http\Controllers\Admin\RegionController::class, 'status'])->name('region.status');
    });
    //Country
    Route::resource('country', \App\Http\Controllers\Admin\CountryController::class);
    Route::post('country/{id}/delete', [\App\Http\Controllers\Admin\CountryController::class, 'delete'])->name('country.delete');
    Route::post('country/{id}/status', [\App\Http\Controllers\Admin\CountryController::class, 'status'])->name('country.status');
    //City
    Route::group(['middleware' => ['permission:add city|edit city|show city|delete city']], function () {
        Route::resource('city', \App\Http\Controllers\Admin\CityController::class);
        Route::post('city/{id}/delete', [\App\Http\Controllers\Admin\CityController::class, 'delete'])->name('city.delete');
        Route::post('city/{id}/status', [\App\Http\Controllers\Admin\CityController::class, 'status'])->name('city.status');
    });
    //Setting
    Route::group(['middleware' => ['permission:edit setting']], function () {
        Route::resource('setting', \App\Http\Controllers\Admin\SiteSettingController::class);
    });

    //Pages
    Route::group(['middleware' => ['permission:edit static pages']], function () {
        Route::resource('page', \App\Http\Controllers\Admin\PagesController::class);
        Route::get('social', [\App\Http\Controllers\Admin\SiteSettingController::class,'social'])->name('social.index');
        Route::get('social-edit/{id}', [\App\Http\Controllers\Admin\SiteSettingController::class,'editSocial'])->name('social.edit');
        Route::post('social-update/{id}', [\App\Http\Controllers\Admin\SiteSettingController::class,'updateSocial'])->name('social.update');
    });
    Route::group(['middleware' => ['permission:show contact us']], function () {
        Route::get('contactUs', [\App\Http\Controllers\Admin\PagesController::class, 'contact'])->name('contact');
        Route::post('delete/contact/{id}', [\App\Http\Controllers\Admin\PagesController::class, 'delete'])->name('delete-contact');
        Route::get('read/contactus/{id}', [\App\Http\Controllers\Admin\PagesController::class, 'viewMessage'])->name('view-contact');
        Route::post('reply/contact/{id}', [\App\Http\Controllers\Admin\PagesController::class, 'reply'])->name('replay');
    });

    //Driver
    Route::group(['middleware' => ['permission:add driver|edit driver|show driver|delete driver']], function () {
        Route::resource('driver', \App\Http\Controllers\Admin\DriverController::class);
        Route::post('driver/{id}/status', [\App\Http\Controllers\Admin\DriverController::class, 'status'])->name('driver.status');
    });

    //Users
    Route::group(['middleware' => ['permission:edit users|show users']], function () {
        Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
        Route::post('user/{id}/status', [\App\Http\Controllers\Admin\UserController::class, 'status'])->name('user.status');
    });

    //Order
    Route::group(['middleware' => ['permission:edit order|show order']], function () {
        Route::resource('order', \App\Http\Controllers\Admin\OrderController::class);
        Route::post('order/{id}/accept', [\App\Http\Controllers\Admin\OrderController::class, 'status'])->name('order.accept');
        Route::post('order/{id}/reject', [\App\Http\Controllers\Admin\OrderController::class, 'status'])->name('order.reject');
        Route::post('order/assign', [\App\Http\Controllers\Admin\OrderController::class, 'assignOrderToDriver'])->name('order.assign');
        Route::get('get/driver/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'getDriver'])->name('all-drivers');
        Route::get('order/{type}/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'orderDriver'])->name('order-drivers');
    });

    //Admin
    Route::group(['middleware' => ['permission:add admin|edit admin|show admin|delete admin']], function () {
        Route::resource('admin', \App\Http\Controllers\Admin\AdminController::class);
        Route::post('admin/{id}/delete', [\App\Http\Controllers\Admin\AdminController::class, 'destroy'])->name('admin.delete');
        Route::post('admin/{id}/status', [\App\Http\Controllers\Admin\AdminController::class, 'status'])->name('admin.status');
    });
    Route::get('profile', [\App\Http\Controllers\Admin\AdminController::class, 'profile'])->name('admin.profile');

    Route::group(['middleware' => ['permission:add role|edit role|show role|delete role']], function () {
        Route::resource('role', \App\Http\Controllers\Admin\RoleController::class);
        Route::post('role/{id}/delete', [\App\Http\Controllers\Admin\RoleController::class, 'delete'])->name('role.delete');
    });
});
