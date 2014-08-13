<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Are you sure to perform this?</h4>
      </div>
      <div class="modal-body">
        Are you sure to <span id="modal_body_content"></span> this <span id="itemtype"></span>?
      </div>
      <div class="modal-footer">
        <div class="col-md-5">
          <div class='input-group date'  data-date-format="YYYY-MM-DD">
            <input type="text" class="form-control requirement_date" data-date-format="YYYY-MM-DD" value="{{ date('Y-m-d')}}">
            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
          </div>
        </div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="modal_save" type="button" class="btn btn-primary" data-status="save" data-dismiss="modal">Accept</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="requirement-modal-multiple" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Requirements Management</h4>
      </div>
      <div class="modal-body requirement-modal ">
        
      </div>
      <div class="modal-footer">
        <div class="col-md-5">
          <div class='input-group date'  data-date-format="YYYY-MM-DD">
            <input type="text" class="form-control requirement_date_m" data-date-format="YYYY-MM-DD" value="{{ date('Y-m-d')}}">
            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
          </div>
        </div>
        <button type="button" class="btn btn-default close-refresh" data-dismiss="modal">Close</button>
        <button id="modal_save_multiple" type="button" class="btn btn-primary" data-status="save" >Accept</button>
      </div>
    </div>
  </div>
</div>