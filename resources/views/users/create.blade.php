@extends('categories.layout')
@section('content')

@if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
  <li>{{$error}}</li>
</ul>
@endforeach
</div>
@endif
<div class="bb">

<form class="form mx-auto" action="{{route('users.store') }}" enctype="multipart/form-data" method="POST">
@csrf
      
 <div class="row">
    <label for="name" class="col-md-3 col-form-label">Name</label>
    <div class="form-group col-md-9">
      <input type="text" value="{{old('name')}}" name="name" class="form-control" id="name">
      @error('name')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
     </div> 

     <div class="row">
     <label for="email" class="col-md-3 col-form-label">email</label>
    <div  class="form-group col-md-9">
    <input type="email" value="{{old('email')}}" name="email" class="form-control" id="description">
     @error('email')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>


    <div class="row">
    <label for="password" class="col-md-3 col-form-label">password</label>
    <div  class="form-group col-md-9">
    <input type="password" class="form-control" value="{{old('password')}}" name="password" id="password">
     @error('password')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>

    <div class="row">
    <label for="phone" class="col-md-3 col-form-label">phone</label>
    <div class="form-group col-md-9">
      <input type="int" value="{{old('phone')}}" name="phone" class="form-control" id="phone">
      @error('phone')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>


    <div class="row">
    <label for="type" class="col-md-3 col-form-label">type</label>
    <div class="form-group col-md-9">
      <select type="float" value="{{old('type')}}" name="type" class="form-control" id="type">
      <option value="user">User</option>
      <option value="admin">Admin</option>
      <option value="super_admin">Super Admin</option>
      </select>
      @error('type')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>

    <div class="row">
     <label for="user_name" class="col-md-3 col-form-label">user name</label>
    <div  class="form-group col-md-9">
    <input type="text" value="{{old('user_name')}}" name="user_name" class="form-control" id="user_name">
     @error('user_name')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>

    <div class="row">
    <label for="gender" class="col-md-3 col-form-label">gender</label>
    <div class="form-group col-md-9">
      <select  value="{{old('gender')}}" name="gender" class="form-control" id="gender">
      <option value="male">Male</option>
      <option value="female">Female</option>
      </select>
      @error('type')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>


    <div class="row">
      <label for="user_image" class="col-md-3 col-form-label">Image</label>
      <div class="form-group col-md-9">
      <input type="file" value="{{old('user_image')}}" name="user_image" class="form-control" id="user_image">
      @error('user_image')
      <p class="text-danger">{{$message}}</p>
      @enderror
      </div>
      </div>
      
      <div class="row">
     <label for="country" class="col-md-3 col-form-label">country</label>
    <div  class="form-group col-md-9">
    <input type="text" value="{{old('country')}}" name="country" class="form-control" id="country">
     @error('country')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>


 <div class="row">
     <label for="city" class="col-md-3 col-form-label">city</label>
    <div  class="form-group col-md-9">
    <input type="text" value="{{old('city')}}" name="city" class="form-control" id="city">
     @error('city')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>

    <div class="row">
     <label for="address" class="col-md-3 col-form-label">address</label>
    <div  class="form-group col-md-9">
    <input type="text" value="{{old('address')}}" name="address" class="form-control" id="address">
     @error('address')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>


  
    <div class="row">
     <label for="birthday" class="col-md-3 col-form-label">birthday</label>
    <div  class="form-group col-md-9">
    <input type="date" value="{{old('birthday')}}" name="birthday" class="form-control" id="birthday">
     @error('birthday')
      <p class="text-danger">{{$message}}</p>
      @enderror
    </div>
    </div>

  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary ">Create</button>
        </div>

</form>
</div>
@endsection