<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    protected $table = 'MonHoc';
    protected $guarded = [];
    protected $fillable = ['mh_ma','mh_ten'];
    protected $primaryKey = ['mh_ma'];
    public $incrementing = false;
}
