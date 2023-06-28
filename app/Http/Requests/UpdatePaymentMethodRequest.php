<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentMethodRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        $rules = [
            'payment_method'=>'required|in:paypal,stc'
        ];
        if($this->payment_method=='paypal'){
            $rules['payment_number'] = 'required|email:dns,rfc|max:200';
        }else{
            $rules['payment_number'] = 'required|integer|digits:9';
        }
        return $rules;
    }
}
