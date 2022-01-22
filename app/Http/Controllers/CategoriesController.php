<?php

namespace App\Http\Controllers;

use App\Rules\parentRule ;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $ccategory = Category::all();

        return view('categories.index',compact('categories','ccategory')) ;
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
    public function show(Category $category)
    {
        return view('categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $categories = Category::findOrFail($id);

        $category= Category::where('id' ,'<>', $id)
           ->where(function($query)use($id){
           $query-> where('parent_id','<>',$id)
           ->orWhereNull('parent_id');
           })->get();

        return view('categories.edit',compact('categories','category')) ;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category ,$id = null)
    {
        
        $request->validate([
            'name'=>['required','max:255','min:3',"unique:categories,name,$id "],
            'description' =>['nullable','max:1000'],
            'parent_id' =>['nullable','exists:categories,id',new parentRule($id)
             
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
        $category = Category::findOrFail($id);
        $category->delete($id);
        return redirect()->route('categories.index')->with('success'," category $category->name was deleted successfully .");
    }
}
