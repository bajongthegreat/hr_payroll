    <title>{{ Config::get('company.name.full')}} HR and Payroll @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo URL::to('img/favicon.ico'); ?>">
     <style type="text/css">
    
  
    </style>

    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/bootstrap-datetimepicker.min.css')}}"/>
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('styles/pygments-manni.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/main-layout.css.php')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/bootstrapValidator.css')}}"/>
    <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet" />

    <!-- <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'/> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.css') }}">
    <!-- <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->