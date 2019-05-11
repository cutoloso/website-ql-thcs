<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GopY_GV_PH extends Model
{
    protected $table = 'GopY_GV_PH';
    protected $guarded = [];
    protected $fillable = ['cd_gvph_ma','gy_gvph_tGian','gy_gvph_noiDung'];
    protected $primaryKey = ['gy_gvph_tGian','cd_gvph_ma'];
    protected $date = ['gy_gvph_tGian'];
    protected $dateFormat = 'Y/m/d ';
    public $incrementing = false;
}
