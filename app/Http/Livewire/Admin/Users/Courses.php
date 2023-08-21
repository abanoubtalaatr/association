<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Courses extends Component
{

    use WithPagination;
    public $user,$ad_title;
    public function mount(User $user){
        $this->page_title = __('site.courses');

        $this->user = $user;
    }

    public function updated(){
        $this->resetPage();
    }

    public function getRecords(){
        return
            $this->user->courses()->paginate();
    }

    public function render()
    {
        $records = $this->getRecords();
        $user = $this->user;
        return view('livewire.admin.users.courses',compact('records','user'))->layout('layouts.admin');
    }
}
