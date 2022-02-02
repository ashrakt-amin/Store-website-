@extends('categories.layout')
@section('content')

<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class=" bb">

   
<div class="row mx-auto">
    <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Name : </strong>
                {{$category->name }}
            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Description : </strong>
                {{ $category->description}}
            </div>
        </div>


        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Parent : </strong>
                <?php if (($category->parent_id) == ""){
                       echo "null" ;
                     } 
                   else {
  
                     echo $category->parent_id ;
                        }  
                 ?>  
            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>created at : </strong>
                {{ $category->created_at}}
            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>updated at : </strong>
                {{ $category->updated_at }}
            </div>
        </div>
    </div>
    </div>

@endsection