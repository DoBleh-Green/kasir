<?php

use Illuminate\Auth\Events\Logout;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CrudKasirController;
use App\Http\Controllers\TransaksiController;
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
    /* Session Admin Start */

    Route::get('/admin', [LoginController::class, 'admin'])->name('admin')->middleware('userAkses:admin');
    Route::get('admin/kasir/form_edit/{id}', [CrudKasirController::class, 'edit'])->name('crud_kasir')->middleware('userAkses:admin');

    // Route Crud Kasir Start

    Route::get('/admin/kasir', [CrudKasirController::class, 'index'])->name('kasir.index')->middleware('userAkses:admin');
    // Route halaman pembuatan data kasir baru.
    Route::post('/admin/kasir', [CrudKasirController::class, 'store'])->name('kasir.store')->middleware('userAkses:admin');
    // Route halaman pengeditan data kasir .
    Route::put('/update/{id}', [CrudKasirController::class, 'update'])->name('kasir.update')->middleware('userAkses:admin');
    // Route untuk back end pengeditan data kasir.
    Route::put('/admin/kasir/{id}', [CrudKasirController::class, 'edit'])->name('kasir.edit')->middleware('userAkses:admin');
    // Route untuk back end penghapusan data kasir.
    Route::delete('/admin/kasir/{id}', [CrudKasirController::class, 'destroy'])->name('kasir.destroy')->middleware('userAkses:admin');

    // Route Crud Kasir End

    // Route Crud Barang Start

    Route::get('/admin/barang', [CrudBarangController::class, 'index'])->name('barang.index')->middleware('userAkses:admin');
    // Route halaman pembuatan data barang baru.    
    Route::post('/admin/barang', [CrudBarangController::class, 'store'])->name('barang.store')->middleware('userAkses:admin');
    // Route halaman pengeditan data barang.
    Route::get('/admin/barang/{id}/edit', [CrudBarangController::class, 'edit'])->name('barang.edit')->middleware('userAkses:admin');
    // Route untuk back end pengeditan data barang.
    Route::put('/admin/barang/update/{id}', [CrudBarangController::class, 'update'])->name('barang.update')->middleware('userAkses:admin');
    // Route untuk back end penghapusan data barang.
    Route::delete('/admin/barang/{id}', [CrudBarangController::class, 'destroy'])->name('barang.destroy')->middleware('userAkses:admin');

    // Route Crud Barang End


    // Route History
    Route::get('/admin/history', [HistoryController::class, 'index'])->name('history.index')->middleware('userAkses:admin');
    // Route History jadi pdf
    Route::get('/admin/history/view/pdf', [HistoryController::class, 'view_pdf'])->name('view_pdf')->middleware('userAkses:admin');
    //filter    
    Route::get('/admin/history/filter', [HistoryController::class, 'filter'])->name('history.filter')->middleware('userAkses:admin');


    /* Session Admin End */

    // Route Endcheckout

    /* Session Kasir Start */

    Route::get('/kasir', [TransaksiController::class, 'index'])->name('kasir')->middleware('userAkses:kasir');
    Route::get('/kasir', [TransaksiController::class, 'search'])->name('search')->middleware('userAkses:kasir');
    Route::post('/kasir/{id}', [TransaksiController::class, 'addToCart'])->name('addToCart')->middleware('userAkses:kasir');
    Route::delete('/kasir/{id}/remove', [TransaksiController::class, 'removeFromCart'])->name('removeFromCart')->middleware('userAkses:kasir');
    Route::delete('/kasir/{id}/reduce', [TransaksiController::class, 'reduceQuantity'])->name('reduceQuantity')->middleware('userAkses:kasir');
    Route::post('/kasir/struk/print', [TransaksiController::class, 'checkout'])->name('checkout')->middleware('userAkses:kasir');
    Route::post('/kasir ', [TransaksiController::class, 'processPayment'])->name('processPayment')->middleware('userAkses:kasir');
    Route::get('/kasir/struk/print/generate-pdf', [TransaksiController::class, 'generatePDF'])->name('generatePDF')->middleware('userAkses:kasir');

    Route::get('/kasir/json/pler', [Controller::class, 'viewCart'])->name('viewCart')->middleware('userAkses:kasir');

    // Route Logout

    /* Session Kasir End */


    Route::get('/logout', [SesiController::class, 'logout']);
});

