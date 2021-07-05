<?php


namespace App\Http\Classes;


use Illuminate\Support\Facades\Auth;

class GarageHelper
{


    public function improve()
    {
        $user = Auth::user();
    }
}
