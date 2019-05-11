<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class QuanTri extends Model
{
    protected $table = 'QuanTri';
    protected $guarded = [];
    protected $fillable = ['qt_ma','qt_matKhau','qt_hoTen','qt_ngaySinh','qt_phai','qt_diaChi','qt_email','qt_dienThoai'];
    protected $primaryKey = ['qt_ma'];
    protected $hidden = ['qt_matKhau'];
    protected $date = 'qt_ngaySinh';
    protected $dateFormat = 'Y/m/d ';
    public $incrementing = false;
}
