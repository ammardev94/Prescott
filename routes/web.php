<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\ContactController;

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

Route::get('/', [SiteController::class, 'index'])->name('site.index');


Route::post('/careers/store', [CareerController::class, 'store'])->name('careers.store');

Route::prefix('admin')->middleware('roleAuth:admin')->name('admin.')->group(function () {
    
    Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
    Route::get('/careers/{id}', [CareerController::class, 'show'])->name('careers.show');
    Route::delete('/careers/{id}', [CareerController::class, 'destroy'])->name('careers.destroy');
});

Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');

Route::prefix('admin')->middleware('roleAuth:admin')->name('admin.')->group(function () {
    
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});

