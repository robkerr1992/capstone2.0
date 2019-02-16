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

Route::get('/', 'HomeController@index');
Route::resource('bars', 'BarsController');
Route::resource('users', 'UserController');
Route::resource('events', 'EventsController');
Route::resource('specials', 'SpecialsController');
Route::resource('reviews', 'ReviewsController');
Route::resource('votes', 'VotesController');
Route::resource('gameplans', 'GameplansController');

Route::post('picture/upload/{bar_id}', 'PicturesController@store');
//
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');
//
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');
Auth::routes();
Route::get('users/password/{id}', 'UserController@editPassword');
Route::put('users/password/{id}', 'UserController@updatePassword');

Route::get('/nearby/{latitude}/{longitude}', 'BarsController@nearby');
Route::get('/search', 'BarsController@search');
Route::get('/discover', 'BarsController@discover');
Route::get('/recent', 'HomeController@recent');
Route::get('gameplans/addHopper/{gameplanid}', 'GameplansController@addHopper');

Route::post('/votes/create', 'VotesController@vote');