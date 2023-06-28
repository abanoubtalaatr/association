<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatsAge extends Model{
    use HasFactory;
    protected $table='ages';
    protected $guarded=[];
    public $timestamps = false;
}
