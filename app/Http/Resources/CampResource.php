<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampResource extends JsonResource{

    public function toArray($request){
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'status'=>__('site.'.$this->status),
            'status_key'=>$this->status,
            'created_at'=>$this->created_at,
            'ads_count'=>$this->ads()->count(),
            'clicks'=>$this->total_clicks,
            'budget'=>$this->total_budget,
            'type'=>__('site.'.$this->type),
            'type_key'=>$this->type
        ];
    }
}
