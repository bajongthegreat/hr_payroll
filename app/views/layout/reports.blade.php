<script type="text/javascript">
            var timerStart = Date.now();
</script>

<!DOCTYPE html>
<html>
  <head>

    <!-- Styles and other configs -->
    <!-- <title>Tibud Cooperative HR and Payroll @yield('title')</title> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo URL::to('img/favicon.ico'); ?>">
     <style type="text/css">
    
  
    </style>

    <!-- Bootstrap -->
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/font.css.php')}}" />    
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('assets/css/app.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.dataTables.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->    
    <style type="text/css">
html {
  overflow-x: scroll; /* Prevent scroll on narrow devices */
}


.container-non-responsive {
  /* Margin/padding copied from Bootstrap */
  margin-left: auto;
  margin-right: auto;
  padding-left: 15px;
  padding-right: 15px;

  /* Set width to your desired site width */
  width: 2400px;
}
    @yield('styles')
    </style>

    @yield('styles_file')


    @yield('js_top')
  </head>
  <body>



    <div class="container-non-responsive">

          
          		@yield('content')

 
           
          
    </div><!-- /.container -->

    <footer>
        @yield('footer')
        <p class="text-center"><strong>{{ Config::get('company.name.full')}} ({{ Config::get('company.name.acro')}})</strong> HR and Payroll System &copy;2014</p>
        <!-- <div id="page_load_counter" class="text-center" style="display:none;">Page generated in <span class="load_time"></span> seconds.</div> -->
      </footer>
    
    



    <!-- Main scripts -->
    @include('layout.main_scripts')


    @yield('after_jquery')


    @yield('scripts')


    @yield('sub_scripts')

    @yield('sub_scripts_1')

    <!-- HR Payroll components -->
     <script src="{{ asset('jquery/hr_applicants.js') }}"></script>

     @yield('later_scripts')
     <script type="text/javascript">
      $(document).ready(function() {
                 // $('.load_time').html(Date.now()-timerStart/1000);
                 // $('#page_load_counter').show();
                 console.log('Page load time:' + (Date.now()-timerStart));
             });
     </script>
  </body>
</html>
