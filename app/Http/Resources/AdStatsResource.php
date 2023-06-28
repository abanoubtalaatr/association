<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdStatsResource extends JsonResource{
    public function toArray($request){
        return [
            'ages'=>$this->statsAges,
            // 'audiences'=>$audiences,
            'countries'=>$this->statsCountries,
            'genders'=>$this->statsGenders
        ];
    }
}
