@extends('layout.dashboard')



@section('styles_file')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fullcalendar.min.css') }}">
@stop


@section('not-content')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">

<div class="dashboard-sidebar col-md-2 col-xs-12 col-sm-12 ">


  <ul>
    <li class="active wow slideInLeft"><a href="#main" data-type="main" data-location="{{ route('dashboard_main')}}"><h3><div class="glyphicon glyphicon-home"></div></h3>Dashboard</a></li>
     <li class="wow slideInRight"><a href="#reports" data-type="reports" data-location="{{ route('dashboard_reports')}}"><h3><div class="glyphicon glyphicon-folder-close"></div></h3>Reports</a></li>
     <li class="wow slideInLeft"><a href="#" data-type="settings" data-location="settings"><h3><div class="glyphicon glyphicon-cog"></div></h3>Settings</a></li>
  </ul>

</div>

<div class="dashboard-main-content  col-md-10 ">


  <div class="canHaveAjaxContent">
    

  </div>

  <div class="loading" style="display:none;">Loading Content. Please wait...</div>




 <footer class="dashboard-footer">
        @yield('footer')
        <p class="text-center">{{ Config::get('company.name.full')}} <strong>({{ Config::get('company.name.acro')}})</strong> <br>HR and Payroll System | &copy;2014</p>
        <!-- <div id="page_load_counter" class="text-center" style="display:none;">Page generated in <span class="load_time"></span> seconds.</div> -->
  </footer>
    
  


</div>

 

@stop


@section('sub_scripts')
<script type="text/javascript" src="{{ asset('assets/js/wow.js')}}"></script>
<script src='{{asset("assets/js/fullcalendar.min.js")}}'></script>
<script type="text/javascript">
 new WOW().init();

(function(){
   setTimeout(function(){


    $('#calendar').fullCalendar({
      handleWindowResize: true,
      changeView: 'month ',
      events: '{{ action('HolidaysController@index')}}?fullcalendar=true',
    });
   },500);
})();
</script>
@stop