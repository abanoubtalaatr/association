<?php

namespace App\Jobs;

use App\Models\AdDevices;
use App\Models\AdTime;
use App\Models\AdUser;
use App\Models\StatsCountry;
use Illuminate\Bus\Queueable;
use App\Models\StatsCountrySoldier;
use Illuminate\Queue\SerializesModels;
use App\Services\GoogleAnalyticsService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class StoreDevicesStatisticsJob implements ShouldQueue
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
        $google_data = GoogleAnalyticsService::getAdDevices($this->filter);

        //sync data (delete old data for ads)
        $oldData = AdDevices::where('ad_id', $this->item_id)->where('key', 'devices')->get();

        foreach ($oldData as $data) {
            $data->delete();
        }

        foreach ($google_data as $data) {
            AdDevices::create([
                'ad_id' => $this->item_id,
                'key' => $data['key'],
                'name' => $data['name'],
                'count' => $data['count'],
            ]);
        }
    }
}
