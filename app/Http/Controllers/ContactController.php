<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function create(){
        $categories = Category::with('parent','children')->paginate();
        $num =Cart::with('product')->Where('user_id',Auth::id())->sum('quantity');
        $user=Auth::id();

        return view('homepage.contact',['categories'=>$categories,'num'=>$num ,'user'=>$user]);
    }

    public function show(){
        $categories = Category::with('parent','children')->paginate();
        $num =Cart::with('product')->Where('user_id',Auth::id())->sum('quantity');
        $user=Auth::id();

        return view('homepage.aboutus',['categories'=>$categories,'num'=>$num ,'user'=>$user]);
    }


    public function store(Request $request){

     $contact=Contact::create([
        "user_id"=>Auth::id(),
        "message"=> request('message'),
     ]);
     $contact->save();
     return redirect()->route('homepage.products')->with('success',"message was created successfully .");
}



}
