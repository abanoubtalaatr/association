<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource{

    public function toArray($request){
        $media = $this->media;
        foreach($media as $k=>$v){
            $media[$k] = url('uploads/pics/'.$v);
        }

        $sharing_link = auth('api-users')->id()? route('show_ad',[$this->id,auth('api-users')->user()->utm]) : route('show_ad',$this->id);

        return [
            'id'=>$this->id,
            'sharing_link'=>$sharing_link,
            'payment_link'=>route('user.pay_ad',$this->id),
            'title'=>$this->title,
            'content'=>$this->content,
            'start_date'=>$this->start_date,
            'start_time'=>$this->start_time,
            'total_clicks'=>$this->total_clicks,
            'month_clicks'=>$this->month_clicks,
            'end_date'=>$this->end_date,
            'budget'=>$this->budget,
            'remaining_budget'=>$this->remaining_budget,
            'media'=>$media,
            'button_text'=>$this->button_text,
            'link'=>$this->link,
            'media_type'=>$this->media_type,
            'camp'=>new CampResource($this->camp),
            'user'=> new UserResource($this->user),
            'status'=>__('site.'.$this->status),
            'status_key'=>$this->status,
            'created_at'=>$this->created_at,
            'short_description'=>$this->short_description,
            'whatsapp_thumbnail'=>url('uploads/pics/'.$this->whatsapp_thumbnail),
            'payment_info'=>$this->payment_info,
            'payment_id'=>$this->payment_id,
            'genders'=>GenderResource::collection($this->genders),
            'languages'=>LanguageResource::collection($this->languages),
            'countries'=>CountryResource::collection($this->countries),
            'cities'=>CityResource::collection($this->cities),
            'ages'=>AgeResource::collection($this->ages),
            'audiences'=>AudienceResource::collection($this->audiences)
        ];
    }
}
