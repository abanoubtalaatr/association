<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camp extends Model{
    use HasFactory;
    protected $guarded=[];

    public function ads(){
        return $this->hasMany(Ad::class);
    }

    public function getTotalClicksAttribute(){
        return $this->ads()->sum('total_clicks');
    }

    public function getTotalBudgetAttribute(){
        return $this->ads()->sum('budget');
    }



    protected static function boot(){
        parent::boot();
        static::creating(function ($query) {
            $query->status='active';
        });
    }

}
