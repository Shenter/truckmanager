<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\DataPreparer;

class DashBoardController extends Controller
{

    public function show()
    {
        $data = DataPreparer::prepareUserCash();
        return view ('dashboard',['dates'=>$data['dates'],'values'=>$data['values']]);
    }
}
