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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/notActive', function () {
    return view('notActive');
});
Route::auth();
Route::group(['middleware' => 'auth'], function()
{
    Route::group(['middleware' => 'redirectIfNotAdmin'], function()
    {
    	Route::get('/keystore/register',function(){
    		return view('keystore/register');
    	});
    	Route::get('/keystore/manageKeystores',['as'=>'admin.createkeystore','uses'=>'keystoreController@getKeystores']);
       	Route::post('keystore/register',['as'=>'admin.createkeystore','uses'=>'keystoreController@storeKeystore']);
    	Route::post('keystore/manageKeystores',['as'=>'admin.managekeystore','uses'=>'keystoreController@manageKeystores']);
    	Route::post('keystore/keystore/{id}',['as'=>'admin.getDetails','uses'=>'keystoreController@getKeystoreDetails']);
        Route::get('/keystore/upgrade/{id}',['as'=>'admin.upgrade','uses'=>'keystoreController@getupgrade']);
        Route::post('keystore/upgrade/{id}',['as'=>'admin.upgrade','uses'=>'keystoreController@setupgrade']);
    	
    });

    Route::group(['middleware' => 'redirectIfNotActive'], function()
    {
        Route::get('/keystore/updateKeystore',['as'=>'admin.createkeystore','uses'=>'keystoreController@getKeystoreToUpdate']);
        Route::post('/keystore/update/{id}',['as'=>'admin.createkeystore','uses'=>'keystoreController@setupdate']);
    });


});

Route::group(['prefix' => 'api'], function () {
	Route::post('getShops',['as'=>'key.getShops','uses'=>'keystoreController@getShops']);
	Route::post('getShop',['as'=>'key.getShop','uses'=>'keystoreController@getKeystore']);
	Route::post('register',['as'=>'key.register','uses'=>'keystoreController@register']);
	Route::post('userLogin',['as'=>'key.uLogin','uses'=>'keystoreController@userLogin']);
	Route::post('setRate',['as'=>'key.setRate','uses'=>'keystoreController@setRate']);
    Route::post('getStatues',['as'=>'key.getStatues','uses'=>'keystoreController@getStatues']);
});

Route::get('/home', 'HomeController@index');
