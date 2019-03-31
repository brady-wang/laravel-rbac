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
	Route::post("/role/del","RoleController@deleteRole");
	Route::Resource("role","RoleController");

	//用户管理
	Route::any("/users","UserController@index");
	Route::any("/user/add/{id?}","UserController@addUser");
	Route::any("/user/del","UserController@deleteUser");
	Route::any("/user/doAdd","UserController@doAddUser");


	//角色管理
//	Route::any("/roles","RoleController@index");
//	Route::any("/role/add/{id?}","RoleController@addRole");
//	Route::any("/role/del","RoleController@deleteRole");
//	Route::any("/role/access","RoleController@setRoleAccess");
//	Route::any("/role/doAdd","RoleController@doAddRole");

	//权限管理
	Route::any("/accesses","AccessController@index");

});