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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="modal_save" type="button" class="btn btn-primary" data-status="save" data-dismiss="modal">Accept</button>
      </div>
    </div>
  </div>
</div>