<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019/3/21
 * Time: 21:50
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;


class AccessController extends Controller
{
	//权限列表
	public function index()
	{

		$access = config('menu');
		return view("admin.access.index",compact('access'));
	}

	//添加权限
	public function addAccess($id=0)
	{
		$id = intval($id);
		if(!empty($id)){
			$access = DB::table('role')->where('id',$id)
				->first();
		} else {
			$access = [];
		}

		return view('admin.access.add',compact('access'));
	}


	//删除权限
	public function deleteAccess()
	{
		//todo
		return "删除权限";
	}

	public function doAddAccess(Request $request)
	{
		$data = $request->all();
		$id = isset($data['id']) ? $data['id'] : '';
		$urls = $data['urls'];

		try{

			if(empty($id)){
				$exists = DB::table("access")->where("urls",$urls)->first();

				if(!empty($exists)){
					throw new Exception("权限已经存在");
				}

				$id = DB::table("access")->insertGetId(['urls'=>$urls]);
				if($id <= 0 ){
					throw new Exception("操作失败");
				}

				$res = ['success'=>true,'msg'=>'添加成功','id'=>$id];
			} else {
				$exists = DB::table("access")->where('id',$id)->first();

				if(empty($exists)){
					throw new Exception("系统错误 数据不存在");
				}

				$id = DB::table("access")->where('id',$id)->update(['title'=>$title,'urls'=>$urls]);
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

}