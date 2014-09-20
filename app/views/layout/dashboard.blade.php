<script type="text/javascript">
            var timerStart = Date.now();
</script>

<!DOCTYPE html>
<html>
  <head>

    <!-- Styles and other configs -->
    @include('layout.header')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <style type="text/css">
html {
  overflow-x: scroll; /* Prevent scroll on narrow devices */
}
    @yield('styles')
    </style>

    @yield('styles_file')


    @yield('js_top');
  </head>
  <body>

    @include('layout.navigation')

    @yield('header')

    <div class="dashboard-wrapper">
    @yield('not-content')

 

    

    @include('modals.ajax_modal')



    <!-- Main scripts -->
    @include('layout.main_scripts')


    @yield('after_jquery')


    @yield('scripts')


    @yield('sub_scripts')

    @yield('sub_scripts_1')

    <!-- HR Payroll components -->
     <!-- // <script src="{{ asset('jquery/hr_applicants.js') }}"></script> -->
     <script src="{{ asset('assets/js/hr_applicants.js') }}"></script>

     @yield('later_scripts')
     <script type="text/javascript">
      $(document).ready(function() {
                 // $('.load_time').html(Date.now()-timerStart/1000);
                 // $('#page_load_counter').show();
                 $('.b_tooltip').tooltip();
                 console.log('Page load time:' + (Date.now()-timerStart));
             });
     </script>
  </body>
</html>
