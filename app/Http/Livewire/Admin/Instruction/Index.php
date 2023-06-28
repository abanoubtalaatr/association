<?php

namespace App\Http\Livewire\Admin\Instruction;

use App\Models\Instruction;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    public $page_title;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->page_title = __('site.instructions');
    }

    public function destroy(Instruction $instruction){
        $instruction->delete();
    }

    public function render(){
        $records = Instruction::latest()->paginate();
        return view('livewire.admin.instruction.index',compact('records'))->layout('layouts.admin');
    }
}
