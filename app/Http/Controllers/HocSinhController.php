<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class HocSinhController extends Controller
{
  public function index()
  {
  	try {
      $ds_HocSinh = DB::table('HocSinh')->get();
      return response([
        'error'=>false,
        'message'=> compact('ds_HocSinh')],200);
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
      DB::table('HocSinh')->insert([
        'hs_ma' => $req->hs_ma,
        'hs_hoTen' => $req->hs_hoTen,
        'hs_ngaySinh' => date('Y-m-d', strtotime($req->hs_ngaySinh)),
        'hs_phai'  =>$req->hs_phai,
        'hs_diaChi' => $req->hs_diaChi,
        'l_ma' => $req->l_ma,
        'kh_khoaHoc' => $req->kh_khoaHoc,
        'ph_ma'=> $req->ph_ma,
        'q_ma' => 3
      ]);
      return response([
        'error'=>false,
        'message'=>"Thêm thành công"]);
    } 
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=> $e->getMessage()],200);
    }
  }

  public function show($id)
  {
    try {
      $hs = DB::table('HocSinh')->where('hs_ma',$id)->first();
      return 
        response(['error'=>$hs == null,
                  'message'=>$hs == null ? "Không tìm thấy học sinh có mã [{$id}]" : compact('hs',$hs)], 200);
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
      DB::table('HocSinh')->where('hs_ma','=',$id)->update([
        'hs_hoTen' => $req->hs_hoTen,
        'hs_ngaySinh' => date('Y-m-d', strtotime($req->hs_ngaySinh)),
        'hs_phai'  =>$req->hs_phai,
        'hs_diaChi' => $req->hs_diaChi,
        'ph_ma' => $req->ph_ma
      ]);
      return response([
        'error'=>false,
        'message'=> "Cập nhật thành công học sinh [{$id}]"],200);
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
      DB::table('HocSinh')->where('hs_ma','=',$id)->delete();
      return response([
          'error'=>true,
          'message'=> "Xóa thành công học sinh [{$id}]"],200);
    }
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=> $e->getMessage()],200);
    }
  }
  public function dsHs($khoahoc,$lop)
  {
    try {
      // $ds_HocSinh = DB::table('HocSinh')
      // ->join('Lop', function($join)
      //   {
      //       $join->on('Lop.l_ma', '=', 'HocSinh.l_ma')
      //       ->On('Lop.kh_khoaHoc','=','HocSinh.kh_khoaHoc');
      //   })
      // ->where('Lop.l_ma','like',$khoi.'%')
      // ->where('Lop.l_ma',$lop)
      // ->where('Lop.kh_khoahoc',$khoahoc)
      // ->get();
      $ds_HocSinh = DB::table('HocSinh')
      ->where('kh_khoahoc',$khoahoc)
      ->where('l_ma',$lop)
      ->get();
      return response([
          'error'=>false,
          'message'=> compact('ds_HocSinh')],200);
    } 
    catch (\Exception $e) {
      return response([
          'error'=>true,
          'message'=> $e->getMessage()],200);
    }
  }

}
