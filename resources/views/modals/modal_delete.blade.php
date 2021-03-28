<div class="modal fade right modal-del" id="sideModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-side" role="document">
    <div class="modal-content">
    <form action="#" name="deleteChoose" method="POST">
      @csrf
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">{{__('Delete')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">{{__('Are you want to delete this item?')}}</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
        <button type="submit" class="btn btn-primary">{{__('OK')}}</button>
      </div>
    </div>
    </form>
  </div>
</div>