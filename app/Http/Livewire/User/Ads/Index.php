<?php

namespace App\Http\Livewire\User\Ads;

use App\Models\Ad;
use App\Models\LibraryProfit;
use App\Models\Setting;
use App\Services\AdsFilterService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $page_title;
    public $title, $camp_id, $status;
    public $camps;
    public $error_message = '';
    protected $queryString = ['title', 'camp_id', 'status'];

    public function mount()
    {

        $this->page_title = __('site.your_ads');
        $this->camps = auth('users')->user()->camps()->get();
        $this->camp_id = request('camp_id', null);
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function deactivate(Ad $ad)
    {
        $ad->update(['status' => 'inactive']);
    }

    public function getRecords()
    {
        $user = auth('users')->user();
        $relation = $user->ads();
        $settings = Setting::first();

        if ($user->user_type == 'soldier') {
            return Ad::whereStatus('active')
                ->where('start_date', '<=', now())
                ->where('remaining_budget', '>', 0)
                ->get()
                ;
//
//            $relation = AdsFilterService::getAdsQuery(auth('users')->id())
//                ->whereIn('id', $firstThirdAds)
//                ->orWhereNotIn('id', $firstThirdAds)
//                ->whereStatus('active')
//                ->where('start_date', '<=', now())
//                ->where('remaining_budget', '>', 0)
//                ->orderBy('id', 'asc');
//
//            return $relation->get();


//            $soldier_current_profit = LibraryProfit::where('soldier_id', $user->id)
//                ->sum('amount');
//
//            if ($user->task_level < 2) {
//                $relation = $relation->whereId(0);
//                $this->error_message = __('site.you_must_complete_your_tasks_first');
//            }
// elseif ($user->last_share != 'library') {
//                $relation = $relation->whereId(0);
//                $this->error_message = __('site.you_must_share_a_library_first');
//            }

//            if($soldier_current_profit < $settings->library_max_profit) {
//                $this->error_message = __('site.you_must_share_from_library') . $settings->library_max_profit . trans('general.rial');
//            }

        }


        return
            $relation
                ->when($this->title, function ($query, $title) {
                    return $query->where('title', 'LIKE', '%' . $title . '%');
                })->when($this->camp_id, function ($query, $camp_id) {
                    return $query->whereCampId($camp_id);
                })->when($this->status, function ($query, $status) {
                    return request('status') == 'only_active' ? $query->where('status', '!=', 'inactive') : $query->whereStatus($status);
                })->orderByDesc('id')
                ->paginate();
    }

    public function render()
    {
        $view_name = auth('users')->user()->user_type . '_index';
        return view('livewire.user.ads.' . $view_name, ['records' => $this->getRecords()]);
    }
}
