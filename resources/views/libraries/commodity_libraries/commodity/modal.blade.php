<!-- Modal -->
<div class="modal fade" id="commodity_modal" tabindex="-1" role="dialog" aria-labelledby="commodity_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commodity_modal_header"></h5>
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
        <div class="form-group {{ $errors->has('commodity_name') ? 'has-error' : '' }}">
          <label for="commodity_name">Commodity Name</label>
          <input id="commodity_id" name="commodity_id" class="form-control commodity-field commoditylib-field" type="text" hidden>
          <input id="commodity_name" type="text" class="form-control commodity-field commoditylib-field" name="commodity_name" value="{{ old('commodity_name') }}" required autocomplete="commodity_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('commodity_name') }}</span>
        </div>
        <div class="row">
          <div class="form-group col">
            <label for="project_sector_id">Project Sector</label>
            <select id="project_sector_id" name="project_sector_id" class="form-control commodity-field select2 commoditylib-field">
              <option value="" selected hidden>Select Project Sector</option>
            </select>
          </div>
          <div class="form-group col">
            <label for="commodity_group_id">Commodity Group</label>
            <select id="commodity_group_id" name="commodity_group_id" class="form-control commodity-field select2 commoditylib-field" required>
              <option value="" hidden>Select Commodity Group</option>
            </select>
          </div>   
        </div>   
        <div class="row">
          <div class="form-group col">
            <label for="commodity_individual_id">Commodity Individual</label>
            <select id="commodity_individual_id" name="commodity_individual_id" class="form-control commodity-field select2 commoditylib-field" disabled>
            </select>
          </div>
          <div class="form-group col">
            <label for="commodity_specific_id">Commodity Specific</label>
            <select id="commodity_specific_id" name="commodity_specific_id" class="form-control commodity-field select2 commoditylib-field" disabled>     
            </select>
          </div>         
        </div>     
        <div class="form-group">
          <label for="commodity_tags">Tags</label>
          <input id="commodity_tags" class="form-control commodity-field commoditylib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="commodity_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="commodity_is_verified" name="is_verified" class="commodity-field form-check-input commoditylib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="commodity_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="commodity_is_active" name="is_active" class="commodity-field form-check-input commoditylib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_commodity" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_commodity" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>