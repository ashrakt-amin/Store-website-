@extends('categories.layout')
@section('content')


<a href="{{route('categories.create')}}" class="btn show create mb-3">Create</a>

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
        <th  width="300px">Action</th>

    </tr>
    @foreach ($categories as $category)
    <tr>
        <td>{{$loop->index}}</td>
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td> @if($category->parent == null) null @else {{$category->parent}} @endif</td>
        <td>{{$category->products_num}}</td>

        <td class="text-success">{{$category->created_at}}</td>
        <td class="text-success">{{$category->updated_at}}</td>

        <td>
                    <a class="btn show" href="{{ route('categories.show',$category->id) }}">Show</a>    
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
