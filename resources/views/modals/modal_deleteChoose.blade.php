<div class="modal fade modal-del" id="deleteChooseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-side" role="document">
    <div class="modal-content">
      <form action="#" name="deleteChoose" method="POST">
      @csrf
        <input class="choose-items" type="hidden" name="items" value="">
        <div class="modal-header">
          <h4 class="modal-title w-100" id="myModalLabel">{{__('Delete Selected Items')}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">{{__('Are you want to delete this items?')}}</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Cancel')}}</button>
          <button type="subnit" name="submit" class="btn btn-primary">{{__('OK')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>