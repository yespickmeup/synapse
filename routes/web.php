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




Route::get('/', 'WelcomeController@index')->name('welcome');

// Auth::routes();
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');


// Routes for logged-in users
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin/settings', 'SettingController@index')->name('admin-settings');
    Route::post('upload', 'UploadController@upload')->name('upload');
    Route::post('upload22', 'UploadController2@upload')->name('upload22');
    Route::post('upload-about', 'UploadAboutController@upload')->name('upload-about');
    Route::get('/admin/about', 'SettingController@index2')->name('admin-about');
    Route::get('/admin/services', 'ServiceController@index2')->name('admin-services');
    Route::get('/admin/clients', 'ClientController@index2')->name('admin-clients');
    Route::get('/admin/portfolios', 'PortfolioController@index2')->name('admin-portfolios');
    Route::get('/admin/testimonials', 'TestimonialController@index2')->name('admin-testimonials');
    Route::get('/admin/our-team', 'TeamMemberController@index2')->name('admin-team');

    Route::post('settings-teamMember-add', 'TeamMemberController@store');
});

