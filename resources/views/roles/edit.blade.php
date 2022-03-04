@extends('categories.layout')
@section('content')
@if(session()->has('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif


<div class=" bb">
<form class="form mx-auto"  action="{{route('roles.update',$roles->id)}}"  method="POST">
@csrf
@method('PUT')
   <input type="text" name="name" class="form-control mb-5 m-2" placeholder="Name Of Role"  value="{{old('name',$roles->name)}}" >


   <div class="form-group ">
<h3 class="text_center">Permission</h3>

@foreach(config('permission') as $code => $label)
<div class="form-check" >
 <input class="form-check-input" name="permission" type="checkbox" 
 value="{{$code}}" @if(in_array($code,$permission)) checked @endif id="flexCheckIndeterminate">
    <label class="form-check-label" for="flexCheckIndeterminate">
    {{$label}}
    </label>
    </div>
 @endforeach
 </div>
   <button type="submit" class="btn btn-primary form-control mb-5 m-2"> Update </button>
  </form>
</div>
@endsection
