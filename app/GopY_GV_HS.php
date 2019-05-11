<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GopY_GV_HS extends Model
{
    protected $table = 'GopY_GV_HS';
    protected $guarded = [];
    protected $fillable = ['cd_gvhs_ma','gy_gvhs_tGian','gy_gvhs_noiDung'];
    protected $primaryKey = ['gy_gvhs_tGian','cd_gvhs_ma'];
    protected $dates = ['gy_gvhs_tGian'];
    protected $dateFormat = 'Y/m/d ';
    public $incrementing = false;
}
