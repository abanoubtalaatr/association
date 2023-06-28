<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadMediaRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'media'=>'required|file|mimes:png,jpg,jpeg,mp4|max:102400',
            'loan_id'=>'required'
        ];
    }
}
