<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViPham extends Model
{
    protected $table = 'ViPham';
    protected $guarded = [];
    protected $fillable = ['hs_ma','vp_ngay','vp_noiDung'];
    protected $primaryKey = ['hs_ma','vp_ngay'];
    protected $date = ['vp_ngay'];
    protected $dateFormat = 'Y/m/d';
    public $incrementing = false;
}
