<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateCampRequest extends FormRequest{

    public $types = [
        'awarness',
        'traffic',
        'app_installs',
        'video_views',
        'messages',
        'lead_generation'
    ];

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'title'=>[
                'required',
                'max:200',
                Rule::unique('camps','title')->where('user_id',auth('api-users')->id())
            ],
            'type'=>'required|in:'.implode(',',$this->types)
        ];
    }
}
