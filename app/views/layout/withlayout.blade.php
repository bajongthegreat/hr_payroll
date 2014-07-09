
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
        <p>&copy; Company 2013</p>
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
  </body>
</html>
