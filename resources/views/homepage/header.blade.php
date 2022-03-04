<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}"></link>
    <link rel="stylesheet" href="{{asset('/css/font-awesome.css') }}"></link>
    <!-- Moyasar Styles -->
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.5.4/moyasar.css">
</head>

<body>
<!--<header class="d-flex">
   <div class="ml-auto dashboard">
      <a href="#" onclick="document.getElementById('logout').submit()">Logout</a>
      <form id="logout" class="d-none" action="{{route('logout')}}" method="POST">
         @csrf
      <button type="submit"></button>
      </form>

   </div>

</header>-->


<!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background-color:#000000">
  <!-- Container wrapper -->
  <div class="container-fluid">




    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>
       
    
    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="{{route('homepage.products')}}">
      <h3 >{{config('app.name')}}</h3>
      </a>


      <!-- Left links -->
      <div class="container-fluid">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
      <!-- Dropdown -->
      <!--@lang('app.categories') == {{trans('app.categories')}} == {{__('app.categories')}} if the file is json we write {{__('only the word in the file')}}-->
      
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{__('Categories')}}</a>
      
      <ul class="dropdown-menu">
      @foreach($categories as $category)
      <li>
      <a class="dropdown-item" href="{{route('homepage.products',$category->id)}}">{{$category->name}}</a>
      </li>
      @endforeach
      </ul>

      </li>
       
        <li class="nav-item">
        <a class="nav-link" href="{{route('homepage.products')}}">{{__('Products')}}</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">{{__('About Us')}}</a>
        </li>

      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->





    <!-- Right elements -->

    <div  class="dropdown">
      <!-- Icon -->
        <a class="text-reset me-3 dropdown-toggle hidden-arrow"
           href="{{route('homepage.cart')}}"         
           id="navbarDropdownMenuLink"
           role="button"
           data-mdb-toggle="dropdown"
           aria-expanded="false">
      <svg  xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
       <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
       </svg>
       <span style="margin-left:-20px" class=" badge rounded-pill badge-notification bg-danger">{{$num}}</span>

       </a>
       </div>


      <!-- Notifications -->
      <div class="dropdown">
        <a
          class="text-reset me-3 dropdown-toggle hidden-arrow"
          href="#"
          id="navbarDropdownMenuLink"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" class="bi bi-bell-slash" viewBox="0 0 16 16">
         <path d="M5.164 14H15c-.299-.199-.557-.553-.78-1-.9-1.8-1.22-5.12-1.22-6 0-.264-.02-.523-.06-.776l-.938.938c.02.708.157 2.154.457 3.58.161.767.377 1.566.663 2.258H6.164l-1 1zm5.581-9.91a3.986 3.986 0 0 0-1.948-1.01L8 2.917l-.797.161A4.002 4.002 0 0 0 4 7c0 .628-.134 2.197-.459 3.742-.05.238-.105.479-.166.718l-1.653 1.653c.02-.037.04-.074.059-.113C2.679 11.2 3 7.88 3 7c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0c.942.19 1.788.645 2.457 1.284l-.707.707zM10 15a2 2 0 1 1-4 0h4zm-9.375.625a.53.53 0 0 0 .75.75l14.75-14.75a.53.53 0 0 0-.75-.75L.625 15.625z"/>
        <span style="margin-left:-20px" class="badge rounded-pill badge-notification bg-danger">1</span>

       </svg>
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuLink"
        >
          <li>
            <a class="dropdown-item" href="#">Some news</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Another news</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Something else here</a>
          </li>
        </ul>
      </div>


      <!-- Avatar -->
      <div class="dropdown">
       <li class="nav-item dropdown">
       <a
       class="text-reset me-3 dropdown-toggle hidden-arrow"
          href="{{route('profile.show')}}"  
          data-bs-toggle="dropdown"    
          id="navbarDropdownMenuAvatar"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp"
            class="rounded-circle"
            height="25"
            alt="Black and White Portrait of a Man"
            loading="lazy"
          />
        </a>
      
      <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item" href="#">My profile</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Settings</a>
          </li>
          <li>
            <a class="dropdown-item" href="#">Logout</a>
          </li>

      </ul>
       </li>
      </div>

    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->


@yield('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="/js/bootstrap.min.js"></script>
<!-- Moyasar Scripts -->
<script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
<script src="https://cdn.moyasar.com/mpf/1.5.4/moyasar.js"></script>

</body>
</html>