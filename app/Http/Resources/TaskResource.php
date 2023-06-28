<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource{

    public function toArray($request){


        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'media_type'=>$this->media_type,
            'media'=>$this->media_url,
            'is_completed'=>false,
        ];
    }
}
