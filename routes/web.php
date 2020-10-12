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

Route::get('/', [App\Http\Controllers\AppController::class, 'get'])->middleware('guest');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::get('/data', [App\Http\Controllers\HomeController::class, 'getData']);
    Route::get('/{user:username}/edit', [App\Http\Controllers\User\ProfileController::class, 'edit']);
    Route::patch('/{user:username}/update', [App\Http\Controllers\User\ProfileController::class, 'update']);
    Route::get('/getData/{user:username}', [App\Http\Controllers\User\ProfileController::class, 'getData']);

    Route::middleware('can:user')->group(function (){
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        // Ideas:
        Route::get('/ideas', [App\Http\Controllers\User\IdeaController::class, 'index']);
        Route::get('ideas/data', [App\Http\Controllers\User\IdeaController::class, 'getData']);
        Route::patch('/ideas/create', [App\Http\Controllers\User\IdeaController::class, 'store']);
        Route::get('/{user:username}', [App\Http\Controllers\User\ProfileController::class, 'index']);
        // Route::get('/{user:username}/edit', [App\Http\Controllers\User\ProfileController::class, 'edit']);
        Route::get('/{user:username}/update', [App\Http\Controllers\User\ProfileController::class, 'update']);
        // Reports:
        Route::get('/reports', [App\Http\Controllers\User\ReportsController::class, 'index']);
        Route::get('reports/data', [App\Http\Controllers\User\ReportsController::class, 'getData']);
        Route::patch('/reports/create', [App\Http\Controllers\User\ReportsController::class, 'store']);

    });
    
    Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('can:admin')->group(function (){
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        
        // Users:
        Route::get('/users/data', [App\Http\Controllers\Admin\UserController::class, 'getData']);
        Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index']);
        Route::post('/users/{user:id}/update', [App\Http\Controllers\Admin\UserController::class, 'update']);
        Route::post('/users/{user:id}/delete', [App\Http\Controllers\Admin\UserController::class, 'delete']);
        Route::post('/users/deleteAll', [App\Http\Controllers\Admin\UserController::class, 'deleteAll']);

        // Ideas:
        Route::get('/ideas/data', [App\Http\Controllers\Admin\IdeasController::class, 'getData']);
        Route::get('/ideas', [App\Http\Controllers\Admin\IdeasController::class, 'index']);
        Route::post('/ideas/{idea:id}/update', [App\Http\Controllers\Admin\IdeasController::class, 'update']);
        Route::post('/ideas/{idea:id}/delete', [App\Http\Controllers\Admin\IdeasController::class, 'delete']);

        // Reports:
        Route::get('/reports/data', [App\Http\Controllers\Admin\ReportsController::class, 'getData']);
        Route::get('/reports', [App\Http\Controllers\Admin\ReportsController::class, 'index']);
        Route::post('/reports/{report:id}/update', [App\Http\Controllers\Admin\ReportsController::class, 'update']);
        Route::post('/reports/{report:id}/delete', [App\Http\Controllers\Admin\ReportsController::class, 'delete']);

    });
});

// Profile Part: 
// Route::get('/{user:username}', [App\Http\Controllers\User\ProfileController::class, 'index']);

