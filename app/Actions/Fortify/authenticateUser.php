<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authenticateUser
{
   
    public static function authenticate(Request $request)
    {
        $request->validate([
            config('fortify.user_name')=>'required',
            'password'=>'required',
        ]);

       /* 
       this in laravel to check and login together
       Auth::attempt([
           'username' => $request->post('username'),
           'password' => $request->post('password')
        ],true);
        */

        $username =$request->post('username');
        $password =$request->post('password');

        $user =User::where('user_name',$username)
        ->orWhere('email',$username)
        ->orWhere('phone',$username)->first();

       if($user && Hash::check($password ,$user->password)){
        return $user;
       /* Auth::login($user ,true);*/
        /* 'true' =>this mean make remmember tpken */
       }

       
    }

}   