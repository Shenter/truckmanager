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

});



require __DIR__.'/auth.php';
