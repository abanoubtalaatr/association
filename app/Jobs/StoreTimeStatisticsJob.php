<?php

namespace App\Jobs;

use App\Models\AdTime;
use App\Models\StatsCountry;
use Illuminate\Bus\Queueable;
use App\Models\StatsCountrySoldier;
use Illuminate\Queue\SerializesModels;
use App\Services\GoogleAnalyticsService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class StoreTimeStatisticsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $filter, $user_id, $item_type, $item_id;

    public function __construct($filter, $user_id, $item_type, $item_id)
    {
        $this->filter = $filter;
        $this->user_id = $user_id;
        $this->item_type = $item_type;
        $this->item_id = $item_id;
    }


    public function handle()
    {
        info('memory usage: ' . round(memory_get_usage(false) / 1024) . ' KB [' . __CLASS__ . ']');
        $time = GoogleAnalyticsService::getTimeForAd($this->filter);

        $exists = AdTime::where([
            'ad_id' => $this->item_id,
        ])->exists();


        if ($exists) {
            AdTime::where([
                'ad_id' => $this->item_id,
            ])->update(['time' => $time]);
        } else {
            AdTime::create([

                'ad_id' => $this->item_id,
                'time' => $time
            ]);
        }
    }
}
