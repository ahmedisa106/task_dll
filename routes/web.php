<?php

use App\Http\Controllers\Website\Auth\AuthController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth:web'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::get('/', [HomeController::class, 'index'])->name('website.index');
    Route::post('buy/{product:id}', [OrderController::class, 'buy'])->name('products.buy');
});

Route::group(['middleware' => 'guest:web'], function () {
    Route::get('/login', [AuthController::class, 'login_form'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('user.login');

});
