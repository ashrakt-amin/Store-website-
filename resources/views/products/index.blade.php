@extends('categories.layout')
@section('content')
@if(session()->has('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif

<div>
  <form action={{route('products.index')}} class="form-inline" method="GET">
   <input type="text" name="name" class="form-control mb-5 m-2" placeholder="serch name"  value="{{$request['name'] ?? ''}}">
   <input type="number" name="min" class="form-control mb-5 m-2" placeholder="price from" value="{{$request['min'] ?? ''}}">
   <input type="number" name="max" class="form-control mb-5 m-2" placeholder="price to" value="{{$request['max'] ?? ''}}">
   <select name="category" class="form-control mb-5 m-2" value="{{$request['category'] ?? ''}}" >
   <option value="">Select Category</option>
    @foreach(App\Models\Category::all() as $category)
     <option value="{{$category->id}}" @if($category->id == $request['category'] ?? '') selected @endif>{{$category->name}}</option>
     @endforeach
   </select>
    <button type="submit" class="btn btn-primary form-control mb-5 m-2">find</button>
  </form>
</div>

    <table class="table table-bordered  text-center">
    <tr>

        <th>#</th>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Image</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>User ID</th>


        <th  width="300px">Action</th>

    </tr>
    @forelse ($products as $product)
    <tr>
        <td>{{$loop->index}}</td>
        <td>{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->category}}</td>
        <td><img style="width:70px; height: 70px;" src="{{$product->image_url}}"></td>
        <td>{{$product->price}}</td>
        <td>{{$product->quantity}}</td>
        <td>{{$product->user_id}}</td>
        

        <td>
                    <a class="btn show" href="{{ route('products.show',$product->id) }}">Show</a>    
                    <a class="btn edit" href="{{ route('products.edit',$product->id) }}">Edit</a>  
                    <form action="{{ route('products.destroy',$product->id) }}" class="companyform" method="POST">   
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
    <a href="{{route('products.create')}}" class="btn show create mb-3">Create</a>

    @endsection
