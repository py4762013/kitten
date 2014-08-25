<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
//

View::composer('cats.create', function($view)
{
    $breeds = Breed::all();
    $breed_options = array_combine($breeds->lists('id'), $breeds->lists('name'));
    $view->with('breed_options', $breed_options);
});

View::composer('cats.show', function($view)
{
    $breeds = Breed::all();
    $breed_options = array_combine($breeds->lists('id'), $breeds->lists('name'));
    $view->with('breed_options', $breed_options);
});

View::composer('cats.edit', function($view)
{
    $breeds = Breed::all();
    $breed_options = array_combine($breeds->lists('id'), $breeds->lists('name'));
    $view->with('breed_options', $breed_options);
});

// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::get('users/logout', 'UserController@logout');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');

Route::controller('articles', 'ArticlesController');

Route::controller('cats', 'CatsController');

Route::controller('users', 'UsersController');
