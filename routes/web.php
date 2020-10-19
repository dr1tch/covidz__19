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




Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/publications', [App\Http\Controllers\User\PublicationController::class, 'index']);
Route::get('/ideas', [App\Http\Controllers\User\IdeaController::class, 'index']);


Route::middleware('auth')->group(function(){

    Route::get('/data', [App\Http\Controllers\HomeController::class, 'getData']);
    Route::get('/{user:username}/edit', [App\Http\Controllers\User\ProfileController::class, 'edit']);
    Route::patch('/{user:username}/update', [App\Http\Controllers\User\ProfileController::class, 'update']);
    Route::get('/getData/{user:username}', [App\Http\Controllers\User\ProfileController::class, 'getData']);

    Route::middleware('can:user')->group(function (){
        // Route::get('/publications', [App\Http\Controllers\User\PublicationController::class, 'index']);

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/bookmarks', [App\Http\Controllers\User\BookmarksController::class, 'index']);
        // Ideas:
        // Route::get('/ideas', [App\Http\Controllers\User\IdeaController::class, 'index']);
        Route::patch('/bookmark/{idea:id}', [App\Http\Controllers\User\IdeaController::class, 'bookmark']);
        Route::patch('/like/{idea:id}', [App\Http\Controllers\User\IdeaController::class, 'like']);
        Route::patch('/ideas/create', [App\Http\Controllers\User\IdeaController::class, 'store']);
        Route::patch('ideas/{idea:id}/update', [App\Http\Controllers\User\IdeaController::class, 'update']);
        Route::patch('/ideas/{idea:id}/delete', [App\Http\Controllers\User\IdeaController::class, 'delete']);
        Route::get('/{user:username}', [App\Http\Controllers\User\ProfileController::class, 'index']);
        Route::patch('/ideas/find', [App\Http\Controllers\User\IdeaController::class, 'categoryOrder']);
        Route::patch('/bookmark/find', [App\Http\Controllers\User\IdeaController::class, 'bookmark']);
        Route::get('/publications/likes/data', [App\Http\Controllers\User\PublicationController::class, 'afterLike']);
        Route::get('ideas/data', [App\Http\Controllers\User\IdeaController::class, 'getData']);

        Route::get('ideas/likes/data', [App\Http\Controllers\User\IdeaController::class, 'afterLike']);
        
        Route::get('/publications/data', [App\Http\Controllers\User\PublicationController::class, 'data']);
        // Route::patch('/bookmarks/find', [App\Http\Controllers\User\IdeaController::class, 'BookmarkCategoryOrder']);

        // Bookmarks:
        // Route::patch('/ideas/bookmark/{idea:id}/add', [App\Http\Controllers\User\IdeaController::class, 'addBookmark']);
        // Route::patch('/ideas/bookmark/{idea:id}/delete', [App\Http\Controllers\User\IdeaController::class, 'deleteBookmark']);

        // Ideas:
        Route::patch('/bookmark/{idea:id}', [App\Http\Controllers\User\IdeaController::class, 'bookmark']);
        Route::patch('/like/{idea:id}', [App\Http\Controllers\User\IdeaController::class, 'like']);
        Route::get('/bookmarks/data', [App\Http\Controllers\User\BookmarksController::class, 'getBookmarks']);

        //Publications:
        Route::patch('/bookmark/{publication:id}/publication', [App\Http\Controllers\User\PublicationController::class, 'bookmark']);
        Route::post('/like/{publication:id}/publication', [App\Http\Controllers\User\PublicationController::class, 'like']);
        Route::get('/bookmarks/publications/data', [App\Http\Controllers\User\PublicationController::class, 'getPubBookmarks']);
        Route::post('/publications/find', [App\Http\Controllers\User\PublicationController::class, 'getOrder']);

        
        
        // Route::get('/{user:username}/edit', [App\Http\Controllers\User\ProfileController::class, 'edit']);
        Route::get('/{user:username}/update', [App\Http\Controllers\User\ProfileController::class, 'update']);
        
        // Reports:
        Route::get('/reports', [App\Http\Controllers\User\ReportsController::class, 'index']);
        Route::get('reports/data', [App\Http\Controllers\User\ReportsController::class, 'getData']);
        Route::patch('/reports/create', [App\Http\Controllers\User\ReportsController::class, 'store']);
        Route::patch('/reports/find', [App\Http\Controllers\User\ReportsController::class, 'categoryOrder']);

        // Publication Controller 
        Route::get('/get/bookmarks', [App\Http\Controllers\HomeController::class, 'bookmarks']);


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
        Route::post('/ideas/{idea:id}/actions', [App\Http\Controllers\Admin\IdeasController::class, 'actions']);
        Route::post('/ideas/{idea:id}/delete', [App\Http\Controllers\Admin\IdeasController::class, 'delete']);

        // Reports:
        Route::get('/reports/data', [App\Http\Controllers\Admin\ReportsController::class, 'getData']);
        Route::get('/reports', [App\Http\Controllers\Admin\ReportsController::class, 'index']);
        Route::post('/reports/{report:id}/update', [App\Http\Controllers\Admin\ReportsController::class, 'update']);
        Route::post('/reports/{report:id}/delete', [App\Http\Controllers\Admin\ReportsController::class, 'delete']);

        // Publication:
        Route::get('/publications', [App\Http\Controllers\Admin\PublicationController::class, 'index']);
        Route::get('/publications/get', [App\Http\Controllers\Admin\PublicationController::class, 'get']);
        Route::patch('/publications/create', [App\Http\Controllers\Admin\PublicationController::class, 'store']);
        Route::patch('/publications/{publication:id}/update', [App\Http\Controllers\Admin\PublicationController::class, 'update']);
        Route::post('/publications/{publication:id}/delete', [App\Http\Controllers\Admin\PublicationController::class, 'delete']);


        // API Data:
        // Route::get('/pulications/get', [App\Http\Controllers\HomeController::class, 'getPubsData']);
        // Route::post('/reports/{report:id}/update', [App\Http\Controllers\Admin\ReportsController::class, 'update']);

        
    });
});

// Profile Part: 
// Route::get('/{user:username}', [App\Http\Controllers\User\ProfileController::class, 'index']);

// Route::get('/get/data', [App\Http\Controllers\HomeController::class, 'guest'])->middleware('guest');
Route::get('/', [App\Http\Controllers\AppController::class, 'get'])->middleware('guest');
// Route::get('/publications/guest/data', [App\Http\Controllers\User\PublicationController::class, 'getGuest'])->middleware('guest');

