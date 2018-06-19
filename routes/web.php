<?php

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



// Routes for logged-in users
Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin/settings', 'SettingController@index')->name('admin-settings');
    Route::post('upload', 'UploadController@upload')->name('upload');
    Route::post('upload22', 'UploadController2@upload')->name('upload22');
    Route::post('upload-about', 'UploadAboutController@upload')->name('upload-about');
    Route::get('/admin/about', 'SettingController@index2')->name('admin-about');
    Route::get('/admin/services', 'ServiceController@index2')->name('admin-services');
});

