<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThongBaoCaNhan extends Model
{
    protected $table = 'ThongBaoCaNhan';
    protected $guarded = [];
    protected $fillable = ['tbcn_ma','tbcn_tGian','tbcn_tieuDe','tbcn_noiDung'];
    protected $primaryKey = ['tbcn_ma'];
    protected $dates = ['tbcn_tGian'];
    protected $dateFormat = 'Y/m/d';
    public $incrementing = false;
    public $timestamps = false;
}
