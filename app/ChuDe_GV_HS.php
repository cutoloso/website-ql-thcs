<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChuDe_GV_HS extends Model
{
    protected $table = 'ChuDe_GV_HS';
    protected $guarded = [];
    protected $fillable = ['cd_gvhs_ma','cd_gvhs_ten'];
    protected $primaryKey = ['cd_gvhs_ma'];
    public $incrementing = false;
}
