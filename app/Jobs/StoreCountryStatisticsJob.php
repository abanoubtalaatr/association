<?php

namespace App\Jobs;
use App\Models\StatsCountry;
use Illuminate\Bus\Queueable;
use App\Models\StatsCountrySoldier;
use Illuminate\Queue\SerializesModels;
use App\Services\GoogleAnalyticsService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class StoreCountryStatisticsJob implements ShouldQueue{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $filter, $user_id, $item_type, $item_id;
    public function __construct($filter, $user_id, $item_type, $item_id){
        $this->filter = $filter;
        $this->user_id = $user_id;
        $this->item_type=$item_type;
        $this->item_id = $item_id;
    }


    public function handle(){
        info('memory usage: '. round(memory_get_usage(false) / 1024) . ' KB ['.__CLASS__.']');
        $google_data = GoogleAnalyticsService::getCountries($this->filter);
        $related_model = app(StatsCountry::class);
        foreach ($google_data as $data) {
            $value = ['value' => $data['value']];

            $record = $related_model->firstorCreate($value);
            $exists = StatsCountrySoldier::where([
                'user_id'=>$this->user_id,
                'item_type'=>$this->item_type,
                'item_id'=>$this->item_id,
                'country_id'=>$record->id
            ])->exists();


            if ($exists) {
                StatsCountrySoldier::where([
                'user_id'=>$this->user_id,
                'item_type'=>$this->item_type,
                'item_id'=>$this->item_id,
                'country_id'=>$record->id
                ])->update(['visitors_number'=>$data['visitors_number']]);
            }else{
                StatsCountrySoldier::create([
                    'country_id'=>$record->id,
                    'user_id'=>$this->user_id,
                    'visitors_number'=>$data['visitors_number'],
                    'item_id'=>$this->item_id,
                    'item_type'=>$this->item_type
                ]);
            }
        }
    }


}
