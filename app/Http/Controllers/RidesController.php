<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use AfricasTalking\SDK\AfricasTalking;

class RidesController extends Controller
{


    //messages auth



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validation = $request->validate([
            'currentLocation'=>'required|string',
            'destination'=>'required|string',
            'pickupTime'=>'required',
            'rider'=>'required'
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['location'] = $validation['currentLocation'];
        $data['destination'] = $validation['destination'];
        $data['time'] = $validation['pickupTime'];
        $data['rider'] = $validation['rider'];

    
        Ride::create($data);
        return response([
            'details' => Ride::where('user_id',Auth::user()->id)->latest()->get()[0]
        ],200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = Ride::where('user_id',Auth::user()->id)->latest()->get()[0];
        $data['confirmed'] = $request->data;
        $res = Ride::where('user_id',Auth::user()->id)->latest()->get()[0]->update($data);
        $ride  = Ride::where('user_id',Auth::user()->id)->latest()->get()[0];
        $username   = "pickMe";
        $apiKey     = "atsk_7d5fe9c5e872034c75ef71ce0eecda6b9e6a058edb877461ae541f412b41996c231a7a53";
        $AT = new AfricasTalking($username, $apiKey);
        $sms        = $AT->sms();
        $recipients = "0756634930";
        $message = "Hello am ".explode(' ',auth()->user()["name"])[0]."\n am requesting ride services \n Location: ".$ride["location"]." \n Destination: ".$ride["destination"]." \nPick me at  ".$ride["time"];
        // try {
        //     $result = $sms->send([
        //       'to'      => $recipients,
        //     'message' => $message,
        //  ]);
        // $result = "one";
        // } catch (\Exception $e) {
        //     return response()->json(['error'=>$e->getMessage()],500);
        // }

        return response([
            'confirmation' => $res,
            'ride' => $ride,
            'message' => $message
        ],200);
    }
    /**
     * completing the the whole  ride transactions
     */
    public function completion(Request $request){
        $data['rider'] = $request->rider;
        $data['paid'] = $request->paid;
        $data['price'] = $request->price;
        if($request->continue == true){
            $res = Ride::where('user_id',Auth::user()->id)->latest()->get()[0]->update($data);
            $ride  = Ride::where('user_id',Auth::user()->id)->latest()->get()[0];



        }elseif($request->continue == false){
            $res = Ride::where('user_id',Auth::user()->id)->latest()->get()[0]->delete();
            $data['id']= '';
            $data['user_id']= '';
            $data['location']= '';
            $data['destination']= '';
            $data['time']= '';
            $data['rider']= '';
            $data['price']= '';
            $data['confirmed']= '';
            $data['paid']= '';
            $data['created_at']= '';
            $data['updated_at']= '';
            $ride  = $data;
        }
        return response([
            'confirmation' => $res,
            'ride' => $ride,

        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
