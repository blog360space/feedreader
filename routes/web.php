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

Route::get('/','FeedController@search');
Route::get('/feed/create','FeedController@create');
Route::post('/feed/store','FeedController@store');
Route::get('/feed/edit/{id}','FeedController@edit');
Route::post('/feed/update','FeedController@update');
Route::post('/feed/destroy','FeedController@destroy');
