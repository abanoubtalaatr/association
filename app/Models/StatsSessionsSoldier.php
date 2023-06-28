<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatsSessionsSoldier extends Model{
    use HasFactory;
    protected $table = 'stats_sessions_soldier';
    protected $guarded=[];
    public $timestamps = false;

    public function ad(){
        return $this->belongsTo(Ad::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function library(){
        return $this->belongsTo(Library::class);
    }
}
