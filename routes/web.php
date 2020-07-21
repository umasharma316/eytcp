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

Route::get('/', function () {
    return view('landing');
});
Route::get('/landingpage', function () {
    return view('landing');
});
Route::any('/landingpage', 'eytcpController@landingpage')->name('landingpage');

Route::get('auth/logout', [
	'as' 			=> 'logout',
	'uses' 			=> 'EytcpAuthController@logout'
	]);

	// //Authentication and Login Routes
Route::any('/login', 'EytcpAuthController@login')->name('login');

Route::any('/loginProcess', 'EytcpAuthController@loginProcess')->name('loginProcess');	

Route::group(['middleware' => 'auth'], function ()
{
    Route::any('/eytcphome', 'EytcpController@eytcp_home')->name('eytcphome');

    Route::any('/categorywisedata', 'eytcpController@categorywisedata')->name('categorywisedata');
	Route::any('/sendmailcred', 'EytcpController@sendmailcred')->name('sendmailcred');	
		
	Route::any('/TCPRegistration', 'eytcpController@TCPRegistration')->name('TCPRegistration');
	Route::post('/tbt/profile/update', [
	'uses' 			=> 'Tbt\TeamprofileController@update',
	'as'   			=> 'tbtUpdate'
	]);


// Route::get('EditProfile',[
//     'as'=>'EditProfile',
//     'uses'=> 'eytcpController@editProfile'
// ]);


Route::any('EditProfile', 'eytcpController@editProfile')->name('EditProfile');
Route::any('ProfileUpdate', 'eytcpController@Profileupdate')->name('ProfileUpdate');
});

/*-----------------Forgot Password---------------------*/
Route::get('/auth/forgot_pwd_land', [
	
	'as'			=>	'authForgotLand',
	'uses'			=>	'EytcpAuthController@forgetPasswordLand'
	]);
Route::post('/auth/forgot_pwd_process', [
	
	'as'			=>	'authForgotProcess',
	'uses'			=>	'EytcpAuthController@forgetPwdProcess'
	]);
Route::get('/auth/validate_token/{username}/{token}', [
	
	'as'			=>	'authValidateToken',
	'uses'			=>	'EytcpAuthController@validateToken'
	]);
Route::get('/auth/set_pwd_land', [
	
	'as'			=>	'authSetPwdLand',
	'uses'			=>	'EytcpAuthController@setPasswordLand'
	]);
Route::post('/auth/set_pwd_process', [
	
	'as'			=>	'authSetPwdProcess',
	'uses'			=>	'EytcpAuthController@setPassword'
	]);


