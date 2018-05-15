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

Route::post('login', function(Illuminate\Http\Request $request)
{
    if($request->is_account==1){
        if (Auth::guard('account')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // return redirect("account/dashboard");
            return response()->json(['name'=>Auth::user()->name,'auth' => true, 'message' => 'Login successfully performed'], 200);
        } 
    }else{
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            //Session::put('redirect', Request::fullUrl());
            return response()->json(['name'=>Auth::user()->name,'auth' => true, 'message' => 'Login successfully performed'], 200);
        }
    }
    return response()->json(['auth' => false, 'message' => 'Unable to login'], 401);
});


Route::middleware(['auth'])->prefix('admin')->group(function () {

	if(Request::is('admin/logout') and !Request::is('admin/login')){
		Route::get('/admin/{any?}',function(){
		    return view('home');
		})->where(['any'=>'.*']);
	}elseif(Request::is('admin*') and !Request::is('admin/login')){
        
		Route::get('/{any?}',function(){
		    return view('home');
		})->where(['any'=>'.*']);
    }
//Route::group(['middleware' => 'auth'], function(){
});	

Route::get('/username',function(){
    return response()->json(['username'=>Auth::user()->name]);
});
Route::get('/', function () {
	return view('welcome');
});  

Auth::routes();
Route::Resource('/post', 'PostController');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('users', function() {
        $users = App\User::all();
    });

    // admin router
    Route::get('/admin', 'CommonController@list');
    Route::get('/admin/list', 'CommonController@list');
});
