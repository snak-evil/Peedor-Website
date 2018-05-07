
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
  <style>
    #app{
        width:100%;
    }
    a{
        text-decoration:none;
        width: 100%;
    }
    .navigation-drawer{
        width: 200px !important;
        margin-top: 40px !important;
    }
    .toolbar__content{
        height: 40px !important;
    }
    main.content{
        width: 100%;
    }
    ul.breadcrumbs li a,ul.breadcrumbs li{
        color:#333 !important;
    }
    * {
  font-family: 'Arial';
  font-size: 12px;
}


.btn-img {
  background-color: #d3394c;
  border: 0;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-weight: bold;
  padding: 15px 35px;
  position: relative;
}

.btn-img:hover {
  background-color: #722040;
}

input[type="file"] {
  position: absolute;
  opacity: 0;
  z-index: -1;
}

.align-center {
  text-align: center;
}

.helper {
  height: 100%;
  display: inline-block;
  vertical-align: middle;
  width: 0;
}

.hidden {
  display: none !important;
}

.hidden.image {
  display: inline-block !important;
}

.display-inline {
  display: inline-block;
  vertical-align: middle;
}

.img {
  border: 1px solid #f6f6f6;
  display: inline-block;
  height: auto;
  max-height: 80%;
  max-width: 80%;
  width: auto;
}

.drop {
  background-color: #f2f2f2;
  border: 1px dashed #ccc;
  background-color: #f6f6f6;
  border-radius: 2px;
  padding: 15px;
  height: 100%;
  max-height: 400px;
  max-width: 600px;
  width: 100%;
}

  </style>
    </head>
    <body>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div id="app"></div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </body>

</html>

