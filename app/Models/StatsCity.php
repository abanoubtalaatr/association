<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatsCity extends Model{
    use HasFactory;
    protected $guarded=[];
    protected $table ='stats_cities';
    public $timestamps = false;
}
