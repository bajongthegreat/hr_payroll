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



<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrapValidator.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('js/lightbox.min.js') }}"></script>

    <!-- Add fancyBox -->
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css?v=2.1.5') }}" type="text/css" media="screen" />

    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.pack.js?v=2.1.5') }}"></script>


    <!-- Custom plugins by James Mones -->
    <script type="text/javascript" src="{{ asset('jquery/jmfileupload.js') }}"></script>
    <script src="{{ asset('jquery/jmsearcheable.js') }}"></script>

     <script src="{{ asset('jquery/employeeProfileSearcher.js') }}"></script>
     <script type="text/javascript" src="{{ asset('js/jquery.dataTables.js')}}"></script> 

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