@extends('categories.layout')
@section('content')
@if(session()->has('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif

    <table class="table table-bordered  text-center">
    <tr>

        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Image</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>User</th>
        <th>Deleted</th>



        <th  width="200px">Action</th>

    </tr>
    @forelse ($products as $product)
    <tr>
        <td>{{$loop->index}}</td>
        <td><a href="{{route('products.show',$product->id)}}">{{$product->name}}</td>
        <td>{{$product->category->name}}</td>
        <td><img style="width:70px; height: 70px;" src="{{$product->image_url}}"></td>
        <td>{{$product->price}}</td>
        <td>{{$product->quantity}}</td>
        <td>{{$product->user->name}}</td>
        <td>{{$product->deleted_at}}</td>

        

        <td>
                    <a class="btn edit" href="{{ route('restore',$product->id) }}">Restore</a>  
                    <form action="{{ route('destroy',$product->id) }}" class="companyform" method="POST">   
                    @method('DELETE')
                    @csrf
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
