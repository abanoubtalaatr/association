<?php

namespace App\Http\Livewire\Admin\Ads;

use App\Models\Ad;
use App\Models\Camp;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $page_title;
    public $title,$camp_id,$status;
    public $camps;
    protected $queryString = ['title','camp_id', 'status'];

    public function mount(){
        $this->page_title = __('site.ads');
        $this->camps = Camp::orderBy('title')->get();
        $this->status = request('status');
    }

    public function updated(){
        $this->resetPage();
    }
     public function deactivate(Ad $ad){
        $ad->update(['status'=>'inactive']);
    }



    public function getRecords(){

        return
            Ad::when($this->title,function($query,$title){
                    return $query->where('title','LIKE','%'.$title.'%');
                })->when($this->camp_id,function($query,$camp_id){
                    return $query->whereCampId($camp_id);
                })->when($this->status,function($query,$status){
                    return $this->status=='only_active'? $query->where('status','!=','inactive') : $query->whereStatus($status);
                })->orderByDesc('id')
                ->paginate();
    }

    public function render(){
        return view('livewire.admin.ads.index',['records'=>$this->getRecords()])->layout('layouts.admin');
    }
}
