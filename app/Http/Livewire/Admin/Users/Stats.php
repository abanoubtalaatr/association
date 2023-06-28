<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use App\Services\StatsService;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\WithPagination;

class Stats extends Component{
    use WithPagination;
    public $user,$ad_title, $total_clicks;
    public function mount(User $user){
        $this->page_title = __('site.soldier_stats') .' ('.$user->username.')';
        $this->user = $user;
    }

    public function updated(){
        $this->resetPage();
    }

    public function getRecords(){
        return
            $this
            ->user
            ->statsSessionsSoldier()
            ->when($this->ad_title,function($query){
                return $query->whereHas('ad',function($query2){
                    return $query2->where('title','LIKE','%'.$this->ad_title.'%');
                });
            })
            ->with('ad')
            ->paginate();
    }

    public function render(){
        $records = $this->getRecords();
        $user = $this->user;
        return view('livewire.admin.users.stats',compact('records','user'))->layout('layouts.admin');
    }
}
