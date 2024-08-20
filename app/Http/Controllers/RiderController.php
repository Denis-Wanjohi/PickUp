<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    // REGISTER A RIDER
    public function register(Request $request){
        $rider =  $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'username' => 'required|string',
            'age' => 'required',
            'email' => 'required|email',
            'bike' => 'required|string',
            'station' => 'required|string',
            'phone' => 'required',
        ]);
        Rider::create($rider);
        return response([
            'data'=> 'success'
        ],200);
    }
}
