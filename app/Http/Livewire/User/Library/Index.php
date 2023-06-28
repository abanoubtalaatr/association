<?php

namespace App\Http\Livewire\User\Library;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    public $category,$page_title,$share_on_whatsapp;

    public function mount(Category $category){
        $this->category = $category;
        $this->page_title = $category->{"title_".app()->getLocale()};

    }

    public function render(){
        $records = $this->category->libraries()->latest()->paginate();
        return view('livewire.user.library.index',compact('records'))->layout('layouts.user');
    }
}
