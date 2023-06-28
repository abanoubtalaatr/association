<?php

namespace App\Http\Livewire\User\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    public $page_title;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->page_title = __('site.categories');
    }


    public function render(){
        $records = Category::latest()->paginate();
        return view('livewire.user.category.index',compact('records'))->layout('layouts.user');
    }
}
