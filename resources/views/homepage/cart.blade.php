@extends('homepage.header')
@section('content')

<div class="row col-md-12">  <!--div 1-->
<div class="col-md-8">   <!--div 2-->
 
   <table class="table table-borderless text-center">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
    </tr>
    <form action="{{route('cart.update')}}" class="companyform" method="POST">   
     @csrf
     @method('patch') 
     @forelse($carts as $cart)
    <tr>
        <td><img style="width:100px; height:100px;" src="{{$cart->product->image_url}}" class="rounded mx-auto d-block" alt="..."></td>
        <td >${{$cart->product->price}}</td>
        <td ><input type="number" min="0" name="quantity[{{$cart->product_id}}]" style="width:20%" value="{{$cart->quantity}}"/></td>
        <td >{{$cart->product->price * $cart->quantity}}</td>
    </tr>
    @empty
    <tr>
        <td colspan="4">No Product</td>
    </tr>
    @endforelse
   </table>
   @forelse($carts as $cart)
      <div class="row d-flex justify-content-center" >
       <button type="submit"style="background-color:#F76E11 ;margin:10px ;width:100px" class="btn delete">Edit</button>
    </form>


   <form action="{{route('cart.destroy')}}" class="companyform" method="POST">   
    @csrf
    @method('DELETE')      
    <button type="submit" style="background-color:#F76E11 ;margin:10px;width:100px" class="btn delete ">Delete</button>
   </form>
      </div>
      @empty

        @endforelse

</div>   <!--end div 2-->
   
  <div class="col-md-3 bord " style="margin-left:5%;margin-top:3%"> <!--div 3-->
  <table class="table table-borderless text-center shadow-lg p-3 mb-5 bg-body rounded" 
            style="background-color:#FBF8F1; height:20% ;width:90%;">
        <div><h4 class="text-center"> SUMMARY </h4></div>
      <tr>
       <th>Tax</th>
       <td>{{$tax}}</td>
      </tr>
      <tr>
        <th>Price</th>
        <td>{{$price}}</td>
      </tr>
      <tr>
       <th>total</th>
       <td>{{$total}}</td>
      </tr>
      <tr>
      <td colspan="2" >
      <form action="{{route('checkout.store')}}" class="companyform" method="POST">   
      @csrf
      <button type="submit" style="background-color:#F76E11 ;margin:10px 10px;width:120px" class="btn delete">Create Order</button>
      </form>
      @if(session()->has('transaction'))
       <div class="alert alert-success" style="height:5%">{{session('transaction')}}</div>
      @endif
      <button  style="background-color:#F76E11 ;margin:0px 10px;width:120px" class="btn delete">
      <a href="{{route('homepage.orders')}}">My Orders</a></button>
      </td>
      </tr>
  </table>
  </div>  <!--end div 3-->
  
</div>    <!--end div 1-->



@endsection