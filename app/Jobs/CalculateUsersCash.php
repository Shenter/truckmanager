<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CalculateUsersCash implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();
        logger('count '. count($users));
        $money=0;
        foreach ($users as $user) {


            $money+=$user->money;
            DB::table('users_cash')->insert([
                'created_at'=>date('Y-m-d H:i:s', time()),
                'updated_at'=>date('Y-m-d H:i:s', time()),
                'user_id' => $user->id,
                'sum' => $money,
            ]);
        }
    }
}
