<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component{
    use WithPagination;
    public $page_title;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->page_title = __('site.roles');
    }

    public function destroy(Role $role){
        $role->delete();
    }

    public function render(){
        $records = Role::latest()->paginate();
        return view('livewire.admin.role.index',compact('records'))->layout('layouts.admin');
    }
}
