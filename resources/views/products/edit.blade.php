@extends('categories.layout')
@section('content')

@if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
  <li>{{$error}}</li>
</ul>
@endforeach
</div>
@endif
<div class="bb">

<form class="form mx-auto" action="{{route('products.update',$products->id) }}" enctype="multipart/form-data" method="POST">
@csrf
@method('PUT')



     <div class="row">
    <label for="name" class="col-md-3 col-form-label">Name</label>

    <div class="form-group col-md-9">
      <input type="text" value="{{old('name',$products->name)}}" name="name" class="form-control" id="name">
      @error('name')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
     </div> 

     <div class="row">

    <label for="description" class="col-md-3 col-form-label">Description</label>
    <div  class="form-group col-md-9">
    <input type="text" value="{{old('description',$products->description)}}" name="description" class="form-control" id="description">

      @error('description')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>

    <div class="row">

    <label for="category_id" class="col-md-3 col-form-label">Category</label>
    <div  class="form-group col-md-9">
    <select class="form-control"  name="category_id" id="category_id">
          <option>select category</option>
          @foreach($categories as $category)
          <option  value="{{$category->id}}" @if($category->id == old('category_id',$products->category_id)) selected @endif>{{$category->name}}</option>
          @endforeach
     </select>      
     @error('description')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>

    <div class="row">

    <label for="image" class="col-md-3 col-form-label">Image</label>
    <div class="form-group col-md-9">
      <input type="file" value="{{old('image',$products->image)}}" name="image" class="form-control" id="image">
      @error('image')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>
    <div class="row">

  
    <label for="price" class="col-md-3 col-form-label">Price</label>
    <div class="form-group col-md-9">
      <input type="float" value="{{old('price',$products->price)}}" name="price" class="form-control" id="price">
      @error('price')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>
    <div class="row">


    <label for="quantity" class="col-md-3 col-form-label">quantity</label>
    <div class="form-group col-md-9">
      <input type="float" value="{{old('quantity',$products->quantity)}}" name="quantity" class="form-control" id="quantity">
      @error('quantity')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>

    <div class="row">

    <label for="user_id" class="col-md-3 col-form-label">User</label>
    <div  class="form-group col-md-9">
    <select class="form-control" name="user_id" id="user_id">
          <option>select </option>
          @foreach($users  as $user)
          <option value="{{$user->id}}" @if($user->id == old('user_id',$products->user_id ))selected @endif >{{$user->name}}</option>
          @endforeach
     </select>      
     @error('user_id')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>    </div>



  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary ">Create</button>
        </div>

</form>
</div>
@endsection