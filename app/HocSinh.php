<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HocSinh extends Model
{
    protected $table = 'HocSinh';
    protected $guarded = [];
    protected $fillable = ['hs_ma','hs_matKhau','hs_hoTen','hs_ngaySinh','hs_phai','hs_diaChi','ph_ma','q_ma','l_ma','kh_khoaHoc'];
    protected $primaryKey = ['hs_ma'];
    protected $hidden = ['hs_matKhau'];
    protected $date = 'hs_ngaySinh';
    protected $dateFormat = 'Y/m/d ';
    public $incrementing = false;
}
