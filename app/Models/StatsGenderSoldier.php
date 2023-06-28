<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatsGenderSoldier extends Model{
    use HasFactory;
    protected $table = 'stats_gender_soldier';
    protected $guarded=[];

    public function gender(){
        return $this->belongsTo(Gender::class,'gender_id','id');
    }

    public function ad(){
        return $this->belongsTo(Ad::class,'item_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function library(){
        return $this->belongsTo(library::class,'item_id','id');
    }
}
