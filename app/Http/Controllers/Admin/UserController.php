<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019/3/21
 * Time: 21:45
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class UserController extends Controller
{
	//用户列表
	public function index()
	{
		$data = DB::table("user")
			->leftJoin("user_role","user.id","=","user_role.uid")
			->leftJoin("role","user_role.role_id","=","role.id")
			->select("user.*","user_role.role_id","role.name as role_name")
			->get();

		return view('admin.user.index',compact('data',$data));
	}

	//添加用户
	public function addUser($id=0)
	{
		$roles = DB::table("role")->get();
		$id = intval($id);
		if(!empty($id)){
			$user = DB::table('user')
				->leftJoin("user_role","user.id","=","user_role.uid")
				->leftJoin("role","user_role.role_id","=","role.id")
				->select("user.*","user_role.role_id","role.name as role_name")
				->where('user.id',$id)
				->first();
		} else {
			$user = [];
		}

		return view("admin.user.add",compact('roles','user'));
	}

	public function doAddUser(Request $request)
	{
		$data = $request->all();
		$id = isset($data['id']) ? $data['id'] : '';
		$name = $data['name'];
		$email= $data['email'];
		$status = $data['status'];
		$role_id = $data['role_id'];

		try{

			if(empty($id)){
				$exists = DB::table("user")->where('email',$email)->first();

				if(!empty($exists)){
					throw new Exception("用户已经存在");
				}

				$id = DB::table("user")->insertGetId(['name'=>$name,'status'=>$status,"email"=>$email]);

				//设置用户角色
				$role_insert_id = DB::table("user_role")->insertGetId(['uid'=>$id,"role_id"=>$role_id]);
				if($id <= 0 || $role_insert_id<0){
					throw new Exception("操作失败");
				}

				$res = ['success'=>true,'msg'=>'添加成功','id'=>$id];
			} else {
				$exists = DB::table("user")->where('id',$id)->first();

				if(empty($exists)){
					throw new Exception("系统错误 数据不存在");
				}

				$affected_rows = DB::table("user")->where('id',$id)->update(['name'=>$name,'status'=>$status,"email"=>$email]);

				//设置用户角色
				$role_info = DB::table("user_role")->where("uid",$id)->get()->toArray();
				if(empty($role_info)){
					$role_insert_id = DB::table("user_role")->where('uid',$id)->insertGetId(["uid"=>$id,"role_id"=>$role_id]);
					if($id <= 0 || $role_insert_id<0){
						throw new Exception("操作失败");
					}
				} else {
					$role_insert_id = DB::table("user_role")->where('uid',$id)->update(["role_id"=>$role_id]);
					if($id <= 0 || $role_insert_id<0){
						throw new Exception("操作失败");
					}
				}


				$res = ['success'=>true,'msg'=>'更新成功','id'=>$id];
			}


			return json_encode($res);
		} catch(Exception $e){
			return json_encode(['success'=>false,'msg'=>$e->getMessage()]);
		}

	}


	//删除用户
	public function deleteUser(Request $request)
	{
		$id = $request->input("id");

		$affected_rows = DB::table('user')->where('id', $id)->delete();
		DB::table("user_role")->where('uid',$id)->delete();
		try{
			if($affected_rows <= 0){
				throw new Exception("删除失败");
			}
			return json_encode(['success'=>true,'msg'=>'操作成功']);
		}catch (Exception $e){
			return json_encode(['success'=>false,'msg'=>$e->getMessage()]);
		}
	}
}