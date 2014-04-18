<!DOCTYPE html>
<html>
  <head>
    <title>Tibud Cooperative HR and Payroll @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/bootstrap-datetimepicker.min.css')}}"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/pygments-manni.css" />
    <!-- <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
   
    	html {
		  overflow-x: hidden; /* Prevent scroll on narrow devices */
		}
		body {
		  padding-top: 40px;
		}
		footer {
		  padding: 30px 5px;
      margin-left: 8%;
		}
    .logout {
      display: none;
    }
		.bs-table {
		  width: 40%;
		}
    .defdiv{
      margin-top: 25px;
    }
    .ajaxload{
      height: 36px;
    }

    .clickableRow{
      cursor:pointer;
    }

    .page-header {
      color: #003366 !important;

    }

    label {
      font-family: Trebuchet MS, Arial;
      color: #7d7d7d;
    }

    /* Employees CSS*/
    .profile-label{ 
      margin-bottom: 5px;
    }

    #main_search_result a:hover {
    background-color: #f5f5f5;  
    color: #000;

    padding: 5px 3px;
     border-radius: 3px;

      /* For Safari 3.1 to 6.0 */
      -webkit-transition-property:width;
      -webkit-transition-duration:1s;
      -webkit-transition-timing-function:linear;
      -webkit-transition-delay:2s;
      /* Standard syntax */
      transition-property: width;
      transition-duration: 1s;
      transition-timing-function: linear;
      transition-delay: 2s;
    }

    #main_search_result a {
      color: #000;
      text-decoration: none;

    }

    .searchResultItem {
     background-color: #ffffff;
      margin: 4px 0; 
  }
    

     #main_search_result {

      
      margin-top: 3px; 
      position:absolute; 
      display: block;
      min-height: 20px;
      width: 190px;
      
      padding: 6px 12px;
      font-size: 14px;
      line-height: 1.428571429;
      color: #555555;
      vertical-align: middle;
      background-color: #ffffff;
      background-image: none;
      border: 1px solid #cccccc;
      border-radius: 4px;
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
              box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
      -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
              transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;

              height:auto;overflow:scroll
    
      
      /* For Safari 3.1 to 6.0 */
      -webkit-transition-property:width;
      -webkit-transition-duration:1s;
      -webkit-transition-timing-function:linear;
      -webkit-transition-delay:2s;
      /* Standard syntax */
      transition-property: width;
      transition-duration: 1s;
      transition-timing-function: linear;
      transition-delay: 2s;
    }

    @media (max-width: 700px) {
    .pull-right, .pull-left {
      display: block;
      float: none !important;
    }

    .sidebar {
      display:none;
    }
    
    .header-buttons {
      margin-top: 15px;
      text-align: center;
    } 

    #main_search_result {
      width: 510px;  
    }
  }

  @media (min-width: 800px) {
    .logout {
      display: none;
    }
  }

  /*
 * Sidebar
 */

/* Hide for mobile, show la     ter */
.sidebar {
  display: none;
}
@media (min-width: 768px) {
  .sidebar {
    margin-top: 0 !important;
    position: fixed;
    top: 51px;
    bottom: 0;
    left: 0;
    z-index: 1000;
    display: block;
    padding: 20px;
    overflow-x: hidden;
    overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
    background-color: #f5f5f5;
    border-right: 1px solid #eee;
  }

  .table-container {
    margin-left: 125px;
  }

  .settings {
    display: none;
  }

  .logout {
    display: block;
  }

}

/* Sidebar navigation */
.nav-sidebar {
  margin-right: -21px; /* 20px padding + 1px border */
  margin-bottom: 20px;
  margin-left: -20px;
}
.nav-sidebar > li > a {
  padding-right: 20px;
  padding-left: 20px;
}
.nav-sidebar > .active > a {
  color: #fff;
  background-color: #428bca;
}



@media (min-width: 500px) {
  .table-container {
    margin-left: 5px important;
  }

}

.loading {
  padding: 2px;
  width: 30px;
  font-size: 12pt;
  font-style: italic;
}      

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
          <a class="navbar-brand" href="#">TIBUD</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">


            <li class="active"> 
              <a href="{{ asset('/admin')}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>

            
              <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book"></span> Basic Files <b class="caret"></b></a>
          <ul class="dropdown-menu">
             <li><a href="{{ action("UsersController@index") }}"><span class="glyphicon glyphicon-user"></span>  Users</a></li>
      
            <li><a href="{{ action("DepartmentsController@index") }}">Department</a></li>
            <li><a href="{{ action("PositionsController@index") }}">Position</a></li>
            <li><a href="{{ action("SSSController@index") }}">SSS Contribution table</a></li>
            <li><a href="{{ action("PhilhealthsController@index") }}">Phihealth Contribution table</a></li>
            <li><a href="{{ action("HDMFController@index") }}">HDMF Contribution table</a></li>
          </ul>

           
           
            <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-dashboard"></span> HR <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ action("EmployeesController@index") }}">Employee Listing</a></li>
            <li><a href="#">Attendance</a></li>
            <li><a href="#">Loans</a></li>
          </ul>



           <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-calendar"></span>  Payroll <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ action("EmployeesController@index") }}">Salary</a></li>
            <li><a href="#">Payslips</a></li>
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


 <form class="navbar-form navbar-right" role="search">
            <input type="text" class="form-control" placeholder="Quick Lookup..." id="header_search">
           <div id="main_search_result" >.</div>

          </form>


        </div><!--/.nav-collapse -->
      </div>
    </div>

    @yield('header')

    
    <div class="container">

          <!-- Angular view templating -->
          <div class="content" ng-view>



          		@yield('content')

 
           
          </div>

    </div><!-- /.container -->

    <footer>
        @yield('footer')
        <p>&copy; Company 2013</p>
      </footer>

    <script type="text/javascript">
      var mainLink = "{{ route('main') . "/\";"}} 
      var employeeLink = "{{ action('EmployeesController@index') . "\";" }}



      

    </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('js/jquery-1.10.2.js') }}"></script>
    @yield('after_jquery')
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
     <!-- AngularJS -->
    <script src="{{ asset('js/angular.min.js') }}"></script>
   
 

    <script src="{{ asset('jquery/jmsearcheable.js') }}"></script>

     <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    

    <!-- jQuery ScrollTo Plugin -->
    <script src="//balupton.github.io/jquery-scrollto/lib/jquery-scrollto.js"></script>

    <!-- History.js -->
    <script src="//browserstate.github.io/history.js/scripts/bundled/html4+html5/jquery.history.js"></script>


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

    // // Bind to StateChange Event
    // History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
    //     var State = History.getState(); // Note: We are using History.getState() instead of event.state

      
    // });





    </script>
    
    @yield('scripts')
  </body>
</html>
