<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\KhoaHoc;

use DB;

class KhoaHocController extends Controller
{
  public function index()
  {
  	try {
      $ds_KhoaHoc = DB::table('KhoaHoc')->get();
      return response([
        'error'=>false,
        'message'=> compact('ds_KhoaHoc')],200);
    } 
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=> $e->getMessage()],200);
    }
  }

  public function store(Request $req)
  {
    try {
      DB::table('KhoaHoc')->insert([
        'kh_khoaHoc' => $req->kh_khoaHoc,
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
      $khoahoc = DB::table('KhoaHoc')->where('kh_khoaHoc',$id)->first();
      return response(['error'=>$khoahoc == null,
                      'message'=>$khoahoc == null ? "Không tìm thấy khóa học [{$id}]" : compact('khoahoc',$khoahoc)], 200);
    }
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=> $e->getMessage()],200);
    }
  }

  public function update(Request $req, $id)
  {
    try {
      DB::table('KhoaHoc')->where('kh_khoaHoc','=',$id)->update([
        'kh_khoaHoc' => $req->kh_sucChua
      ]);
      return response([
        'error'=>true,
        'message'=> "Cập nhật thành công phòng [{$id}]"],200);
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
      DB::table('KhoaHoc')->where('kh_khoaHoc','=',$id)->delete();
      return response([
          'error'=>true,
          'message'=> "Xóa thành công khóa học [{$id}]"],200);
    }
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=> $e->getMessage()],200);
    }
  }

}
