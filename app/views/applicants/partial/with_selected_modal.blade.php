<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
         <div class='input-group date col-sm-5 hidden' id='date_hired_container'>
            <span class="input-group-addon">Hire date</span>
            {{ Form::text('date_hired', date('Y-m-d'), array('class' => 'form-control date', 'data-format' => "YYYY-MM-DD", 'id' => 'date_hired') ) }}
           
          </div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save">Save changes</button>
      </div>
    </div>
  </div>
</div>