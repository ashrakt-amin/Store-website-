<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request= request() ;
        $users=User::with('profile');

        if($request->query('name')){
           $users-> where('users.name' ,'like', $request->query('name'));
        }
        return view('users.index',['users'=>$users->get(),'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::with('profile');
        return view('users.create',compact('users'));
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
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            'phone'=>'required',
            'type'=>'in:user,admin,super_admin|required',
            'user_name'=>'nullable',
            'gender'=>'in:male,female|required',
            'user_image'=>'nullable',
            'country'=>'nullable',
            'city'=>'nullable',
            'address'=>'nullable',
            'birthday'=>'nullable|date',
        ]);

        $users =User::create([
            'name'=>$request->post('name'),
            'email'=>$request->post('email'),
            'password'=>Hash::make($request->post('password')),
            'phone'=>$request->post('phone'),
            'type'=>$request->post('type'),
            'user_name'=>$request->post('user_name'),

        ]);

        $profiles =Profile::create([
            'user_id'=>$users->id,
            'gender'=>$request->post('gender'),
            'user_image'=>$request->post('user_image'),
            'country'=>$request->post('country'),
            'city'=>$request->post('city'),
            'address'=>$request->post('address'),
            'birthday'=>$request->post('birthday'),
        ]);
       

        return redirect()->route('users.index',compact('users','profiles'))->with('success','user was deleted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users =User::with('profile')->findOrFail($id);
        return view('users.show',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success','user was deleted');

    }
}
