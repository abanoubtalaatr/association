<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaybackRequest extends Model{
    use HasFactory;
    protected $guarded=[];

    public function wallets(){
        return $this->hasMany(Wallet::class);
    }

    public function soldier(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
