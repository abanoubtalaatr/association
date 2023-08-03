<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Ad;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\ValidationTrait;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use WithFileUploads, ValidationTrait;

    public $form;
    public $admin;
    public $roles;

    public function mount(Admin $admin)
    {
        $this->page_title = __('site.create_admin');
        $this->admin = $admin;
        $this->roles = Role::where('is_owner', 0)->get();

        $this->form = Arr::except($admin->toArray(), ['updated_at', 'created_at', 'id']);
    }


    public function store()
    {

        $this->validate();

        if (isset($this->form['password'])) {
            $this->form['password'] = bcrypt($this->form['password']);
        }
        $admin = Admin::create(Arr::except($this->form, ['roles', 'password_confirmation']));

        DB::table('model_has_roles')->insert(['role_id' => $this->form['roles'], 'model_id' => $admin->id, 'model_type' => 'App\Models\Admin']);


        return redirect()->to(route('admin.admins.index'))->with('message', __('site.admin_created_successfully'));
    }

    public
    function getRules()
    {
        return [
            'form.email' => 'required|email|unique:admins,email',
            'form.name' => 'required|min:3|max:100|unique:admins,name',
            'form.phone' => 'nullable|unique:admins,phone',
            'form.password' => 'required|min:8',
            'form.password_confirmation' => 'required|same:form.password',
            'form.roles' => 'required'
        ];
    }


    public
    function toggleStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
    }

    public
    function render()
    {

        return view('livewire.admin.admins.create')->layout('layouts.admin');
    }
}
