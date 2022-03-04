<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use function Livewire\str;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(request $request){
        $request->validate([
              'email'=>'required',
              'password'=>'required',
              'device'=>'nullable'
        ]);
       $user = User::where('email',$request->post('email'))->first();
       if($user && Hash::check($request->post('password'),$user->password) ){
            /* $token = Str::random(46);
             $user->api_token =$token;
             $user->save();*/
             $device = $request->post('device' ,$request->header('user-agent'));
             $token = $user->createToken($device);

             return [
                 'code'=> 1,
                 'token'=> $token->plainTextToken
             ];
       }else{
           return response()->json([
                'code' => 0 ,
                'message' => 'invalid email or password' ,
                ],401);
       }
    }

    public function logout(){
        $user = Auth::guard('sanctum')->user();
        $user = User::where('id', $user->id);
        $user->currentAccessToken()->delete();


        return [
            'code' => 1,
            'message' => 'token deleted' ,
        ];
    }
}
