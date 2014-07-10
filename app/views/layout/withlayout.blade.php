<script type="text/javascript">
            var timerStart = Date.now();
</script>

<!DOCTYPE html>
<html>
  <head>

    <!-- Styles and other configs -->
    @include('layout.header')

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
        <p class="text-center">TIBUD sa Katibawasan Cooperative &copy;2014</p>
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
