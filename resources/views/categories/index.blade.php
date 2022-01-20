@extends('categories.layout')
@section('content')

<h2 class="mb-5"> Categories </h2>
<a href="{{route('categories.create')}}" class="btn btn-outline-primary mb-3">Create</a>
    <table class="table table-bordered text-white text-center">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>description</th>
        <th>Parent</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th  width="300px">Action</th>

    </tr>
    @foreach ($categories as $category)
    <tr>
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td>{{$category->description}}</td>
        <?php if (($category->parent_id) == ""){
            echo "<td>null</td>" ;
        } 
else {
  
   echo "<td>". $category->parent_id."</td>";

}        ?>  
        <td class="text-success">{{$category->created_at}}</td>
        <td class="text-success">{{$category->updated_at}}</td>

        <td>
                    <a class="btn btn-info" href="{{ route('categories.show',$category->id) }}">Show</a>    
                    <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Edit</a>  
                    <form action="{{ route('categories.destroy',$category->id) }}" class="companyform" method="POST">   
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
        </td>
      </tr>
      @endforeach

    </table>
    @endsection