<!-- Modal -->
<div class="modal fade" id="location_municipality_modal" tabindex="-1" role="dialog" aria-labelledby="location_municipality_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="location_municipality_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="location_municipality_name">Municipality</label>
          <input id="location_municipality_id" name="location_municipality_id" class="form-control location-municipality-field locationlib-field" type="text" hidden>
          <input id="location_municipality_name" type="text" class="form-control location-municipality-field locationlib-field" name="location_municipality_name" value="{{ old('location_municipality_name') }}" required autocomplete="location_municipality_name" autofocus required>           
          <span class="text-danger"><small id="municipality-name-error" class="error"></small></span>
        </div>
        <div class="form-group">
          <label for="disctict_id">District</label>
          <input id="disctict_id" class="form-control location-municipality-field locationlib-field" type="text" required>
        </div>      
        <div class="form-group">
          <label for="province_id">Province</label>
          <select id="province_id" name="province_id" class="form-control select2 location-municipality-field locationlib-field" required>
            <option value="" hidden>Select Province</option>
            @foreach ($location_provinces as $prov)
              <option value="{{ $prov->id }}"> {{ $prov->province }}</option>
            @endforeach
          </select>
          <span class="text-danger"><small id="province-error" class="error"></small></span>
        </div>     
        <div class="form-group">
          <label for="name_id">Name</label>
          <input id="name_id" class="form-control location-municipality-field locationlib-field" type="text" required>
        </div>  
        <div class="form-group">
          <label for="location_municipality_tags">Tags</label>
          <input id="location_municipality_tags" class="form-control location-municipality-field locationlib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="location_municipality_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="location_municipality_is_verified" name="is_verified" class="location-municipality-field form-check-input locationlib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="location_municipality_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="location_municipality_is_active" name="is_active" class="location-municipality-field form-check-input locationlib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_location_municipality" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_location_municipality" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>