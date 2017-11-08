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


use Illuminate\Support\Facades\Route;

///// GET

Route::get('', 'PostsController@index')->name('home');

Route::get('/posts/create', 'PostsController@create');

Route::get('/posts/{post}', 'PostsController@show');

Route::get('/register', 'RegistrationController@create');

Route::get('/login', 'SessionsController@create');

Route::get('/logout', 'SessionsController@destroy');


///// POST
Route::post('/posts', 'PostsController@store');

Route::post('/posts/{post}/comments', 'CommentsController@store');

Route::post('/register', 'RegistrationController@store');

Route::post('/login', 'SessionsController@store');