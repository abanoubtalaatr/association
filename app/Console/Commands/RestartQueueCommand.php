<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RestartQueueCommand extends Command{
    protected $signature = 'my-queue:restart';
    protected $description = 'Stops the queue worker, and start it again';


    public function __construct(){
        parent::__construct();
    }

    public function handle(){
        info('queue restarted at: '.now());
        Artisan::call('queue:restart');
        Artisan::call('queue:work --max-time=600');
        return 0;
    }
}
