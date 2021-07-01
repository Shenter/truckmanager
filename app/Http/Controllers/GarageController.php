<?php

namespace App\Http\Controllers;

use App\Http\Classes\UserHelper;
use App\Models\Garage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $user->money-=config('garages.first_level_cost');
        $user->save();
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
        //
    }
}
