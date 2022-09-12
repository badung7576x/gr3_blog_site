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
Route::get('/', function() {
    return redirect()->route('article.home');
});

Route::get('/management', function() {
    return redirect()->route('admin.login');
});

Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers', 'as' => 'admin.'
], function () {
    Route::get('login', 'LoginController@create')->middleware('guest')->name('login');
    Route::post('login', 'LoginController@store')->middleware('guest');
    Route::post('logout', 'LoginController@destroy')->middleware('auth')->name('logout');
});

Route::group([
    'prefix' => 'management',
    'namespace' => 'App\Http\Controllers\Admin', 'as' => 'admin.',
    'middleware' => 'auth'
], function () {
    Route::get('', 'DashboardController@index')->name('dashboard.index');
    Route::resource('articles', 'ArticleController')->names('article');
    Route::get('assignments', 'ArticleController@assignments')->name('article.assignment');
    Route::post('assignments', 'ArticleController@assignReviewer')->name('article.assignment');
    Route::resource('users', 'UserController')->names('user');
});


Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers', 'as' => 'article.',
], function () {
    Route::get('', 'ArticleController@home')->name('home');
    Route::get('/article/{article:slug}', 'ArticleController@detail')->name('detail');
    Route::get('/preview/{article:slug}', 'ArticleController@preview')->name('preview');
});

Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers', 'as' => 'article.',
    'middleware' => 'auth'
], function () {
    Route::get('/articles', 'ArticleController@list')->name('list');
    Route::get('/articles/create', 'ArticleController@create')->name('create');
    Route::post('/articles/create', 'ArticleController@store')->name('store');
    Route::get('/articles/{article}/edit', 'ArticleController@edit')->name('edit');
    Route::post('/articles/{article}/edit', 'ArticleController@update')->name('update');
    Route::post('/articles/{article}/delete', 'ArticleController@destroy')->name('delete');
});