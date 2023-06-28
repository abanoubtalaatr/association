<?php

namespace App\Console\Commands;

use App\Models\PaybackRequest;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Console\Command;

class PaySoldierCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'soldier:pay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a request to admin, to pay a soldier.';


    public function __construct(){
        parent::__construct();
    }


    public function handle(){
        info('pay soldier ran at: '.now());
        $soldiers = User::whereUserType('soldier')
                        ->whereHas('wallets',function($query){
                            return $query->whereNull('payback_request_id');
                        })->withSum('notPaidWallets','amount')->get()->filter(function($item){
                            return $item->not_paid_wallets_sum_amount> Setting::whereId(1)->value('minimum_payback_amount');
                        });

        foreach($soldiers as $soldier){
            $data = [
                'amount'=>$soldier->not_paid_wallets_sum_amount,
                'status'=>'not_paid'
            ];

            $request = $soldier->paybackRequests()->create($data);
            $soldier->wallets()->whereNull('payback_request_id')->update(['payback_request_id'=>$request->id]);

        }
    }
}
