<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Ad;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\WithPagination;
use App\Services\StatsService;

class UserAdsStats extends Component{
    use WithPagination;
    public $user,$ad_title;
    public function mount(User $user){
        $this->page_title = __('site.soldier_stats') .' ('.$user->username.')';
        $this->user = $user;

    }


    public function render(){

        $data = [
            'total_clicks'=> StatsService::totalClicksForAllAdsForSoldier($this->user),
            'page_title'=>__('site.soldier_stats'),
            'countries'=>StatsService::getAllAdCountryStats($this->user),
            'cities'=>StatsService::getAllAdCityStats($this->user),
            'ages'=>StatsService::getAllAdAgeStats($this->user),
            'audiences'=>StatsService::getAllAdAgeStats($this->user),
            'genders'=>StatsService::getAllAdGenderStats($this->user),
        ];
        return view('livewire.admin.users.ads_user_stats',$data)->layout('layouts.admin');
    }
}
