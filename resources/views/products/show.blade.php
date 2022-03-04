@extends('categories.layout')
@section('content')

<div class="row ">
        <div class="col-lg-12 margin-tb">
          
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class=" bb">

   
    <div class="row mx-auto">
        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Name : </strong>
                {{$product->name }}
            </div>
        </div>

        <div class="row mx-auto">
        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>tags : </strong>
                @foreach ($product->tags  as $tag)
                <strong>{{$tag->name}}</strong>
                @endforeach
            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Description : </strong>
                {{$product->description}}
            </div>
        </div>


        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Category : </strong>
                {{$category->name}}

            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Image : </strong>
                {{$product->image}}

            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Price : </strong>
                {{$product->price}}

            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Quantity : </strong>
                {{ $product->quantity}}
            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>User : </strong>
                {{ $product->name }}
            </div>
        </div>
    </div>
    </div>

@endsection
