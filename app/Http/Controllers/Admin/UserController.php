<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019/3/21
 * Time: 21:45
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
	//用户列表
	public function index()
	{
		return "用户列表";
	}

	//添加用户
	public function addUser()
	{
		return "用户新增";
	}

	//删除用户
	public function deleteUser()
	{
		return "删除用户";
	}
}