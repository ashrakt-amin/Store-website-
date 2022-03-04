<?php

namespace App\Http\Controllers;
use App\Models\Cart;


use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{

  
    public function index(){
        $carts =Cart::with('product')->where('id',$this->getCartId())
        ->orWhere('user_id',Auth::id())->get();
        $num =Cart::with('product')->Where('user_id',Auth::id())->sum('quantity');
        $price=$carts->sum(function($item){
           return $item->quantity * $item->product->price ;
        });
        $tax= .05;
        $total=$price + ($price * ($tax) );
        $categories = Category::with('parent','children')->get();

        return view('homepage.cart',compact('carts','categories','price','tax','total','num'));
    }
    
    public function store(Request $request){
        $request->validate([
            'product_id'=>'required|exists:products,id',
            'quantity'=>'int|min:1'
        ]);
       $cart = Cart::updateOrCreate(
            ['id'=>$this->getCartId(),'product_id'=>$request->post('product_id')],

            ['quantity'=>DB::raw('quantity +'. $request->post('quantity',1)),'user_id'=>Auth::id()]
   );  

   /*$cart = Cart::where([
       'id'=>$this->getCartId(),
       'product_id'=>$request->post('product_id')])
   ->first();

   if($cart){
    Cart::where(['id'=>$this->getCartId(),'product_id'=>$request->post('product_id')])
     ->update(['quantity' => $cart->quantity + $request->post('quantity',1)]);
   }else{
    $cart = Cart::create([
        'id'=>$this->getCartId(),
        'product_id'=>$request->post('product_id'),
        'quantity'=>$request->post('quantity',1),
        'user_id'=>Auth::id()
    ]);

   }*/
        $product= $cart->product->name;
        
        return redirect()->back()->with('status',"product $product added to cart");
    }
      
    public function update(Request $request){
        $request->validate([
        'quantity'=>['required','array']
        ]);
      $that =$this;
      foreach($request->post('quantity') as $product_id => $quantity ){
         Cart::where('product_id',$product_id)
                ->where(function($query)use($that){
                    $query->where('id','=', $that->getCartId())
                    ->orWhere('user_id','=', Auth::id());
                  })->update(['quantity'=> $quantity ]);
                }
     return redirect()->back()->with('status',"cart updated");

    }


    public function destroy(){
       Cart::where('id','=',$this->getCartId())
        ->orWhere('user_id', Auth::id())->delete();
       $cookie =Cookie::make("cart_id",'',-60);
        return redirect()->back()->with('status',"cart was deleted")->cookie($cookie);

        }
    public function getCartId(){
        $id = request()->cookie('cart_id');
        if(! $id){
         $id =Str::uuid();
         Cookie::make('cart_id' ,$id ,(60 * 24 * 7));
        }
        return $id ;
    }



   


    
}
