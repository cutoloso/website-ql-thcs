<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KetQua extends Model
{
    protected $table = 'KetQua';
    protected $guarded = [];
    protected $fillable = ['hs_ma','hk_hocKy','hk_namHoc','mh_ma','kq_lan','kq_Diem'];
    protected $primaryKey = ['hs_ma','hk_hocKy','hk_namHoc','mh_ma','kq_lan'];
    public $incrementing = false;
}
