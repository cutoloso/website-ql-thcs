<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KetQuaController extends Controller
{
  protected function getNamHoc(){
    if (idate("m")<6) {
      $hk_namHoc = (string)(idate("Y")-1).'-'.(string)idate("Y");
    }
    else{
      $hk_namHoc = (string)idate("Y").'-'.(string)(idate("Y")+1);
    }
    return $hk_namHoc;
  }

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

    if (idate("m")<6) {
      $hk_namHoc = (string)(idate("Y")-1).'-'.(string)idate("Y");
    }
    else{
      $hk_namHoc = (string)idate("Y").'-'.(string)(idate("Y")+1);
    }

    try {
      DB::table('KetQua')->insert([
        'hs_ma'     => $req->hs_ma,
        'hk_hocKy'  => $req->hk_hocKy,
        'hk_namHoc' => $hk_namHoc,
        'mh_ma'     => $req->mh_ma,
        'kq_lan'    => $req->kq_lan,
        'kq_diem'   => $req->kq_diem,
        'kq_heSo'   => $req->kq_heSo,
      ]);
      return response([
        'error'=>false,
        'message'=>"Thêm thành công"]);
    } 
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=>"Thêm thất bại,vui lòng kiểm tra lại"]);
    }

  }

  public function show($hs_ma,$hk_hocKy,$mh_ma)
  {
    if (idate("m")<6) {
      $hk_namHoc = (string)(idate("Y")-1).'-'.(string)idate("Y");
    }
    else{
      $hk_namHoc = (string)idate("Y").'-'.(string)(idate("Y")+1);
    }
    try {
      if ($mh_ma=="all") {
        $ds_KetQua = DB::table('KetQua')
        ->where('hs_ma',$hs_ma)
        ->where('hk_hocKy',$hk_hocKy)
        ->where('hk_namHoc',$hk_namHoc)
        ->get();
      }
      else{
        $ds_KetQua = DB::table('KetQua')
        ->where('hs_ma',$hs_ma)
        ->where('hk_hocKy',$hk_hocKy)
        ->where('hk_namHoc',$hk_namHoc)
        ->where('mh_ma',$mh_ma)
        ->get();
      } 
      return response([
        'error'   => false,
        'message' => compact('ds_KetQua')
      ],200);
    } 
    catch (Exception $e) {
      return response([
        'error'   => false,
        'message' => "Có lỗi"
      ],200);
    }
  }

  public function edit($id)
  {
    	# code...
  }

  public function update(Request $req)
  {
    $hk_namHoc = $this->getNamHoc();
    try {
      DB::table('KetQua')
        ->where('hs_ma',$req->hs_ma)
        ->where('hk_hocKy',$req->hk_hocKy)
        ->where('hk_namHoc',$hk_namHoc)
        ->where('mh_ma',$req->mh_ma)
        ->where('kq_lan',$req->kq_lan)
        ->where('kq_heSo',$req->kq_heSo)
        ->update(['kq_diem' => $req->kq_diem]);

      return response([
        'error'=>false,
        'message'=>"Sửa thành công"]);
    } 
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=>"Có lỗi khi sửa"]);
    }
  }

  public function destroy(Request $req)
  {
    $hk_namHoc = $this->getNamHoc();
    try {
      DB::table('KetQua')
        ->where('hs_ma',$req->hs_ma)
        ->where('hk_hocKy',$req->hk_hocKy)
        ->where('hk_namHoc',$hk_namHoc)
        ->where('mh_ma',$req->mh_ma)
        ->where('kq_lan',$req->kq_lan)
        ->where('kq_heSo',$req->kq_heSo)
        ->delete();

      return response([
        'error'=>false,
        'message'=>"Xóa thành công"]);
    } 
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=>"Có lỗi khi xóa"]);
    }
  }
  public function import()
  {
    try {
      Excel::import(new TkbImport, request()->file('fileTKB'));
      return response([
        'error'=>false,
        'message'=> "Upload file điểm thành công"],200);
    } 
    catch (\Exception $e) {
      return response([
        'error'=>true,
        'message'=> "Có lỗi khi up file, vui lòng kiểm tra lại file !!!"],200);
    }
  }

  public function getDiemTBCN($hs_ma,$hk_hocKy,$mh_ma)
  {
    try {

      if (idate("m")<6) {
        $hk_namHoc = (string)(idate("Y")-1).'-'.(string)idate("Y");
      }
      else{
        $hk_namHoc = (string)idate("Y").'-'.(string)(idate("Y")+1);
      }

      if ($mh_ma=="all") {
        $ds_diem = DB::table('KetQua')
        ->where('hs_ma',$hs_ma)
        ->where('hk_namHoc',$hk_namHoc)
        ->where('hk_hocKy',$hk_hocKy)
        ->get();
      }
      else{
        $ds_diem = DB::table('KetQua')
        ->where('hs_ma',$hs_ma)
        ->where('hk_namHoc',$hk_namHoc)
        ->where('hk_hocKy',$hk_hocKy)
        ->where('mh_ma',$mh_ma)
        ->get();
      }

      $diem=0;
      $count = 0;
      foreach ($ds_diem as $d) {
        $count = $count + $d->kq_heSo;
        $diem = $diem + $d->kq_heSo*$d->kq_diem;
      }

      if ($count == 0) {
        $diemTBCN = 0;
      }
      else{
        $diemTBCN = $diem/$count;
      }
      return response([
        'error'=>false,
        'message'=> compact('diemTBCN')]);
    } 
    catch (Exception $e) {
      return response([
        'error'=>true,
        'message'=> "Có lỗi"],200);
    }
  }

}
