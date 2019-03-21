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
Route::get("/",function(){
	return redirect("/admin");
});


Route::namespace('Admin')->prefix("admin")->group(function (){
	//首页
	Route::get("/","IndexController@index");

	//用户管理
	Route::any("/users","UserController@index");
	Route::any("/user/add/{id?0}","UserController@addUser");
	Route::any("/user/del/{id}","UserController@deleteUser");

	//角色管理
	Route::any("/roles","RoleController@index");
	Route::any("/role/add{id?0}","RoleController@addRole");
	Route::any("/role/del/{id}","RoleController@deleteRole");
	Route::any("/role/access","RoleController@setRoleAccess");

	//权限管理
	Route::any("/accesses","AccessController@index");
	Route::any("/access/add/{id?0}","AccessController@addAccess");
	Route::any("/access/del/{id}","AccessController@deleteAccess");
});