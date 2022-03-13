<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class HomepageController extends Controller
{
    public function header(){
       
        $categories = Category::with('parent','children')->paginate();
        $num =Cart::with('product')->Where('user_id',Auth::id())->sum('quantity');
        $carts =Cart::with('product')->where('id',$this->getCartId())
        ->orWhere('user_id',Auth::id())->get();
        
       return view('homepage.header',['categories'=>$categories,'carts'=>$carts,'num'=>$num]);

    }

    public function getProducts(){
        $allcategories = Category::with('parent','children')->get();

        $categories = Category::with('parent','children')->get();
        $products =Product::with('category','user');
        $request = request();
        $num =Cart::with('product')->Where('user_id',Auth::id())->sum('quantity');

        if($request->query('name')){
            $products->where('products.name',"like",$request->query('name'));
        }
               //scopeFeatured => local scope 

        return view('homepage.products',
        ['products'=>$products->Featured()->paginate(),'categories'=>$categories,'allcategories'=>$allcategories,'request'=>$request,'num'=>$num]);


    }


    public function productsOfCategory($id){

        $categories = Category::findOrFail($id)->get();
       

        $products =Product::with('category','user')->where('category_id',$id);

        $num =Cart::with('product')->Where('user_id',Auth::id())->sum('quantity');
        $request = request();
        if($request->query('name')){
            $products->where('products.name',"like",$request->query('name'));
        }
               //scopeFeatured => local scope 
        return view('homepage.index',
        ['products'=>$products->Featured()->paginate(),'categories'=>$categories,'request'=>$request,'num'=>$num ]);


    }

    public function switchLang($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        return Redirect::back();
 
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
