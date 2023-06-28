<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeLanguageRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'default_language'=>'required|in:ar,en'
        ];
    }
}
