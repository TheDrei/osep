<!-- Modal -->
<div class="modal fade" id="commodity_group_modal" tabindex="-1" role="dialog" aria-labelledby="commodity_group_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commodity_group_modal_header"></h5>
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
        <div class="form-group {{ $errors->has('commodity_group_name') ? 'has-error' : '' }}">
          <label for="commodity_group_name">Commodity Group Name</label>
          <input id="commodity_group_id" name="commodity_group_id" class="form-control commodity-group-field commoditylib-field" type="text" hidden>
          <input id="commodity_group_name" type="text" class="form-control commodity-group-field commoditylib-field" name="commodity_group_name" value="{{ old('commodity_group_name') }}" required autocomplete="commodity_group_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('commodity_group_name') }}</span>
        </div>
        <div class="form-group">
          <label for="project_sector_id">Project Sector</label>
          <select id="project_sector_id" class="form-control commodity-group-field select2 commoditylib-field">
            <option value="" selected hidden>Select Project Sector</option>
          </select>
        </div>  
        <div class="form-group">
          <label for="commodity_group_tags">Tags</label>
          <input id="commodity_group_tags" class="form-control commodity-group-field commoditylib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="commodity_group_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="commodity_group_is_verified" name="is_verified" class="commodity-group-field form-check-input commoditylib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="commodity_group_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="commodity_group_is_active" name="is_active" class="commodity-group-field form-check-input commoditylib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_commodity_group" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_commodity_group" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>