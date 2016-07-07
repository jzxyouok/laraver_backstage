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


/**
 * 前台入口
 */
Route::get('/', function () {
    return view('welcome');
});


/**
 * 后台入口
 */
Route::group(['prefix' => '/admin', 'namespace' => 'Backstage','middleware' => 'web'],function(){

    Route::get('/','IndexController@index');
});


/**
 * 微信部分
 */
Route::group(['prefix' => '/weixin', 'namespace' => 'Backstage','middleware' => 'web'],function(){

    Route::get('/','WeiXinController@index');
    Route::get('/addArticle','WeiXinController@updateWX');
    Route::get('/list','WeiXinController@wxList');
    Route::post('/delete','WeiXinController@deleteById');
});


/**
 * 定时运行
 */
Route::group(['prefix' => '/timing','namespace' => 'Backstage','middleware' => 'web'],function(){

   Route::get('/sendEmails','IndexController@sendEmails');
});