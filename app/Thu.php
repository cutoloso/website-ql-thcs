<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thu extends Model
{
    protected $table = 'Thu';
    protected $guarded = [];
    protected $fillable = ['t_thu'];
    protected $primaryKey = ['t_thu'];
    public $incrementing = false;
}
