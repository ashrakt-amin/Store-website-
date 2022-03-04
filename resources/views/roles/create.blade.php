@extends('categories.layout')
@section('content')
@if(session()->has('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif


<div>
  <form action="{{route('roles.store')}}" class="form-inline" method="POST">
  @csrf
   <input type="text" name="name" class="form-control mb-5 m-2" placeholder="Name Of Role"  value="{{old('name')}}" >
   


   <button type="submit" class="btn btn-primary form-control mb-5 m-2">create</button>
  </form>
</div>
@endsection
