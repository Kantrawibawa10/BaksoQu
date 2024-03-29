<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Homepage\CartController;
use App\Http\Controllers\Homepage\IndexController;
use App\Http\Controllers\Homepage\ProfileController;
use App\Http\Controllers\Homepage\TransaksiUsersController;
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
Route::middleware('guest')->group(function(){
    Route::get("/login", [LoginController::class, "index"])->name("login");
    Route::resource('/register', RegisterController::class);
});

Route::post("login/post", [LoginController::class, "posts"])->name('posts.login');
Route::post("logout/post", [LogoutController::class, "posts"])->name('posts.logout');

Route::middleware('auth')->group(function(){
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/produk', ProdukController::class);
    Route::resource('/pelanggan', PelangganController::class);
    Route::resource('/users', UsersController::class);
    Route::resource('/roles', RolesController::class);

    //transaksi
    Route::get("/transaksi/terbaru", [TransaksiController::class, "terbaru"])->name("transaksi.terbaru");
    Route::get("/transaksi/proses", [TransaksiController::class, "proses"])->name("transaksi.proses");
    Route::get("/transaksi/selesai", [TransaksiController::class, "selesai"])->name("transaksi.selesai");
    Route::get("/transaksi/batal", [TransaksiController::class, "batal"])->name("transaksi.batal");

    //aksi transaksi
    Route::post("/transaksi/aprove", [TransaksiController::class, "posts"])->name("aprove.transaksi");
});

Route::get("/", [IndexController::class, "index"])->name('home');
Route::get("/kontak-kami", [IndexController::class, "kontak"])->name('kontak');
Route::get('/search', [IndexController::class, 'search'])->name('search');

Route::middleware('auth')->group(function(){
    Route::resource('/myprofile', ProfileController::class);
    Route::resource('/produk-kami', IndexController::class);
    Route::resource('/cart', CartController::class);
    Route::resource('/transaksi', TransaksiUsersController::class);

    //keranjang
    Route::post("cart/post", [IndexController::class, "postCart"])->name('posts.cart');
    Route::post("stock/post/{id}", [CartController::class, "stock"])->name('stock.post');

    //transaksi
    Route::post("transaksi/post", [IndexController::class, "postTransaksi"])->name('posts.transaksi');
    Route::get("transaksi/detail/{id_transaksi}", [TransaksiUsersController::class, "detail"])->name('transaksi.detail');
});


// API ROUTE DATA
Route::get('/total-keranjang', [CartController::class, 'getTotal'])->name('cart.total');
Route::get('/cart-data', [CartController::class, 'getCartData'])->name('cart.data');
Route::delete('/delete-stock/{id}', [CartController::class, 'hapusStock'])->name('delete.stock');
