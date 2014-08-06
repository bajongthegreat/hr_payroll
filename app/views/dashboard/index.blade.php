<?php 
$new_employees_count = DB::table('employees')->where(DB::raw('MONTH(created_at)'), '=', date('m') )
                                             ->where(DB::raw('YEAR(created_at)'), '=', date('Y') )
                                             ->count(); 

$employee_count = DB::table('employees')->count();
$pe_count = DB::table('employees_physical_examinations')->where(DB::raw('YEAR(date_conducted)'), '=', date('Y'))->count();
$violator_count = DB::table('disciplinary_actions')->where(DB::raw('YEAR(violation_date)'), '=', date('Y'))->groupBy('employee_id')->count();
$leave_count = DB::table('leaves')->where(DB::raw('YEAR(start_date)'), '=', date('Y'))->where('status', '=', 'approved')->count();


$on_leave = DB::table('leaves')->orWhere(function($query) {


$date= date('Y-m-d');


  $query->where('start_date', '=', DB::raw('CURDATE() ') );
  $query->where('end_date', '=', DB::raw('CURDATE() '));

})->groupBy('employee_id')->where('status', 'Approved')->count();

if (!$on_leave) $on_leave = 0;
if (!$violator_count) $violator_count = 0;
if (!$leave_count) $leave_count = 0;

$holidays = DB::table('holidays')->where(DB::raw('MONTH(holiday_date)'), '=', date('m'))
                                 ->where(DB::raw('YEAR(holiday_date)'), '=', date('Y'))
                                 ->get();


?>
<!DOCTYPE html>
<html lang="en">
  <head>

   <!-- Styles and Other configs -->
   @include('layout.header')

  </head>

  <body>

    <!-- Navigation -->
    @include('layout.navigation')

    <style type="text/css">
      .legend {

        border: 1px solid #AAA;
      }
    </style>
    <script type="text/javascript">
      var pe_count = {{ $pe_count or 0}};
      var violator_count = {{ $violator_count or 0}};
      var leave_count = {{ $leave_count or 0}};
    </script>
<br><br>   
    <!-- Main -->
<div class="container">
<div class="row">
  <div class="col-md-3">
      <!-- Left -->
      <h3>Currently showing</h3>
      <hr>
      <ul class="nav nav-pills nav-stacked">
        <li class="nav-header"></li>
        <li class="active"><a href="#" title="HR report">HR report</a></li>
        
      </ul>

      <br><br>
       <h3>Quick Start</h3>
                      <hr>
      <div class="panel">
                    
                  <div class="panel-content">
                    
                      <div class="btn-group btn-group-justified">
                        <a href="{{ action('DisciplinaryActionsController@index') }}" class="btn btn-primary col-sm-3">
                          <i class="glyphicon glyphicon-cloud"></i>
                          <p>DPC</p>
                        </a>
                        <a href="{{ action('EmployeesMedicalExaminationsController@index') }}" class="btn btn-primary col-sm-3">
                          <i class="glyphicon glyphicon-plus"></i>
                          <p>P.E</p>
                        </a>
                        <a href=" {{ action('LeavesController@index') }}" class="btn btn-primary col-sm-3">
                          <i class="glyphicon glyphicon-cog"></i>
                          <p>Leaves</p>
                        </a>
                        <a href=" {{ action('EmployeesController@index') }}" class="btn btn-primary col-sm-3">
                          <i class="glyphicon glyphicon-question-sign"></i>
                          <p>Emp</p>
                        </a>
                      </div>
                  </div><!--/panel content-->
              </div><!--/panel-->
              

    </div><!-- /span-3 -->
    <div class="col-md-9">
        <!-- Right -->
        
        <h3><span class="glyphicon glyphicon-dashboard"></span> My Dashboard</h3>  
             
        <hr>
      
    <div class="row">
          <div class="col-md-6">
        <div class="well"><strong>On Leave</strong> <span class="badge pull-right"> {{ $on_leave }}</span></div>
        <div class="well"><strong>Suspended</strong> <span class="badge pull-right">0</span></div>
              
                
              
              <div class="panel panel-default">
                  <div class="panel-heading">Employee Summary</div>
  
                  <div class="container">
                      <div class="row top-down-margin-5">
                        <span class="col-md-3"> New </span>
                        <span class="col-md-3"> <span class="badge">{{$new_employees_count}}</span></span>
                      </div>

                      <div class="row top-down-margin-5">
                        <span class="col-md-3"> Total employees</span>
                        <span class="col-md-3"> <span class="badge">{{$employee_count}}</span></span>
                      </div>
                      
                      <div class="row top-down-margin-5">
                          <span class="col-md-4">
                            <hr>
                          </span>
                      </div>

                      <canvas id="hr_summary" width="350" height="200"></canvas>  
                     

                    <div class="legend text-center" style="max-width: 365px; padding: 5px;">                           
                      <div class="row top-down-margin-5" style="margin-left: 10px">
                        <span class="col-md-5 text-right"> <span style="background: #F7464A;"></span> Who took P.E</span>
                        <span class="col-md-5"> <span class="badge">{{ $pe_count }}</span> </span>
                      </div>

                      <div class="row top-down-margin-5" style="margin-left: 10px">
                        <span style="background:#46BFBD; " class="col-md-5 text-right"> Violated a rule</span>
                        <span class="col-md-5"> <span class="badge">{{ $violator_count }}</span> </span>
                      </div>

                      <div class="row top-down-margin-5" style="margin-left: 10px ">
                        <span style="background: #FDB45C;" class="col-md-5 text-right"> Filed a leave</span>
                        <span  class="col-md-5"> <span class="badge">{{ $leave_count }}</span> </span>
                      </div>

                      </div>

                      <br>
                  </div>

               </div><!--/panel-->
              
              
              <div class="panel panel-default hidden" >
                  <div class="panel-heading">Charts</div>
                  <div class="panel-body"><img src="http://www.wired.com/playbook/wp-content/uploads/2012/08/data-tracking-run-chart.jpg" class="img-responsive"></div>
              </div><!--/panel-->
              
            </div>
          <div class="col-md-6">
        <div class="panel panel-default">
                  <div class="panel-heading">Events (Current Month)</div>
                  <div class="panel-body">
                    <div class="container">
                    @if (count($holidays) == 0) 
                      <div class="top-down-margin-5">
                          <span >No holidays for this month.</span>
                      </div>
                    @else
                      <ul>
                        @foreach($holidays as $holiday)
                        <?php 
                          $holiday_date = new DateTime($holiday->holiday_date);
                        ?>
                          <li>{{ $holiday->name}} will be on {{ $holiday_date->format('F d, Y') }} </li>
                        @endforeach
                      </ul>
                    @endif
                    </div>
                  </div>
                </div>
              
                <div class="panel panel-default hidden">
                  <div class="panel-heading">
                        <div class="panel-title">
                        <i class="glyphicon glyphicon-chevron-up chevron"></i>
                      <i class="glyphicon glyphicon-wrench pull-right"></i>
                        Form
                        </div>
                  </div>
                  <div class="panel-body">

                      <form class="form form-vertical">
                       
                        <div class="control-group">
                          <label>Name</label>
                          <div class="controls">
                           <input type="text" class="form-control" placeholder="Enter Name">
                          </div>
                        </div>      
                        
                        <div class="control-group">
                          <label>Label</label>
                          <div class="controls">
                           <input type="password" class="form-control" placeholder="Password">
                          
                          </div>
                        </div>   
                        
                        <div class="control-group">
                          <label>Text</label>
                          <div class="controls">
                            <textarea class="form-control"></textarea>
                          </div>
                        </div> 
                             
                        <div class="control-group">
                          <label>Select</label>
                          <div class="controls">
                             <select class="form-control"><option>options</option></select>
                          </div>
                        </div>    
                        
                        <div class="control-group">
                            <label></label>
                          <div class="controls">
                          <button type="submit" class="btn btn-primary">
                              Post
                            </button>
                          </div>
                        </div>   
                        
                      </form>
                
                
                  </div><!--/panel content-->
                </div><!--/panel-->
              
                <div class="panel panel-default">
                  <div class="panel-heading"><div class="panel-title">Engagement</div></div>
                  <div class="panel-body">  
                
                  <canvas id="myChart" width="350" height="300"></canvas>  
                  
                  </div>
               </div><!--/panel-->
              
              
                <i class="icon-bar-chart icon-3x"></i>
                <i class="icon-plus icon-3x"></i>
                <i class="icon-facebook icon-3x"></i>
                <i class="icon-beaker icon-3x"></i>
                <i class="icon-twitter icon-3x"></i>
                
              
      </div><!--/col-span-6-->
     
      </div><!--/row-->
    </div><!--/col-span-9-->
</div>
</div>
<!-- /Main -->

<footer><strong>TIBUD sa Katibaasan Multi-Purpose Cooperative (TSKMPC)</strong> HR & Payroll System | &copy 2014</footer>

<div class="modal" id="addWidgetModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Add Widget</h4>
      </div>
      <div class="modal-body">
        <p>Add a widget stuff here..</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dalog -->
</div><!-- /.modal -->


    <!-- Main scripts -->
    @include('layout.main_scripts')

    <script type="text/javascript" src="{{ asset('js/Chart.min.js') }}"></script>

    <script type="text/javascript">
      // Get the context of the canvas element we want to Select
      var ctx = document.getElementById("myChart").getContext("2d");
      
      var data = {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [
              {
                  label: "My First dataset",
                  fillColor: "rgba(220,220,220,0.5)",
                  strokeColor: "rgba(220,220,220,0.8)",
                  highlightFill: "rgba(220,220,220,0.75)",
                  highlightStroke: "rgba(220,220,220,1)",
                  data: [65, 59, 80, 81, 56, 55, 40]
              },
              {
                  label: "My Second dataset",
                  fillColor: "rgba(151,187,205,0.5)",
                  strokeColor: "rgba(151,187,205,0.8)",
                  highlightFill: "rgba(151,187,205,0.75)",
                  highlightStroke: "rgba(151,187,205,1)",
                  data: [28, 48, 40, 19, 86, 27, 90]
              }
          ]
      };

      var myBarChart = new Chart(ctx).Bar(data);
    </script>

    <script type="text/javascript">
      // Get the context of the canvas element we want to Select
      var pie = document.getElementById("hr_summary").getContext("2d");
    
    var _data = [
        {
            value: pe_count,
            color:"#F7464A",
            highlight: "#FF5A5E",
            label: "Who took P.E"
        },
        {
            value: violator_count,
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: "Violated a rule"
        },
        {
            value: leave_count,
            color: "#FDB45C",
            highlight: "#FFC870",
            label: "Filed a leave"
        }
    ];

    // For a pie chart
    var myPieChart = new Chart(pie).Pie(_data);

    </script>

  </body>
</html>
