<?php

namespace App\Http\Controllers\Api;

use App\Models\Age;
use App\Models\Gender;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Audience;
use App\Models\Language;
use App\Http\Resources\AgeResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\GenderResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\SettingResource;
use App\Http\Resources\LanguageResource;

class DataController extends Controller{
  public function getCountries(){
      return CountryResource::collection(Country::whereId(1)->get());
  }

  public function getCountryCities(Country $country){
    return CityResource::collection($country->cities);
  }

  public function getAges(){
      return AgeResource::collection(Age::get());
  }

  public function getAudience(){
    return AgeResource::collection(Audience::get());
  }

  public function getLanguages(){
    return LanguageResource::collection(Language::get());
  }

   public function getGenders(){
    return GenderResource::collection(Gender::get());
  }


    public function contactSettings(){
        return new SettingResource(Setting::find(1));
    }


}
