<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class MonHocController extends Controller
{
    public function index()
    {
    	# code...
    }

    public function create()
    {
    	# code...
    }

    public function store(Request $req)
    {
    	# code...
    }
	
    // môn học giáo viên được dạy
    // public function show($mh_ma)
    // {
    //     try {
    //         $tocm = DB::table('GiaoVien')->where('mh_ma',$mh_ma)->pluck('cm_ma')->first();
    //         $ds_mh = DB::table('MonHoc')
    //         ->where('mh_ma','like',$tocm.'_')->get();
    //         return response([
    //             'error'   => false,
    //             'message' => compact('ds_mh')],200);
    //     }
    //     catch (Exception $e) {
    //         return response([
    //             'error'   => true,
    //             'message' => $e->getMessage()],200);
    //     }
    // }

    //  giáo viên dạy môn học
    public function show($id)
    {
        
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
// Môn học theo khối
    public function monHoc_khoi($khoi)
    {
        try {
            $ds_mh = DB::table('MonHoc')->where('mh_ma','like','%'.$khoi)->get();
            return response([
                'error'     =>false,
                'message'   =>compact('ds_mh')]);  
        } catch (Exception $e) {
            return respose([
                'error'     => true,
                'message'   =>$e->message()]);
        }
    }

}
