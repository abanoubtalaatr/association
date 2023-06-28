<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource{
    public function toArray($request){
        return [
            'id'=>$this->id,
            'amount'=>$this->amount,
            'created_at'=>$this->created_at,
            'status'=>__('site.'.$this->status),
            'status_key'=>$this->status,
            'transaction_id'=>$this->transaction_id,
            'notes'=>$this->{"notes_".app()->getLocale()}
        ];
    }
}
