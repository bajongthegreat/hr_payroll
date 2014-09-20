<?php 

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



// Employment Progress
$employment_progress = DB::table('employees')->select( DB::raw('COUNT(*) as count'), DB::raw('YEAR(date_hired) as year') )
                                             ->groupBy(DB::raw('YEAR(date_hired)'))
                                             ->get();

foreach($employment_progress as $i => $ep) { 
  # code...
    $ep_headers[$i] = $ep->year; 
    $ep_values[$i] = $ep->count;
}

$ep_values[0] = 0;
?>

<header>
      <h2 class="wow bounceInDown">Dashboard</h2>
    </header>


    <div class="top-content-grid clearfix">

      <div class="item-container madison col-lg-3 col-md-3 col-sm-6 col-xs-12 wow bounceInLeft">
        <div class="item-icon">
                  <span class="glyphicon glyphicon-user"></span>
        </div>
          <div class="item-count">{{ $employee_count }}</div>
          <div class="item-label">Current Employees</div>
      </div>

       <div class="item-container light-red col-lg-3 col-md-3 col-sm-6 col-xs-12 wow bounceInUp">
         
          <div class="item-icon">
                  <span class=" glyphicon glyphicon-stats"></span>
        </div>

          <div class="item-count">{{ $violator_count }}</div>
          <div class="item-label">Violators</div>
      </div>

       <div class="item-container green-haze col-lg-3 col-md-3 col-sm-6 col-xs-12 wow bounceInDown">
         <div class="item-icon">
                  <span class=" glyphicon glyphicon-plane"></span>
        </div>
          <div class="item-count">{{ $leave_count}}</div>
          <div class="item-label">On-Leave</div>
      </div>

       <div class="item-container purple col-lg-3 col-md-3 col-sm-6 col-xs-12 wow bounceInRight">
         <div class="item-icon">
                  <span class=" glyphicon glyphicon-stats"></span>
        </div>
          <div class="item-count">{{ $pe_count }}</div>
          <div class="item-label">Did Physical Exam</div>
      </div>

    </div>

    <div class="clearfix"></div>

    <div class="activities-container clearfix">

      <div class="recent-activities col-md-5 col-sm-5  wow bounceInLeft ">
        <div class="tab-header"><span class="icon glyphicon glyphicon-tag"></span> <span class="title">Recent Activities</span></div>
        <ul class="activities">
          <li><div class="activity-container"><span class="activity-icon glyphicon glyphicon-tasks"></span> <span class="description">Database server #12 overloaded. Please fix the issue.</span> <span class="date">2014-01-01</span></div></li>
          <li><span class="activity-icon glyphicon glyphicon-tasks"></span> <span class="description">New user registered.</span></li>
          <li><span class="activity-icon glyphicon glyphicon-tasks"></span> <span class="description">Web server hardware needs to be upgraded.</span></li>
          <li><span class="activity-icon glyphicon glyphicon-tasks"></span> <span class="description">You have 4 pending tasks.</span> </li>
        </ul>
      </div>

      <div class="calendar-container col-md-6 col-sm-6  wow bounceInRight ">
        <div class="tab-header">
          <span class="icon glyphicon glyphicon-tag"></span> 
          <span class="title">Calendar</span>
          <span class="button"><a href="{{ action('HolidaysController@create') }}">Add new holiday</a></span>
        </div>
         <div id='calendar'></div>
      </div>


    </div>
    <div class="clearfix"></div>