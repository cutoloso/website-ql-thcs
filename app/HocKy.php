<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HocKy extends Model
{
    protected $table = 'HocKy';
    protected $guarded = [];
    protected $fillable = ['hk_hocKy','hk_namHoc'];
    protected $primaryKey = ['hk_hocKy','hk_namHoc'];
    public $incrementing = false;
}
