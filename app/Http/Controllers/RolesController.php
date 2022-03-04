<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $roles =Role::paginate();
            return view('roles.index',compact('roles'));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('roles.create');
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
                'name'=>'required'
            ]);
            $roles =Role::create($request->all());
            return redirect()->route('roles.index')->with('sucess','role'. $roles->name .'added');
        }
    
        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }
    
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $roles = Role::FindOrFail($id);
            $permission = $roles->permissions()->pluck('permission')->toArray();
            return view('roles.edit',compact('roles','permission'));
        }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $roles
     * @return \Illuminate\Http\Response
     */
        public function update(Request $request , Role $roles)
        {
            $request->validate(['name' => 'required']);
            $roles->update($request->all());
            $roles->permissions()->delete();

            foreach($request->post('permissions',[]) as $permission){
            $roles->permissions()->create([
                "permissions" => $permission ,
            ]);

            }
            return redirect()->route('roles.index')->with('sucess','role updated');
    
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $roles = Role::findOrFail($id);
            $roles->delete($id);
            return redirect()->route('roles.index')->with('sucess','role deleted');
    
        }
}
