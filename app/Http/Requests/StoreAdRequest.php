<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        $min_ad_budget = Setting::find(1)->min_ad_budget;
        $rules = [
            'title'=>'required|min:3|max:300',
            'content'=>'required|min:3|max:500',
            'start_date'=>'required|date|date-format:Y-m-d|after:yesterday',
            'start_time'=>'required',
            'budget'=>'required|integer|gte:'.$min_ad_budget.'|digits_between:1,7',
            'button_text'=>'required|min:2|max:200',
            'link'=>'required|active_url|max:300',
            'camp_id'=>'required|exists:camps,id',
            'ad_cities'=>'required|array',
            'short_description'=>'required|min:3|max:300',
            'whatsapp_thumbnail'=>'required|file|mimes:jpg,png,jpeg|max:300',
            'ad_countries'=>'required|array',
            'media_type'=>'required|in:video,image,slider',

            'media'=>'required|array',

            'ad_genders'=>'required|array',
            'ad_genders.*'=>'integer|exists:genders,id',

            'ad_ages'=>'required|array',
            'ad_ages.*'=>'integer|exists:ages,id',

            'ad_targeted_audiences'=>'required|array',
            'ad_targeted_audiences.*'=>'integer|exists:audiences,id',

            'ad_languages'=>'required|array',
            'ad_languages.*'=>'exists:languages,id',
        ];

        $rules['media'] = 'nullable';

        return $rules;
    }
}
