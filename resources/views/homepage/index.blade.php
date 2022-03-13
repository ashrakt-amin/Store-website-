@extends('homepage.header')
@section('content')


<div class="cotainer d-flex justify-content-center">

<div class="body category" style="margin-top:20px;"  data-currency-code="USD">
    
  <form action={{route('homepage.products')}} class="form-inline " method="GET">
   <input type="text" name="name" class="form-control mb-5 m-2" placeholder="serch name"  value="{{$request['name'] ?? ''}}">
   <button type="submit" class="btn btn-primary form-control mb-5 m-2">find</button>
  </form>
</div></div>




    <div class="position-relative" >
    <h3 class="position-absolute top-0 start-50 translate-middle "></h3>
    </div>


    <div class="container">
    @if(session()->has('status'))
    <div class="alert alert-success" style="height:5%">{{session('status')}}</div>
    @endif


<div class="row" >

@foreach($products as $product)
 <div class="col-sm-3" style="margin-bottom:1em">
    <div class="card text-center" >
      <form action={{route('cart.store')}} method="POST">
        @csrf
        <button type="submit" value="{{$product->id}}" name="product_id" style="float:right ;background-color:white;border:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg> 
        </button>
      </form>   
      <img style="width:200px; height:200px;" src="{{$product->image_url}}" class="rounded mx-auto d-block" alt="...">
      <div class="card-body">
      <h6 class="card-title col-md-6" style="color:gray">{{$product->category->name}}</h5>
      <p style="height:30px;" >{{$product->name}}</p>
      <a class=""><i class="icon-heart"></i></a>
      <p class="card-title" >${{$product->price}}</p>

      </div>
    </div>
  </div>
  @endforeach



  </div>

  
</div>
@endsection