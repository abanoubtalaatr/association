<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyResetPasswordCodeRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'code'=>'required|integer|digits:4',
            'user_id'=>'required|integer'
        ];
    }
}
