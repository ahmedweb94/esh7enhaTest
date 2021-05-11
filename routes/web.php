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
Route::get('lang/{lang}', [\App\Http\Controllers\HomeController::class,'lang'])->name('lang');
Route::get('driver-order/{id}', [\App\Http\Controllers\CheckoutController::class,'orderDetails'])->name('driver-order');
Route::get('finish-order/{id}', [\App\Http\Controllers\CheckoutController::class,'finishOrder'])->name('finish-order');
Route::post('reject-deliver', [\App\Http\Controllers\CheckoutController::class,'rejectDeliver'])->name('reject-deliver');
Route::get('d-o/{id}', [\App\Http\Controllers\CheckoutController::class,'orderDetails'])->name('driver-order');
Route::get('login',[\App\Http\Controllers\AuthController::class,'loginView'])->name('login');
Route::post('login',[\App\Http\Controllers\AuthController::class,'login'])->name('post-login')->middleware('active');
Route::get('forget-password',[\App\Http\Controllers\AuthController::class,'forgetPasswordView'])->name('forget-password');
Route::post('forget-password',[\App\Http\Controllers\AuthController::class,'forgetPassword'])->name('post-forget-password');
Route::post('reset-password',[\App\Http\Controllers\AuthController::class,'resetPassword'])->name('post-reset');
Route::get('reset-password',[\App\Http\Controllers\AuthController::class,'resetPasswordView'])->name('reset');
Route::get('register',[\App\Http\Controllers\AuthController::class,'registerView'])->name('register');
Route::post('register',[\App\Http\Controllers\AuthController::class,'register'])->name('post-register');
Route::get('mobile-confirm',[\App\Http\Controllers\AuthController::class,'confirmView'])->name('mobile-confirm');
Route::post('mobile-confirm',[\App\Http\Controllers\AuthController::class,'confirmPhone'])->name('post-mobile-confirm');
Route::post('resend-code',[\App\Http\Controllers\AuthController::class,'resendCode'])->name('resend-code');
//Route::group(['middleware' => 'active'],function (){
    Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('home');
    Route::post('logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');
    Route::get('category', [\App\Http\Controllers\CategoryController::class,'index'])->name('category');
    Route::get('category/{category}', [\App\Http\Controllers\CategoryController::class,'catProduct'])->name('category-products');
    Route::post('liked', [\App\Http\Controllers\ProductController::class,'like'])->name('liked');
    Route::get('products', [\App\Http\Controllers\ProductController::class,'index'])->name('products');
    Route::get('product/{id}', [\App\Http\Controllers\ProductController::class,'details'])->name('product-details');
    Route::get('cart', [\App\Http\Controllers\CartController::class,'index'])->name('cart');
    Route::post('remove-from-cart', [\App\Http\Controllers\CartController::class,'remove'])->name('remove-from-cart');
    Route::post('add-to-cart', [\App\Http\Controllers\CartController::class,'addToCart'])->name('add-to-cart');
    Route::post('update-cart', [\App\Http\Controllers\CartController::class,'updateCart'])->name('update-cart');
    Route::get('about-us', [\App\Http\Controllers\PagesController::class,'aboutus'])->name('about-us');
    Route::get('terms', [\App\Http\Controllers\PagesController::class,'terms'])->name('terms');
    Route::get('contact', [\App\Http\Controllers\PagesController::class,'contact'])->name('web.contact');
    Route::post('contact', [\App\Http\Controllers\PagesController::class,'postContact'])->name('post-contact');

    Route::group(['middleware'=>['auth','verify','active']],function (){
        Route::get('checkout', [\App\Http\Controllers\CheckoutController::class,'index'])->name('checkout');
        Route::post('checkout', [\App\Http\Controllers\CheckoutController::class,'checkout'])->name('post-checkout');
        Route::get('track', [\App\Http\Controllers\CheckoutController::class,'track'])->name('track');
        Route::get('profile', [\App\Http\Controllers\ProfileController::class,'index'])->name('profile');
        Route::post('update-profile', [\App\Http\Controllers\ProfileController::class,'updateProfile'])->name('update-profile');
        Route::post('update-mobile', [\App\Http\Controllers\ProfileController::class,'updateMobile'])->name('update-mobile');
        Route::post('resend-tmp', [\App\Http\Controllers\ProfileController::class,'resendCode'])->name('resend-tmp');
        Route::get('profile-confirm', [\App\Http\Controllers\ProfileController::class,'mobileConfirm'])->name('profile-confirm');
        Route::get('change-password', [\App\Http\Controllers\ProfileController::class,'password'])->name('password');
        Route::post('change-password', [\App\Http\Controllers\ProfileController::class,'changePassword'])->name('change-password');
        Route::get('favorite', [\App\Http\Controllers\ProductController::class,'favorite'])->name('favorite');
        Route::get('address', [\App\Http\Controllers\AddressController::class,'index'])->name('address');
        Route::post('delete-address', [\App\Http\Controllers\AddressController::class,'delete'])->name('delete-address');
        Route::post('address/create', [\App\Http\Controllers\AddressController::class,'store'])->name('address.store');
        Route::post('set-default-address', [\App\Http\Controllers\AddressController::class,'setDefault'])->name('set-default');
//    });

});









Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
