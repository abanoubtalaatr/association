<?php

namespace App\Http\Livewire\User\Library;

use Livewire\Component;
use App\Models\Library;

class Show extends Component{
    public $record,$page_title,$share_on_whatsapp,$link_new_lines;

    public function mount(Library $library){
        $this->record = $library;
        $this->page_title = $library->title;
        $this->link = route('show_library',[$library,auth()->user()->utm]);
        $this->share_on_whatsapp = $library->title.'%0a'.$this->link.'%0a'.$library->description;

        $link = $library->title.' %0A %0A '.$library->description.' %0A %0A '.route('show_library',[$library,auth()->user()->utm]);
        $this->link_new_lines = $link;

    }

    public function render(){
        return view('livewire.user.library.show')->layout('layouts.user');
    }
}
