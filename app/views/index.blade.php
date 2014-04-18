
<!DOCTYPE html>
<html ng-app="app">
  <head>
    <title>My Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/bootstrap-datetimepicker.min.css')}}"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/pygments-manni.css" />
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

<div ng-view></div>		



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('js/jquery-1.10.2.js') }}"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
     <!-- AngularJS -->
    <script src="{{ asset('js/angular.min.js') }}"></script>
    // <script src="{{ asset('js/angular-route.js') }}"></script>
   
 
   <script src="{{ asset('angular/main.js') }}"></script>
      <script src="{{ asset('jquery/main.js') }}"></script>


     <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>

    
    @yield('scripts')
  </body>
</html>



  <script>
    angular.module("app").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>');
  </script>

