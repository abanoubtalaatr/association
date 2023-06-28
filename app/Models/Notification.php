<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model{
    protected $guarded=[];


    public function getImageUrlAttribute(){
        return asset('assets_ar/imgs/home/bell.png');
    }

    public function getRedirectUrlAttribute(){
        if($this->type=='soldier_new_ad'){
            return route('user.ads');
        }elseif($this->type=='ad_status_changed'){
            return route('user.show_ad',$this->subject_id);
        }
        return '#';
    }
}
