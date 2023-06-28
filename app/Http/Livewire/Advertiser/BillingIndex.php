<?php

namespace App\Http\Livewire\Advertiser;

use Livewire\Component;
use Livewire\WithPagination;

class BillingIndex extends Component
{
    use WithPagination;

    public $title, $status, $ad_id, $myAds;

    public $sortBy = 'status';
    public $sortDirection = 'asc';

    protected $queryString = ['title', 'status'];

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->page_title = __('site.billing');
        $this->myAds = auth('users')
            ->user()
            ->ads()
            ->whereNotNull('payment_info')
            ->get();
    }

    public function sortBy($column)
    {
        if ($this->sortBy == $column) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function getRecords()
    {
        return auth('users')
            ->user()
            ->ads()
            ->whereNotNull('payment_info')
            ->when($this->title, function ($query) {
                $query->where('title', 'LIKE', '%' . $this->title . '%');
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->ad_id, function ($q) {
                $q->where('id', $this->ad_id);
            })
            ->when($this->sortBy == 'timestamp', function ($q) {
                $q->orderBy('payment_info->timestamp', $this->sortDirection);
            })
            ->when($this->sortBy == 'paymentBrand', function ($q) {
                $q->orderBy('payment_info->paymentBrand', $this->sortDirection);
            })
            ->when($this->sortBy == 'bin', function ($q) {
                $q->orderBy('payment_info->card->bin', $this->sortDirection);
            })
            ->when($this->sortBy != 'paymentBrand' && $this->sortBy !== 'timestamp' && $this->sortBy != 'bin', function ($q) {
                $q->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate();
    }

    public function render()
    {

        $records = $this->getRecords();

//        dd($records[5]->payment_info->paymentBrand);
        return view('livewire.admin.billing.index', ['records' => $records]);
    }
}
