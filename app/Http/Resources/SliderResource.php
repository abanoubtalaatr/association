<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource{
    public function toArray($request){
        $locale = app()->getLocale();
        return [
            'id'=>$this->id,
            'picture'=>$this->picture_url,
            'line1'=>$this->{"line1_".$locale},
            'line2'=>$this->{"line2_".$locale},
            'line3'=>$this->{"line3_".$locale},
            'button_text'=>$this->{"button_text_".$locale},
            'button_link'=>$this->{"button_link_".$locale}
        ];
    }
}
