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
		return view('admin.user.index');
	}

	//添加用户
	public function addUser()
	{
		return view("admin.user.add");
	}

	public function doAddUser(Request $request)
	{
		$data = $request->all();
		$name = $data['name'];
		$email= $data['email'];
		$status = $data['status'];

		$exists = DB::table("user")->where('email',$email)->first();
		try{
			if(!empty($exists)){
				throw new Exception("用户已经存在");
			}

			$id = DB::table("role")->insertGetId(['name'=>$name,'status'=>$status]);
			if($id <= 0 ){
				throw new Exception("操作失败");
			}

			$res = ['success'=>true,'msg'=>'添加成功','id'=>$id];
			return json_encode($res);
		} catch(Exception $e){
			return json_encode(['success'=>false,'msg'=>$e->getMessage()]);
		}

	}


	//删除角色
	public function deleteUser(Request $request)
	{
		$id = $request->input("id");
		$res = DB::table('role')->where('id', $id)->delete();
		try{
			if(!$res){
				throw new Exception("删除失败");
			}
			return json_encode(['success'=>true,'msg'=>'操作成功']);
		}catch (Exception $e){
			return json_encode(['success'=>false,'msg'=>$e->getMessage()]);
		}
	}
}