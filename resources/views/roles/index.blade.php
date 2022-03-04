@extends('categories.layout')
@section('content')
@if(session()->has('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif

<a href="{{route('roles.create')}}" class="btn show create mb-3">Create</a>

<table class="table table-bordered  text-center">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th  width="200px">Action</th>
    </tr>

    @forelse ($roles as $role)
    <tr>
        <td>{{$role->id}}</td>
        <td>{{$role->name}}</td>
        <td>
            <a class="btn edit" href="{{ route('roles.edit',$role->id) }}">Edit</a>  
            <form action="{{ route('roles.destroy',$role->id) }}" class="companyform" method="POST">   
            @csrf
            @method('DELETE')      
            <button type="submit" class="btn delete">Delete</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="9">No Product</td>
    </tr>
    @endforelse

    </table>
   
    @endsection
