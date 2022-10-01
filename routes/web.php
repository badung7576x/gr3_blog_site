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
    Route::get('articles/{article}/pdf-preview', 'ArticleController@pdfPreview')->name('article.pdf-preview');
    Route::resource('articles', 'ArticleController')->names('article');
    Route::get('assignments', 'ArticleController@assignments')->name('article.assignment');
    Route::post('assignments', 'ArticleController@assignReviewer')->name('article.assignment');
    Route::get('reviews', 'ArticleController@reviews')->name('article.reviews');
    Route::resource('articles.comments', 'CommentController')->names('comment');
    Route::resource('users', 'UserController')->names('user');
    Route::post('articles/{article}/review-update', 'ArticleController@reviewUpdate')->name('article.review-update');
    Route::resource('categories', 'CategoryController')->names('category');
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
    'namespace' => 'App\Http\Controllers', 'as' => '',
    'middleware' => 'auth'
], function () {
    Route::resource('{username}/articles', 'ArticleController')->names('article');
});