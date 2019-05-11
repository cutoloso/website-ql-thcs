<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    protected $table = 'Quyen';
    protected $guarded = [];
    protected $fillable = ['q_ma','q_ten'];
    protected $primaryKey = ['q_ma'];
    public $incrementing = false;
}
