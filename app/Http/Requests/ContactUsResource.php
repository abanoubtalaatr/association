<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsResource extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [

        ];
    }
}
