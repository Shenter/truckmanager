<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function (){
//    Route::get('drivers','App')
    Route::resource('drivers','App\Http\Controllers\DriverController', ['names'=>
            ['index'=>'drivers.index',
            'create'=>''
            ]
            ]);
    Route::resource('garages','App\Http\Controllers\GarageController', ['names'=>
        ['index'=>'garages.index',
        'create'=>'garages.create',
        'store'=>'garages.store',
        ]
    ]);


    Route::resource('trucks','App\Http\Controllers\TruckController', ['names'=>
        ['index'=>'trucks.index',
            'create'=>'trucks.create',
            'store'=>'trucks.store',
            'show' =>'truck.show',
        ]
    ]);

});
Route::middleware(['auth'])->group(function (){
    Route::post('changeGarage','App\Http\Controllers\TruckController@changeGarage')->name('changeGarage');
    Route::get('hire','App\Http\Controllers\DriverController@hireCharacter')->name('hireCharacter');
    Route::post('hire','App\Http\Controllers\DriverController@confirmHireCharacter')->name('confirmHireCharacter');
    Route::post('assignTruckToDriver','App\Http\Controllers\DriverController@assignTruckToDriver')->name('assignTruckToDriver');
});

Route::get('seed',function (){
   $response = \Illuminate\Support\Facades\Http::get('https://randomuser.me/api/?nat=us,fr,gb&results=100');
   $result1 = json_decode($response->body());
    foreach ($result1 as $result) {
   foreach ($result as $item)
   {

       $picture = $item->picture->medium;

       $expname = explode ("/", $picture);
       $lastV =  end($expname);
//       $lastV =  pos($expname);
        $file = \Illuminate\Support\Facades\Http::get($picture);
        \Illuminate\Support\Facades\Storage::put($lastV,$file);

       \Illuminate\Support\Facades\DB::table('characters')->insert(['id'=>null, 'name'=>$item->name->first.' '.$item->name->last, 'age'=>$item->dob->age,'avatar'=>$lastV]);
   }
   die();
    }
});



require __DIR__.'/auth.php';
