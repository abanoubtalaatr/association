<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\ValidationTrait;

class Edit extends Component
{
    use WithFileUploads, ValidationTrait;

    public $form;
    public $user;

    public function mount(User $user)
    {
        $this->page_title = __('site.edit_user');
        $this->user = $user;
        $this->form = Arr::except($user->toArray(), ['updated_at', 'created_at', 'id']);
    }


    public function update()
    {
        $this->validate();
        if (isset($this->form['password'])) {
            $this->form['password'] = bcrypt($this->form['password']);
        }

        $this->user->update(Arr::except($this->form, ['password_confirmation']));
        return redirect()->to(route('admin.users.index'))->with('message', __('site.user_edited_successfully'));
    }

    public function getRules()
    {
        return [
            'form.user_type' => 'required|in:soldier,advertiser',
            'form.email' => ($this->user->user_type == 'advertiser' ? 'required' : 'nullable') . '|max:200|email:dns,rfc|unique:users,email,' . $this->user->id,
            'form.username' => 'required|min:3|max:100|unique:users,username,' . $this->user->id,
            'form.mobile' => ($this->user->user_type == 'advertiser' ? 'nullable' : 'required') . '|integer|digits:9|bail|unique:users,mobile,' . $this->user->id,
            'form.password' => 'nullable|min:8',
            'form.password_confirmation' => 'nullable|same:form.password'
        ];
    }


    public function toggleStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
    }

    public function render()
    {

        return view('livewire.admin.users.edit')->layout('layouts.admin');
    }
}
