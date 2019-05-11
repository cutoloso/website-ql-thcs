<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ThongBaoLopController extends Controller
{
	public function index()
	{
		try {
			// if (Auth::user()->level == 2) {//giao vien
			// 	$name = Auth::user()->name;
			// 	$ds_thongBaoLop = DB::table('ThongBaoLop')->where('gv_ma',$name)->get();
			// }
			// elseif (Auth::user()->level == 4) {//hoc sinh
			// 	$hs = DB::table('HocSinh')
			// 	->where('hs_ma',Auth::user()->name)
			// 	->get(['l_ma','kh_khoaHoc']);

			// 	$ds_thongBaoLop = DB::table('ThongBaoLop')
			// 	->where('l_ma',$hs[0]->l_ma)
			// 	->where('kh_khoaHoc',$hs[0]->kh_khoaHoc)
			// 	->get();
			// }
			 $ds_thongBaoLop = DB::table('ThongBaoLop')->get();
			return response([
				'error'=>false,
				'message'=> compact('ds_thongBaoLop')],200);

		} catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}

	public function create()
	{
    	# code...
	}

	public function store(Request $req)
	{
		try {
			$user = Auth::user()->name;
			$l_ma = DB::table('Lop')->where('gv_ma',$user)->first()->l_ma;
			$tbl_ngayBD = new Carbon(substr($req->tbl_ngayBD,3,12));
			$tbl_ngayKT = new Carbon(substr($req->tbl_ngayKT,3,12));
			DB::table('ThongBaoLop')->insert([
				'tbl_tieuDe'	=>$req->tbl_tieuDe,
				// 'tbl_ngayBD'=>date('Y-m-d', strtotime($req->tbl_ngayBD)),
				// 'tbl_ngayKT'=>date('Y-m-d', strtotime($req->tbl_ngayKT)),
				'tbl_ngayBD' 	=>$tbl_ngayBD,
				'tbl_ngayKT' 	=>$tbl_ngayKT,
				'tbl_noiDung'	=>$req->tbl_noiDung,
				'l_ma'			=>$l_ma,
				'gv_ma'			=>$user
			]);

			return response([
				'error'=>false,
				'message'=> "Thêm thành công"],200);

		} 
		catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=>"Thêm thất bại"]);
		}

	}

	public function show($id)
	{
		try {
			$thongBaoLop = DB::table('ThongBaoLop')->where('tbl_ma',$id)->first();
			return response(['error'=>$thongBaoLop == null,
				'message'=>compact('thongBaoLop',$thongBaoLop)], 200);
		}
		catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}

	public function edit($id)
	{
    	# code...
	}

	public function update(Request $req, $id)
	{
		try {
			$tbl_ngayBD = new Carbon(substr($req->tbl_ngayBD,3,12));
			$tbl_ngayKT = new Carbon(substr($req->tbl_ngayKT,3,12));
			DB::table('ThongBaoLop')->where('tbl_ma',$id)->update([
				'tbl_tieuDe' 	=>$req->tbl_tieuDe,
				// 'tbl_ngayBD'=>date('Y-m-d', strtotime($req->tbl_ngayBD)),
				// 'tbl_ngayKT'=>date('Y-m-d', strtotime($req->tbl_ngayKT)),
				'tbl_ngayBD' 	=>$tbl_ngayBD,
				'tbl_ngayKT' 	=>$tbl_ngayKT,
				'tbl_noiDung' =>$req->tbl_noiDung
			]);
			return response([
				'error'=>true,
				'message'=> "Cập nhật thành công thông báo [{$id}]"],200);
		} 
		catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}

	public function destroy($id)
	{
		try {
			DB::table('ThongBaoLop')->where('tbl_ma','=',$id)->delete();
			return response([
				'error'=>true,
				'message'=> "Xóa thành công thông báo [{$id}]"],200);
		}
		catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}
}
