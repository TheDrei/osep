<!-- Modal -->
<div class="modal fade" id="location_region_modal" tabindex="-1" role="dialog" aria-labelledby="location_region_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="location_region_modal_header"></h5>
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
        <div class="form-group {{ $errors->has('location_region_name') ? 'has-error' : '' }}">
          <label for="location_region_name">Region</label>
          <input id="location_region_id" name="location_region_id" class="form-control location-region-field locationlib-field" type="text" hidden>
          <input id="location_region_name" type="text" class="form-control location-region-field locationlib-field" name="location_region_name" value="{{ old('location_region_name') }}" required autocomplete="location_region_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('location_region_name') }}</span>
        </div>
        <div class="form-group">
          <label for="region_number">Region Number</label>
          <input id="region_number" class="form-control location-region-field locationlib-field" type="text" required>
        </div>      
        <div class="form-group">
          <label for="cluster_id">Cluster</label>
          <input id="cluster_id" class="form-control location-region-field locationlib-field" type="text" required>
        </div>    
        <div class="form-group">
          <label for="location_region_tags">Tags</label>
          <input id="location_region_tags" class="form-control location-region-field locationlib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="location_region_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="location_region_is_verified" name="is_verified" class="location-region-field form-check-input locationlib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="location_region_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="location_region_is_active" name="is_active" class="location-region-field form-check-input locationlib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_location_region" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_location_region" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>