<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChuDe_GV_PH extends Model
{
    protected $table = 'ChuDe_GV_PH';
    protected $guarded = [];
    protected $fillable = ['cd_gvph_ma','cd_gvph_ten'];
    protected $primaryKey = ['cd_gvph_ma'];
    public $incrementing = false;
}
