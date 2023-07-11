<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::chunk(100,function($users){
            \Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/database.log'),
              ])->info("---------------------user data----------------------");
            foreach($users as $user){
                \Log::build([
                    'driver' => 'single',
                    'path' => storage_path('logs/database.log'),
                  ])->info($user);
            }   
        });

        // $this->getData(1000);
     }

     public function getData($numberOfData){
        $pages=$numberOfData/100;
        for($i=0; $i<$pages; $i++){
            $offsite=$i*100;
            \Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/database.log'),
            ])->info("form $offsite row");
            $users=DB::table('users')->limit(100)->offset($offsite)->get();
           foreach($users as $user){
                \Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/database.log'),
                ])->info("user $user->name email $user->email");
            }
        }
     }
}
