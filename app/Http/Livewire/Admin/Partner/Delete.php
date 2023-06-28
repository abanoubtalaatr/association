<?php

namespace App\Http\Livewire\Admin\Partner;

use App\Models\Partner;
use Livewire\Component;

class Delete extends Component{
    public function mount(Partner $partner){
        $partner->delete();
        return redirect()->to(route('admin.partner'))->with('success_message',(__('site.partner_deleted_successfully')));
    }
}
