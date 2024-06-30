<?php

namespace App\Http\Controllers;

use App\Models\MpesaTransaction;
use App\Models\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackagesController extends Controller
{
    public function create(Request $request){
        // throw new \Exception($request);
        $data = $request->validate([
            'location' => 'required|string',
            'destination' => 'required|string',
            'weight' => 'required|string',
            'time' => 'required|string',
        ]);
        $data['user_id'] = Auth::user()->id;
        $rider = [
            'name'=>'Martin Kimani',
            'username'=>'Marto',
            'loaction'=>'kinoru',
            'price'=>'100',
        ];
        $rider['response'] = 'available';
        $res = Packages::create($data);
        $package = Packages::where('user_id',Auth::user()->id)->latest()->get()[0];

        return response([
         'response' => $res,
          'package' => $package,
          'rider'=> $rider
        ]);
    }

    public function packageConfirmation(Request $request){
        if($request->data == 1){
            $data['confirmed'] = true;
        }elseif($request->data  == 0){
            $data['confirmed'] = false;
        }
        // throw new \Exception( $request->rider['data']['username']);
        $data['rider'] = $request->rider['data']['username'];
        $data['price'] =  $request->rider['data']['price'];
        Packages::where('user_id',auth()->user()->id)->latest()->get()[0]->update($data);
        return response([
            'package' => Packages::where('user_id',auth()->user()->id)->latest()->get()[0]
        ]);
    }
    public function packageNumber(Request $request){
        // throw new \Exception('one');
        $data['user_id'] = Auth::user()->id;
        $data['table'] = 'packages';
        $data['table_id'] = Packages::where('user_id',Auth::user()->id)->latest()->get()[0]->id;
        $data['number'] = $request->data['number'];

        MpesaTransaction::create($data);

        return response([
            'data' => MpesaTransaction::where('user_id',Auth::user()->id)->latest()->get()[0]
        ]);
    }
    public function packageMpesaCode(Request $request){
        $data['transactionCode'] = $request->data['confirmationCode'];
        MpesaTransaction::where('user_id',Auth::user()->id)->latest()->get()[0]->update($data);
         return response([
            'data' => MpesaTransaction::where('user_id',Auth::user()->id)->latest()->get()[0]
        ]);

    }
}
