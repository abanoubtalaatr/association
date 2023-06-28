<?php

namespace App\Jobs;
use App\Models\StatsAudience;
use Illuminate\Bus\Queueable;
use App\Models\StatsAudienceSoldier;
use Illuminate\Queue\SerializesModels;
use App\Services\GoogleAnalyticsService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class StoreAudienceStatisticsJob implements ShouldQueue{
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
        $google_data = GoogleAnalyticsService::getTargetedAudience($this->filter);
        $related_model = app(StatsAudience::class);
        foreach ($google_data as $data) {
            $value = ['value' => $data['value']];

            $record = $related_model->firstorCreate($value);
            $exists = StatsAudienceSoldier::where([
                'user_id'=>$this->user_id,
                'item_type'=>$this->item_type,
                'item_id'=>$this->item_id,
                'audience_id'=>$record->id
            ])->exists();


            if ($exists) {
                StatsAudienceSoldier::where([
                'user_id'=>$this->user_id,
                'item_type'=>$this->item_type,
                'item_id'=>$this->item_id,
                'audience_id'=>$record->id
                ])->update(['visitors_number'=>$data['visitors_number']]);
            }else{
                StatsAudienceSoldier::create([
                    'audience_id'=>$record->id,
                    'user_id'=>$this->user_id,
                    'visitors_number'=>$data['visitors_number'],
                    'item_id'=>$this->item_id,
                    'item_type'=>$this->item_type
                ]);
            }
        }
    }


}
