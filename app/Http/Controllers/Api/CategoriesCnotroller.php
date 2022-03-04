<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesCnotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::paginate();
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
            'name'=>'required',
        ]);
        $categories = Category::create($request->all());
        return [
            "code" =>"1",
            "status" =>"success",
            "message" =>"category created",
            "data" =>$categories ,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::findOrFair($id);
         return $categories;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categories = Category::findOrFair($id);

        $request->validate([
            'name'=>'required',
        ]);
        $categories->update($request->all());
        return [
            "code" =>"1",
            "status" =>"success",
            "message" =>"category updated",
            "data" =>$categories ,
        ];
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFair($id)->delete();
        return [
            "code" =>"1",
            "status" =>"success",
            "message" =>"category deleted",
        ];
    }
}
