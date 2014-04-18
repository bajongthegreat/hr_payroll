<div class="modal fade" id="old_new" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Employee Type</h4>
      </div>
      <div class="modal-body">
        <p>Please select what type of employee you are registering.</p>
      </div>
      <div class="modal-footer">
        <a href="{{ action('EmployeesController@create', ['type' => 'old']) }}" class="btn btn-default">Old </a>
         <a href="{{ action('EmployeesController@create', ['type' => 'new']) }}" class="btn btn-primary">New</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->