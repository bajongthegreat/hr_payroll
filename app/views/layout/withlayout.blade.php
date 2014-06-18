
<!DOCTYPE html>
<html>
  <head>
    <title>Tibud Cooperative HR and Payroll @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo URL::to('img/favicon.ico'); ?>">
     <style type="text/css">
    
  
    </style>

    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/bootstrap-datetimepicker.min.css')}}"/>
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('styles/pygments-manni.css')}}" />
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/main-layout.css.php')}}" />
    <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'/>

    <!-- <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">

    @yield('styles')
    </style>

    @yield('styles_file')


    @yield('js_top');
  </head>
  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"> <img src="{{ asset('img/logo.png') }}" height="24" width="30"> TIBUD</a>
        </div>


        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">


            <li class="active"> 
              <a href="{{ asset('/admin')}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>

                <li class="dropdown">

       



            </li>

            
              <!-- <li class="dropdown"> -->

              <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book"></span> Basic Files <b class="caret"></b></a> -->
          <!-- <ul class="dropdown-menu"> -->
             <!-- <li><a href="{{ action("UsersController@index") }}"><span class="glyphicon glyphicon-user"></span>  Users</a></li> -->
 
            <!-- <li><a href="{{ action("SSSController@index") }}">SSS Contribution table</a></li> -->
            <!-- <li><a href="{{ action("PhilhealthsController@index") }}">Phihealth Contribution table</a></li> -->
            <!-- <li><a href="{{ action("HDMFController@index") }}">HDMF Contribution table</a></li> -->
          <!-- </ul> -->

           
           
            <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-dashboard"></span> HR <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ action("CompaniesController@index") }}"><span class="glyphicon glyphicon-user"></span>  Companies</a></li>

            <li><a href="{{ action("DepartmentsController@index") }}">Department</a></li>
            <li><a href="{{ action("PositionsController@index") }}">Position</a></li>
            <li><a href="{{ action("HolidaysController@index") }}"><span class="glyphicon glyphicon-calendar"></span>  Holidays</a></li>
                        <li><a href="{{ action("StageProcessesController@index") }}">Stage Process</a></li>
            <li><a href="{{ action("RequirementsController@index") }}">Requirements</a></li>

            <li><a href="{{ action("EmployeesMedicalExaminationsController@index") }}">Physical Examinations</a></li>
            <li><a href="{{ action("ViolationsController@index") }}">Violations</a></li>
            

            <li><a href="{{ action("ApplicantsController@index") }}">Applicant Management</a></li>
            <li><a href="{{ action("EmployeesController@index") }}">Employee Management</a></li>

             <li><a href="{{ action("LeavesController@index") }}">Leaves Management</a></li>
            <li><a href="#">Loans</a></li>
          </ul>



           <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-calendar"></span>  Payroll <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ action("DTRController@index") }}"> <span class="glyphicon glyphicon-dashboard"></span>  Daily Time Record</a></li>
            <li><a href="#">Process Payroll </a></li>
            <li><a href="#">Loans</a></li>
          </ul>


            </li>
                
            </ul>
          
               <ul class="nav navbar-nav navbar-right hidden-sm">

             <li class=" dropdown" >
        
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{{  Session::get('email') }}} <b class="caret"></b></a>
              <ul class="dropdown-menu">
         
                 <li><a href="#users"><span class="glyphicon glyphicon-wrench"></span>  Settings</a></li> 
                @if (Auth::check() )
                <li> <a href="{{ url('logout')}}"><span class="glyphicon glyphicon-off"></span>  Logout</a> </li>
                @endif
            
              </ul>

            </li>
         


          
          </ul>


 <form class="navbar-form navbar-right" role="search" autocomplete="off">
            <input type="text" class="form-control" placeholder="Quick Lookup..." id="header_search" on>
           <div id="main_search_result" >.</div>

          </form>


        </div><!--/.nav-collapse -->
      </div>
    </div>
    @yield('header')

    
    <div class="container">

          <!-- Angular view templating -->
          <div class="content" ng-view>

            <noscript> 
              <br>
              <br>
              <div  class="alert alert-danger">
                <h3 style="text-align:center;"><span class="glyphicon glyphicon-warning-sign"></span>  In order for the system to run, please turn on your Javascript. </h3>

                    <div class="well">
                      <h4> For Google chrome browsers: </h4>

                      <div>
                        <li>Right click, select "View page Info" </li>
                        <li>Under permissions, move your cursor Javascript</li>
                        <li>Click the caret, it is labeled "Allowed by default" or "Blocked by you"</li>
                        <li>Choose Global default.</li>
                        <li>Refresh your browser.</li>
                      </div>
                    </div>
                </div>
              </div>
            </noscript>             

          		@yield('content')

 
           
          </div>

    </div><!-- /.container -->

    <footer>
        @yield('footer')
        <p>&copy; Company 2013</p>
      </footer>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('js/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('jquery/main.js') }}"></script>

    <script type="text/javascript">
      var mainLink = "{{ route('main') . "/\";"}} 
      var employeeLink = "{{ action('EmployeesController@index') . "\";" }}

      var hrApp = new myApp(mainLink);

     var _globalObj = {{ json_encode(array('_token'=> csrf_token(),
                                           '_baseURL' =>  route('main'),
                                           'loaderImage' => asset('img/loading.gif') 
                                           ) 
                                      ) 
                      }}




    </script>

    @yield('after_jquery')
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('js/lightbox.min.js') }}"></script>
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css?v=2.1.5') }}" type="text/css" media="screen" />
    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.pack.js?v=2.1.5') }}"></script>


    <!-- Custom plugins by James Mones -->
    <script type="text/javascript" src="{{ asset('jquery/jmfileupload.js') }}"></script>
    <script src="{{ asset('jquery/jmsearcheable.js') }}"></script>

     <script src="{{ asset('jquery/employeeProfileSearcher.js') }}"></script>


    <script type="text/javascript">

   $('#header_search').jmSearcheable({
          containerWrapper: '#main_search_result',
          url:  employeeLink,
          urlWithID: true,
          idSeparator: '/',
          idField: 'employee_work_id',
          fadeOut: 'slow',
          format: 'employee_work_id: - :lastname'
      });

    </script>
    
    @yield('scripts')


    @yield('sub_scripts')

    @yield('sub_scripts_1')

    <!-- HR Payroll components -->
     <script src="{{ asset('jquery/hr_applicants.js') }}"></script>

     @yield('later_scripts')
  </body>
</html>
