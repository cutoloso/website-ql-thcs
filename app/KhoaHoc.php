<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhoaHoc extends Model
{
    protected $table = 'KhoaHoc';
    protected $guarded = [];
    protected $fillable = ['kh_khoaHoc'];
    protected $primaryKey = ['kh_khoaHoc'];
    public $incrementing = false;
}
