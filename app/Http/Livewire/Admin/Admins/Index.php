<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Admin;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $is_active, $name, $email, $page_title;
    protected $queryString = ['is_active','name', 'email'];
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->page_title = __('site.admins');
    }

    public function getRecords()
    {

        return Admin::query()
            ->when($this->name, function ($query) {
                return $query->where('name', 'LIKE', '%' . $this->name . '%');
            })->when($this->email, function ($query) {
                return $query->where('email', 'LIKE', '%' . $this->email . '%');
            })->paginate(10);
    }

    public function toggleStatus(Admin $admin)
    {
        if ($admin->is_active == 1) {
            $admin->update(['is_active' => '0']);
        } else {
            $admin->is_active = '1';
            $admin->save();
        }
    }

    public function destroy(Admin $admin)
    {
       $admin->delete();
    }

    public function render()
    {
        $records = $this->getRecords();
        return view('livewire.admin.admins.index', compact('records'))->layout('layouts.admin');
    }
}
