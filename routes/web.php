<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');
Route::get('/services','PagesController@services');

Route::resource('posts','PostController');

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello',function() {
    return "Hello World of Laravel....";
});

Route::get('/about',function() {
    return view('pages/about');
});
Route::get('/user',function() {
    return "User not specified..";
});

Route::get('/user/{id}',function($id) {
    if(!$id) return "User not specified..";
    return "this is user".$id;
});*/
