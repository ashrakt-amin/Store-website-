<!DOCTYPE html>
<html>
<head>
    <title>Store</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}"></link>
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}"></link>
    <link rel="stylesheet" href="{{ asset('/css/backend.css') }}"></link>
</head>

<body class="bg-dark  text-white position-relative">

<div class="container">
  @yield('content')
</div>
   <script src="/js/bootstrap.min.js"></script>
</body>
</html>