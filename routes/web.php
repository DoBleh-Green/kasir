<?php

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CrudKasirController;
use App\Http\Controllers\CrudBarangController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});

Route::get('/home', function () {
    return redirect('/admin');
});

Route::middleware(['auth'])->group(function ($user) {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin')->middleware('userAkses:admin');
    Route::get('/form_edit/{id}', [CrudKasirController::class, 'edit'])->name('crud_kasir')->middleware('userAkses:admin');

    // Route Crud Kasir Start

    Route::get('/admin/kasir', [CrudKasirController::class, 'index'])->name('kasir.index')->middleware('userAkses:admin');
    // Route halaman pembuatan data kasir baru.
    Route::post('/admin/kasir', [CrudKasirController::class, 'store'])->name('kasir.store')->middleware('userAkses:admin');
    // Route halaman pengeditan data kasir .
    Route::put('/admin/kasir/update/{id}', [CrudKasirController::class, 'update'])->name('kasir.update')->middleware('userAkses:admin');
    // Route untuk back end pengeditan data kasir.
    Route::put('/admin/kasir/{id}', [CrudKasirController::class, 'edit'])->name('kasir.edit')->middleware('userAkses:admin');
    // Route untuk back end penghapusan data kasir.
    Route::delete('/admin/kasir/{id}', [CrudKasirController::class, 'destroy'])->name('kasir.destroy')->middleware('userAkses:admin');

    // Route Crud Kasir End

    // Route Crud Barang Start
    Route::get('/admin/barang', [CrudBarangController::class, 'index'])->name('barang.index')->middleware('userAkses:admin');
    Route::post('/admin/barang', [CrudBarangController::class, 'store'])->name('barang.store')->middleware('userAkses:admin');
    Route::put('/admin/kasir/{id}', [CrudKasirController::class, 'edit'])->name('kasir.edit')->middleware('userAkses:admin');

    // Route Crud Barang End


    // Route History
    Route::get('/admin/history', [HistoryController::class, 'index'])->name('history.index')->middleware('userAkses:admin');
    // Route History jadi pdf
    Route::get('/admin/history/view/pdf', [HistoryController::class, 'view_pdf'])->name('view_pdf')->middleware('userAkses:admin');

    // Route End

    Route::get('/kasir', [AdminController::class, 'kasir'])->middleware('userAkses:kasir');

    Route::get('/logout', [SesiController::class, 'logout']);
});

