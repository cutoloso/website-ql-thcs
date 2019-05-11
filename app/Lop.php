<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    protected $table = 'Lop';
    protected $guarded = [];
    protected $fillable = ['l_ma','kh_khoaHoc','p_ma','gv_ma'];
    protected $primaryKey = ['l_ma','kh_khoaHoc'];
    public $incrementing = false;
}
