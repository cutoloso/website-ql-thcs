<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Phong;

use DB;

class PhongController extends Controller
{
  public function index()
  {
  	try {
      $ds_Phong = DB::table('Phong')->get();
      return response([
        'error'=>false,
        'message'=> compact('ds_Phong')],200);
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
      DB::table('Phong')->insert([
        'p_ma' => $req->p_ma,
        'p_sucChua' => $req->p_sucChua,
        'p_ghiChu' => $req->p_ghiChu
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
      $phong = DB::table('Phong')->where('p_ma',$id)->first();
      return response(['error'=>$phong == null,
                      'message'=>$phong == null ? "Không tìm thấy phòng có mã [{$id}]" : compact('phong',$phong)], 200);
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
      DB::table('Phong')->where('p_ma','=',$id)->update([
        'p_sucChua' => $req->p_sucChua,
        'p_ghiChu' => $req->p_ghiChu
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
      DB::table('Phong')->where('p_ma','=',$id)->delete();
      return response([
          'error'=>true,
          'message'=> "Xóa thành công phòng [{$id}]"],200);
    }
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=> $e->getMessage()],200);
    }
  }

}
