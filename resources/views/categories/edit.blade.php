@extends('categories.layout')
@section('content')
<div class="bb">

<form class="form mx-auto " action="{{route('categories.update',$categories->id) }}" method="POST">
@csrf
@method('PUT')

<!-- <input type="hidden" value="PUT" name="_method" > == method_filled('PUT') == @method('PUT') -->




<div class="row">

    <label for="name" class="col-md-3 col-form-label">Name</label>

    <div class="form-group col-md-9">
      <input type="text" value="{{old('name',$categories->name)}}" name="name" class="form-control" id="name">
    @error('name')
    <p class="text-danger">{{$message}}</p>
    @enderror
    </div>
    </div>


    <div class="row">

    <label for="product" class="col-md-3 col-form-label">Product</label>
    <div  class="form-group col-md-9">
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
      </div>


      <div class="row">

    <label for="des" class="col-md-3 col-form-label">Description</label>
    <div  class="form-group col-md-9 ">
      <textarea class="form-control" value="{{old('description',$categories->description)}}" name="description" id="des"></textarea>
      @error('description')
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