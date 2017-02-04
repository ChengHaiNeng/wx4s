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




//
Route::any('/index','IndexController@index');
//用户中心
Route::any('/center','CenterController@center');

//登入，登出
Route::any('/login', "CenterController@login");
Route::any('/logout', "CenterController@logout");

//填写个人信息路由
Route::any('/fullfill', "UserController@fullfill");

//展示个人信息路由
Route::any('/infolist', "UserController@infolist");

//公司静态展示
Route::any('/company', "UserController@company");
//在线预约
Route::any('/zxyy', "YuyueController@zxyy");

//重新预约，改天预约当天的预约时间
Route::any('/reyy', "YuyueController@reyy");

//查看我的预约
Route::any('/myyy', "YuyueController@myyy");