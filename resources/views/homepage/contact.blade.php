@extends('homepage.header')
@section('content')

<div class="card mb-3 mx-auto contact shadow p-3 mb-5 bg-body rounded" style="max-width:800px;">
  <div class="row g-0">
    <div class="col-md-6">
      <img  src="{{ asset('images/image1.jpg') }}" class="img-fluid rounded-start contactImage" alt="...">
    </div>
    <div class="col-md-6 ">
      <div class="card-body ">
        <h5 class="card-text d-flex justify-content-center">Contact Us</h5>
        <p class="card-text" style="color:darkgreen">Please Tell Us About Your  think of our site Or Anny Questions,, Do not Forget To Register </p>
        <p class="card-text" ><small class="text-muted"></small></p>
        <div class="container">
            <form action="{{route('contact.store')}}" method="POST" class="form ">
             @csrf           
			   <textarea class="form-control"  required ='required' placeholder="message" name ="message"></textarea>
               <div class="col-xs-12 col-sm-12 col-md-12 text-center">
               <button type="submit" class="btn btn-success "  value="Send">Create</button>
        </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>


		
         @endsection