
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
     <!--  <meta name="csrf-token" content="{{ csrf_token() }}" /> -->
      <title>@yield('title')</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="Ricky Spires">
      
   <!--    <link rel="icon" href="../../favicon.ico">
      <link rel="apple-touch-icon" href="icons/apple-touch-icon.png">
      <link rel="apple-touch-icon" sizes="72x72" href="icons/apple-touch-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="114x114" href="icons/apple-touch-icon-114x114.png">
      
      <link href='http://fonts.googleapis.com/css?family=Bree+Serif|Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'> -->
      <link rel="stylesheet" type="text/css" href="{{ elixir('css/all.css') }}">
      
      @yield('head')
      
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      
  </head>


  <body id="app-layout">

    @include('partials.main_nav') 

    <div class="container">
      @yield('content')
    </div>
    
    <script src="{{ elixir('js/all.js') }}"></script>
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- {!! HTML::script('/assets/js/ie10-viewport-bug-workaround.js') !!} -->
  
  </body>
</html>