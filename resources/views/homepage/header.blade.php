<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}"></link>
    <link rel="stylesheet" href="{{asset('/css/font-awesome.css') }}"></link>
    <link rel="stylesheet" href="{{ asset('/css/backend.css') }}"></link>

    <!-- Moyasar Styles -->
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.5.4/moyasar.css">

    <link rel="stylesheet" media="all" href="https://cdn.shopify.com/shopifycloud/brochure/assets/application-15065a20bcc439ed82721b3579f52386963fffcf5dc3a07b645272d0f9832fef.css" />
    <link rel="stylesheet" media="screen" href="https://cdn.shopify.com/shopifycloud/brochure/assets/manifests/about-acf30d40008e759a13f0a6665b0687e6380f781bc68bc1299be8d56bd43161a0.css" />    <meta property="fb:app_id" content="847460188612391">


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
<nav class="navbar navbar-expand-lg" style="background-color:#000000 ;height:70px">
  <!-- Container wrapper -->
  <div class="container-fluid">
    
    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="{{route('homepage.products')}}">
      <h4 style="color:blue">{{config('app.name')}}</h4>
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
      <a class="dropdown-item" href="{{route('homepage.category', $category->id)}}">{{$category->name}}</a>
      </li>
      @endforeach
      </ul>

      </li>
       
        <li class="nav-item">
        <a class="nav-link" href="{{route('homepage.products')}}">{{__('Products')}}</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{route('homepage.about')}}">{{__('About Us')}}</a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link" href="{{route('homepage.create')}}">{{__('Contact Us')}}</a>
        </li>

      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->





    <!-- Right elements -->
    
        <!-- start localization -->

    <div  class="dropdown">
      <ul>

       <li class="nav-item dropdown" style="color:blue">
        <a  class="text-reset me-3 dropdown-toggle" data-bs-toggle="dropdown" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false" >
          {{ Config::get('languages')[App::getLocale()]}}
        </a>
        <ul class="dropdown-menu dropleft">
          @foreach (Config::get('languages') as $lang => $language)
          @if ($lang != App::getLocale())
          <li>
          <a class="dropdown-item" href="{{route('lang.switch', $lang) }}"> {{$language}}</a>
          </li>
          @endif
          @endforeach
        </ul>
       </li>

      </ul>
    </div>

             <!-- end localization -->


      <!-- Notifications -->
     <x-Notifications/>
      <!-- end Notifications -->
   
            <!-- cart -->

     
    <div  class="dropdown">
      <ul>
      <li class="nav-item dropdown" style="color:blue">

      <a class="nav-link dropdown-toggle"
         href="{{route('homepage.cart')}}"         
          aria-expanded="false" style="color:blue">
         <svg  xmlns="http://www.w3.org/2000/svg" width="40" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
         <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
         </svg>
         <span style="margin-left:-20px" class=" badge rounded-pill badge-notification bg-danger">{{$num}}</span>
     </a>

     <ul class="dropdown-menu dropleft">
        
        </ul>
       </li>
     </ul>
    </div>
 
                 <!-- end cart -->

      <!--<div class="dropdown">
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
      </div>-->


      <!-- Avatar -->

      <div class="dropdown">
      <ul>
      <li class="nav-item dropdown">

       <a
       class="text-reset me-3 dropdown-toggle"
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
     
      
      <ul class="dropdown-menu dropleft">
          <li>
            <a class="dropdown-item" href="{{route('profile.show')}}">{{__('My Profile')}}</a>
          </li>
          <li>
            <a class="dropdown-item" href="{{route('profile.show')}}">{{__('Sittings')}}</a>
          </li>
          <li>
            <a class="dropdown-item" href="{{route('logout')}}">{{__('Logout')}}</a>
          </li>

      </ul>

       </li>
       </ul>
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



<footer  id="ShopifyMainFooter" style="background-color:black ;margin-top:60px" >
  <h2 class="visuallyhidden">More resources</h2>
  <div class="footer-top">
  <div class="grid">
    <div class="grid__item">
        <nav class="footer-nav">
          <ul class="footer-nav__list" role="list">
              <li class="footer-nav__list-item">
                <a href="{{route('homepage.products')}}">{{__('Products')}}</a>
              </li>
              <li class="footer-nav__list-item">
                <a href="{{route('homepage.about')}}">{{__('About Us')}}</a>
              </li>
              <li class="footer-nav__list-item">
                <a  href="{{route('homepage.create')}}">{{__('Contact Us')}}</a>
              </li>
            
          </ul>
        </nav>
</div>
    
        <div class="grid__item grid__item--mobile-up-half grid__item--tablet-up-3">
      <h3 class="footer-subhead heading--5 ">Online store</h3>
      <div class="gutter-bottom--mobile footer__3-column-list">
        <ul role="list">
            <li>
              <a class="footer-link" href="">Sell online</a>
            </li>
            <li>
              <a class="footer-link" href="">Features</a>
            </li>
            <li>
              <a class="footer-link" href="">Examples</a>
            </li>
            <li>
              <a class="footer-link" href="">Website editor</a>
            </li>
            <li>
              <a class="footer-link" href="">Online retail</a>
            </li>
           
        </ul>
</div></div>    <div class="grid__item grid__item--mobile-up-half grid__item--tablet-up-1">
      <h3 class="footer-subhead heading--5 ">Point of sale</h3>
      <div class="gutter-bottom--mobile footer__-column-list">
        <ul role="list">
            <li>
              <a class="footer-link" href="">Point of sale</a>
            </li>
            <li>
              <a class="footer-link" href="">Features</a>
            </li>
            <li>
              <a class="footer-link" href="">Hardware</a>
            </li>
        </ul>
</div></div>    <div class="grid__item grid__item--mobile-up-half grid__item--tablet-up-1">
      <h3 class="footer-subhead heading--5 ">Support</h3>
      <div class="gutter-bottom--mobile footer__-column-list">
        <ul role="list">
            <li>
              <a class="footer-link" href="">24/7 support</a>
            </li>
            <li>
              <a class="footer-link" href="">Shopify Help Center</a>
            </li>
            <li>
              <a class="footer-link" href="">Shopify Community</a>
            </li>
           
        </ul>
        </div>
     </div> 
   <div class="grid__item grid__item--mobile-up-half grid__item--tablet-up-1">
      <h3 class="footer-subhead heading--5 ">Shopify</h3>
      <div class="gutter-bottom--mobile footer__-column-list">
        <ul role="list">
            <li>
              <a class="footer-link" href="/contact">Contact</a>
            </li>
            <li>
              <a class="footer-link" href="">Partner program</a>
            </li>
           
        </ul>
</div></div>
    

</div></div>

</footer>


  
<script src="https://cdn.shopify.com/shopifycloud/brochure/bundles/latest/runtime-fe8e668df62dc1cd1ad3d7b94ff800d255685fc38844115180cf2233a888f1db.js"></script>
<script src="https://cdn.shopify.com/shopifycloud/brochure/bundles/latest/vendor-bcb652bef5527e10d0022d3e2d2244de6e9c1e78e387ee7c52c94ec09887c24d.js"></script>
<script src="https://cdn.shopify.com/shopifycloud/brochure/bundles/latest/manifests/about-2aee07e099478091856b3e7cbc2f2e11ccba4d227c40942ea344010d5089eb0b.js"></script>  
<!--<script src="{{ asset('/css/js/main.js') }}"></script>

</body>
</html>