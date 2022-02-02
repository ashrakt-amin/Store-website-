<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;   
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $products =DB::table('products')->pageinate(); 

        $request = request();
        $products = Product::join('categories','categories.id','=','products.category_id')
        ->select(['products.*','categories.name as category']);
        if($request->query('name')){
            $products->where('products.name',"like",$request->query('name'));
        }
        if($request->query('min')){
            $products->where('products.price',">=",$request->query('min'));
        }
        if($request->query('max')){
            $products->where('products.price',"<=",$request->query('max'));
        }
        if($request->query('category')){
            $products->where('category_id',"=",$request->query('category'));
        }
       

        return view('products.index',
        ['products'=>$products->paginate(),'request'=>$request]);

        
      


       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users =User::all();
        $categories =Category::all();
        return view('products.create',compact('categories','users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" =>'required|min:3',
            "description"=> 'required|max:1000',
            "category_id"=>'required',
            "image"=>'image|mimes:jpg,jpeg,bmp,png|unique:products',
            "price"=>'required|numeric',
            "quantity"=>'required|int',
            "user_id"=>'sometimes',
        ]);
        $products=$request->except('image');
         $image =$request->file('image');

         if($request->hasfile('image')){
           $filename = time() . '.' . $image->getClientOriginalName();
            $products['image'] = $image->storeAs('Uploads',$filename,'uploads');

        }

         Product::create($products);
         //dd($products);
         return redirect()->route('products.index')->with('success','product was created');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
       $product = Product::findOrFail($id);
       //dd($product,$user ,$category);
     return view ('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $users =User::all();
         $categories =Category::all();
         $products = Product::findOrFail($id);
         return view ('products.edit',compact('users','categories','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            "name" =>'sometimes|min:3',
            "description"=> 'sometimes|max:1000',
            "category_id"=>'sometimes',
            "image"=>'image|mimes:jpg,jpeg,bmp,png|unique:products|max:1024000',
            "price"=>'sometimes|numeric',
            "quantity"=>'sometimes|numeric',
            "user_id"=>'sometimes',
        ]);
         $products=$request->except('image');
        $image =$request->file('image');
 
                           
         if( $request->hasfile('image') &&  $image->isValid() ){
            $filename = time() . '.' . $image->getClientOriginalName();
            $products['image'] = $image->storeAs('Uploads',$filename,'uploads');
         }

           
        if(isset($product->image) && isset($products['image']) ){
            Storage::disk('uploads')->delete($product->image);
        }

         $product->update($products);
         
     
         return redirect()->route('products.index')->with('success','product was created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $product->delete(); 
        if($product->image){
            Storage::disk('uploads')->delete($product->image);
        }
        return redirect()->route('products.index')->with('success','product was deleted');


    }
}
