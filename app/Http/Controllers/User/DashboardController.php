<?php

namespace App\Http\Controllers\User;

use App\Models\Ad;
use Illuminate\Http\Request;
use App\Services\StatsService;
use App\Models\StatsCitySoldier;
use App\Models\StatsCountrySoldier;
use App\Http\Controllers\Controller;

class DashboardController extends Controller{
    public function index(){

        if(auth('users')->user()->user_type=='soldier'){
            $user_payback_requests = auth('users')->user()->paybackRequests()->get();
            $data = [
                'paid'=>$user_payback_requests->filter(function($item){
                            return $item->status == 'paid';
                        })->sum('amount'),
                'not_paid'=>$user_payback_requests->filter(function($item){
                                return $item->status == 'not_paid';
                            })->sum('amount'),
                'canceled'=>$user_payback_requests->filter(function($item){
                                return $item->status == 'canceled';
                            })->sum('amount'),
                'wallet_balance'=>round(auth('users')->user()->wallets()->whereNull('payback_request_id')->sum('amount'),2),
                'payback_requests'=>auth('users')->user()->paybackRequests()->paginate()
            ];
            return view('front.user.soldier_dashboard',$data);
        }

        $data = [

            'country_stats'=>StatsCountrySoldier::whereItemType('ad')->whereHas('ad',function($query){
                return $query->whereUserId(auth('users')->id());
            })->with('country')->get()->groupBy('country.value')->map(function($element,$key){
                return $element->sum('visitors_number');
            })->toArray(),

            'city_stats'=>StatsCitySoldier::whereItemType('ad')->whereHas('ad',function($query){
                return $query->whereUserId(auth('users')->id());
            })->with('city')->get()->groupBy('city.value')->map(function($element,$key){
                return $element->sum('visitors_number');
            })->toArray(),

            'week_stats'=>StatsService::getAdvertiserWeekStats(auth('users')->user()),
        ];
        // dd($data['country_stats']);
        return view('front.user.advertiser_dashboard',$data);
    }
}
