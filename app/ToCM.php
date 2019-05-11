<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToCM extends Model
{
    protected $table = 'ToCM';
    protected $guarded = [];
    protected $fillable = ['cm_ma','cm_moTa'];
    protected $primaryKey = 'cm_ma';
    public $incrementing = false;
}
