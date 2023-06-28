<?php

namespace App\Http\Livewire\Admin\PaybackRequest;

use Livewire\Component;
use App\Models\PaybackRequest;

class Index extends Component
{
    public $page_title, $status, $payment_method;
    public $current_request, $request_id;

    public $transaction_id;

    public function mount()
    {
        $this->page_title = __('site.payback_requests');
    }


    protected function filterRecords()
    {
        return
            PaybackRequest::query()->whereHas('soldier')
                ->when($this->status, function ($query, $status) {
                    return $query->whereStatus($status);
                })->when(request('user_id'), function ($query, $user_id) {
                    return $query->whereUserId($user_id);
                })->when($this->payment_method, function ($query) {
                    return $query->whereHas('soldier', function ($query) {
                        return $query->wherePaymentMethod($this->payment_method);
                    });
                })
                ->latest()->paginate();
    }

    public function setCurrentRequest($current_request_id)
    {
        $this->current_request = PaybackRequest::find($current_request_id);
    }

    public function accept($current_request_id)
    {
        $this->validate([
            'transaction_id' => 'required|max:200'
        ]);

        $this->current_request = PaybackRequest::find($current_request_id);
        if ($this->current_request->status == 'not_paid') {
            $this->current_request->update(['status' => 'paid', 'transaction_id' => $this->transaction_id]);
            $this->dispatchBrowserEvent('alert-success', ['alert_id' => 'control-request-success', 'message' => __('site.accepted_successfully'), 'modal_id' => 'request-modal']);
        } else {
            $this->dispatchBrowserEvent('alert-error', ['message' => __('site.cant_accept_this_request')]);
        }

    }

    public function refuse()
    {
        $this->current_request = PaybackRequest::find($this->current_request->id);
        if ($this->current_request->status == 'not_paid') {
            $this->current_request->update(['status' => 'canceled']);
            $this->dispatchBrowserEvent('alert-success', ['alert_id' => 'control-request-success', 'message' => __('site.refused_successfully'), 'modal_id' => 'request-modal']);
        } else {
            $this->dispatchBrowserEvent('alert-error', ['alert_id' => 'control-request-error', 'message' => __('site.cant_refuse_this_request')]);
        }

    }


    public function cancel(PaybackRequest $paybackRequest)
    {
        $paybackRequest->update(['status' => 'canceled']);
        $paybackRequest->wallets()->update(['payback_request_id' => null]);
    }

    public function render()
    {
        $records = $this->filterRecords();
        return view('livewire.admin.payback-request.index', compact('records'))->layout('layouts.admin');
    }
}
