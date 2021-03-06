<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('js/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
   <script src="{{ asset('assets/js/sub-scripts.js') }}"></script>

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
    <script src="{{ asset('js/lightbox.min.js') }}"></script>

    <!-- Add fancyBox -->
    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.pack.js?v=2.1.5') }}"></script>


    <!-- Custom plugins by James Mones -->

    <script type="text/javascript" src="{{ asset('assets/js/jmfileupload.js') }}"></script>
    <script src="{{ asset('assets/js/jmsearcheable.js') }}"></script>

     <script src="{{ asset('assets/js/employeeProfileSearcher.js') }}"></script>
     <script type="text/javascript" src="{{ asset('js/jquery.dataTables.js')}}"></script> 

    <script type="text/javascript">

   $('#header_search').jmSearcheable({
          containerWrapper: '#main_search_result',
          url:  employeeLink,
          urlWithID: true,
          idSeparator: '/',
          idField: 'employee_work_id',
          fadeOut: 'slow',
          format: 'employee_work_id: - :lastname, :firstname',
          itemIcon: _globalObj._baseURL + "/img/default-avatar.png",
          limit: 10,
          loaderImage: _globalObj.loaderImage,
      });

    </script>