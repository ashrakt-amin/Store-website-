@extends('categories.layout')
@section('content')

<form class="form " action="{{route('categories.update',$categories->id) }}" method="POST">
@csrf
@method('PUT')

<!-- <input type="hidden" value="PUT" name="_method" > == method_filled('PUT') == @method('PUT') -->


<h2 class="mb-5 text-center">Create New Categories </h2>

<div class="row d-flex justify-content-center">

<div class="col-xs-8 col-sm-8 col-md-8">
    <label for="name" class="col-sm-2 col-form-label">Name</label>

    <div class="form-group">
      <input type="text" value="{{old('name',$categories->name)}}" name="name" class="form-control" id="name">
    @error('name')
    <p class="text-danger">{{$message}}</p>
    @enderror
    </div>

    <label for="product" class="col-sm-2 col-form-label">Product</label>
    <div  class="form-group ">
      <select class="form-control"   name="parent_id" id="product">
          <option value="">no parent</option>
          @foreach( $category as $cat)
          <option  value="{{$cat->id}}" @if($cat->id == old('parent_id',$categories->id ))selected @endif >{{ $cat->name}}</option>
          @endforeach
      </select>
      @error('parent_id')
      <p class="text-danger">{{$message}}</p>
      @enderror
      </div>

    <label for="des" class="col-sm-2 col-form-label">Description</label>
    <div  class="form-group ">
      <textarea class="form-control" value="{{old('description',$categories->description)}}" name="description" id="des"></textarea>
      @error('description')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>



  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary ">Submit</button>
        </div>

</div>
</form>
@endsection