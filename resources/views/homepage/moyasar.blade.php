@extends('homepage.header')
@section('content')
 

<form accept-charset="UTF-8" action="https://api.moyasar.com/v1/payments.html" method="POST" class="form mx-auto col-md-6 " style="margin-top:5%">
    <input type="hidden" name="callback_url" value="{{url(route('moyasar.callback',$order->id))}}" >
    <input type="hidden" name="publishable_api_key" value="{{config('services.moyasar.key')}}" >
    <input type="hidden" name="amount" value="{{$order->total}}" >
    <input type="hidden" name="source[type]" value="creditcard" >
    <input type="hidden" name="description" value="Order ID :{{$order->id}} by User {{$order->user->name}} " >
    
    <div class="form-group">
     <input type="text" name="source[name]" id="mysr-cc-name" required class="form-control" placeholder="Name on card" >
    </div>

    <div class="form-group">
     <input type="number" id="mysr-cc-number" required class="form-control" name="source[number]" placeholder="1234 5678 9101 1121" >
    </div>

    <div class="form-group">
      <input type="number" name="source[month]" class="form-control"  placeholder="month" >
    </div>

    <div class="form-group">
      <input type="number" name="source[year]" class="form-control"  placeholder="year" >
    </div>


    <div class="form-group">
      <input type="number" name="source[cvc]" class="form-control"  placeholder="CVC" >
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
     <button type="submit" class="btn btn-primary">Pay {{$order->total}}</button>
    </div>
</form>


@endsection