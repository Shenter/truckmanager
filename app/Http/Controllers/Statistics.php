<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Statistics extends Controller
{
    //
    public function top()
    {
        $latestStat = DB::table('users_cash')->latest()->first()->created_at;


        $usersStat = DB::table('users_cash')->where(['created_at'=>$latestStat])->orderBy('sum','desc')->limit(20)->get();
        foreach ($usersStat as $stat)
        {
            $stat->name = User::where(['id'=>$stat->user_id])->first('name')->name;
        }
        $currentUsersCash =  DB::table('users_cash')->where(['created_at'=>$latestStat])->where(['user_id'=>Auth::user()->id])->first()->sum;
        $currentUsersPlace = DB::table('users_cash')->where(['created_at'=>$latestStat])->where('sum','>',$currentUsersCash)->count()+1;
        return view('top',['usersStat'=>$usersStat, 'currentUsersCash'=>$currentUsersCash,'currentUserPlace'=>$currentUsersPlace]);
    }
}
