<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
class ThongBaoTruongController extends Controller
{
	public function index()
	{
		try {
			$ds_ThongBaoTruong = DB::table('ThongBaoTruong')->get();

			return response([
				'error'=>false,
				'message'=> compact('ds_ThongBaoTruong')],200);

		} catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}

	public function create()
	{
		return view('thongBaoTruong.create');
	}

	public function store(Request $req)
	{
		if ($req->hasFile('tbt_noiDung')) {
			
			$user = Auth::user()->name;
			$pathFile = $req->tbt_noiDung->store('public/thongBao');
			try {
				if ($pathFile) {
					DB::table('ThongBaoTruong')->insert([
	    				'tbt_tieuDe'=>$req->tbt_tieuDe,
						'tbt_ngayBD'=>date('Y-m-d', strtotime($req->tbt_ngayBD)),
						'tbt_ngayKT'=>date('Y-m-d', strtotime($req->tbt_ngayKT)),
						'tbt_noiDung'=>$pathFile,
						'qt_ma'=>$user
					]);
				}
				return redirect()->route('dsthongbaotruong');
			} 
			catch (\Exception $e) {
				return response([
					'error'=>true,
					'message'=>"Thêm thất bại"]);
			}
		}
		else{
			return response([
				'error'=>true,
				'message'=> "upload file error" ],200);
		}
	}

	public function show($id)
	{
		try {
			$thongBaoTruong = DB::table('ThongBaoTruong')->where('tbt_ma',$id)->first();
			return response([
				'error'=>false,
				'message'=> compact('thongBaoTruong')],200);
		} catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}

	public function edit($id)
	{
		return view('thongBaoTruong.edit');
	}

	public function update(Request $req, $id)
	{
		if ($req->hasFile('tbt_noiDung')) {
			$thongBaoTruong = DB::table('ThongBaoTruong')->where('tbt_ma',$id)->first();
			$path = $thongBaoTruong->tbt_noiDung;
			Storage::delete($path);
			$pathFile = $req->tbt_noiDung->store('public/thongBao');
			try {
				if ($pathFile) {
					DB::table('ThongBaoTruong')->update([
	    			'tbt_tieuDe'=>$req->tbt_tieuDe,
						'tbt_ngayBD'=>date('Y-m-d', strtotime($req->tbt_ngayBD)),
						'tbt_ngayKT'=>date('Y-m-d', strtotime($req->tbt_ngayKT)),
						'tbt_noiDung'=>$pathFile
					]);
				}
				return redirect()->route('dsthongbaotruong');
			} 
			catch (\Exception $e) {
				return response([
					'error'=>true,
					'message'=> $e->getMessage()],200);
			}
		}
		else{
			try {
				DB::table('ThongBaoTruong')->update([
    			'tbt_tieuDe'=>$req->tbt_tieuDe,
					'tbt_ngayBD'=>date('Y-m-d', strtotime($req->tbt_ngayBD)),
					'tbt_ngayKT'=>date('Y-m-d', strtotime($req->tbt_ngayKT)),
				]);
				return redirect()->route('dsthongbaotruong');
			} 
			catch (\Exception $e) {
				return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
			}
		}

	}

	public function destroy($id)
	{
		try {
			$ThongBaoTruong = DB::table('ThongBaoTruong')->where('tbt_ma',$id)->first();
			$path = $ThongBaoTruong->tbt_noiDung;
			if(Storage::delete($path)){
				DB::table('ThongBaoTruong')->where('tbt_ma','=',$id)->delete();
				return response([
					'error'=>true,
					'message'=> "Xóa thành công thông báo trường [{$id}]"],200);
			}
			else{
				return response([
					'error'=>true,
					'message'=> "Xóa thất bại "],200);
			}
		}
		catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}

	public function test()
	{
		// if (Storage::delete('public/thongBao/vHRIihoXWQ4mWjIbHfcsKpu19NIMQTuun3ZH0UB4.jpeg')) {
		// 	return "deleted";
		// }
		$ThongBaoTruong = DB::table('ThongBaoTruong')->where('tbt_ma',15)->first();
		$path = $ThongBaoTruong->tbt_noiDung;
		return $path;
	}

}
