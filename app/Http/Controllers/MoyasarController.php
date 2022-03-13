<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class MoyasarController extends Controller
{
    public function index($id){

       //$user =Order::with('user')->get;
       $carts =Cart::with('product')->where('id',$this->getCartId())
        ->orWhere('user_id',Auth::id())->get();
        $order=Order::with('user')->findorFail($id);
               // $order =Order::Where('user_id',Auth::id())->Where('status','shiped')->first();

        $num =Cart::with('product')->Where('user_id',Auth::id())->sum('quantity');
       
        $categories = Category::with('parent','children')->get();

        return view('homepage.moyasar',compact('categories','num','carts','order'));
    }
    

    public function getCartId(){
        $id = request()->cookie('cart_id');
        if(! $id){
         $id =Str::uuid();
         Cookie::make('cart_id' ,$id ,(60 * 24 * 7));
        }
        return $id ;
    }

    public function callback (Order $order){
       $id = request()->query('id');
       $token =base64_encode(config('services.moyasar.secret') .':' );
       $payment = Http::baseUrl('https://api.moyasar.com/v1')
       //->withHeaders(['authorizarion' => "Basic {$token}"]) // to send basic authorization
       ->withBasicAuth(config('services.moyasar.secret') , '' )
       ->get("payments/{$id}")
       ->json();
       
     if($payment['status'] == 'paid'){
        Http::baseUrl('https://api.moyasar.com/v1')
        ->withHeaders(['authorizarion' => "Basic{$token}"]) 
        ->post("payments/{$id}")
        ->json();
           
        if(isset($payment['type']) && $payment['type'] == 'invalid_request_error'){
            return redirect()->route('homepage.orders')->with('error',$payment['message']);
        }
     
      
          /*  $order->status ='paid';
            $order->save();*/
          

        }

       return redirect()->route('homepage.orders')->with('status','order paid');

    
}
}
