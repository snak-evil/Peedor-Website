<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Compiled and minified CSS -->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/css/materialize.min.css">

    
</head>
<body>
    <div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper">
          <a href="#!" class="brand-logo">
              <img src="/images/icon/PiiDoor-Logo.png" height="60px">
          </a>
          <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="#"><?=strtoupper('Why PEEDOR')?></a></li>
            <li><a href="#"><?=strtoupper('pricing')?></a></li>
            <li><a href="#"><?=strtoupper('blog')?></a></li>
            <li><a href="#"><?=strtoupper('resourcefule')?></a></li>
          </ul>
        </div>
      </nav>
  </div>

      <ul class="sidenav" id="mobile-demo">
        <li><a href="#">Sass</a></li>
        <li><a href="#">Components</a></li>
        <li><a href="#">Javascript</a></li>
        <li><a href="#">Mobile</a></li>
      </ul>
        
        <main class="py-4">
            @yield('content')
            @include('layouts.footer')
        </main>
</div>
    <!-- Compiled and minified JavaScript -->
    <script src="/js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="/js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.slider').slider({
                fullWidth: true,
                indicators: true
            });
        });
    </script>
</body>
</html>
