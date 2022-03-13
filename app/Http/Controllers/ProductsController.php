<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\Cart;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;   
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        /*$products = Product::join('categories','categories.id','=','products.category_id')
        ->select(['products.*','categories.name as category']);*/
         //Eager loading
        $products =Product::with('category','user');

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
       
       //->withTrashed()
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
        $tags =Tag::all();
        $product_tags=[];
        return view('products.create',compact('tags','categories','users','product_tags'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,Product $product)
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

        $products['user_id']=Auth::id();
       // $products['user_id']=Auth::user()->id;
       // $products['user_id']=$request->user()->id;

        $product= Product::create($products);
        $this->saveTags($product ,$request);
         /*$tags = $request->post('tag',[]);
         foreach($tags as $tag){
             DB::table('product_tag')->insert([
                 'product_id'=>$product->id,
                 'tag_id'=>$tag
             ]);
         }*/
         //dd($products);
         return redirect()->route('products.index')->with('success','product was created');

    }
     
    public function saveTags(Product $product ,Request $request )
    {
        $tag_id=[];
        $tag=explode(',',$request->post('tag'));
        foreach($tag as $name){
          $name=strtoupper(trim($name));
          $tag = Tag::where('name',$name)->first();
          if(!$tag){
              $tag=Tag::create([
                  'name'=>$name
              ]);
          }
          $tag_id[]=$tag->id;
      }
      $product->tags()->sync($tag_id);
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
       $category =$product->category;
       //dd($product,$user ,$category);
     return view ('products.show',compact('product','category'));
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
         $tags=Tag::all();
         $products = Product::findOrFail($id);
         $product_tag= strtoupper(implode(',',($products->tags->pluck('name')->toArray())) );
         return view ('products.edit',compact('tags','users','categories','products','product_tag'));
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
        
         $this->saveTags($product ,$request);

        /* $tags = $request->post('tag',[]);
         $product->tags($tags);*/

         /*DB::table('product_tag')->where('product_id',$product->id)->delete();
         foreach($tags as $tag){
             DB::table('product_tag')->insert([
                 'product_id'=>$product->id,
                 'tag_id'=>$tag
             ]);
         }*/
        


         
     
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
       /* if($product->image){
            Storage::disk('uploads')->delete($product->image);
        }*/
        return redirect()->route('products.index')->with('success','product was deleted');

    }



  


}