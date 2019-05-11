<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\TkbImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
class TKBController extends Controller
{
  public function index()
  {
    return view('TKB.index');
  }

  public function create()
  {

  }

  public function store(Request $req)
  {
    	# code...
  }

  public function show($hk_hocKy,$kh_khoaHoc,$l_ma)
  {
    if (idate("m")<6) {
      $hk_namHoc = (string)(idate("Y")-1).'-'.(string)idate("Y");
    }
    else{
      $hk_namHoc = (string)idate("Y").'-'.(string)(idate("Y")+1);
    }
    $ds_tkb = DB::table('TKB')
    ->where('hk_namHoc', $hk_namHoc)
    ->where('hk_hocKy', $hk_hocKy)
    ->where('kh_khoaHoc', $kh_khoaHoc)
    ->where('l_ma', $l_ma)
    ->orderBy('t_ma')
    ->orderBy('th_stt')

    ->get();

    // return compact('ds_tkb');
    return response(['error'=>$ds_tkb == null,
      'message'=>compact('ds_tkb',$ds_tkb)], 200);
  }

  public function edit($id)
  {
    	# code...
  }

  public function update(Request $req)
  {
    if (idate("m")<6) {
      $hk_namHoc = (string)(idate("Y")-1).'-'.(string)idate("Y");
    }
    else{
      $hk_namHoc = (string)idate("Y").'-'.(string)(idate("Y")+1);
    }

    $gv_ma = DB::table('Day')
      ->where('kh_khoaHoc',$req->kh_khoaHoc)
      ->where('l_ma',$req->l_ma)
      ->where('mh_ma',$req->mh_ma)
      ->first(['gv_ma']);

    try {
      DB::table('TKB')
      ->where('th_stt',     $req->th_stt)
      ->where('th_buoi',    $req->th_buoi)
      ->where('t_ma',       $req->t_ma)
      ->where('l_ma',       $req->l_ma)
      ->where('hk_hocKy',   $req->hk_hocKy)
      ->where('hk_namHoc',  $hk_namHoc)
      ->where('kh_khoaHoc', $req->kh_khoaHoc)
      ->update([
                'mh_ma'  => $req->mh_ma,
                'gv_ma'  => $gv_ma->gv_ma
      ]);

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

  public function importView()
  {
    return view('TKB.import');
  }

  public function import($kh_khoaHoc, $hk_hocKy, $l_ma)
  { 
    try {
      DB::table('TKB')
      ->where('kh_khoaHoc',$kh_khoaHoc)
      ->where('hk_hocKy',$hk_hocKy)
      ->where('l_ma',$l_ma)
      ->delete();
      
      Excel::import(new TkbImport, request()->file('fileTKB'));

      return response([
        'error'=>false,
        'message'=> "Cập nhật thành công"],200);
    } 
    catch (Exception $e) {
      return response([
        'error'=>true,
        'message'=> $e->message() ],200);
    }
  }
  public function destroy(Request $req)
  {
    try {
      DB::table('TKB')
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

  public function getTKBGV($gv_ma, $hk_hocKy)
  {
    try {
      $ds_tkb = DB::table('TKB')
      ->where('gv_ma',$gv_ma)
      ->where('hk_hocKy',$hk_hocKy)
      // ->orderBy('kh_khoaHoc','desc')
      ->orderBy('l_ma')
      ->orderBy('t_ma')
      ->orderBy('th_buoi')
      ->orderBy('th_stt')
      ->get();
      return response([
        'error'=>false,
        'message'=> compact('ds_tkb')],200); 
    } 
    catch (Exception $e) {
      return response([
        'error'=>true,
        'message'=> $e->getMessage()],200);
    }
  }
}
