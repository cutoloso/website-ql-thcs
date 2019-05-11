<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class ProfileController extends Controller
{
    public function index()
    {
    	$name = Auth::user()->name;
    	$level = Auth::user()->level;
        if ($level == 1) {
            # quản trị
            $profile = DB::table('QuanTri')->where('qt_ma',$name)->first();
            return view('quanTri.profile',compact('profile'));
        }
    	elseif ($level == 2) {
    		# giáo viên
    		$profile = DB::table('GiaoVien')->where('gv_ma',$name)->first();
            
    		return view('giaoVien.profile',compact('profile'));
    	} 
    	elseif ($level == 3) {
    		# phụ huynh
            $ds_hs = DB::table('HocSinh')->where('ph_ma',$name)->get();
    		$profile = DB::table('PhuHuynh')->where('ph_ma',$name)->first();
    		return view('phuHuynh.profile',compact('profile','ds_hs'));
    	} 
    	elseif ($level == 4) {
    		# học sinh
    		$profile = DB::table('HocSinh')->where('hs_ma',$name)->first();
    		return view('hocSinh.profile',compact('profile'));
    	}
    	
    }
}
