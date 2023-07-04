<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\LibraryProfit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $user_type, $status, $username, $email, $page_title, $task_level;
    protected $queryString = [ 'email'];
    public $rowNumber = 1;
    public $currentPage = 1;
    public $perPage = 15;
    public $start_task_two = false;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        //count page = 15 in first page the counter start from 1 and then in next page
        $this->page_title = __('site.trainers');
    }

    public function updatedPage()
    {
        // Calculate the row number for the first record on the current page
        $this->rowNumber = ($this->page - 1) * $this->perPage + 1;
    }

    public function getRecords()
    {

        return User::query()
            ->when(!empty($this->status), function ($query) {
                return $this->status == 'active' ? $query->whereIsActive(1) : $query->whereIsActive(0);
            })->when(!empty($this->user_type), function ($query) {
                return $query->whereUserType($this->user_type);
            })->when(!empty($this->username), function ($query) {
                return $query->where('username', 'LIKE', '%' . $this->username . '%');
            })->when(!empty($this->email), function ($query) {
                return $query->where('email', 'LIKE', '%' . $this->email . '%');
            })->when(!empty($this->task_level), function ($query) {
                if ($this->task_level != 'start_the_second') {
                    $this->start_task_two = false;
                    return $query->where('task_level', $this->task_level);
                } else {
                    $this->start_task_two = true;
                    return $query->whereHas('libraryProfits', function ($q) {
                        $q->where('amount', '>', 0)
                            ->where('amount', '<', DB::raw('(SELECT library_max_profit FROM settings)'));
                    });
                }
            })->paginate();
    }

    public function getAllWithoutFilter()
    {
        return User::paginate();
    }

    public function toggleStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
    }

    public function render()
    {
        $records = $this->getRecords();
        if ($records->count() == 0) {
            $this->reset(['email']);
            $this->resetPage();
            $records = $this->getAllWithoutFilter();
        }


        return view('livewire.admin.users.index', compact('records'))->layout('layouts.admin');
    }
}
