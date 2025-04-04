<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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
    Route::get('/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::post('/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});
