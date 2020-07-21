<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>e-Yantra TCP</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{!! asset('css/mystyle.css') !!}?{{ time() }}" rel='stylesheet' type='text/css' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="{!! asset('js/responsiveslides.min.js') !!}"></script>

    <!-- Compiled and minified JavaScript -->
  @yield('style')
</head>
<body>
  @include('layouts.nav')
  @yield('content')
  @include('layouts.footer')
  @yield('script')
  <script type="text/javascript">
    $(document).ready(function(){
            $(".dropdown-trigger").dropdown({ hover: false,constrainWidth: false, coverTrigger: false});
             $('.sidenav').sidenav();
        });

  </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-145861739-6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-145861739-6');
</script>
</body>
</html>