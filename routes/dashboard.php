<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\UserProduct;
use Illuminate\Support\Facades\Route;

/**
 * for Auth & guard => admin
 */

Route::group(['middleware' => ['auth:admin', 'role:super_admin|admin'], 'prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    /********************* Categories *************************/
    Route::resource('categories', CategoryController::class)->except('show');
    /********************* End Categories *********************/

    /********************* Admins *************************/
    Route::resource('admins', AdminController::class)->except('show');
    /********************* End Admins *********************/

    /********************* Users *************************/
    Route::resource('users', UserController::class)->except('show');
    /********************* End users *********************/

    /********************* Products *************************/
    Route::resource('categories/{category:id}/products', ProductController::class)->except('show');
    /********************* End Products *********************/

    /********************* User Products *************************/
    Route::get('user-products', [UserProduct::class, 'index'])->name('user_products.index');
    Route::get('user-products/{user:id}', [UserProduct::class, 'view_products'])->name('user_products.view_products');
    /********************* End Products *********************/
});

/**
 * for Guest & guard => admin
 */

Route::group(['middleware' => 'guest:admin', 'prefix' => 'dashboard'], function () {
    Route::get('login', [AuthController::class, 'login_form'])->name('dashboard.login');
    Route::post('login', [AuthController::class, 'login'])->name('dashboard.doLogin');
});



