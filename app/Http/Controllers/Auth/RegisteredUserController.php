<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
    
            $validator = Validator::make($request->all(),[
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required','min:8', 'confirmed', Rules\Password::defaults()],
                'phone' => 'required',
            ]);

            if($validator->fails()){
                return response(['error' => $validator->messages()],422);
            }else{
                $validated = $validator->validate();
        
        
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->string('password')),
                    'phone' =>$request->phone,
                    'isAdmin' => false
                ]);
        
                // event(new Registered($user));
        
                Auth::login($user);
                
                return response([
                    'user'=>$user,
                    'token' => $user->createToken('Auth')->plainTextToken
                ],200);
            }

;
       
    }
}
