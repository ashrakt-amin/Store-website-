<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    
public function admin(){
    $contacts =Contact::with('users')->paginate();
     return view('products.message',['contacts'=>$contacts]);
 }
 
 
 public function trash(){
    $products =Product::with('category','user');
    return view('products.trash',
    ['products'=>$products->onlyTrashed()->paginate()]);
}

public function restore($id){
    $products =Product::onlyTrashed()->findOrFail($id);
    $products->restore();
    return redirect()->route('products.index');

}

public function forceDelete($id){
    $products =Product::onlyTrashed()->findOrFail($id);
    $products->forceDelete();
    if($products->image){
        Storage::disk('uploads')->delete($products->image);
    return redirect()->route('products.index');

}
 

}
}
