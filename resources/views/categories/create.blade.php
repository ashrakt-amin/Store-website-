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
<div class=" bb">
<form class="form mx-auto" action="{{route('categories.store') }}" method="POST">
@csrf




<div class="row">
    <label for="name" class="col-md-3 col-form-label">Name</label>

    <div class="form-group col-md-6">
      <input type="text" value="{{old('name')}}" name="name" class="form-control" id="name">
      @error('name')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>

    <div class="row">

    <label for="product" class="col-md-3 col-form-label">Product</label>
    <div  class="form-group col-md-6">
      <select class="form-control" value="{{old('parent_id')}}" name="parent_id" id="product">
          <option value=" ">no parent</option>
          @foreach($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
     </select>
      @error('parent_id')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>

    <div class="row">

    <label for="des" class="col-md-3 col-form-label">Description</label>
    <div  class="form-group col-md-6">
      <textarea class="form-control" value="{{old('description')}}" name="description" id="des"></textarea>
      @error('description')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>


    

  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary ">Create</button>
        </div>

</div>
</form>
</div>
@endsection