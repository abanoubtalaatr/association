<?php

namespace App\Jobs;

use App\Models\{Ad, AdProfit, LibraryProfit, User, Library, Setting, StatsSessionsSoldier};


use App\Jobs\StoreAudienceStatisticsJob;
use Spatie\Analytics\Period;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Spatie\Analytics\Analytics;
use App\Jobs\StoreAgeStatisticsJob;
use App\Jobs\StoreCityStatisticsJob;
use App\Jobs\StoreGenderStatisticsJob;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\AdFinishedNotification;


class StoreItemStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user_utm, $user_id, $user, $item_type, $item_id, $filter, $filter_without_utm;

    public function __construct($item_type, $item_id, $user_utm = '')
    {
        $this->item_id = $item_id;
        $this->item_type = $item_type;
        $this->user = $user_utm ? User::whereUtm($user_utm)->first() : 0;
        $this->user_id = $this->user ? $this->user->id : 0;

        $this->filter = 'ga:pagePath=@/' . $this->item_type . '/' . $this->item_id . '/' . $user_utm;
        $this->filter_without_utm = 'ga:pagePath=@/' . $this->item_type . '/' . $this->item_id;
    }

    public function handle()
    {
        info('memory usage: ' . round(memory_get_usage(false) / 1024) . ' KB [' . __CLASS__ . ']');
        $current_month_clicks = $this->getCurrentMonthClicks($this->filter_without_utm);
        $ad_new_total_clicks = $this->getTotalClicks($this->filter_without_utm);

        $item = $this->item_type == 'ad' ? Ad::find($this->item_id) : Library::find($this->item_id);

        if (!($item->total_clicks < $ad_new_total_clicks)) {
            return;
        }

        $soldier_new_visits = $this->getTotalClicks($this->filter);

        if ($this->item_type == 'ad') {
            $ad = $item;

            $settings = Setting::first();

            $ad_current_visits = $ad->total_clicks;
            $ad_new_visits = $ad_new_total_clicks;

            $ad_visit_cost = $settings->ad_click_price;

            $soldier_profit_per_visit = $this->user_id ? $settings->soldier_ad_click_price : 0;
            $platform_profit_per_visit = $ad_visit_cost - $soldier_profit_per_visit;

            $visits_diff = $ad_new_visits - $ad_current_visits;
            // $platform_profit = $visits_diff * $platform_profit_per_visit;
            $soldier_profit = 0;


            if ($this->user_id) {
//                if ($this->user->task_level < 3) {
//                    $this->user->update(['task_level' => 3]);
//                }
                $soldier_current_visits = $this->getSoldierAdTotalClicks();

                if ($soldier_diff = $soldier_new_visits - $soldier_current_visits) {
                    $soldier_profit = $soldier_diff * $soldier_profit_per_visit;
                    if ($soldier_profit > $settings->solider_ad_max_profit) {
                        $soldier_current_profit = AdProfit::whereSoldierId($this->user_id)->whereAdId($this->item_id)->sum('amount');
                        info('Current profit' . $soldier_current_profit);
                        info('new profit: ' . $soldier_profit);
                        // $soldier_profit = $settings->solider_ad_max_profit;
                        $soldier_profit = $settings->solider_ad_max_profit - $soldier_current_profit;
                        $soldier_profit = $soldier_profit > 0 ? $soldier_profit : 0;
                        info('new profit: ' . $soldier_profit);
                    }

                    $where = [
                        'user_id' => $this->user_id,
                        'item_type' => 'ad',
                        'ad_id' => $this->item_id
                    ];
                    $exists = StatsSessionsSoldier::where($where)->exists();
                    if ($exists) {
                        StatsSessionsSoldier::where($where)->update(['visitors_number' => $soldier_new_visits]);
                    } else {
                        StatsSessionsSoldier::insert(array_merge($where, ['visitors_number' => $soldier_new_visits, 'created_at' => now(), 'updated_at' => now()]));
                    }
                }

            }


            // $advertiser_cost = $platform_profit + $soldier_profit;
            $advertiser_cost = $visits_diff * $ad_visit_cost;
            $platform_profit = $advertiser_cost - $soldier_profit;
            info('platform=' . $advertiser_cost . '-' . $soldier_profit . '=' . $platform_profit);
            $remaining_budget = $ad->remaining_budget - $advertiser_cost;
            $new_status = $ad->status;
            if ($remaining_budget <= 0) {
                $new_status = 'finished';
                $soldier_percent = $soldier_profit_per_visit / $ad_visit_cost;

                $advertiser_cost = $ad->remaining_budget;
                $soldier_profit = $soldier_percent * $advertiser_cost;
                $platform_profit = $ad->remaining_budget - $soldier_profit;
                $remaining_budget = 0;
            }


            if ($platform_profit) {
                $ad->adProfits()->create([
                    'profit_for' => 'platform',
                    'amount' => $platform_profit
                ]);
            }


            if ($soldier_profit > 0) {
                $ad->adProfits()->create([
                    'profit_for' => 'soldier',
                    'soldier_id' => $this->user_id,
                    'amount' => $soldier_profit
                ]);
                $this->user->wallets()->create([
                    'amount' => $soldier_profit,
                    'reason_ar' => $soldier_diff . ' زيارة لإعلان رقم ' . $ad->id,
                    'reason_en' => $soldier_diff . 'Visit to ad number ' . $ad->id
                ]);
            }


            info('soldier_profit:' . $soldier_profit);
            info('platform_profit:' . $platform_profit);
            info('advertiser_cost: ' . $advertiser_cost);

            $ad->update([
                'status' => $new_status,
                'finished_at' => $new_status == 'finished' ? now() : null,
                'remaining_budget' => $remaining_budget,
                'total_clicks' => $ad_new_visits
            ]);

            if ($new_status == 'finished') {
                $ad->advertiser->notify(new AdFinishedNotification($this->item_id));
            }


        } elseif ($this->item_type == 'library') {
            $library = $item;

            $settings = Setting::first();

            $soldier_profit_per_visit = $settings->library_visit_price;

            $soldier_profit = 0;
            $soldier_current_visits = $this->getSoldierLibraryTotalClicks();

            $soldier_current_profit = LibraryProfit::where('soldier_id', $this->user_id)
                ->sum('amount');


            $soldier_diff = $soldier_new_visits - $soldier_current_visits;

            if ($soldier_diff > 0) {
                $soldier_profit = $soldier_diff * $soldier_profit_per_visit;
            }

            Library::whereId($this->item_id)->update([
                'total_clicks' => $ad_new_total_clicks,
                'month_clicks' => $current_month_clicks
            ]);


            $where = [
                'user_id' => $this->user_id,
                'item_type' => 'library',
                'ad_id' => $this->item_id
            ];

            $exists = StatsSessionsSoldier::where($where)->exists();
            if ($exists) {
                StatsSessionsSoldier::where($where)->update(['visitors_number' => $soldier_new_visits]);
            } else {
                StatsSessionsSoldier::insert(array_merge($where, ['visitors_number' => $soldier_new_visits, 'created_at' => now(), 'updated_at' => now()]));
            }

//            if ($this->user->task_level > 0) {
            // this means complete his task 2
            if ($soldier_current_profit >= $settings->library_max_profit) {
                if ($this->user) {
                    $new_data = ['last_share' => 'library'];
//                    if ($this->user->task_level < 3) {
//                        $new_data['task_level'] = $this->user->task_level == 0 ? 1 : 2;
//                    }
                    $this->user->update($new_data);
//                        $this->user->update(['task_level' => 2]);
                }
            } else {
                if ($soldier_profit > 0) {
                    $library->libraryProfits()->create([
                        'profit_for' => 'soldier',
                        'soldier_id' => $this->user_id,
                        'amount' => $soldier_profit
                    ]);

                    $this->user->wallets()->create([
                        'amount' => $soldier_profit,
                        'reason_ar' => $soldier_diff . ' زيارة المكتبة رقم ' . $library->id,
                        'reason_en' => $soldier_diff . 'Visit to library number ' . $library->id
                    ]);
                }
            }
//            }
        }

        dispatch(new StoreCityStatisticsJob($this->filter, $this->user_id, $this->item_type, $this->item_id));
        dispatch(new StoreAgeStatisticsJob($this->filter, $this->user_id, $this->item_type, $this->item_id));
        dispatch(new StoreCountryStatisticsJob($this->filter, $this->user_id, $this->item_type, $this->item_id));
        dispatch(new StoreGenderStatisticsJob($this->filter, $this->user_id, $this->item_type, $this->item_id));
        dispatch(new StoreAudienceStatisticsJob($this->filter, $this->user_id, $this->item_type, $this->item_id));
        dispatch(new StoreTimeStatisticsJob($this->filter_without_utm, $this->user_id, $this->item_type, $this->item_id));
        dispatch(new StoreDevicesStatisticsJob($this->filter_without_utm, $this->user_id, $this->item_type, $this->item_id));
        dispatch(new StoreBrowserStatisticsJob($this->filter_without_utm, $this->user_id, $this->item_type, $this->item_id));
        dispatch(new StoreOperatingSystemStatisticsJob($this->filter_without_utm, $this->user_id, $this->item_type, $this->item_id));

    }


    protected function getSoldierAdTotalClicks()
    {
        return $this->user->statsSessionsSoldier()->whereItemType('ad')->whereAdId($this->item_id)->value('visitors_number');
    }

    public function getSoldierLibraryTotalClicks()
    {
        return \App\Models\StatsSessionsSoldier::where('user_id', $this->user_id)
            ->where('item_type', 'library')->where('ad_id', $this->item_id)->value('visitors_number');
    }

    public function getFirstObject(array $arr)
    {
        return head(head($arr));
    }

    public function getTotalClicks($filter)
    {
        $visitors = 0;
        $visitorResponse = app(Analytics::class)->performQuery(
            Period::days(365), 'ga:users,ga:sessions', ['filters' => $filter]);
        if (isset($visitorResponse['rows'])) {
            $visitors = $this->getFirstObject($visitorResponse['rows']);
        }
        return $visitors;
    }

    public function getCurrentMonthClicks($filter)
    {
        $today = Carbon::today()->format('d');
        $visitors = 0;
        $visitorResponse = app(Analytics::class)->performQuery(
            Period::days($today),
            'ga:users,ga:sessions',
            [
                'metrics' => 'ga:users',
                'filters' => $filter,
            ]
        );
        if (isset($visitorResponse['rows'])) {
            $visitors = $this->getFirstObject($visitorResponse['rows']);
        }
        return $visitors;
    }


}
