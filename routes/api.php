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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

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

// List Services
Route::get('services', 'ServiceController@index');
Route::post('settings-services-add', 'ServiceController@store');
Route::post('settings-services-update/{id}', 'ServiceController@update');
Route::delete('settings-services-delete/{id}', 'ServiceController@destroy');

// List Clients
Route::get('clients', 'ClientController@index');
Route::post('settings-clients-add', 'ClientController@store');
Route::post('settings-clients-update/{id}', 'ClientController@update');
Route::delete('settings-clients-delete/{id}', 'ClientController@destroy');

// List Porfolio
Route::get('portfolios', 'PortfolioController@index');
Route::post('settings-portfolios-add', 'PortfolioController@store');
Route::post('settings-portfolios-update/{id}', 'PortfolioController@update');
Route::delete('settings-portfolios-delete/{id}', 'PortfolioController@destroy');

// List Testimonials
Route::get('testimonials', 'TestimonialController@index');
Route::post('settings-testimonials-add', 'TestimonialController@store');
Route::post('settings-testimonials-update/{id}', 'TestimonialController@update');
Route::delete('settings-testimonials-delete/{id}', 'TestimonialController@destroy');

// List Team Members
Route::get('teamMembers', 'TeamMemberController@index');
Route::post('settings-teamMember-add', 'TeamMemberController@store');
Route::post('settings-teamMember-update/{id}', 'TeamMemberController@update');
Route::delete('settings-teamMember-delete/{id}', 'TeamMemberController@destroy');

