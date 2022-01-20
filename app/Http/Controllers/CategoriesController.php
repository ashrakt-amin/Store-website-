<?php

namespace App\Http\Controllers;

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
    public function create( Category $categories)
    {
        $categories= Category::all();
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
         'name'=>'required',
         'description' =>'required',
         'parent_id' =>'sometimes',

       ]);

       Category::create($request->all());

        return redirect()->route('categories.index')->with('success','copmpany created successfully.');

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
        $category= Category::all();

        return view('categories.edit',compact('categories','category')) ;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        
        $request->validate([
            'name'=>'required',
            'description' =>'required',
            'parent_id' =>'sometimes',
   
          ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success','copmpany created successfully.');



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
        return redirect()->route('categories.index')->with('success','Post deleted successfully');
    }
}
