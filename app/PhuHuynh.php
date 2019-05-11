<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhuHuynh extends Model
{
    protected $table = 'PhuHuynh';
    protected $guarded = [];
    protected $fillable = ['ph_ma','ph_matKhau','ph_hoTen','ph_ngaySinh','ph_phai','ph_diaChi','ph_email','ph_dienThoai','q_ma'];
    protected $primaryKey = ['ph_ma'];
    protected $hidden = ['ph_matKhau'];
    protected $date = 'ph_ngaySinh';
    protected $dateFormat = 'Y/m/d ';
    public $incrementing = false;
}
