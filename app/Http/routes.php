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

Route::group(['prefix' => '/admin', 'namespace' => 'Backstage','middleware' => 'web'],function(){

    Route::get('/','IndexController@index');
});

Route::group(['prefix' => '/weixin', 'namespace' => 'Backstage','middleware' => 'web'],function(){

    Route::get('/','WeiXinController@index');
    Route::get('/addArticle','WeiXinController@updateWX');
    Route::post('/delete','WeiXinController@deleteById');

});