<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group([
	'prefix' => 'pictures',
	'middleware' => 'auth',
], function () {
	Route::get('/', ['as' => 'pictures', 'uses' => 'Pictures@index']);
	Route::get('upload', ['as' => 'pictures.upload.form', 'uses' => 'Pictures@upload']);
	Route::post('upload', ['as' => 'pictures.upload.save', 'uses' => 'Pictures@uploadSave']);
	Route::get('{id}', ['as' => 'pictures.image', 'uses' => 'Pictures@showImage']);
});