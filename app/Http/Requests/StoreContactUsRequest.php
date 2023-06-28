<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactUsRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'sender_name'=>'required|max:200',
            'sender_email'=>'required|max:200|email:rfc,dns',
            'message'=>'required|max:500'
        ];
    }
}
