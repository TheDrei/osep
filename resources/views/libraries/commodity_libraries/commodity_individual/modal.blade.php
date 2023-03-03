<!-- Modal -->
<div class="modal fade" id="commodity_individual_modal" tabindex="-1" role="dialog" aria-labelledby="commodity_individual_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commodity_individual_modal_header"></h5>
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
        <div class="form-group {{ $errors->has('commodity_individual_name') ? 'has-error' : '' }}">
          <label for="commodity_individual_name">Commodity Individual</label>
          <input id="commodity_individual_id" name="commodity_individual_id" class="form-control commodity-individual-field commoditylib-field" type="text" hidden>
          <input id="commodity_individual_name" type="text" class="form-control commodity-individual-field commoditylib-field" name="commodity_individual_name" value="{{ old('commodity_individual_name') }}" required autocomplete="commodity_individual_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('commodity_individual_name') }}</span>
        </div>
        <div class="form-group">
          <label for="commodity_group_id">Commodity Group</label>
          <select id="commodity_group_id" name="commodity_group_id" class="form-control commodity-individual-field select2 commoditylib-field" required>
            <option value="" hidden>Select Commodity Group</option>
          </select>
        </div>          
        <div class="form-group">
          <label for="commodity_individual_tags">Tags</label>
          <input id="commodity_individual_tags" class="form-control commodity-individual-field commoditylib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="commodity_individual_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="commodity_individual_is_verified" name="is_verified" class="commodity-individual-field form-check-input commoditylib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="commodity_individual_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="commodity_individual_is_active" name="is_active" class="commodity-individual-field form-check-input commoditylib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_commodity_individual" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_commodity_individual" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>