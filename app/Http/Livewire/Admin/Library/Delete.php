<?php

namespace App\Http\Livewire\Admin\Library;

use App\Models\Library;
use Livewire\Component;

class Delete extends Component{
    public function mount(Library $library){
        $library->delete();
        return redirect()->to(route('admin.library'))->with('success_message',(__('site.library_deleted_successfully')));
    }
}
