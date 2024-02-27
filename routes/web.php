<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Kasircontroller;
use App\Http\Controllers\Montircontroller;
use App\Http\Controllers\OwnerController;
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

Route::get('/', [Authcontroller::class, 'login'])->name('login');
Route::post('/post-login', [Authcontroller::class, 'postLogin'])->name('post-login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::prefix('montir')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/logout', [Authcontroller::class, 'logout'])->name('logout');
        Route::get('/home-montir', [montircontroller::class, 'home'])->name('home-montir');
        Route::get('/keranjang', [montircontroller::class, 'keranjang'])->name('keranjang');
        Route::post('/post-pesan', [montircontroller::class, 'postpesan'])->name('post-pesan');
        Route::post('/detail{service}', [Montircontroller::class, 'detail'])->name('detail');
        Route::get('/hapus', [Montircontroller::class, 'hapus'])->name('hapus');
        Route::get('/cari{service}', [Montircontroller::class, 'index'])->name('cari');
    });

    route::prefix('kasir')->group(function () {

        Route::get('/home-kasir', [Kasircontroller::class, 'home'])->name('home-kasir');
        Route::get('/detailkasir/{no_kendaraan}', [Kasircontroller::class, 'detailkasir'])->name('detailkasir');
        Route::post('/lunas/{no_kendaraan}', [Kasircontroller::class, 'lunas'])->name('lunas');
        Route::get('/summary', [Kasircontroller::class, 'summary'])->name('summary');
        Route::get('/detailsummary/{no_kendaraan}', [Kasircontroller::class, 'detailsummary'])->name('detail-summary');
        Route::get('/transaksi/filter', [KasirController::class, 'filter'])->name('transaksi.filter');
        Route::get('/pdf/{no_kendaraan}',[Kasircontroller::class, 'pdf'])->name('pdf');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/dash-admin', [AdminController::class,'dash'])->name('dash-admin');
        Route::get('/log-admin', [AdminController::class,'log'])->name('log-admin');
        Route::get('/tambah', [AdminController::class,'tambah'])->name('tambah');
        Route::post('/post-tambah', [AdminController::class,'postTambah'])->name('post-tambah');
        Route::delete('/delete/{service}', [AdminController::class,'hapus'])->name('hapus-admin');
        Route::get('/ubah/{service}', [AdminController::class,'ubah'])->name('ubah');
        Route::post('/post-ubah/{service}', [AdminController::class,'postUbah'])->name('post-ubah');
        Route::get('/dash-user', [AdminController::class,'user'])->name('dash-user');
        Route::get('/tambah-user', [AdminController::class,'tambahuser'])->name('tambah-user');
        Route::post('/post-user', [AdminController::class,'posttambahuser'])->name('post-user');
        Route::delete('/delete-user/{user}', [AdminController::class,'hapususer'])->name('hapus-user');
        Route::get('/edit/{user}', [AdminController::class,'ubahuser'])->name('edit');
        Route::post('/post-edit/{user}', [AdminController::class,'postubahuser'])->name('edit-user');
        Route::get('/log/filter', [AdminController::class, 'filterlog'])->name('log-filter');
    });

    Route::prefix('owner')->group(function () {
        Route::get('/home-owner', [OwnerController::class,'home'])->name('home-owner');
        Route::get('/filterowner', [OwnerController::class,'filterowner'])->name('filterowner');
        Route::get('/logowner', [OwnerController::class,'logowner'])->name('logowner');
        Route::get('/log/filter', [OwnerController::class, 'filterlog'])->name('filter-log');
        Route::get('/sum-owner', [OwnerController::class,'summary'])->name('sum-owner');
        Route::get('/report/filter', [OwnerController::class, 'filter'])->name('report-filter');
    });
});
