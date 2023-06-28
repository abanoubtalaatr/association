<?php

namespace App\Http\Controllers\User;

use App\Models\Ad;
use App\Models\AdTime;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\StatsService;
use App\Services\HyperpayService;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditAdStatusRequest;

class AdController extends Controller
{
    public function index()
    {
        return view('front.user.ads.index');
    }

    public function create()
    {
        return view('front.user.ads.create');
    }

    public function edit(Ad $ad)
    {
        return view('front.user.ads.edit', compact('ad'));
    }

    public function show(Ad $ad)
    {
        $link = $ad->title . '\n ' . $ad->short_description . '\n' . route('show_ad', [$ad, auth()->user()->utm]);
        $data = [
            'record' => $ad,
            'page_title' => $ad->title_ar,
            'link' => $link,
            'link_new_lines' => nl2br($link),
            'share_on_whatsapp' => $ad->title . '%0a %0a' . $ad->content . '%0a %0a' . $link
        ];
        return view('front.user.ads.show', $data);
    }

    public function stats(Ad $ad)
    {
        $rowTime = AdTime::where('ad_id', $ad->id)->first();

        $data = [
            'record' => $ad,
            'page_title' => $ad->title_ar,
            'countries' => StatsService::getAdCountryStats($ad),
            'cities' => StatsService::getAdCityStats($ad),
            'ages' => StatsService::getAdAgeStats($ad),
            'audiences' => StatsService::getAdAgeStats($ad),
            'genders' => StatsService::getAdGenderStats($ad),
            'devices' => StatsService::getDevices($ad),
            'operating_system' => StatsService::getOperatingSystem($ad),
            'browsers' => StatsService::getBrowsers($ad),
            'time' => $rowTime ? $rowTime->time : ''
        ];
        return view('front.user.ads.stats', $data);
    }

    public function adminStats(Ad $ad)
    {
        $rowTime = AdTime::where('ad_id', $ad->id)->first();
        $data = [
            'record' => $ad,
            'page_title' => $ad->title_ar,
            'countries' => StatsService::getAdCountryStats($ad),
            'cities' => StatsService::getAdCityStats($ad),
            'ages' => StatsService::getAdAgeStats($ad),
            'audiences' => StatsService::getAdAgeStats($ad),
            'genders' => StatsService::getAdGenderStats($ad),
            'devices' => StatsService::getDevices($ad),
            'operating_system' => StatsService::getOperatingSystem($ad),
            'browsers' => StatsService::getBrowsers($ad),
            'time' => $rowTime ? $rowTime->time : ''

        ];
        return view('front.user.ads.admin_stats', $data);
    }

    public function adminAdSoldiers(Ad $ad)
    {
        $data = [
            'record' => $ad,
            'page_title' => $ad->title . ' ' . __('site.statistics'),
            'records' => $ad->soldiers()->whereHas('user')->paginate()

        ];
        return view('front.user.ads.ad_soldiers', $data);
    }

    public function editStatus(Ad $ad)
    {
        $statuses = ['reviewing', 'active', 'finished', 'inactive'];
        return view('front.user.ads.edit_status', compact('ad', 'statuses'));
    }

    public function saveEditStatus(EditAdStatusRequest $request, Ad $ad)
    {
        $data = ['status' => $request->new_status];
        if ($ad->remaining_budget == 0 && is_null($ad->finished_at) && $request->new_stauts == 'active') {
            $data['remaining_budget'] = $ad->budget;
        }
        $ad->update($data);
        return redirect()->to(route('admin.ads'))->withSuccessMessage(__('site.saved'));
    }


    public function pay(Ad $ad)
    {

        $payment_info = HyperpayService::prepareCheckout($ad['budget'], $ad->advertiser);
        $ad->update(['checkout_id' => $payment_info['id']]);
        $data = [
            'page_title' => $ad->title,
            'record' => $ad,
            'checkout_id' => $payment_info['id']
        ];
        return view('payment.index', $data);
    }
}
