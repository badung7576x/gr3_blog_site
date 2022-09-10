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
    'namespace' => 'App\Http\Controllers', 'as' => 'admin.',
    'middleware' => 'auth'
], function () {
    Route::get('', 'DashboardController@index')->name('dashboard.index');

});


Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers', 'as' => 'article.',
], function () {
    Route::get('', 'ArticlesController@home')->name('home');
    Route::get('/article/{article:slug}', 'ArticlesController@detail')->name('detail');
});

Route::group([
    'prefix' => '',
    'namespace' => 'App\Http\Controllers', 'as' => 'article.',
    'middleware' => 'auth'
], function () {
    Route::get('/articles', 'ArticlesController@list')->name('list');
    Route::get('/article/create', 'ArticlesController@create')->name('create');
    Route::post('/article/create', 'ArticlesController@store')->name('store');
    Route::get('/article/{article}/edit', 'ArticlesController@edit')->name('store');
    Route::post('/article/{article}/edit', 'ArticlesController@update')->name('update');
    Route::post('/article/{article}/delete', 'ArticlesController@destroy')->name('delete');
});