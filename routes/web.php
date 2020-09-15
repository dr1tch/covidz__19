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

// Route::get('/', function () {
//     return view('app');
// });

Route::get('/', [App\Http\Controllers\AppController::class, 'get']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('can:admin')->group(function (){
    Route::resource('/users', UserController::class)->except(
        'show', 'create', 'store'
    );
    Route::resource('/ideas', IdeasController::class)->except(
        'show', 'create', 'store'
    );
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
