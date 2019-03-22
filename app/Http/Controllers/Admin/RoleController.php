<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019/3/21
 * Time: 21:46
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class RoleController extends Controller
{
	//角色列表
	public function index()
	{
		$data = DB::table('role')->get();
		return view("admin.role.index",compact("data",$data));
	}

	//添加角色
	public function addRole($id=0)
	{
		return view('admin.role.add');
	}

	public function doAddRole(Request $request)
	{
		$data = $request->all();
		$name = $data['name'];
		$status = $data['status'];

		$exists = DB::table("role")->where('name',$name)->first();
		try{
			if(!empty($exists)){
				throw new Exception("角色名称已经存在");
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
	public function deleteRole(Request $request)
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

	//设置角色权限
	public function setRoleAccess()
	{
		//todo
		return "设置角色权限";
	}

}