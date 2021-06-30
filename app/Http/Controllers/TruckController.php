<?php

namespace App\Http\Controllers;

use App\Http\Classes\UserHelper;
use App\Models\Garage;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TruckController extends Controller
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
        $user = Auth::user();
        $trucks = $user->trucks;

        return view('trucksshow',['trucks'=>$trucks,'userCanBuyTruck'=>$this->userHelper->isEnoughMoneyToBuyFirstLevelTruck()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('truckscreate',[
            'isEnoughMoneyToBuyFirstLevelTruck'=>$this->userHelper->isEnoughMoneyToBuyFirstLevelTruck(),
            'isEnoughMoneyToBuySecondLevelTruck'=>$this->userHelper->isEnoughMoneyToBuySecondLevelTruck(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO Нужна проверка данных
        $truck = new Truck(['user_id'=>Auth::user()->id]);
        $truck->type = $request->type;
        $truck->save();
        $user = Auth::user();
        if($request->type=='1')
        {
            $cost = config('trucks.first_level_cost');
        }
        else
        {
            $cost = config('trucks.second_level_cost');
        }
        $user->money-=$cost;
        $user->save();
        return redirect(route('trucks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        //
        return view('truckshow',['truck'=>$truck]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit(Truck $truck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truck $truck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Truck $truck)
    {
        //
    }


    public function changeGarage(Request $request)
    {//TODO валидация
    $truck = Truck::findorfail($request->truck_id);
    $truck->garage_id = $request->garage_id;
    $truck->save();
    return redirect(route('truck.show',['truck'=>$request->truck_id]));
    }
}
