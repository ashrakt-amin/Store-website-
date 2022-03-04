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
                {{$categories->name }}
            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Description : </strong>
                {{ $categories->description}}
            </div>
        </div>

        
        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Parent : </strong>
                <?php if (($categories->parent_id) == ""){
                       echo "null" ;
                     } 
                   else {
  
                     echo $categories->parent_id ;
                        }  
                 ?>  
            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>created at : </strong>
                {{ $categories->created_at}}
            </div>
        </div>

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>updated at : </strong>
                {{ $categories->updated_at }}
            </div>
        </div>
        

        <div class="col-xs-9 col-sm-9 col-md-9">
            <div class="form-group">
                <strong>Products : </strong>
                <table class="table table-bordered-none mt-3 text-center">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>

                    </tr>
                    <tr>
                    @foreach($products as $product)

                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td><img style="width:70px; height: 70px;" src="{{$product->image_url}}"></td>
                        @endforeach

                    </tr>
                </table>
              
            </div>
        </div>


    </div>
    </div>

@endsection