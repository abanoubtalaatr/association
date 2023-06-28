<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Ad;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\WithPagination;
use App\Services\StatsService;

class UserAdStats extends Component{
    use WithPagination;
    public $user,$ad_title;
    public function mount(User $user,Ad $ad){
        $this->page_title = __('site.soldier_stats') .' ('.$user->username.')';
        $this->user = $user;
        $this->ad = $ad;
    }


    public function render(){
        $data = [
            'total_clicks'=>StatsService::totalClicks($this->ad, $this->user),
            'page_title'=>$this->ad->title_ar,
            'countries'=>StatsService::getAdCountryStats($this->ad,$this->user),
            'cities'=>StatsService::getAdCityStats($this->ad,$this->user),
            'ages'=>StatsService::getAdAgeStats($this->ad,$this->user),
            'audiences'=>StatsService::getAdAgeStats($this->ad,$this->user),
            'genders'=>StatsService::getAdGenderStats($this->ad,$this->user),
        ];
        return view('livewire.admin.users.ad_user_stats',$data)->layout('layouts.admin');
    }
}
