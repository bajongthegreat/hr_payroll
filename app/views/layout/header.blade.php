    <title>{{ Config::get('company.name.full')}} HR and Payroll @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo URL::to('img/favicon.ico'); ?>">
     <style type="text/css">
    
  
    </style>

    <!-- Bootstrap -->
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}"/>
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/font.css.php')}}" />    
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/main.css')}}" />
    <link href="{{ asset('assets/css/lightbox.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.dataTables.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->