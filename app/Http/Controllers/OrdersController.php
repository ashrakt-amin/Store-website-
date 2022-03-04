<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index(){
        $user_id =Auth::id();
        $orders = Order::with('products')->where('user_id',$user_id)->get();
        $categories = Category::with('parent','children')->get();
        $num =Cart::with('product')->Where('user_id',Auth::id())->sum('quantity');


        return view('homepage.orders',compact('orders','categories','num'));

        //dd($orders);
    }
    public function store(){
        $orders = Order::create([]);
        $orders->products()->sync();
    }
}
