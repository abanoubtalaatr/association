<?php

namespace App\Http\Livewire\Advertiser;

use App\Models\Camp;
use Livewire\Component;
use Livewire\WithPagination;

class CampsIndex extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $page_title='';
    public $current_camp;

    public function mount(){
        $this->page_title = __('site.camps');
    }

    public function setCurrentCamp(Camp $camp){
        $this->current_camp = $camp;
    }

    public function destroy(){
        $this->current_camp->update(['status'=>'inactive']);
        $this->current_camp->ads()->update(['status'=>'inactive']);
        $this->dispatchBrowserEvent('hide-modal');
    }



    public function render(){
        $records =
            auth('users')
            ->user()
            ->camps()
            ->withCount('ads')
            ->latest()
            ->paginate();
        return view('livewire.advertiser.camps-index',['records'=>$records]);
    }
}
