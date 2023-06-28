<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource{

    public function toArray($request){
        return [
            'id'=>$this->id,
            'transaction_number'=>$this->transaction_number,
            'amount'=>$this->amount,
            'status'=>__('site.'.$this->status),
            'status_key'=>$this->status,
            'created_at'=>$this->created_at
        ];
    }
}
