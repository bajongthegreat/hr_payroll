    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand nav-icon" href="/"> <img src="{{ asset('img/logo.png') }}"  height="24" width="24" class=""> {{ Config::get('company.name.acro') }}</a>
        </div>


        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">


            <!-- <li class="active"> 
              <a href="{{ asset('/admin')}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
             -->
              <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book"></span> Files <b class="caret"></b></a>
          <ul class="dropdown-menu">
             <li><a href="{{ action("UsersController@index") }}"><span class="glyphicon glyphicon-user"></span>  Users</a></li>
            
                         <!-- <li><a href="{{ action("CompaniesController@index") }}"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Companies</a></li> -->

            <li><a href="{{ action("DepartmentsController@index") }}"><span class="glyphicon glyphicon glyphicon-book"></span>&nbsp;&nbsp;Department</a></li>
            <li><a href="{{ action("PositionsController@index") }}"><span class="glyphicon glyphicon-bookmark"></span>&nbsp;&nbsp;Position</a></li>
            <li><a href="{{ action("HolidaysController@index") }}"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Holidays</a></li>
            <li><a href="{{ action("StageProcessesController@index") }}"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;Stage Process</a></li>
            <li><a href="{{ action("RequirementsController@index") }}"><span class="glyphicon glyphicon-check"></span>&nbsp;&nbsp;Requirements</a></li>

            <li><a href="{{ action("ViolationsController@index") }}"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;Violations</a></li>
            
            <li><a href="{{ action("RatesController@index") }}"> <span class="glyphicon glyphicon-tags"></span> &nbsp; Rates</a></li>


            <li><a href="{{ action("SSSController@index") }}">SSS Contribution table</a></li>
            <li><a href="{{ action("PhilhealthsController@index") }}">Phihealth Contribution table</a></li>
            <li><a href="{{ action("HDMFController@index") }}">HDMF Contribution table</a></li>
          </ul>

           
           
            <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-dashboard"></span> HR <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ action("ApplicantsController@index") }}"><img src="{{ asset('img/icons/32x32/user-2.png') }}" width="16"> Applicant Management</a></li>
            <li><a href="{{ action("EmployeesController@index") }}"><img src="{{ asset('img/icons/32x32/user-card.png') }}" width="16"> Employee Management</a></li>
            <li><a href="{{ action("DisciplinaryActionsController@index") }}"><img src="{{ asset('img/icons/32x32/address-book.png') }}" width="16"> DPC Management</a></li>
            <li><a href="{{ action("EmployeesMedicalExaminationsController@index") }}"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;Physical Examinations</a></li>
            <li><a href="{{ action("LeavesController@index") }}"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Leaves Management</a></li>
            <!-- <li><a href="#">Loans</a></li> -->
          </ul>



           <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-calendar"></span>  Payroll <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ action("DTRController@index") }}"> <span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;  Daily Time Record</a></li>
      
            <li><a href="{{ action('PayrollController@create') }}">Process Payroll </a></li>
            <li><a href="#">Loans</a></li>
          </ul>


            </li>
              


           <li class="dropdown">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-calendar"></span>  Reports <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ action('ReportsController@employee_index') }}"> <span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;  Employee</a></li>
      
            <li><a href="{{ action('PayrollController@create') }}">Process Payroll </a></li>
            <li><a href="#">Loans</a></li>
          </ul>


            </li>



            </ul>
          
               <ul class="nav navbar-nav navbar-right hidden-sm">

             <li class=" dropdown" >
        
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{{  Session::get('email') }}} <b class="caret"></b></a>
              <ul class="dropdown-menu">
                 <li><a href="{{ action('ImportsController@create') }}"><span class="glyphicon glyphicon-import"></span>  Importation</a></li>          
                 <li class="divider"></li>

                 <li><a href="{{ action("UsersController@index") }}"><span class="glyphicon glyphicon-user"></span>  Users</a></li>
                 <li><a href="{{ action("UsersController@edit", Auth::user()->id) }}"><span class="glyphicon glyphicon-lock"></span>  Change Password</a></li>


                 <li class="divider"></li>
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