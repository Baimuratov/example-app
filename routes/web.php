<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyPlaceController;

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

Route::group(['namespace' => 'App\Http\Controllers\Post'], function () {
    Route::get('/posts', 'IndexController')->name('posts.index');

    Route::get('/posts/create', 'CreateController')->name('posts.create');

    Route::post('/posts', 'StoreController')->name('posts.store');

    Route::get('/posts/{post}', 'ShowController')->name('posts.show');

    Route::get('/posts/{post}/edit', 'EditController')->name('posts.edit');

    Route::patch('/posts/{post}', 'UpdateController')->name('posts.update');

    Route::delete('/posts/{post}', 'DestroyController')->name('posts.destroy');
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin'], function () {
    Route::group(['namespace' => 'Post'], function () {
        Route::get('/posts', 'IndexController')->name('admin.posts.index');
    });
});

Route::get('/', [MyPlaceController::class, 'index'])->name('index');
