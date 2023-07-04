<?php

namespace App\Http\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $page_title;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->page_title = __('site.courses');
    }

    public function destroy(Course $category)
    {
        $category->delete();
    }

    public function render()
    {
        $records = Course::latest()->paginate();
        return view('livewire.admin.course.index', compact('records'))->layout('layouts.admin');
    }
}
