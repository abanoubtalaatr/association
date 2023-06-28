<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatsAudience extends Model{
    use HasFactory;
    protected $table='audiences';
    protected $guarded=[];
    public $timestamps = false;
}
