<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function show()
    {

        return view('orders',['orders'=>Order::where(['user_id'=>Auth::user()->id])->latest() ->paginate() ]) ;
    }
}
