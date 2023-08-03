<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules()    {
        $user_id = auth()->id();
        return [
            'avatar'=>'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'email'=>'max:200|email|unique:users,email,'.$user_id,
            'first_name'=>'required|max:100',
            'last_name' => 'required',
            'title' => 'nullable',
            'fourth_name_in_arabic' =>'nullable',
            'passport'=> 'nullable|unique:users,passport,'. $user_id,
            'hospital' => 'nullable',
            'specialty' => 'nullable',
            'mobile'=>'unique:users,mobile,'.$user_id,
        ];
    }
}
