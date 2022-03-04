<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Events\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store (Request $request){
        $user_id=$request->user()->id;
        $carts =Cart::with('product')->where('user_id',Auth::id())
        ->get();
         
        

        if(!$carts){
            return redirect()->route('checkout.store');
        }

        $price = $carts->sum(function($item){
          return $item->product->price * $item->quantity ;
        });
        $tax= .05;
        $total=$price + ($price * ($tax) );
        DB::beginTransaction();
        try{
         foreach($carts as $item){
        $order =Order::with('products')->create([
        'user_id'=> $user_id,
        'status'=>"shiped" ,
        'total'=>$total ,
        'price'=>$item->price
        
        ]);
    
    }
     Cart::where('user_id',Auth::id())
        ->orWhere('id' , $request->cookie('cart_id'))->delete();
        
    // if code in try is correct  DB::commit(); stop */

    DB::commit();
    event(new OrderCreated($order));

return redirect()->back()->with('transaction',"order created" );

    // if code in try is not correct go to catch
}catch(Throwable $e){
  
    DB::rollBack();
    

return redirect()->back()->with('transaction',"there are some errors" /*$e->getMessage()*/);
    
}
}
}
