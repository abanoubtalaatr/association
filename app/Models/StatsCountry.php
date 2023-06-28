<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatsCountry extends Model{
    use HasFactory;
    protected $guarded=[];
    protected $table ='countries';
    public $timestamps = false;
}
