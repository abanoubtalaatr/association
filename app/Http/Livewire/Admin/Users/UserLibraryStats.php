<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\{Library,Ad};
use App\Models\User;
use Illuminate\Support\Arr;
use Livewire\WithPagination;
use App\Services\StatsService;
use App\Models\StatsAgeSoldier;
use Spatie\Analytics\Analytics;
use App\Models\StatsCitySoldier;
use App\Models\StatsGenderSoldier;
use App\Models\StatsCountrySoldier;
use App\Models\{StatsAudienceSoldier,StatsSessionsSoldier};
class UserLibraryStats extends Component
{
    use WithPagination;
    public $user;
    public $total_clicks;
    public $month_clicks;
    
    public function mount(User $user){
        $this->page_title = __('site.soldier_stats') .' ('.$user->username.')';
        $this->user = $user;

    }


    public function render()
    {
        $soldier = $this->user;
        $countries = StatsCountrySoldier::with('country')
        ->when($soldier,function($query) use ($soldier){
            return $query->whereBelongsTo($soldier);
        })
        ->get()
        ->groupBy('country.value')->map(function($element){
            return $element->sum('visitors_number');
        })->toArray();
        $cities = StatsCitySoldier::with('city')
        ->when($soldier,function($query) use ($soldier){
            return $query->whereBelongsTo($soldier);
        })
        ->get()
        ->groupBy('city.value')->map(function($element){
            return $element->sum('visitors_number');
        })->toArray();

        $ages = StatsAgeSoldier::with('age')
        ->when($soldier,function($query) use ($soldier){
            return $query->whereBelongsTo($soldier);
        })
        ->get()
        ->groupBy('age.value')->map(function($element){
            return $element->sum('visitors_number');
        })->toArray();

        $audiences =  StatsAudienceSoldier::with('audience')
        ->when($soldier,function($query) use ($soldier){
            return $query->whereBelongsTo($soldier);
        })
        ->get()
        ->groupBy('audience.value')->map(function($element){
            return $element->sum('visitors_number');
        })->toArray();

        $genders = StatsGenderSoldier::with('gender')
        ->when($soldier,function($query) use ($soldier){
            return $query->whereBelongsTo($soldier);
        })
        ->get()
        ->groupBy('gender.value')->map(function($element){
            return $element->sum('visitors_number');
        })->toArray();

        $visitors_count = StatsSessionsSoldier::where('user_id',$soldier->id)->sum('visitors_number');
        $data = [
            'visits_count'=>$visitors_count,
            'page_title'=>$this->page_title,
            'countries'=>$countries,
            'cities'=>$cities,
            'ages'=>$ages,
            'audiences'=>$audiences,
            'genders'=>$genders,
        ];
        return view('livewire.admin.users.user-library-stats',$data)->layout('layouts.admin');
    }
}
