<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatsCitySoldier extends Model{
    use HasFactory;
    protected $table = 'stats_city_soldier';
    protected $guarded=[];

    public function ad(){
        return $this->belongsTo(Ad::class,'item_id','id');
    }

    public function city(){
        return $this->belongsTo(StatsCity::class,'city_id','id');
    }

     public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function library(){
        return $this->belongsTo(library::class,'item_id','id');
    }
}
