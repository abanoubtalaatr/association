<?php

namespace App\Http\Livewire\User;

use App\Models\Contact;
use App\Models\Setting;
use Livewire\Component;

class ContactUs extends Component
{
    public $form;
    public $success_message = false;

    public function mount()
    {

        $this->form = [];
        $this->page_title = __('site.contact_us');
    }

    public function store()
    {
        $this->withValidator(function () {
            $this->dispatchBrowserEvent('scroll-to-top');
        })->validate();

        Contact::create($this->form);
        $this->form = [];
        $this->success_message = __('site.your_message_was_sent');
        $this->dispatchBrowserEvent('scroll-to-top');
    }

    protected function getRules()
    {
        return [
            'form.sender_name' => 'required|max:200',
            'form.sender_email' => 'required|max:200|email:rfc,dns',
            'form.message' => 'required|max:500'
        ];
    }

    protected function getValidationAttributes()
    {
        return [
            'form.sender_name' => __('validation.attributes.sender_name'),
            'form.sender_email' => __('validation.attributes.sender_email'),
            'form.message' => __('site.message')
        ];
    }


    public function render()
    {
        $settings = Setting::first();

        return view('livewire.user.contact-us',compact('settings'));
    }
}
