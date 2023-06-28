<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveResetPasswordRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'user_id'=>'required|integer',
            'secret_code'=>'required|string|size:100',
            'new_password'=>'required|min:8'
        ];
    }
}
