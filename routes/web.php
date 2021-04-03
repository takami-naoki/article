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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function() {
    return redirect('/articles/list');
});

Route::group(['middleware' => ['auth']], function() {
    Route::prefix('articles')->group(function () {
        Route::get('list', 'ArticlesController@list')->name('articles.list');
        Route::get('detail/{id}', 'ArticlesController@detail')->name('articles.detail');
        Route::get('createOrEdit/{id?}', 'ArticlesController@createOrEdit')->name('articles.createOrEdit');
    });
});

Route::middleware('auth')->get('api/articles', 'Api\ArticlesController@index');
Route::middleware('auth')->get('api/articles/{id}', 'Api\ArticlesController@show');
Route::middleware('auth')->post('api/articles', 'Api\ArticlesController@store');
Route::middleware('auth')->post('api/articles/{id}', 'Api\ArticlesController@update');
Route::middleware('auth')->delete('api/articles/{id}', 'Api\ArticlesController@destroy');
Route::middleware('auth')->post('api/comments/{id}', 'Api\CommentsController@udpate');

