<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpFileController extends Controller
{
	public function store(Request $req)
	{
		if ($req->hasFile('myFile')) {
			try {
				$pathFile = $req->myFile->store('public/thongBao');
				return response([
					'error'=>true,
					'message'=> "Thêm  thành công"],200);
			} catch (Exception $e) {
				return response([
					'error'=>true,
					'message'=> $e->getMessage()],200);
			}
		}
		else{
			return response([
				'error'=>true,
				'message'=> "upload file error" ],200);
		}
	}
}

