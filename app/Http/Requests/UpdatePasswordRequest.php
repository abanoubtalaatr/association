<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'new_password'=>'required|min:8',
            'current_password'=>'required|min:8'
        ];
    }
}
