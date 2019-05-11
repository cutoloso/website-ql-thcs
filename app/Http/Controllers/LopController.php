<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lop;

use DB;

class LopController extends Controller
{
  public function index()
  {
  	try {
      $ds_Lop = DB::table('Lop')->get();
      return response([
        'error'=>false,
        'message'=> compact('ds_Lop')],200);
    } 
    catch (\Exception $e) {
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
      DB::table('Lop')->Insert([
        'l_ma'        => $req->l_ma,
        'kh_khoaHoc'  => $req->kh_khoaHoc,
        'p_ma'        => $req->p_ma,
        'gv_ma'       => $req->gv_ma
      ]);

      return response([
          'error'   => false,
          'message' => "Thêm thành công"],200);
    } 
    catch (\Exception $e) {
      return response([
        'error'   => false,
        'message' => "Có lỗi khi thêm lớp"],200);
    }
  }

  public function show($id)
  {
  	try {
      $ds_Lop = DB::table('Lop')->where('l_ma',$id)->get();
      return response([
        'error'=>false,
        'message'=> compact('ds_Lop')],200);
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

  public function update(Request $req, $l_ma)
  {
  	try {
      DB::table('Lop')
      ->where('l_ma',$l_ma)
      ->where('kh_khoaHoc',$req->kh_khoaHoc)->update([
          'p_ma' => $req->p_ma,
          'gv_ma'=> $req->gv_ma
      ]);

      return response([
        'error'=>false,
        'message'=> "Sửa lớp thành công" ],200);
    } 
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=> "Có lỗi khi sửa lớp"],200);
    }
  }

  public function destroy(Request $req)
  {
    try {
      DB::table('Lop')
      ->where('l_ma',$req->l_ma)
      ->where('kh_khoaHoc',$req->kh_khoaHoc)
      ->delete();

      return response([
        'error'=>false,
        'message'=> "Xóa lớp thành công" ],200);
    } 
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=> "Có lỗi khi xóa lớp"],200);
    }
  }

  public function dsLopKhoahoc($khoahoc)
  {
    try {
      $ds_Lop = DB::table('Lop')->where('kh_khoaHoc',$khoahoc)->get();
      return response([
        'error'=>false,
        'message'=> compact('ds_Lop')],200);
    } 
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=> $e->getMessage()],200);
    }
  }

  public function dsLopKhoahocKhoi($khoahoc,$khoi)
  {
    try {
      $ds_Lop = DB::table('Lop')
      ->where('kh_khoaHoc',$khoahoc)
      ->where('l_ma','like',$khoi.'%')
      ->get();
      return response([
        'error'=>false,
        'message'=> compact('ds_Lop')],200);
    } 
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=> $e->getMessage()],200);
    }
  }
//lấy lớp gv chủ nhiệm
  public function getMaLop($gv_ma)
  {
    try {
      $lop = DB::table('Lop')
      ->where('gv_ma',$gv_ma)
      ->first();
      return response([
          'error'=>false,
          'message'=> compact('lop')],200);
    } catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=> $e->getMessage()],200);
    }
  }
}
