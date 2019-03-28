<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019/3/21
 * Time: 21:46
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Route;

class RoleController extends Controller
{
	//角色列表
	public function index()
	{
		$data = DB::table('role')
			->get();

		$rols = DB::table("user_role")->select(DB::raw("role_id,count(*) as number "))
			->groupBy("role_id")
			->get();
		$number= [];
		foreach ($rols as $v){
			$number[$v->role_id] = $v;
		}
		return view("admin.role.index",compact("data","number"));
	}

	public function show(Role $role)
	{
		dd($role);
	}

	//添加角色
	public function addRole(Request $request,$id=0)
	{
		$id = intval($id);
		if(!empty($id)){
			$role = DB::table('role')->where('id',$id)
				->first();
			$role->urls = json_decode($role->urls,true);
		} else {
			$role = [];
		}
		$access = config('menu');

		return view('admin.role.add',compact("role","access"));
	}

	public function store(Request $request)
	{
		$data = $request->all();
		$id = isset($data['id']) ? $data['id'] : '';
		$name = $data['name'];
		$status = $data['status'];
		$urls = $data['urls'];


		try{

			if(empty($id)){
				$exists = DB::table("role")->where('name',$name)->first();

				if(!empty($exists)){
					throw new Exception("角色名称已经存在");
				}

				$id = DB::table("role")->insertGetId(['name'=>$name,'status'=>$status,"urls"=>json_encode($urls)]);
				if($id <= 0 ){
					throw new Exception("操作失败");
				}

				$res = ['success'=>true,'msg'=>'添加成功','id'=>$id];
			} else {
				$exists = DB::table("role")->where('id',$id)->first();

				if(empty($exists)){
					throw new Exception("系统错误 数据不存在");
				}

				$id = DB::table("role")->where('id',$id)->update(['name'=>$name,'status'=>$status,"urls"=>json_encode($urls),'updated_time'=>date("Y-m-d H:i:s")]);
				if($id <= 0 ){
					throw new Exception("操作失败");
				}

				$res = ['success'=>true,'msg'=>'更新成功','id'=>$id];
			}


			return json_encode($res);

		}catch(Exception $e){
			return json_encode(['success'=>false,'msg'=>$e->getMessage()]);
		}

	}


	//删除角色
	public function deleteRole(Request $request)
	{
		$data = $request->all();
		$id = $data['id'];
		//查询角色是否还有用户
		$res = DB::table("user_role")->where('role_id',$id)->first();

		try{
			if(!empty($res)){
				throw new Exception("该角色下还有用户 不能删除！");
			}
			$affected_rows = DB::table('role')->where('id', $id)->delete();

			if($affected_rows <= 0){
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

	public function create(Request $request ,$id = 0)
	{

		$id = intval($id);
		if(!empty($id)){
			$role = DB::table('role')->where('id',$id)
				->first();
			$role->urls = json_decode($role->urls,true);
		} else {
			$role = [];
		}
		$access = config('menu');

		return view('admin.role.add',compact("role","access"));
	}



}
