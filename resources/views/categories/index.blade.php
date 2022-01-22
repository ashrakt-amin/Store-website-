@extends('categories.layout')
@section('content')
@if(session()->has('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif
<a href="{{route('categories.create')}}" class="btn show create mb-3">Create</a>
    <table class="table table-bordered  text-center">
    <tr>
        <th>#</th>
        <th>ID</th>
        <th>Name</th>
        <th>Parent</th>
        <th>Creat</th>
        <th>Update</th>
        <th  width="300px">Action</th>

    </tr>
    @foreach ($categories as $category)
    <tr>
        <td>{{$loop->index}}</td>
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <?php if (($category->parent_id) == ""){
            echo "<td>null</td>" ;
        } 
else {
  
   echo "<td>". $category->parent_id."</td>";

}        ?>  
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
