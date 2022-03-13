<!DOCTYPE html>
<html>

<head>
    <title>STORE</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}"></link>
    <link rel="stylesheet" href="{{asset('/css/font-awesome.css') }}"></link>
    <link rel="stylesheet" href="{{ asset('/css/backend.css') }}"></link>
</head>

<body>
   
<header class="d-flex">
   <div ><h3 >{{config('app.name')}}</h3></div>
   <div class="ml-auto dashboard">
      <a href="{{route('profile.show')}}">{{Auth::user()->name}}</a>
      <a href="#" onclick="document.getElementById('logout').submit()">Logout</a>
      <form id="logout" class="d-none" action="{{route('logout')}}" method="POST">
         @csrf
      <button type="submit"></button>
      </form>

   </div>

</header>
<div class="container ">
<div class="row ">

<div class="col-md-2 bord ">
<nav class="nav flex-column">
      <button> <a href="{{route('categories.index')}}" class="nav_link active">categories</a></button>
      <button><a href="{{route('products.index')}}" class="nav_link active">Products</a></button>
      <button><a href="{{route('users.index')}}" class="nav_link active">Users</a></button>
      <button><a href="{{route('message')}}" class="nav_link active">Messages</a></button>
      <button><a href="{{route('trash')}}" class="nav_link active">Trash</a></button>

      </nav>
</div>

<div class="col-md-10">
  @yield('content')
</div>

</div> <!--container -->
</div> <!--row -->
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <script src="/js/bootstrap.min.js"></script>
   <!--start pusher -->
   <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

   
     <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('13f3d2c375c98460c8d7', {
      cluster: 'eu',
      authEndpoint:'/broadcasting/auth'

    });

    var channel = pusher.subscribe('private-orders');
    channel.bind('OrderCreated', function(data) {
      alert(JSON.stringify(data));
    });
  </script>

</body>
</html>