<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class WithdrawIndex extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render(){
        return view('livewire.admin.withdraw-index');
    }
}
