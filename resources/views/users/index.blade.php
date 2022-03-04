@extends('categories.layout')
@section('content')
@if(session()->has('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif

<div>
  <form action={{route('users.index')}} class="form-inline" method="GET">
   <input type="text" name="name" class="form-control mb-5 m-2" placeholder="serch name"  value="{{$request['name'] ?? ''}}">
    <button type="submit" class="btn btn-primary form-control mb-5 m-2">find</button>
  </form>
</div>


    <table class="table table-bordered  text-center">
    <tr>

        <th>Name</th>
        <th>Country</th>
        <th>City</th>
        <th>Email</th>
        <th>Phone</th>
        <th>user name</th>
        <th>Gender</th>
        <th width="200px">Action</th>

    </tr>
    @forelse ($users as $user)
    <tr>
        <td><a href="{{route('users.show',$user->id)}}">{{$user->name}}</td>
        <td>{{$user->profile->country}}</td>
        <td>{{$user->profile->city}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->phone}}</td>
        <td>{{$user->user_name}}</td>
        <td>{{$user->profile->gender}}</td>
        <td>
                    <form action="{{ route('users.destroy',$user->id) }}" class="companyform" method="POST">   
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn delete">Delete</button>
                    </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="9">No user</td>
      </tr>
      @endforelse

    </table>
    <a href="{{route('users.create')}}" class="btn show create mb-3">Create</a>

    @endsection
