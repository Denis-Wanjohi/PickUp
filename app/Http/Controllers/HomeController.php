<?php

namespace App\Http\Controllers;

use App\Http\Resources\HomeResource;
use App\Models\orders;
use App\Models\Packages;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rides = Ride::where('user_id',Auth::user()->id)->get();
        $shopping = orders::where('user_id',Auth::user()->id)->get();
        $packages = Packages::where('user_id',Auth::user()->id)->get();

        return response([
            'rides' => $rides,
            'shopping' => $shopping,
            'packages' => $packages,
            'user' => User::where('id',Auth::user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
