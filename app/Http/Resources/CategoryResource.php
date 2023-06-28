<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource{

    public function toArray($request){
        return [
            'id'=>$this->id,
            'title'=>$this->{"title_".app()->getLocale()},
            'picture'=>$this->picture_url,
            'created_at'=>$this->created_at
        ];
    }
}
