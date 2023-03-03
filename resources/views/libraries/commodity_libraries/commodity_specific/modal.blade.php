<!-- Modal -->
<div class="modal fade" id="commodity_specific_modal" tabindex="-1" role="dialog" aria-labelledby="commodity_specific_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commodity_specific_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- <div class="row">
          <div class="col">
            <div class="status-message"></div>
          </div>
        </div> --}}
        <div class="form-group {{ $errors->has('commodity_specific_name') ? 'has-error' : '' }}">
          <label for="commodity_specific_name">Commodity Specific</label>
          <input id="commodity_specific_id" name="commodity_specific_id" class="form-control commodity-specific-field commoditylib-field" type="text" hidden>
          <input id="commodity_specific_name" type="text" class="form-control commodity-specific-field commoditylib-field" name="commodity_specific_name" value="{{ old('commodity_specific_name') }}" required autocomplete="commodity_specific_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('commodity_specific_name') }}</span>
        </div>        
        <div class="form-group">
          <label for="commodity_individual_id">Commodity Individual</label>
          <select id="commodity_individual_id" name="commodity_individual_id" class="form-control commodity-specific-field select2 commoditylib-field" disabled>
          </select>
        </div>       
        <div class="form-group">
          <label for="commodity_specific_tags">Tags</label>
          <input id="commodity_specific_tags" class="form-control commodity-specific-field commoditylib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="commodity_specific_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="commodity_specific_is_verified" name="is_verified" class="commodity-specific-field form-check-input commoditylib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="commodity_specific_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="commodity_specific_is_active" name="is_active" class="commodity-specific-field form-check-input commoditylib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_commodity_specific" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_commodity_specific" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>