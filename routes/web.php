<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::post("login/post", [LoginController::class, "posts"])->name('posts.login');
Route::post("logout/post", [LogoutController::class, "posts"])->name('posts.logout');

Route::resource('/dashboard', DashboardController::class);
Route::resource('/kategori', KategoriController::class);
Route::resource('/produk', ProdukController::class);

