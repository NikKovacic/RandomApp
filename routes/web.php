<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\LegalPersonController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('legal-person')->name('legal-person.')->middleware('auth')->group(function() {
    Route::get('/index', [LegalPersonController::class, 'index'])->name('index');
    Route::get('/show/{id}', [LegalPersonController::class, 'show'])->name('show');
    Route::get('/create', [LegalPersonController::class, 'create'])->name('create');
    Route::post('/store', [LegalPersonController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [LegalPersonController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [LegalPersonController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [LegalPersonController::class, 'destroy'])->name('destroy');
});
Route::prefix('group')->name('group.')->middleware('auth')->group(function() {
    Route::get('/index', [GroupController::class, 'index'])->name('index');
    Route::get('/show/{id}', [GroupController::class, 'show'])->name('show');
    Route::get('/create', [GroupController::class, 'create'])->name('create');
    Route::post('/store', [GroupController::class, 'store'])->name('store');
//    Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('edit');
//    Route::patch('/update/{id}', [GroupController::class, 'update'])->name('update');
//    Route::delete('/destroy/{id}', [GroupController::class, 'destroy'])->name('destroy');
});
