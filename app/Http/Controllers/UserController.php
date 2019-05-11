<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
	public function index()
	{
		try {
			$ds_taiKhoan = DB::table('users')->get();
			return response([
				'error'=>false,
				'message'=> compact('ds_taiKhoan')],200);
		} 
		catch (Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}

	public function store(Request $req)
	{
		try {
			DB::table('users')->insert([
				'name' => $req->name,
				'password' => Hash::make($req->password),
				'level' => $req->level,
				'created_at' => date('Y-m-d', time())
			]);
			return response([
				'error'=>false,
				'message'=> "Thêm thành công"],200);
		} 
		catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=> "Thêm tài khoản bị lỗi"],200);
		}
	}

	public function show($id)
	{
		try {
			$tk = DB::table('users')->where('name',$id)->first();
			return response(['error'=>$tk == null,
				'message'=>compact('tk')], 200);
		}
		catch (Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}

	public function update(Request $req, $id)
	{
		try {
			DB::table('users')->where('name','=',$id)->update([
				'password' => Hash::make($req->password),
				'level' => $req->level,
				'updated_at' => date('Y-m-d', time())
			]);
			return response([
				'error'=>true,
				'message'=> "Cập nhật thành công tài khoản [{$id}]"],200);
		} 
		catch (Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}

	public function destroy($id)
	{
		try {
			DB::table('users')->where('name','=',$id)->delete();
			return response([
				'error'=>true,
				'message'=> "Xóa thành công tài khoản [{$id}]"],200);
		}
		catch (Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}

}
