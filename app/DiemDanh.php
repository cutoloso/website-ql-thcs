<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiemDanh extends Model
{
    protected $table = 'DiemDanh';
    protected $guarded = [];
    protected $fillable = ['hs_ma','dd_ngay'];
    protected $primaryKey = ['hs_ma','dd_ngay'];
    protected $dates = ['dd_ngay'];
    protected $dateFormat = 'Y/m/d ';
    public $incrementing = false;
}
