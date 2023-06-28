<?php

namespace App\Http\Livewire\Admin\Library;

use App\Models\Library;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    public $page_title;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->page_title = __('site.libraries');
    }


    public function render(){
        $records = Library::latest()->paginate();
        return view('livewire.admin.library.index',compact('records'))->layout('layouts.admin');
    }
}
