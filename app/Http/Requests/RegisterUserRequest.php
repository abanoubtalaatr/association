<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'user_type'=>'required|in:soldier,advertiser',
            'email'=>[
                'required_if:user_type,advertiser',
                'max:200',
                'email:dns,rfc',
                Rule::unique('users','email')->whereNull('delete_requested_at')
            ],
            'username'=>[
                'required',
                'min:3',
                'max:100',
                Rule::unique('users','username')->whereNull('delete_requested_at')
            ],
            'mobile'=>[
                'required_if:user_type,soldier',
                'integer',
                'digits:9',
                'bail',
                'starts_with:5',
                Rule::unique('users','mobile')->whereNull('delete_requested_at')
            ],
            'password'=>'required|min:8',
            'password_confirmation'=>'required|same:password'
       ];;
    }
}
