<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\ValidationTrait;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    use WithFileUploads, ValidationTrait;

    public $form;
    public $admin;
    public $roles;
    public $selectedRoles = [];


    public function mount(Admin $admin)
    {
        $this->page_title = __('site.edit_admin');
        $this->admin = $admin;
        $this->roles = Role::where('is_owner', 0)->get();
        $this->form = Arr::except($admin->toArray(), ['updated_at', 'created_at', 'id']);
        $this->selectedRoles = DB::table('model_has_roles')->where('model_id', $this->admin->id)->pluck('role_id')->toArray();
    }

    public function update()
    {

        $this->validate();

        if (isset($this->form['password'])) {
            $this->form['password'] = bcrypt($this->form['password']);
        }

        if (!empty($this->selectedRoles)) {
            $this->admin->syncRoles($this->selectedRoles);
        }

        $this->admin->update(Arr::except($this->form, ['password_confirmation']));
        return redirect()->to(route('admin.admins.index'))->with('message', __('site.admin_edited_successfully'));
    }


    public function getRules()
    {
        return [
            'form.email' => 'required|email:dns,rfc|unique:admins,email,' . $this->admin->id,
            'form.name' => 'required|min:3|max:100|unique:admins,name,' . $this->admin->id,
            'form.phone' => 'nullable|unique:admins,phone,' . $this->admin->id,
            'form.password' => 'nullable|min:8',
            'form.password_confirmation' => 'nullable|same:form.password',
            'selectedRoles' => 'required'
        ];
    }


    public function toggleStatus(Admin $admin)
    {
        $admin->update(['is_active' => !$admin->is_active]);
    }

    public function render()
    {
        return view('livewire.admin.admins.edit')->layout('layouts.admin');
    }
}
