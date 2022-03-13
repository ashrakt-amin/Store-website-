@extends('homepage.header')
@section('content')

<div class="container">

    @if(session()->has('status'))
     <div class="alert alert-success" style="height:5%">{{session('status')}}</div>
    @endif
    
    <table class="table table-borderless text-center">
    <tr>
        <th>Order</th>
        <th>Total</th>
        <th></th>

    </tr>
   @forelse($orders as $order)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$order->total}}</td>
        <td>
        <button  style="background-color:#F76E11 ;margin:0px 10px;width:120px" class="btn delete">
        <a  href="{{ route('homepage.moyasar',$order->id) }}">Payment</a></button>
        </td>
    </tr>

    @empty
    <tr>
        <td colspan="4">No Orders</td>
    </tr>
    @endforelse
   </table>
</div>


@endsection