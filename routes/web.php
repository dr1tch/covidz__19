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
    Route::middleware('can:user')->group(function (){
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    });
        Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('can:admin')->group(function (){
            // Route::resource('/users', UserController::class)->except(
            //     'show', 'create', 'store'
            // );
            // Route::resource('/ideas', IdeasController::class)->except(
            //     'show', 'create', 'store'
            // );
            Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
            Route::get('/data', [App\Http\Controllers\HomeController::class, 'getData']);
            Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index']);
            Route::post('/users/{user:id}/update', [App\Http\Controllers\Admin\UserController::class, 'update']);
            Route::post('/users/{user:id}/delete', [App\Http\Controllers\Admin\UserController::class, 'delete']);
            Route::post('/users/deleteAll', [App\Http\Controllers\Admin\UserController::class, 'deleteAll']);
            // Route::get('/admin/users/{user:id}', [App\Http\Controllers\UserController::class, 'edit']);
        });
});

// Route::get('/admin/data', [App\Http\Controllers\HomeController::class, 'getData'])->middleware('auth:api');
// ->middleware('can:admin');
