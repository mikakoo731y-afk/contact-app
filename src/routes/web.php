<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;
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

Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');



Route::middleware('auth')->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/search', [AdminController::class, 'index'])->name('admin.search');
    Route::get('/reset', [AdminController::class, 'reset'])->name('admin.reset');
    Route::delete('/delete', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
});