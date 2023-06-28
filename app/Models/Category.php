<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    use HasFactory;
    protected $guarded=[];

    public function libraries(){
        return $this->hasMany(Library::class);
    }

    public function getPictureUrlAttribute(){
        return url('uploads/pics/'.$this->picture);
    }
}
