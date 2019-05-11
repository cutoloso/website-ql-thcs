<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('lop/{khoahoc}/khoa-hoc','LopController@dsLopKhoahoc');
	// Route::get('tkb/{hk_hocKy}/hoc-ky/{kh_khoaHoc}/khoa-hoc/{l_ma}/ma-lop','TKBController@show');
Route::get('dstkb','TKBController@index')->name('dstkb');
Route::get('tkb/{hk_hocKy}/hoc-ky/{kh_khoaHoc}/khoa-hoc/{l_ma}/ma-lop','TKBController@show');

// Route::get('hoc-sinh/{hs_ma}', 'HocSinhController@show');
	Route::get('thong-bao-truong', 'ThongBaoTruongController@index');

Route::get('ket-qua-hoc-tap',function (){
		return view('khach.diem');
	})->name('ketquahoctap');

	Route::get('ket-qua/diemTBCN/{hs_ma}/hs-ma/{hk_hocKy}/hoc-ky/{mh_ma}/ma-mh','KetQuaController@getDiemTBCN');
	Route::get('ket-qua/{hs_ma}/hs-ma/{hk_hocKy}/hoc-ky/{mh_ma}/ma-mh','KetQuaController@show');


Route::group(['prefix'=>'quan-tri','middleware'=>'auth'],function (){
	Route::get('/', function () {
		return view('layouts.master');
	})->name('quan-tri');
	
	Route::apiResource('giao-vien', 'GiaoVienController');
	Route::get('dsgiaovien',function(){
		return view('giaoVien.index');
	})->name('dsgiaovien');
	Route::get('giao-vien/{cm_ma}/ma-cm','GiaoVienController@gv_tocm');
	Route::apiResource('to-cm', 'ToCMController');
	Route::get('giao-vien-dshs',function(){
		return view('giaoVien.dshs');
	})->name('giaovien.dshs');

	Route::apiResource('lop', 'LopController');
	Route::get('lop/{khoahoc}/khoa-hoc/{khoi}/khoi','LopController@dsLopKhoahocKhoi');
	// Route::get('lop/{khoahoc}/khoa-hoc','LopController@dsLopKhoahoc');

	Route::post('lop/del','LopController@destroy');
	Route::get('dslop',function(){
		return view('lop.index');
	})->name('dslop');
	Route::get('lop/ma-gv/{gv_ma}','LopController@getMaLop');
	// Route::apiResource('hoc-sinh', 'HocSinhController')->except(['show']);
	Route::apiResource('hoc-sinh', 'HocSinhController');

	Route::get('dshocsinh',function(){
		return view('hocSinh.index');
	})->name('dshocsinh');
	Route::get('hoc-sinh/{khoahoc}/{lop}','HocSinhController@dsHs');

	Route::apiResource('khoa-hoc', 'KhoaHocController');
	Route::get('dskhoahoc',function(){
		return view('khoaHoc.index');
	})->name('dskhoahoc');

	Route::apiResource('phu-huynh', 'PhuHuynhController');

	Route::apiResource('phong', 'PhongController');
	Route::get('dsphong',function(){
		return view('phong.index');
	})->name('dsphong');

	Route::get('gop-y/{loai_chude}/{cd_ma}','GopYController@show');
	Route::get('dsgopy/{loai_chude}/{cd_ma}','GopYController@view');
	Route::post('gop-y','GopYController@store');

	Route::apiResource('chu-de-gop-y', 'ChuDeController')->except(['store']);
	Route::post('chu-de-gop-y/{state}', 'ChuDeController@store');
	Route::get('chu-de-gop-y/{cd_loai}/{cd_ma}', 'ChuDeController@view');
	Route::get('dschude',function (){
		return view('gopY.index');
	})->name('dschude');

	// Route::apiResource('thong-bao-truong', 'ThongBaoTruongController');
	Route::get('dsthongbaotruong',function (){
		return view('thongBaoTruong.index');
	})->name('dsthongbaotruong');

	Route::resource('thong-bao-truong', 'ThongBaoTruongController')->names([
		'create' => 'ThongBaoTruongController.create',
		'store'=>'ThongBaoTruongController.store',
		'update'=>'ThongBaoTruongController.update'
	])->except(['index']);
	
	Route::apiResource('thong-bao-lop', 'ThongBaoLopController');
	Route::get('dsthongbaolop',function (){
		return view('thongBaoLop.index');
	})->name('dsthongbaolop');

	Route::get('hs-dsthongbaolop',function (){
		return view('hocSinh.thongBaoLop');
	})->name('hocsinh.thongbaolop');

	Route::apiResource('tai-khoan', 'UserController');
	Route::get('dstaikhoan',function (){
		return view('taiKhoan.index');
	})->name('dstaikhoan');

	Route::get('profile','ProfileController@index')->name('profile');

	// Route::get('dstkb','TKBController@index')->name('dstkb');
	// Route::get('tkb/{hk_hocKy}/hoc-ky/{kh_khoaHoc}/khoa-hoc/{l_ma}/ma-lop','TKBController@show');
	Route::post('tkb/import/{kh_khoaHoc}/khoa-hoc/{hk_hocKy}/hoc-ky/{l_ma}/lop','TKBController@import')->name('tkb.import');
	Route::post('tkb/update', 'TKBController@update');
	Route::post('tkb/del', 'TKBController@destroy');

	Route::get('tkb-hs',function(){
		return view('hocSinh.tkb');
	})->name('hocSinh.tkb');

	Route::get('tkb-gv',function(){
		return view('giaoVien.tkb');
	})->name('giaoVien.tkb');
	Route::get('tkb-gv/ma-gv/{gv_ma}/hoc-ky/{hk_hocKy}','TKBController@getTKBGV');

	Route::get('day/{kh_khoaHoc}/khoa-hoc/{l_ma}/ma-lop/{mh_ma}/ma-mh', 'DayController@getGV');

	Route::get('dsday',function (){
		return view('day.index');
	})->name('dsday');
	Route::apiResource('day', 'DayController')->only(['index', 'store']);
	Route::get('day/{kh_khoaHoc}/khoa-hoc/{l_ma}/ma-lop', 'DayController@show');
	Route::post('day/update', 'DayController@update');
	Route::post('day/del', 'DayController@delete');
	Route::get('day/{kh_khoaHoc}/khoa-hoc/{gv_ma}/ma-gv', 'DayController@getLop');

	Route::get('mon-hoc/{khoi}/khoi','MonHocController@monHoc_khoi');
	Route::get('ds-ket-qua',function (){
		return view('ketQua.index');
	})->name('dsketqua');
	Route::post('ket-qua','KetQuaController@store');
	Route::post('ket-qua/update','KetQuaController@update');
	Route::post('ket-qua/delete','KetQuaController@destroy');
	Route::get('ket-qua-hs',function(){
		return view('hocSinh.diem');
	})->name('hocSinh.diem');


	Route::get('quan-ly-diem',function (){
		return view('diem.index');
	})->name('quan-ly-diem');
	// Route::apiResource('ket-qua','KetQuaController');

});

Route::get('trang-chu',function(){
	return view('khach.layouts.home');
})->name('trang-chu');
Route::get('lien-he',function(){
	return view('khach.lienHe.index');
})->name('lien-he');

Route::get('gioi-thieu/gioi-thieu-chung',function(){
	return view('khach.gioiThieuChung');
})->name('gioi-thieu-chung');

Route::get('tkb',function(){
	return view('khach.tkb');
})->name('tkb');

Route::get('thb-truong',function(){
	return view('khach.thongBaoTruong');
})->name('khach.thongBaoTruong');
Route::get('test',function(){
	return view('diem.index');
})->name('test');
Route::get('test2',function(){
	$tkb = DB::table('TKB')
	->where('gv_ma','GV141')
	->where('hk_hocKy',2)
	->orderBy('kh_khoaHoc')
	->orderBy('l_ma')
	->orderBy('t_ma')
	->orderBy('th_buoi')
	->orderBy('th_stt')
	->get();
	return $tkb;
});
Route::get('checkLogin/{name}',function($name){
	$info = DB::table('users')->where('name',$name)->get();
	return $info;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
