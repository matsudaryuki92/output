<?php

use App\Http\Controllers\ContactController;
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

Route::prefix('contacts')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
    Route::post('/', [ContactController::class, 'index'])->name('contacts.search');
    Route::get('/show/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::delete('/delete/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::get('/csv', [ContactController::class, 'csvExport'])->name('contacts.csv');
});
