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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'],function () {
    Route::get('/contato',[\App\Http\Controllers\ContatoController::class, 'index'])->name('contatos');
    Route::get('/contato/create',[\App\Http\Controllers\ContatoController::class, 'create'])->name('createContatos');
    Route::get('/contato/{id}',[\App\Http\Controllers\ContatoController::class, 'show'])->name('showContato');
    Route::post('/contato',[\App\Http\Controllers\ContatoController::class, 'store'])->name('storeContatos');

});
