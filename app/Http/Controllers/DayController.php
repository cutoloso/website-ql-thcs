<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DayController extends Controller
{
	public function index()
	{
		try {
			$ds_day = DB::table('Day')->get();
			return response([
				'error'=>false,
				'message'=>compact('ds_day')]);            
		} catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=>$e->message()]);  
		}
	}

	public function create()
	{
    	# code...
	}

	public function store(Request $req)
	{
		try {
			DB::table('Day')->insert([
				'mh_ma'			=> $req->mh_ma,
				'l_ma' 			=> $req->l_ma,
				'kh_khoaHoc'	=> $req->kh_khoaHoc,
				'gv_ma'			=> $req->gv_ma
			]);
			return response([
				'error'=>false,
				'message'=>"Thêm thành công"],200);            
		} catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=>"Thêm thất bại"],200);  
		}
	}

	public function show($kh_khoaHoc,$l_ma)
	{
		try {
			$ds_day = DB::table('Day')
			->leftJoin('MonHoc', 'Day.mh_ma', '=', 'MonHoc.mh_ma')
			->leftJoin('GiaoVien', 'Day.gv_ma', '=', 'GiaoVien.gv_ma')
			->where('kh_khoaHoc',$kh_khoaHoc)
			->where('l_ma',$l_ma)
			->get();
			return response([
				'error'=>false,
				'message'=>compact('ds_day')],200);            
		} catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=>$e->message()]);  
		}
	}

	public function edit(Request $req)
	{
    	# code...
	}

	public function update(Request $req)
	{
		try {
			DB::table('Day')
			->where('mh_ma',$req->mh_ma)
			->where('l_ma',$req->l_ma)
			->where('kh_khoaHoc',$req->kh_khoaHoc)
			->update(['gv_ma' => $req->gv_ma]);
			return response([
				'error'=>false,
				'message'=> "Cập nhật thành công"],200);
		}
		catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}

	public function destroy($id)
	{
    	# code...
	}

	public function delete(Request $req)
	{
		try {
			DB::table('Day')
			->where('mh_ma',$req->mh_ma)
			->where('l_ma',$req->l_ma)
			->where('kh_khoaHoc',$req->kh_khoaHoc)
			->where('gv_ma',$req->gv_ma)
			->delete();
			return response([
				'error'=>false,
				'message'=> "Xóa thành công"],200);
		}
		catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}

	public function getGV($kh_khoaHoc, $l_ma, $mh_ma)
	{
		try {
			$ds_gv = DB::table('Day')
			->where('kh_khoaHoc',$kh_khoaHoc)
			->where('l_ma',$l_ma)
			->where('mh_ma',$mh_ma)
			->first();
			return response([
				'error'=>false,
				'message'=>compact('ds_gv')]);            
		} catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=>$e->message()]);  
		}
	}
	public function getLop($kh_khoaHoc, $gv_ma)
	{
		try {
			$ds_lop = DB::table('Day')
			->where('gv_ma',$gv_ma)
			->where('kh_khoaHoc',$kh_khoaHoc)
			->get(['l_ma']);

			return response([
				'error'=>false,
				'message'=>compact('ds_lop')]);            
		} catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=>$e->message()]);  
		}
	}

}
