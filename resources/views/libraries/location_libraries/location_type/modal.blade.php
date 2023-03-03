<!-- Modal -->
<div class="modal fade" id="location_type_modal" tabindex="-1" role="dialog" aria-labelledby="location_type_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="location_type_modal_header"></h5>
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
        <div class="form-group {{ $errors->has('location_type_name') ? 'has-error' : '' }}">
          <label for="location_type_name">Type</label>
          <input id="location_type_id" name="location_type_id" class="form-control location-municipality-field locationlib-field" type="text" hidden>
          <input id="location_type_name" type="text" class="form-control location-municipality-field locationlib-field" name="location_type_name" value="{{ old('location_type_name') }}" required autocomplete="location_type_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('location_type_name') }}</span>
        </div>        
        <div class="form-group">
          <label for="location_type_tags">Tags</label>
          <input id="location_type_tags" class="form-control location-municipality-field locationlib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="location_type_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="location_type_is_verified" name="is_verified" class="location-municipality-field form-check-input locationlib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="location_type_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="location_type_is_active" name="is_active" class="location-municipality-field form-check-input locationlib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_location_type" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_location_type" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>