<?php

namespace App\Http\Livewire\User\PaybackRequests;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $status;
    protected $queryString = ['status'];
    public function mount(){
        $this->status=null;
    }

     public function updated(){
        $this->resetPage();
    }

    protected function getRecords(){
        return auth()->user()->paybackRequests()->when($this->status,function($query){
            return $query->whereStatus($this->status);
        })->paginate();
    }

    public function render(){
        return view(
            'livewire.user.payback-requests.index',
            ['records'=>$this->getRecords(),'page_title'=>__('site.payback_requests')]
        )->layout('layouts.user');
    }
}
