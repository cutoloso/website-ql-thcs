<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChuDe_GV_HS;
use App\ChuDe_GV_PH;
use DB;
use Illuminate\Support\Facades\Auth;

class ChuDeController extends Controller
{
	public function index()
	{
		$user_name = Auth::user()->name;
		$user_level = Auth::user()->level;
		switch ($user_level) {
			case '2':
								# giao vien
			try {
				$ds_ChuDe_GVPH = DB::table('ChuDe_GV_PH')->where('gv_ma',$user_name)->get();
				$ds_ChuDe_GVHS = DB::table('ChuDe_GV_HS')->where('gv_ma',$user_name)->get();
				return response([
					'error'=>false,
					'message'=> compact('ds_ChuDe_GVHS','ds_ChuDe_GVPH')],200);
			} 
			catch (\Exception $e) {
				return response([
					'error'=>true,
					'message'=> $e->getMessage()],200);
			}
			break;
			case '3':
                # phu huynh
			try {
				// chủ đề gv-ph
				$ds_ChuDe_GVPH = DB::table('ChuDe_GV_PH')->where('ph_ma',$user_name)->get();
				// chủ đề gv-hs
				$ds_hs = DB::table('HocSinh')
				->where('ph_ma','PH100')
				->get(['hs_ma']);
				$chudeGVHS = [];
				foreach ($ds_hs as $hs) {
					$chuDe = DB::table('ChuDe_GV_HS')->where('hs_ma',$hs->hs_ma)->get();
					array_push($chudeGVHS, $chuDe);
				}

				return response([
					'error'=>false,
					'message'=> compact('ds_ChuDe_GVPH','chudeGVHS')],200);
			} 
			catch (\Exception $e) {
				return response([
					'error'=>true,
					'message'=> $e->getMessage()],200);
			}
			break;

			case '4':
                # hoc sinh
			try {
				$ds_ChuDe_GVHS = DB::table('ChuDe_GV_HS')->where('hs_ma',$user_name)->get();
				return response([
					'error'=>false,
					'message'=> compact('ds_ChuDe_GVHS')],200);
			} 
			catch (\Exception $e) {
				return response([
					'error'=>true,
					'message'=> $e->getMessage()],200);
			}
			break;
		}
	}

	public function create()
	{
    	# code...
	}

	public function store(Request $req, $state)
	{
		try {
			switch (substr($req->name,0,2)) {
				case 'GV':
				if ($state=='ph') {
					DB::table('ChuDe_GV_PH')->insert([
						'cd_gvph_ten' => $req->cd_ten,
						'ph_ma' => $req->ph_ma,
						'gv_ma' => $req->name
					]);
				}
				else{
					DB::table('ChuDe_GV_HS')->insert([
						'cd_gvhs_ten' => $req->cd_ten,
						'hs_ma' => $req->hs_ma,
						'gv_ma' => $req->name
					]);
				}
				break;

				case 'PH':
				DB::table('ChuDe_GV_PH')->insert([
					'cd_gvph_ten' => $req->cd_ten,
					'ph_ma' => $req->name,
					'gv_ma' => $req->gv_ma
				]);
				break;
				case 'HS':
				DB::table('ChuDe_GV_HS')->insert([
					'cd_gvhs_ten' => $req->cd_ten,
					'hs_ma' => $req->name,
					'gv_ma' => $req->gv_ma
				]);
				break;
			}
			return response([
				'error'=>false,
				'message'=> "Thêm thành công"],200);
			
		} catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=> "Thêm thất bại"],200);
		}


	}

	public function show($cd_ma)
	{
		try {
			$ChuDe = DB::table('ChuDe_GV_HS')->where('cd_gvhs_ma',$cd_ma)->get();
			return response([
				'error'=>false,
				'message'=> compact('ChuDe')],200);
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
    	# code...
	}

	public function destroy($id)
	{
    	# code...
	}
	public function view($cd_loai, $cd_ma)
	{
		if ($cd_loai == 'gvhs') {
			$table = 'ChuDe_GV_HS';
			$ma = 'cd_gvhs_ma';
		} else {
			$table = 'ChuDe_GV_PH';
			$ma = 'cd_gvph_ma';
		}
		try {
			$ChuDe = DB::table($table)->where($ma, $cd_ma)->get();
			return response([
				'error'=>false,
				'message'=> compact('ChuDe')],200);
		} 
		catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=> $e->getMessage()],200);
		}
	}
}
