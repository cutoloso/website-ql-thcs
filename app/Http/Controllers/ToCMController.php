<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\ToCM;

class ToCMController extends Controller
{
    public function index()
    {
    	$ds_ToCM = ToCM::all();
        return response([
            'error'=>false,
            'message'=>compact('ds_ToCM')]);
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
    	// $ToCM = DB::table('ToCM')->where('cm_ma','=','$id')->first();
        $ToCM = ToCM::find($id);
        return response(['error'=>$ToCM == null,
                        'message'=>$ToCM == null ? "Không tìm thấy tổ chuyên môn [{$id}]" : $ToCM->toJson()], 200);
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
    	$ToCM = ToCM::find($id);;
        if ($ToCM) {
            $ToCM->delete();
            return response(['error'=>$ToCM == null,
                            'message'=>($ToCM == null ? "Xóa tổ chuyên môn [{$id}] thành công" : $ToCM->toJson())], 200);
        }else{
            return response(['error'=>$ToCM == null,
                            'message'=>($ToCM == null ? "Không tìm thấy tổ chuyên môn [{$id}]" : $ToCM->toJson())], 200);
        }
    }
}
