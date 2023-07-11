<?php

namespace App\Console\Commands;


use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Jobs\GetEmail;

class EmailLoging extends Command 
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    //  use Queueable;

    protected $signature = 'emailLoging';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get email and add to log file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $job=new GetEmail();
        // $job->onQueue('email');
        // dispatch($job);
        $job->onConnection('database')->onQueue('email')->dispatch();
        $this->info("done");    }
}
