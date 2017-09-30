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
Auth::routes();
Route::get('/','HomeController@show');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'PostController@create');


Route::get('/user/update', 'UserController@update_form')->name('update');
Route::get('/user/{user}', 'UserController@show')->name('profile');
Route::patch('/user/{user}/update', 'UserController@update');

Route::get('/post/{post}','PostController@show');
Route::post('/post/{post}/comments', 'CommentController@store');
Route::get('/post/{post}/update', 'PostController@update');
Route::patch('/post/{id}', 'PostController@patch');
Route::get('/post/delete/{id}', 'PostController@delete');
Route::get('/topic/{tag}', 'TagController@showPost');
Route::get('/archive', 'HomeController@show');
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('help', function(){
    return view('others.help');
});