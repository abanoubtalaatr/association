<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Course;
use App\Models\LibraryProfit;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class Index extends Component
{
    use WithPagination;

    public $user_type, $status, $username, $email, $page_title, $task_level;
    protected $queryString = ['email'];
    public $rowNumber = 1;
    public $currentPage = 1;
    public $perPage = 15;
    public $courses = [];
    public $course;
    protected $users=[];

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->page_title = __('site.trainers');
        $this->courses = Course::query()->get();
    }

    public function updatedPage()
    {
        // Calculate the row number for the first record on the current page
        $this->rowNumber = ($this->page - 1) * $this->perPage + 1;
    }

    public function updateCourse()
    {
        dd('great way to speak english');
    }

    public function getRecords()
    {

        return User::query()->when(!empty($this->username), function ($query) {
                return $query->where('first_name', 'LIKE', '%' . $this->username . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $this->username . '%');
            })->when(!empty($this->email), function ($query) {
                return $query->where('email', 'LIKE', '%' . $this->email . '%');
            })->paginate();
    }

    public function getAllWithoutFilter()
    {
        return User::paginate();
    }

    public function destroy(User $user)
    {
        $user->delete();
    }


    public function toggleStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
    }

    public function getCourseTrainers()
    {
        $course = Course::findOrFail($this->course);
        return $course->users()->simplePaginate(10);
    }

    public function export()
    {

     $users =User::query()->when(!empty($this->username), function ($query) {
            return $query->where('first_name', 'LIKE', '%' . $this->username . '%')
                ->orWhere('last_name', 'LIKE', '%' . $this->username . '%');
        })->when(!empty($this->email), function ($query) {
            return $query->where('email', 'LIKE', '%' . $this->email . '%');
        })->get();

        if ($this->course) {
            $idsForTrainers = $this->getCourseTrainers()->pluck('id');
            $users = User::query()->whereIn('id', $idsForTrainers)->get();
        }

        $export = new UsersExport(Collection::make($users));
        return Excel::download($export, 'trainers.csv');
    }

    public function render()
    {
        $records = $this->getRecords();
        $this->users = $records;
        if ($records->count() == 0) {
            $this->reset(['email']);
            $this->resetPage();
            $records = $this->getAllWithoutFilter();
            $this->users = $records;
        }

        if ($this->course) {
            $records = $this->getCourseTrainers();
            $this->users = $records;
        }
        return view('livewire.admin.users.index', compact('records'))->layout('layouts.admin');
    }
}
