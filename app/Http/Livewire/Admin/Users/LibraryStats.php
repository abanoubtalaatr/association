<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Arr;
use Livewire\WithPagination;

class LibraryStats extends Component
{

    use WithPagination;
    public $user,$ad_title;
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
            ->statsLibrarySessionsSoldier()
            ->when($this->ad_title,function($query){
                return $query->whereHas('library',function($query2){
                    return $query2->where('title','LIKE','%'.$this->ad_title.'%');
                });
            })
            ->paginate();
    }

    public function render()
    {
        $records = $this->getRecords();
        $user = $this->user;
        return view('livewire.admin.users.library-stats',compact('records','user'))->layout('layouts.admin');
    }
}
