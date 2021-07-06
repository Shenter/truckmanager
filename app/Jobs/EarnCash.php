<?php

namespace App\Jobs;

use App\Models\Driver;
use App\Models\Order;
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
        $jobs = Order::where('is_active',true)->where('ends_at','<=',date('Y-m-d H:i:s'))->get();
        foreach ($jobs as $job) {
        logger('found finished job');
        $driver= Driver::find($job->driver_id);
        $user = User::find($driver->user_id);
            $user->money+=$job->cost;
            $user->save();
            $job->is_active = false;
//            DB::table('work_jobs')->where('id','=',$job->id)->update(['is_active'=>false]);
            $job->save();
            $driver->job_id=0;
            $driver->save();
        }
        //Все водители без работы, с гаражом и грузовиком выходят на работу
        $drivers = Driver::where('job_id','=',0)->get();
        foreach ($drivers as $driver) {

            if($driver->truck!=null && $driver->truck->garage!=null)
            {
                    if($driver->searches_a_job) {
                        if (rand(1, 200) < $driver->character->age) {
                            $jobName = array(
                                'Песок', 'Щебень', 'Запчасти', 'Холодный квас', 'Стекло', 'Молоко', 'Зеркала', 'Доски', 'Бетон', 'Документы', 'Косметика', 'Компьютеры'
                            );
                            $random = $jobName[array_rand($jobName)];
                            $name = $random;
                            $duration = rand(200, 1000);
                            $cost = round($duration *  ($driver->truck->type/1.5)  *25);
                            $job = new Order([ 'driver_id' => $driver->id,
                                'user_id'=>$driver->user_id,
                                'ends_at' => date('Y-m-d H:i:00', time() + $duration),
                                'name' => $name,
                                'cost' => $cost]);
                            $job->save();
//                                DB::table('work_jobs')->insertGetId([
//                                'driver_id' => $driver->id,
//                                'user_id'=>$driver->user_id,
//                                'ends_at' => date('Y-m-d H:i:00', time() + $duration),
//                                'name' => $name,
//                                'cost' => $cost,
//                            ]);
                            $driver->job_id = $job->id;
                            $driver->save();
                        }
                    }
                    else
                    {
                        if(rand(1,10)<3)
                        {
                            $driver->searches_a_job = true;
                            $driver->save();
                        }
                    }
            }
        }
        //В таблицу работ проставляем сумму и время окончания поездки


        //
    }
}
