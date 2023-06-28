<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAdStatusRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'new_status'=>'required|in:unpaid,reviewing,active,finished,inactive'
        ];
    }
}
