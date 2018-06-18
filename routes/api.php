<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List Articles
Route::get('articles', 'ArticleController@index');

// List Single Article
Route::get('article/{id}', 'ArticleController@show');

// Create new Article
Route::post('article', 'ArticleController@store');

// Update Article
Route::put('article', 'ArticleController@store');

// Delete Article
Route::delete('article/{id}', 'ArticleController@destroy');

// List Banners
Route::get('banners', 'BannerController@index');

// List Settings
Route::get('settings', 'SettingController@index2');
Route::get('settings2', 'SettingController@index3');
// Update Basic Settings
Route::post('settings-update', 'SettingController@update')->name('settings-update');
Route::post('settings-update-about', 'SettingController@update_about')->name('settings-update-about');


