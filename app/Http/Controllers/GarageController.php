<?php

namespace App\Http\Controllers;

use App\Http\Classes\UserHelper;
use App\Models\Garage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GarageController extends Controller
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
        $garages = Garage::where(['user_id'=>$user->id])->get();

        return view('garagesshow',['garages'=>$garages,'userCanBuyGarage'=>$this->userHelper->isEnoughMoneyToBuyGarage()]);
    //    return ( Garage::where(['user_id'=>$user->id])->get()->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('garagescreate');

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

        $garage = new Garage(['user_id'=>Auth::user()->id]);
        $cities = array(
            'Вирджиния-Бич','Вишакхапатнам','Владивосток','Владимир','Волгоград','Воркута','Воронеж','Вроцлав','Егорьевск','Ейск','Екатеринбург','Елабуга','Елгава','Елец','Кабул','Казань','Каир','Калькутта','Карачи','Кейптаун','Киев','Кинг-Эдуард-Пойнт','Елизово','Оклахома','Окленд','Олимпия','Таллин','Талса','Таоюань','Ташкент','Тебриз','Тегеран','Токио','Тольятти','Омск','Оран','Орду','Оренбург'
        );
        $random = $cities[array_rand($cities)];
        $garage->name = 'Гараж в г. '.$random;

        $garage->save();
        Auth::user()->pay(config('garages.first_level_cost'));
        return redirect(route('garages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function show(Garage $garage)
    {
        return view('garageshow',['garage'=>$garage]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function edit(Garage $garage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Garage $garage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Garage $garage)
    {
        if ($garage->user_id!=Auth::user()->id)
        {
            return back()->withErrors(['message'=>'This garage is not yours']);
        }
        if($garage->level==3)
        {
            Auth::user()->addMoney(config('garages.first_level_sell_price'));
        }
        else
        {
            Auth::user()->addMoney(config('garages.second_level_sell_price'));
        }
        foreach ($garage->trucks as $truck)
        {
            DB::table('work_jobs')->where(['is_active'=>true,'driver_id'=>$truck->driver->id])->update(['is_active'=>false]);
        }
        $garage->delete();
        return redirect(route('garages.index'))->with(['success'=>'Гараж продан!']);
    }




    public function upgrade(Garage $garage)
    {
        if(!$this->userHelper->isEnoughMoneyToUpdateGarage())
        {
            return back()->withErrors(['message'=>'You do not have enough money']);
        }
        if($garage->level!=3)
        {
            return back()->withErrors(['message'=>'Garage level is alreagy 5']);
        }
        Auth::user()->pay(config('garages.second_level_cost'));
        $garage->level = 5;
        $garage->save();
        return back()->with('success','upgraded');

    }
}
