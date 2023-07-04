<?php

namespace App\Http\Livewire\Admin\Certification;

use App\Models\Certification;
use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $page_title;
    protected $paginationTheme = 'bootstrap';
    protected $courses;

    public function mount()
    {
        $this->page_title = __('site.certifications');

    }

    public function destroy(Certification $certification)
    {
        $certification->delete();
    }

    public function render()
    {
        $records = Certification::latest()->paginate();
        return view('livewire.admin.certification.index', compact('records'))->layout('layouts.admin');
    }
}
