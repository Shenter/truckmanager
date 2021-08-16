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

Route::get('/dashboard', 'App\Http\Controllers\DashBoardController@show')->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function (){
//    Route::get('drivers','App')
    Route::resource('drivers','App\Http\Controllers\DriverController', ['names'=>
            ['index'=>'drivers.index',
            'create'=>'drivers.create',
            'show'=>'drivers.show'
            ]
            ]);
    Route::resource('garages','App\Http\Controllers\GarageController', ['names'=>
        ['index'=>'garages.index',
        'create'=>'garages.create',
        'store'=>'garages.store',
        'destroy'=>'garages.destroy',
        ]
    ]);
    Route::prefix('garages')->group(function (){
        Route::post('{garage}/upgrade','App\Http\Controllers\GarageController@upgrade')->name('upgradeGarage');
    });



    Route::resource('trucks','App\Http\Controllers\TruckController', ['names'=>
        ['index'=>'trucks.index',
            'create'=>'trucks.create',
            'store'=>'trucks.store',
            'show' =>'truck.show',
            'destroy'=>'truck.destroy',
        ]
    ]);

});
Route::middleware(['auth'])->group(function (){
    Route::post('changeGarage','App\Http\Controllers\TruckController@changeGarage')->name('changeGarage');
    Route::get('hire','App\Http\Controllers\DriverController@hireCharacter')->name('hireCharacter');
    Route::post('hire','App\Http\Controllers\DriverController@confirmHireCharacter')->name('confirmHireCharacter');
    Route::post('assignTruckToDriver','App\Http\Controllers\DriverController@assignTruckToDriver')->name('assignTruckToDriver');
    Route::post('assignTruckToGarage','App\Http\Controllers\TruckController@assignTruckToGarage')->name('assignTruckToGarage');
    Route::get('orders','App\Http\Controllers\OrdersController@show')->name('orders');
    Route::get('top','App\Http\Controllers\Statistics@top')->name('top');
});

require __DIR__.'/auth.php';
