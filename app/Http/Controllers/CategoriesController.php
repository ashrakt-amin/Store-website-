<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Rules\parentRule ;
use Illuminate\Http\Request;
use App\Http\Middleware\UserType;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
     // $this->middleware(['auth',UserType::class]);
    }
    

    public function index()
    {
      
       /*
             // Date

       $date = new DateTime();
        $date->add(new DateInterval('P1D')); // now + day
        $date->add(new DateInterval('P1M')); // now + month
        echo $date->format('d/m/Y h:i:s');

        $date = new Carbon(); // larvel
        $diff =$date->diff(new Carbon('2000-10-10'));
        echo $diff->y ;
        $date->addDay(3);
        echo $date->format('F ,l d , Y h:i:s A');
        exit();
        */

        /*$categories = Category::leftJoin('categories as parents','parents.id','=','categories.parent_id')
        ->leftJoin('products','products.category_id','=','categories.id')
        ->select([
            'categories.name',
            'categories.id',
            'categories.parent_id',
            'categories.created_at',
            'categories.updated_at',
            'parents.name as parent',
            DB::raw('count(products.id) as products_num')])
        ->groupBy([ 'categories.name',
        'categories.id',
        'categories.parent_id',
        'categories.created_at',
        'categories.updated_at',
        'parent'])
        ->orderBy('products_num','DESC')
        ->orderBy('categories.name','DESC')
        ->paginate();*/
        $categories = Category::with('parent','children')
        ->withCount('products as products')
        ->orderBy('products','DESC')->paginate();
        
        

        return view('categories.index',compact('categories')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Category $categories ,$id =null)
    {
        $categories= Category::where('id' ,'<>', $id)
        ->where(function($query)use($id){
        $query-> where('parent_id','<>',$id)
        ->orWhereNull('parent_id');
        })->get();

        return view('categories.create',compact('categories')) ;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {

        $request->validate([
            'name'=>['required','max:255','min:3','unique:categories,name'],
            'description' =>'nullable|max:1000',
            'parent_id' =>'nullable|exists:categories,id',
   

       ]);

       $category=Category::create($request->all());

        return redirect()->route('categories.index')->with('success'," category $category->name was created successfully .");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::findOrFail($id);
                $products= $categories->products;

        //$products= $categories->products()->get();
        return view('categories.show',compact('categories','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Gate::denies is oppsite of allows
        if(Gate::allows('categories.edit')){
        $categories = Category::findOrFail($id);
        $category= Category::where('id' ,'<>', $id)
           ->where(function($query)use($id){
           $query-> where('parent_id','<>',$id)
           ->orWhereNull('parent_id');
           })->get();

        return view('categories.edit',compact('categories','category')) ;
        }else{
            return abort(403,'you must be super admin');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {
        
        $request->validate([
            'name'=>['required','max:255','min:3',"unique:categories,name,$category->id"],
            'description' =>['nullable','max:1000'],
            'parent_id' =>['nullable','exists:categories,id',new parentRule($category->id)
             
            ]
   
          ]);
          

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success'," category $category->name was created successfully ." );



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('category.destroy');
        $category = Category::findOrFail($id);
        $category->delete($id);
        return redirect()->route('categories.index')->with('success'," category $category->name was deleted successfully .");
    }


    public function xml(){
        $categories =Category::all();
        $xml ='<?xml version="1.0" ?>';
        $xml .='<categories>';
        foreach($categories as $category){
           $xml .= sprintf('<category id= "%d">',$category->id);
           $xml .= sprintf('<name> %s </name>',$category->name);
           $xml .= '</category>';
        }
        $xml .='</categories>';
        return response($xml ,200 ,[
            "Content-Type" => 'application/xml'
        ]);
    }

    public function json(){
        return Category::all();
      /*  $category = Category::all();
        return json_encode($category);*/
}
}
