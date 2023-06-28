<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules()    {
        $mobile_rule = auth()->user()->user_type == 'soldier'? 'required': 'nullable';
        $user_id = auth()->id();
        return [
            'avatar'=>'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'email'=>(auth()->user()->user_type=='advertiser'? 'required' : 'nullable').'|max:200|email:dns,rfc|unique:users,email,'.$user_id,
            'username'=>'required|max:100|unique:users,username,'.$user_id,
            'mobile'=>$mobile_rule.'|integer|digits:9|unique:users,mobile,'.$user_id,
            'address'=>'nullable|max:300',
            'password'=>'nullable',
            'new_password'=>'required_with:password'
        ];
    }
}
