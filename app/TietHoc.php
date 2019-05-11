<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TietHoc extends Model
{
    protected $table = 'TietHoc';
    protected $guarded = [];
    protected $fillable = ['th_stt','th_buoi','th_gio'];
    protected $primaryKey = ['th_stt','th_buoi'];
    public $incrementing = false;
}
