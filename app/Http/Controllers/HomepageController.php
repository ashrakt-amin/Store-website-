<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function header(){
        $categories = Category::with('parent','children')->get();
        $num =Cart::with('product')->Where('user_id',Auth::id())->sum('quantity');
       

        return view('homepage.header',compact('categories','num'));

    }

    public function getProducts(){
        $categories = Category::with('parent','children')->get();
        $products =Product::with('category','user');
        $request = request();
        $num =Cart::with('product')->Where('user_id',Auth::id())->sum('quantity');

        if($request->query('name')){
            $products->where('products.name',"like",$request->query('name'));
        }
        return view('homepage.products',
        ['products'=>$products->paginate(),'categories'=>$categories,'request'=>$request,'num'=>$num]);


    }
}
