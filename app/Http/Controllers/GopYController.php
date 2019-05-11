<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GopY_GV_HS;
use App\GopY_GV_PH;
use App\ChuDe_GV_HS;
use App\ChuDe_GV_PH;
use DB;
use Illuminate\Support\Facades\Auth;

class GopYController extends Controller
{
	public function index()
	{
		
	}

	public function create()
	{
    	# code...
	}

	public function store(Request $req)
	{
		try {
			if ($req->loai == 'gvhs') {
				DB::table('GopY_GV_HS')->insert([
					'cd_gvhs_ma' => $req->cd_ma,
					'gy_gvhs_noiDung' => $req->gy_noiDung,
					'gy_nguoiGY' => $req->gy_nguoiGY
				]);

				return response([
					'error'=>false,
					'message'=> "Thêm thành công"],200);

			}
			else{
				DB::table('GopY_GV_PH')->insert([
					'cd_gvph_ma' => $req->cd_ma,
					'gy_gvph_noiDung' => $req->gy_noiDung,
					'gy_nguoiGY' => $req->gy_nguoiGY
				]);
				
				return response([
					'error'=>false,
					'message'=> "Thêm thành công"],200);
			}
		}
		catch (\Exception $e) {
			return response([
				'error'=>true,
				'message'=>"Thêm thất bại"]);
		}

	}

	public function show($cd_ma)
	{
		return view('gopY.show');
	}

	public function view($loai_chude, $cd_ma)
	{
		if ($loai_chude == 'gvhs') {
			$loai_chude = 'GopY_GV_HS';
			$ma = 'cd_gvhs_ma';
		}
		else{
			$loai_chude = 'GopY_GV_PH';
			$ma = 'cd_gvph_ma';
		}

		try {
			$ds_GopY = DB::table($loai_chude)->where($ma,$cd_ma)->get();
			return response([
				'error'=>true,
				'message'=> compact('ds_GopY')],200);
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
	}
