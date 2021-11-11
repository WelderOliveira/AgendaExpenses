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

Auth::routes();

Route::get('/calendario', [\App\Http\Controllers\AgendaController::class, 'index'])->name('indexCalendario')->middleware('auth');
Route::get('/calendario/view', [\App\Http\Controllers\AgendaController::class, 'show'])->name('showCalendario')->middleware('auth');
Route::post('/calendario', [\App\Http\Controllers\AgendaController::class, 'store'])->name('storeCalendario')->middleware('auth');

Route::group(['middleware'=>'auth'],function () {
    Route::get('/',[\App\Http\Controllers\ContatoController::class, 'index'])->name('contatos');
    Route::get('/agenda/create',[\App\Http\Controllers\ContatoController::class, 'create'])->name('createContatos');
    Route::get('/agenda/{id}',[\App\Http\Controllers\ContatoController::class, 'show'])->name('showContato');
    Route::post('/agenda',[\App\Http\Controllers\ContatoController::class, 'store'])->name('storeContatos');
    Route::get('/agenda/edit/{id}',[\App\Http\Controllers\ContatoController::class, 'edit'])->name('editContato');
    Route::put('/agenda/update/{id}',[\App\Http\Controllers\ContatoController::class, 'update'])->name('updateContato');
    Route::delete('/agenda/{id}',[\App\Http\Controllers\ContatoController::class, 'destroy'])->name('destroyContato');
    Route::get('/search',[\App\Http\Controllers\ContatoController::class, 'autocompleteSearch'])->name('search');

});
