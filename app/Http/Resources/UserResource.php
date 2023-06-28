<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource{

    public function toArray($request){
        return [
            'id'=>$this->id,
            'wallet_balance'=>round($this->wallets()->whereNull('payback_request_id')->sum('amount'),2),
            'paid_transactions'=>round($this->paybackRequests()->whereStatus('paid')->sum('amount'),2),
            'not_paid_transactions'=>round($this->paybackRequests()->whereStatus('not_paid')->sum('amount'),2),
            'allowed_to_show_ads'=>$this->allowed_to_show_ads,
            'last_share'=>$this->last_share,
            'mobile'=>$this->mobile,
            'email'=>$this->email,
            'is_active'=>$this->is_active,
            'is_verified'=>$this->is_verified,
            'username'=>$this->username,
            'avatar'=>$this->avatar_url,
            'default_language'=>$this->default_language,
            'user_type'=>$this->user_type,
            'task_level'=>$this->task_level,
            'address'=>$this->address,
            'payment_method'=>$this->payment_method,
            'payment_number'=>$this->payment_number,
        ];

    }
}
