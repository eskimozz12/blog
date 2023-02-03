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

Route::group(['namespace' => 'App\Http\Controllers\Main'], function () {
    Route::get('/', IndexController::class);
});
Route::group(['namespace' => 'App\Http\Controllers\Personal', 'prefix'=> 'personal', 'middleware' => ['auth']],function () {
    Route::group(['namespace' => 'Main', 'prefix' => 'main'], function () {
        Route::get('/', IndexController::class)->name('personal.main.index');
    });

    Route::group(['namespace' => 'Liked', 'prefix' => 'liked'], function () {
        Route::get('/', IndexController::class)->name('personal.liked.index');
    });

    Route::group(['namespace' => 'Comment', 'prefix' => 'comment'], function () {
        Route::get('/', IndexController::class)->name('personal.comment.index');
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix'=> 'admin', 'middleware' => ['auth', 'admin']],function () {
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', IndexController::class)->name('admin.main.index');
    });

    Route::group(['namespace' => 'Category', 'prefix'=> 'categories'], function () {

        Route::get('/', 'AdminCategoryController@index')->name('admin.category.index');
        Route::get('/create', 'AdminCategoryController@createPage')->name('admin.category.create');
        Route::post('/', 'AdminCategoryController@store')->name('admin.category.store');
        Route::get('/{category}', 'AdminCategoryController@show')->name('admin.category.show');
        Route::get('/{category}/edit', 'AdminCategoryController@editPage')->name('admin.category.edit');
        Route::patch('/{category}', 'AdminCategoryController@update')->name('admin.category.update');
        Route::delete('/{category}', 'AdminCategoryController@delete')->name('admin.category.delete');
    });

    Route::group(['namespace' => 'Tag', 'prefix'=> 'tags'], function () {

        Route::get('/', 'AdminTagController@index')->name('admin.tag.index');
        Route::get('/create', 'AdminTagController@createPage')->name('admin.tag.create');
        Route::post('/', 'AdminTagController@store')->name('admin.tag.store');
        Route::get('/{tag}', 'AdminTagController@show')->name('admin.tag.show');
        Route::get('/{tag}/edit', 'AdminTagController@editPage')->name('admin.tag.edit');
        Route::patch('/{tag}', 'AdminTagController@update')->name('admin.tag.update');
        Route::delete('/{tag}', 'AdminTagController@delete')->name('admin.tag.delete');
    });

    Route::group(['namespace' => 'Post', 'prefix'=> 'posts'], function () {

        Route::get('/', 'AdminPostController@index')->name('admin.post.index');
        Route::get('/create', 'AdminPostController@createPage')->name('admin.post.create');
        Route::post('/', 'AdminPostController@store')->name('admin.post.store');
        Route::get('/{post}', 'AdminPostController@show')->name('admin.post.show');
        Route::get('/{post}/edit', 'AdminPostController@editPage')->name('admin.post.edit');
        Route::patch('/{post}', 'AdminPostController@update')->name('admin.post.update');
        Route::delete('/{post}', 'AdminPostController@delete')->name('admin.post.delete');
    });

    Route::group(['namespace' => 'User', 'prefix'=> 'users'], function () {

        Route::get('/', 'AdminUserController@index')->name('admin.user.index');
        Route::get('/create', 'AdminUserController@createPage')->name('admin.user.create');
        Route::post('/', 'AdminUserController@store')->name('admin.user.store');
        Route::get('/{user}', 'AdminUserController@show')->name('admin.user.show');
        Route::get('/{user}/edit', 'AdminUserController@editPage')->name('admin.user.edit');
        Route::patch('/{user}', 'AdminUserController@update')->name('admin.user.update');
        Route::delete('/{user}', 'AdminUserController@delete')->name('admin.user.delete');
    });
});

Auth::routes();

