<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyAccountRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'code'=>'required|integer|digits:4'
        ];
    }
}
