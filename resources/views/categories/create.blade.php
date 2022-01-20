@extends('categories.layout')
@section('content')

<form class="form " action="{{route('categories.store') }}" method="POST">
@csrf


<h2 class="mb-5 text-center">Create New Categories </h2>

<div class="row d-flex justify-content-center">

<div class="col-xs-8 col-sm-8 col-md-8">
    <label for="name" class="col-sm-2 col-form-label">Name</label>

    <div class="form-group">
      <input type="text" name="name" class="form-control" id="name">
    </div>


    <label for="des" class="col-sm-2 col-form-label">Description</label>
    <div  class="form-group ">
      <textarea class="form-control" name="description" id="des"></textarea>
    </div>

    <label for="product" class="col-sm-2 col-form-label">Product</label>
    <div  class="form-group ">
      <select class="form-control" name="parent_id" id="product">
          <option value="">no parent</option>
          @foreach($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach

      </select>
    </div>

  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary ">Submit</button>
        </div>

</div>
</form>
@endsection