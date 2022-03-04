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

<form class="form mx-auto" action="{{route('products.store') }}" enctype="multipart/form-data" method="POST">
@csrf

    <div class="row">
    <label for="name" class="col-md-3 col-form-label">Name</label>
    <div class="form-group col-md-9">
    <input type="text" value="{{old('name')}}" name="name" class="form-control" id="name">
    @error('name')
      <p class="text-danger">{{$message}}</p>
    @enderror
    </div>
    </div> 

    <div class="row">
    <label for="description" class="col-md-3 col-form-label">Description</label>
    <div  class="form-group col-md-9">
    <input type="text" value="{{old('description')}}" name="description" class="form-control" id="description">
    @error('description')
      <p class="text-danger">{{$message}}</p>
    @enderror
    </div>
    </div>

    <div class="row">
    <label for="category_id" class="col-md-3 col-form-label">Category</label>
    <div  class="form-group col-md-9">
    <select class="form-control" value="{{old('category_id')}}" name="category_id" id="category_id">
    <option >select category</option>
    @foreach($categories as $category)
    <option value="{{$category->id}}">{{$category->name}}</option>
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
    <input type="file" value="{{old('image')}}" name="image" class="form-control" id="image">
    @error('image')
      <p class="text-danger">{{$message}}</p>
    @enderror
    </div>
    </div>

    <div class="row">
    <label for="price" class="col-md-3 col-form-label">Price</label>
    <div class="form-group col-md-9">
    <input type="float" value="{{old('price')}}" name="price" class="form-control" id="price">
    @error('price')
      <p class="text-danger">{{$message}}</p>
    @enderror
    </div>
    </div>

    <div class="row">
    <label for="quantity" class="col-md-3 col-form-label">quantity</label>
    <div class="form-group col-md-9">
    <input type="float" value="{{old('quantity')}}" name="quantity" class="form-control" id="quantity">
    @error('quantity')
      <p class="text-danger">{{$message}}</p>
    @enderror
    </div>
    </div>

    <div class="row">
    <label for="user_id" class="col-md-3 col-form-label">User</label>
    <div  class="form-group col-md-9">
    <select class="form-control" value="{{old('user_id')}}" name="user_id" id="user_id">
    <option>select user</option>
    @foreach($users as $user)
    <option value="{{$user->id}}">{{$user->name}}</option>
    @endforeach
    </select>      
    @error('user_id')
      <p class="text-danger">{{$message}}</p>
    @enderror
    </div>   
    </div>

    {{--<div>
    @foreach($tags as $tag)
    <div class="form-check">
    <input class="form-check-input" type="checkbox" value="{{$tag->id}}" name="tag[]" id="flexCheckDefault">
    <label class="form-check-label" for="flexCheckDefault">
    {{$tag->name}}
    </label>
    </div>
    @endforeach
    </div>--}}

    
    <div class="row">
    <label for="tag" class="col-md-3 col-form-label">Taga</label>
    <div class="form-group col-md-9">
    <input type="text" value="{{old('tag')}}" name="tag" class="form-control" id="tag">
    @error('tag')
      <p class="text-danger">{{$message}}</p>
    @enderror
    </div>
    </div>



    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary ">Create</button>
    </div>

</form>
</div>
@endsection