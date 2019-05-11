<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThongBaoTruong extends Model
{
    protected $table = 'ThongBaoTruong';
    protected $guarded = [];
    protected $fillable = ['tbt_ma','tbt_ngayBD','tbt_ngayKT','tbt_noiDung','qt_ma'];
    protected $primaryKey = ['tbt_ma'];
    protected $date = ['tbt_ngayBD','tbt_ngayKT'];
    protected $dateFormat = 'Y/m/d H:i:s';
    public $incrementing = false;
}
