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

//后台登录
Route::resource("/adminlogin","Admin\AdminLoginController");

Route::group(["middleware"=>'login'],function(){
	//搭建后台
	Route::resource("/admin","Admin\AdminController");

	//用户模块
	Route::resource("/adminusers","Admin\UsersController");
	//用户Ajax删除
	Route::get("/adminusersdel","Admin\UsersController@del");



	//后台无限分类模块
	Route::resource("/admincates","Admin\CateController");


	//管理员管理模块
	Route::resource("/adminsuser","Admin\AdminuserController");
	//角色分配
	Route::get("/adminrole/{id}","Admin\AdminuserController@rolelist");
	//角色保存
	Route::post("/adminsaverole","Admin\AdminuserController@saverole");

	//帖子管理
	Route::resource("/adminarticle","Admin\ArticleController");
	//公告管理
	Route::resource("/admingonggao","Admin\GonggaoController");
	//友情链接管理
	Route::resource("/adminlink","Admin\LinkController");
	//轮播图管理
	Route::resource("/carousel","Admin\CarouselController");
	//广告管理
	Route::resource("/ads","Admin\AdsController");



});


//前台首页
// Route::resource("/homeindex","Home\IndexController");
//前台首页
// Route::resource("/homeindex","Home\IndexController");
