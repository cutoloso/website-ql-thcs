<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TKB extends Model
{
    protected $table = 'TKB';
    protected $guarded = [];
    protected $fillable = ['mh_ma','th_stt','th_buoi','t_ma','l_ma','kh_khoaHoc','hk_hocKy','hk_namHoc','tbk_moTa','gv_ma'];
    protected $primaryKey = ['mh_ma','th_stt','th_buoi','t_ma','l_ma','kh_khoaHoc','hk_hocKy','hk_namHoc','gv_ma'];
    public $incrementing = false;
    public $timestamps = false;
}
