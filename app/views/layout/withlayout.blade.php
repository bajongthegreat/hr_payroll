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

            <!-- TODO -->

<!--             <div style="border: 1px solid #000;">
                
                <div style="margin: 15px 5px;">
                  <div style="font-size:16px; margin-bottom: 5px;">TODO</div>
                      <span style="margin-bottom: 5px;">Build reports for:</span>
                      <ul>
                        <li>Employee Profile</li>
                        <li>Employee Masterlist ->  <span class="label label-success">Excel done</span></li>
                        <li>SSS Loan - Monthly Report</li>
                        <li>DTR report - (per employee)</li>
                        <li>DTR report - (per position)</li>
                        <li>DTR report - (per department)</li>

                      </ul>
                </div>

            </div>
 -->
          		@yield('content')

 
           
          </div>

    </div><!-- /.container -->

    @include('modals.ajax_modal')

    <footer>
        @yield('footer')
        <p class="text-center">{{ Config::get('company.name.full')}} <strong>({{ Config::get('company.name.acro')}})</strong> <br>HR and Payroll System | &copy;2014</p>
        <!-- <div id="page_load_counter" class="text-center" style="display:none;">Page generated in <span class="load_time"></span> seconds.</div> -->
      </footer>
    
    



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
