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
Route::group(['middleware' => 'auth'], function(){

    //Route::get('admin', function () { $user = \Auth::user(); dd($user); });
	Route::get('/admin/{any?}',function(){
	    return view('home');
	})->where(['any'=>'.*']);
});

// Route::get('/', function () {
  
// });  

Auth::routes();
//Route::post('/login', 'AuthController@login')->name('login');
Route::get('/home', 'HomeController@index')->name('home');
Route::Resource('/post', 'PostController');
