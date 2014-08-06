   <div class="container-fluid">

          <div class="col-sm-3 col-md-2 sidebar" >
            

            <ul class="nav nav-sidebar">
              <li class="active"><a href="#">Employees</a></li>
              <li ><a href="{{ action('DisciplinaryActionsController@index') }}">DPC</a></li>
              <li><a href="{{ action('EmployeesMedicalExaminationsController@index') }}">Physical Examination</a></li>
              <li><a href="{{ action('LeavesController@index') }}">Leaves</a></li>

              <li> 
                   <div class="filter-collection well" style="margin: 3px;">
          
                    <div class="filter-title" style="font-size: 16px; font-weight: bold;"> Filter by:</div>
                    <div class="filter-content"> 

                        @include('employees.partial.filterby')
                       
                    </div> <!-- Filter content -->
                    
                  </div>
            </li>
            </ul>
            
          </div>

  </div>