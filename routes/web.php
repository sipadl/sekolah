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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\AuthController::class, 'index'])->name('/');
Route::post('/logins', [App\Http\Controllers\AuthController::class, 'logins'])->name('logins');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


Route::get('api', [App\Http\Controllers\HomeController::class, 'api'])->name('api');

Route::prefix('user')->group(function () {
    Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('user');
    Route::prefix('admin')->group(function () {
        Route::get('', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
        Route::get('add', [App\Http\Controllers\HomeController::class, 'addAdmin'])->name('admin.add');
        Route::post('add', [App\Http\Controllers\HomeController::class, 'postAddAdmin'])->name('admin.add.post');
        Route::get('ubah/{id}', [App\Http\Controllers\HomeController::class, 'getDetailAdmin'])->name('admin.edit');
        Route::get('hapus/{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('admin.delete');
    });
    Route::prefix('siswa')->group(function () {
        Route::get('', [App\Http\Controllers\HomeController::class, 'siswa'])->name('siswa');
        Route::get('add', [App\Http\Controllers\HomeController::class, 'siswaAdd'])->name('siswa.add');
        Route::post('add-post', [App\Http\Controllers\HomeController::class, 'siswaAddPost'])->name('siswa.add.post');
        Route::get('ubah/{id}', [App\Http\Controllers\HomeController::class, 'siswa'])->name('siswa.delete');
        Route::get('hapus/{id}', [App\Http\Controllers\HomeController::class, 'getDetailSiswa'])->name('siswa.edit');
    });
    Route::prefix('tagihan')->group(function () {
        // Admin
        Route::get('', [App\Http\Controllers\HomeController::class, 'tagihan'])->name('tagihan');
        Route::get('add', [App\Http\Controllers\HomeController::class, 'tagihanAdd'])->name('tagihan.add');
        Route::post('add', [App\Http\Controllers\HomeController::class, 'tagihanAddPost'])->name('tagihan.add.post');
        Route::get('topup', [App\Http\Controllers\HomeController::class, 'Saldos'])->name('tagihan.topup');
        Route::get('history', [App\Http\Controllers\HomeController::class, 'history'])->name('tagihan.history');
        Route::get('waiting', [App\Http\Controllers\HomeController::class, 'waiting'])->name('tagihan.waiting');
        Route::get('accept/{id}', [App\Http\Controllers\HomeController::class, 'accept'])->name('tagihan.accept');
        Route::get('deny/{id}', [App\Http\Controllers\HomeController::class, 'deny'])->name('tagihan.deny');
        Route::prefix('saldo')->group(function () {
            Route::get('', [App\Http\Controllers\HomeController::class, 'listSaldo'])->name('saldolist');
            Route::post('topup', [App\Http\Controllers\HomeController::class, 'SaldosPost'])->name('topup.post');
        });
    });
});
Route::prefix('siswa')->group(function () {
    // User
    Route::get('me', [App\Http\Controllers\UserController::class, 'MyInfo'])->name('me');
    Route::get('pengaturan', [App\Http\Controllers\UserController::class, 'settings'])->name('pengaturan');
    Route::get('', [App\Http\Controllers\UserController::class, 'tagihan'])->name('tagihan.user');
    Route::get('history', [App\Http\Controllers\UserController::class, 'history'])->name('history.user');
    Route::get('topup', [App\Http\Controllers\UserController::class, 'topup'])->name('topup.user');
    Route::post('topup', [App\Http\Controllers\UserController::class, 'topuppost'])->name('topup.user.post');
    Route::get('/tagihan/bayar/{id}', [App\Http\Controllers\UserController::class, 'bayar'])->name('bayar.user');
    Route::post('/tagihan/bayar/{id}', [App\Http\Controllers\UserController::class, 'bayarPost'])->name('bayar.user.post');
});
