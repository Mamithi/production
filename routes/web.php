<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'web'], function($api){
	$api->post('search','App\Http\Controllers\SearchController@search');
});

$api->version('v1', function($api){
	$api->post('private','App\Http\Controllers\SearchController@private');
});

$api->version('v1', function($api){
	$api->post('bulk','App\Http\Controllers\SearchController@bulk');
});

$api->version('v1', function($api){
	$api->post('register','App\Http\Controllers\RegisterController@register');
});

$api->version('v1', function($api){
	$api->post('verify','App\Http\Controllers\RegisterController@verify');
});

$api->version('v1', function($api){
	$api->post('valid','App\Http\Controllers\RegisterController@valid');
});

$api->version('v1', ['middleware' => 'web'], function($api){
	$api->post('login','App\Http\Controllers\RegisterController@login');
});

$api->version('v1', function($api){
	$api->post('company','App\Http\Controllers\RegisterController@company');
});

$api->version('v1', function($api){
	$api->post('validCompany','App\Http\Controllers\RegisterController@validCompany');
});

$api->version('v1', function($api){
	$api->post('forgot','App\Http\Controllers\RegisterController@forgot');
});

$api->version('v1', function($api){
	$api->post('resetPassword','App\Http\Controllers\RegisterController@resetPassword');
});


//Api Token Authentication
$api->version('v1', function($api){
	$api->post('apiRegister','App\Http\Controllers\AuthController@apiRegister');
});

$api->version('v1', function($api){
	$api->post('authenticate','App\Http\Controllers\AuthController@authenticate');
});


//Routes to import and export excel sheets for bulk verification
$api->version('v1', function($api){
	$api->get('downloadExcel','App\Http\Controllers\ExcelController@downloadExcel');
});

$api->version('v1', function($api){
	$api->get('importExport','App\Http\Controllers\ExcelController@importExport');
});

$api->version('v1', function($api){
	$api->post('importExcel','App\Http\Controllers\ExcelController@importExcel');
});


$api->version('v1', function($api){
	$api->get('deleteExcel','App\Http\Controllers\ExcelController@deleteExcel');
});

$api->version('v1', function($api){
	$api->post('creditsBal','App\Http\Controllers\RegisterController@creditsBal');
});


$api->version('v1', function($api){
	$api->post('credits','App\Http\Controllers\RegisterController@credits');
});


$api->version('v1', function($api){
	$api->post('getId','App\Http\Controllers\RegisterController@getId');
});


//buying credits
$api->version('v1', function($api){
	$api->post('buyCredits','App\Http\Controllers\ExcelController@buyCredits');
});

//setting sessions
$api->version('v1', ['middleware' => 'web'], function($api){
	$api->get('session/get','App\Http\Controllers\UserController@accessSessionData');
});

$api->version('v1', ['middleware' => 'web'], function($api){
	$api->get('session/set','App\Http\Controllers\UserController@storeSessionData');
});

$api->version('v1', ['middleware' => 'web'], function($api){
	$api->get('session/remove','App\Http\Controllers\UserController@deleteSessionData');
});


//lock screen
$api->version('v1', ['middleware' => 'web'], function($api){
	$api->post('lockScreen','App\Http\Controllers\RegisterController@lockScreen');
});

//Short code routes
$api->version('v1', function($api){
	$api->post('join','App\Http\Controllers\PhoneController@join');
});

$api->version('v1', function($api){
	$api->post('phoneRegister','App\Http\Controllers\PhoneController@phoneRegister');
});


$api->version('v1', function($api){
	$api->post('codeCheck','App\Http\Controllers\PhoneController@codeCheck');
});

// 'before' => 'oauth', 

//knec api
$api->version('v1', function($api){
	$api->post('knecCert','App\Http\Controllers\PhoneController@knecCert');
});


$api->version('v1', function($api){
	$api->post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});
});


Route::get('/register ',function(){$user = new App\User();
 $user->name="test user";
 $user->email="test@test.com";
 $user->password = \Illuminate\Support\Facades\Hash::make("password");
 $user->save();
 
});

Route::post('/register ',function(){$user = new App\User();
 
});