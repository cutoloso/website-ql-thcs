<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table = 'Day';
    protected $guarded = [];
    protected $fillable = ['mh_ma','l_ma','gv_ma'];
    protected $primaryKey = ['mh_ma','l_ma'];
    public $incrementing = false;
}
