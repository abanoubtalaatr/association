<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Support\Arr;
use App\Http\Livewire\Traits\ValidationTrait;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use ValidationTrait;
    use WithFileUploads;

    public $form, $page_title, $settings, $solider_whats_app_file;
    public $pdfFile;
    public $progress = 0;

    public function mount()
    {
        $this->page_title = __('messages.settings');
        $this->settings = Setting::first();

        $this->form = Arr::except($this->settings->toArray(), ['id', 'created_at', 'updated_at']);


    }

    public function update()
    {
        $this->validate();

        if (isset($this->pdfFile)) {
            $this->pdfFile = $this->pdfFile->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->pdfFile->extension(), 'public');
            $this->form['solider_whats_app_file'] = $this->pdfFile;
        }

        $this->settings->update($this->form);

        return redirect()->to(route('admin.settings'))->with('success_message', __('site.saved'));
    }

    public function deleteSoliderFile()
    {
        $this->form['solider_whats_app_file'] = null;
        $this->settings->update(['solider_whats_app_file' => null]);
    }

    public function getRules()
    {

        return [
            'form.email' => 'email',
            'form.address' => 'string|min:10|max:200',
            'form.address_ar' => 'string|min:10|max:200',
            'form.mobile' => 'numeric',
            'form.lat' => 'numeric',
            'form.lng' => 'numeric',
            'form.facebook' => 'string|min:10|max:1000',
            'form.instagram' => 'string|min:10|max:1000',
            'form.twitter' => 'string|min:10|max:1000',
            'form.campaign_min_Duration' => 'integer',

            'form.ad_min_budget' => 'integer',
            'form.ad_click_price' => 'numeric',
            'form.soldier_ad_click_price' => 'numeric',
            'form.taxes' => 'integer',

            'form.min_ad_view_duration' => 'integer',
            'form.solider_ad_max_profit' => 'numeric',

            'form.solider_ad_max_profit_currency' => 'required',
            'form.ad_click_price_currency' => 'required',
            'form.app_store' => 'required',
            'form.google_play' => 'required',
            'form.minimum_payback_amount' => 'required|numeric',
            'form.mission_ar' => 'nullable',
            'form.mission_en' => 'nullable',
            'form.vision_ar' => 'nullable',
            'form.vision_en' => 'nullable',
            'form.number_of_days' => 'nullable|numeric',
            'form.library_visit_price' => 'nullable|numeric',
            'form.library_max_profit' => 'nullable|numeric',
            'form.website_link' => 'required|url',
            'form.solider_whats_app_message' => 'nullable|string|max:1000',
            'form.latest_android_version' => 'nullable',
            'form.latest_ios_version' => 'nullable',
            'form.app_status' => 'nullable',
            'form.app_inactive_message' => 'nullable',
            'pdfFile' => 'nullable|mimes:pdf', // max size 1M
            'form.solider_whats_app_file' => 'nullable',
        ];
    }

    public function logoutAllMobileUsers()
    {
        $key = Str::random(60);

        file_put_contents(base_path('.env'), str_replace(
            'JWT_SECRET=' . \Illuminate\Support\Facades\Config::get('jwt.secret'),
            'JWT_SECRET=' . $key,
            file_get_contents(base_path('.env'))
        ));

        \Illuminate\Support\Facades\Config::set('jwt.secret', $key);
        return redirect()->to(route('admin.settings'))->with('success_message', __('site.saved'));
    }

    public function render()
    {
        return view('livewire.admin.settings')->layout('layouts.admin');
    }
}
