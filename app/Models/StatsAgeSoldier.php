<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatsAgeSoldier extends Model{
    use HasFactory;
    protected $table = 'stats_age_soldier';
    protected $guarded=[];

    public function age(){
        return $this->belongsTo(StatsAge::class,'age_id','id');
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
