<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource{
    public function toArray($request){

        return [
            'id'=>$this->id,
            'event_type'=>$this->type,
            'subject_id'=>$this->subject_id,
            'content'=>$this->{"content_".app()->getLocale()},
            'title'=>$this->{"title_".app()->getLocale()},
            'created_at'=>$this->created_at,
            'read_at'=>$this->read_at
        ];
    }
}
