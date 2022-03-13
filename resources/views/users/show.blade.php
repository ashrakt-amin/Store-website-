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
                {{$users->name}}
            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Email : </strong>
                {{$users->email}}
            </div>
        </div>


        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>User Name : </strong>
                {{$users->user_name}}

            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Country : </strong>
                {{$users->profile->country}}

            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Gender : </strong>
                {{$users->profile->gender}}

            </div>
        </div>

        

       
    </div>
    </div>

@endsection
