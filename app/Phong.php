<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    protected $table = 'Phong';
    protected $guarded = [];
    protected $fillable = ['p_ma','p_sucChua','p_ghiChu'];
    protected $primaryKey = ['p_ma'];
    public $incrementing = false;
}
