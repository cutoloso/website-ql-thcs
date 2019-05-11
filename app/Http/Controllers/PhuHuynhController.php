<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PhuHuynh;

use DB;

class PhuHuynhController extends Controller
{
  public function index()
  {
  	try {
      $ds_PhuHuynh = DB::table('PhuHuynh')->get();
      return response([
        'error'=>false,
        'message'=> compact('ds_PhuHuynh')],200);
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
  	# code...
  }

  public function show($id)
  {
  	# code...
  }

  public function edit($id)
  {
  	# code...
  }

  public function update(Request $req, $id)
  {
  	# code...
  }

  public function destroy($id)
  {
  	# code...
  }
}
