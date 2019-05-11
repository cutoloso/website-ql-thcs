<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaoVien extends Model
{
    protected $table = 'GiaoVien';
    protected $guarded = [];
    protected $fillable = ['gv_ma','gv_matKhau','gv_hoTen','gv_ngaySinh','gv_phai','gv_diaChi','gv_email','gv_dienThoai','cm_ma'];
    protected $primaryKey = ['gv_ma'];
    protected $hidden = [''];
    protected $dates = ['gv_ngaySinh'];
    protected $dateFormat = 'Y/m/d ';
    public $incrementing = false;
    public $timestamps = false;

}
