<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'lng' => $this->lng,
            'lat' => $this->lat,
            'address' => $this->address,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'youtube' => $this->youtube,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'facebook' => $this->facebook,
            'snapchat' => $this->snapchat,
            'minimum_payback_amount' => $this->minimum_payback_amount,
            'website_link' => $this->website_link,
        ];
    }
}
