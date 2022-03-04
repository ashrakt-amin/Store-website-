@extends('categories.layout')
@section('content')

<div class="row ">
        <div class="col-lg-12 margin-tb">
          
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class=" bb">

   
    <div class="row mx-auto">
        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Name : </strong>
                {{$users->profile->country}}
            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Description : </strong>
                {{$users->profile->country}}
            </div>
        </div>


        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Category : </strong>
                {{$users->profile->country}}

            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Image : </strong>
                {{$users->profile->country}}

            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Price : </strong>
                {{$users->profile->country}}

            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Quantity : </strong>
                {{$users->profile->country}}
            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>User : </strong>
                {{$users->profile->country}}
            </div>
        </div>
    </div>
    </div>

@endsection
