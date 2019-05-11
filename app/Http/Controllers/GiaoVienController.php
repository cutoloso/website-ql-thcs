<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GiaoVien;
use DB;
use Illuminate\Support\Facades\Auth;


class GiaoVienController extends Controller
{
  public function index()
  {
    try {
      $ds_GiaoVien = DB::table('GiaoVien')->get();
      return response([
        'error'=>false,
        'message'=> compact('ds_GiaoVien')],200);
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
      DB::table('GiaoVien')->insert([
        'gv_ma' => $req->gv_ma,
        'gv_hoTen' => $req->gv_hoTen,
        'gv_ngaySinh' => date('Y-m-d', strtotime($req->gv_ngaySinh)),
        'gv_phai'  =>$req->gv_phai,
        'gv_diaChi' => $req->gv_diaChi,
        'gv_email' => $req->gv_email,
        'gv_dienThoai' => $req->gv_dienThoai,
        'cm_ma' => $req->cm_ma,
      ]);
      return response([
        'error'=>false,
        'message'=>"Thêm thành công"]);
    } 
    catch (Exception $e) {
      return response([
        'error'=>true,
        'message'=>"Thêm thất bại"]);
    }
  }

  public function show($id)
  {
    try {
      $gv = DB::table('GiaoVien')->where('gv_ma',$id)->first();
      return response(['error'=>$gv == null,
        'message'=>compact('gv',$gv)], 200);
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
      DB::table('GiaoVien')->where('gv_ma','=',$id)->update([
        'gv_hoTen' => $req->gv_hoTen,
        'gv_ngaySinh' => date('Y-m-d', strtotime($req->gv_ngaySinh)),
        'gv_phai'  =>$req->gv_phai,
        'gv_diaChi' => $req->gv_diaChi,
        'gv_email' => $req->gv_email,
        'gv_dienThoai' => $req->gv_dienThoai,
        'cm_ma' => $req->cm_ma
      ]);
      return response([
        'error'=>false,
        'message'=> "Cập nhật thành công giáo viên [{$id}]"],200);
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
      DB::table('GiaoVien')->where('gv_ma','=',$id)->delete();
      return response([
        'error'=>false,
        'message'=> "Xóa thành công giáo viên [{$id}]"],200);
    }
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=> $e->getMessage()],200);
    }
  }

  public function gv_tocm($cm_ma)
  {
    try {
      $ds_gv = DB::table('GiaoVien')->where('cm_ma',$cm_ma)->get();

      return response([
        'error'   => false,
        'message' => compact('ds_gv')],200);
    }
    catch (\Exception $e) {
      return response([
        'error'   => true,
        'message' => $e->getMessage()],200);
    }
  }

  public function getToCM($gv_ma)
  {
    try {
      $gv = DB::table('GiaoVien')->where('gv_ma',$gv_ma)->first('cm_ma');
      return response([
        'error'   => false,
        'message' => compact('gv')],200);
    } 
    catch (\Exception $e) {
      return response([
        'error'   => true,
        'message' => $e->getMessage()],200);
    }
  }
}
