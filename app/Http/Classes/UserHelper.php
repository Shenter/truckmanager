<?php


namespace App\Http\Classes;


use Illuminate\Support\Facades\Auth;

class UserHelper
{

    public function isEnoughMoneyToBuyGarage()
    {
        return Auth::user()->money >=config('garages.first_level_cost');
    }
    public function isEnoughMoneyToUpdateGarage()
    {
        return Auth::user()->money >=config('garages.second_level_cost');
    }
    public function isEnoughMoneyToBuyFirstLevelTruck()
    {
        return Auth::user()->money >=config('trucks.first_level_cost');
    }
    public function isEnoughMoneyToBuySecondLevelTruck()
    {
        return Auth::user()->money >=config('trucks.first_level_cost');
    }
    public function pay($sum)
    {
        $user = Auth::user();
        $user->money -= $sum*100;
        $user->save();
    }


}
