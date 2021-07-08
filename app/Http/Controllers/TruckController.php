<?php

namespace App\Http\Controllers;

use App\Http\Classes\UserHelper;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Http\Classes\DataPreparer;

class TruckController extends Controller
{
    public $userHelper;
    public $dataPreparer;
    public function __construct()
    {
        $this->userHelper = new UserHelper();
        $this->dataPreparer = new DataPreparer();
    }





    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $user = Auth::user();
        $trucks =$this->dataPreparer->paginate( $user->trucks, 10, null, route('trucks.index'));

        return view('trucksshow',['trucks'=>$trucks,'userCanBuyTruck'=>$this->userHelper->isEnoughMoneyToBuyFirstLevelTruck()]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create():View
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
     *
     */
    public function store(Request $request)
    {
        //TODO Нужна проверка данных
        $user = Auth::user();
        $truck = new Truck(['user_id'=>Auth::user()->id]);
        $truck->type = $request->type;
        $truck->name = $request->truck_name;
        $truck->garage_id = $request->garage_id;
        $truck->user_id = $user->id;
        $truck->save();

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
     * @return View
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
        if ($truck->user_id!=Auth::user()->id)
        {
            return back()->withErrors(['message'=>'This truck is not yours']);
        }
        if($truck->level==1)
        {
            Auth::user()->addMoney(config('trucks.first_level_sell_price'));
        }
        else
        {
            Auth::user()->addMoney(config('trucks.second_level_sell_price'));
        }
        if($truck->driver!=null)
        {
            DB::table('work_jobs')->where(['is_active'=>true,'driver_id'=>$truck->driver->id])->update(['is_active'=>false]);
            $truck->driver->truck_id = 0;
            $truck->driver->save();
        }
        $truck->delete();
        return redirect(route('trucks.index'))->with(['success'=>'Грузовик продан!']);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     */
    public function changeGarage(Request $request)
    {//TODO валидация
    $truck = Truck::findorfail($request->truck_id);
    $truck->garage_id = $request->garage_id;
    $truck->save();
    return redirect(route('trucks.index'));
    }
}
