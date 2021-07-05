<?php

namespace App\Jobs;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class EarnCash implements ShouldQueue
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
        logger('handle');

        //Все работы, время окончания которых меньше, чем текущее, становятся выполненными и за них начисляются деньги
        $jobs = DB::table('work_jobs')->where('is_active',true)->where('ends_at','<=',date('Y-m-d H:i:s'))->get();
        foreach ($jobs as $job) {
logger('found finished job');
$driver= Driver::find($job->driver_id);
$user = User::find($driver->user_id);
            $user->money+=$job->cost;
            $user->save();
            DB::table('work_jobs')->where('id','=',$job->id)->update(['is_active'=>false]);
//            $job->is_active = false;
//            $job->save();
            $driver->job_id=0;
            $driver->save();
        }
        //Все водители без работы и с грузовиком выходят на работу (можно добавить вероятность выхода в зависмости от скилла)
        $drivers = Driver::where('job_id','=',0)->get();
        foreach ($drivers as $driver) {
            if($driver->truck!=null)
            {
                    if($driver->searches_a_job) {
                        if (rand(1, 10) < 3) {
                            $jobname = array(
                                'Песок', 'Щебень', 'Запчасти', 'Холодный квас', 'Стекло', 'Молоко', 'Зеркала', 'Доски', 'Бетон', 'Документы', 'Косметика'
                            );
                            $random = $jobname[array_rand($jobname)];

                            $name = $random;
                            $duration = rand(500, 5000);
                            $cost = round($duration / 2*($driver->truck->type/1.5));
                            $jobID = DB::table('work_jobs')->insertGetId([
                                'driver_id' => $driver->id,
                                'ends_at' => date('Y-m-d H:i:00', time() + $duration),
                                'name' => $name,
                                'cost' => $cost,
                            ]);
                            $driver->job_id = $jobID;
                            $driver->save();
                        }
                    }
                    else
                    {
                        if(rand(1,10)<5)
                        {
                            $driver->searches_a_job=true;
                            $driver->save();
                        }
                    }
            }
        }
        //В таблицу работ проставляем сумму и время окончания поездки


        //
    }
}
