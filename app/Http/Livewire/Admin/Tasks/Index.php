<?php

namespace App\Http\Livewire\Admin\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $term;
    public function mount(){
        $this->page_title = __('site.instructions');
    }

    public function destroy(Task $task){
        $task->delete();
    }

    public function getRecords(){
        return
            Task::query()
                ->when($this->term,function($q){
                    $search_term = "%".$this->term."%";
                    return
                        $q
                        ->where('title','LIKE',$search_term)
                        ->orWhere('description','LIKE',$search_term)
                        ->orWhere('content','LIKE',$search_term);
                })->paginate();
    }

    public function render(){
        $records = $this->getRecords();
        return view('livewire.admin.tasks.index',['records'=>$records]);
    }
}
