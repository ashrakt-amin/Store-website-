@extends('categories.layout')
@section('content')

@can('categories.create')<!--== Gate::allows-->
<a href="{{route('categories.create')}}" class="btn show create mb-3">Create</a>
@endcan
<x-alerts/>

<!--<x-alerts message=""><h1></h1></x-alerts>-->

    <table class="table table-bordered  text-center">
    <tr>
        <th>#</th>
        <th>ID</th>
        <th>Name</th>
        <th>Parent</th>
        <th>NOP</th>
        <th>Creat</th>
        <th>Update</th>
        <th  width="200px">Action</th>

    </tr>
    @foreach ($categories as $category)
    <tr>
        <td>{{$loop->index}}</td>
        <td>{{$category->id}}</td>
        <td><a href="{{ route('categories.show',$category->id) }}">{{$category->name}}</td>
        <td>{{$category->parent->name}}</td>
        <td>{{$category->products}}</td>

        <td class="text-success">{{$category->created_at}}</td>
        <td class="text-success">{{$category->updated_at}}</td>

        <td>
                    <a class="btn edit" href="{{ route('categories.edit',$category->id) }}">Edit</a>  
                    <form action="{{ route('categories.destroy',$category->id) }}" class="companyform" method="POST">   
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn delete">Delete</button>
                    </form>
        </td>
      </tr>
      @endforeach

    </table>
    @endsection
