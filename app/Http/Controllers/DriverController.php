<?php

namespace App\Http\Controllers;

use App\Http\Classes\UserHelper;
use App\Models\Character;
use App\Models\Driver;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DriverController extends Controller
{

    public $userHelper;
    public function __construct()
    {
        $this->userHelper = new UserHelper();


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('driversShow',['drivers'=>Auth::user()->drivers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function hireCharacter()
    {

        return view('hireCharacter',['characters'=>Character::all()]);

    }



    public function assignTruckToDriver(Request $request)
    {//TODO Добавить проверку, наш ли это сотрудник и грузовик+свободны ли они
        $driver = Driver::findorfail($request->driver_id);
        $driver->truck_id = $request->truck_id;
        $driver->save();
        $user = Auth::user();
        $trucks = $user->trucks;
        return back(302);
            //view('trucksshow',['trucks'=>$trucks,'userCanBuyTruck'=>$this->userHelper->isEnoughMoneyToBuyFirstLevelTruck()]);
    }
    public function confirmHireCharacter(Request $request)
    {
//TODO тут наверное должна быть проверка наличия машины и её свободности
//        dd($request->character_id);
        if($request->truck_id==null)
            return back()->withErrors('You do not have trux');
        $driver = new Driver(['user_id'=>Auth::user()->id,'character_id'=>$request->character_id,'truck_id'=>$request->truck_id]);
        $driver->save();
        return redirect(route('drivers.index'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
