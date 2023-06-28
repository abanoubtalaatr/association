<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatsCitySoldierView extends Model{
    use HasFactory;
    protected $table = 'soldier_top_cities_v';


     public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
