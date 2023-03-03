<!-- Modal -->
<div class="modal fade" id="location_barangay_modal" tabindex="-1" role="dialog" aria-labelledby="location_barangay_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="location_barangay_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="location_barangay_name">Barangay</label>
          <input id="location_barangay_id" name="location_barangay_id" class="form-control location-barangay-field locationlib-field" type="text" hidden>
          <input id="location_barangay_name" type="text" class="form-control location-barangay-field locationlib-field" name="location_barangay_name" value="{{ old('location_barangay_name') }}" required autocomplete="location_barangay_name" autofocus required>           
          <span class="text-danger"><small id="barangay-name-error" class="error"></small></span>
        </div>
        <div class="row">         
          <div class="form-group col">
            <label for="province_id">Province</label>
            <select id="province_id" name="province_id" class="form-control select2 location-barangay-field locationlib-field" required>
              <option value="" hidden>Select Province</option>
              @foreach ($location_provinces as $prov)
                <option value="{{ $prov->id }}"> {{ $prov->province }}</option>
              @endforeach
            </select>
            <span class="text-danger"><small id="province-error" class="error"></small></span>
          </div>           
          <div class="form-group col">
            <label for="municipality_id">Municipality</label>
            <select id="municipality_id" name="municipality_id" class="form-control select2  location-barangay-field locationlib-field" disabled
              @foreach ($view_barangays as $b)
                {{ $b->municipality_id ? 'selected' : ''}}               
              @endforeach>
              @foreach($location_municipalities as $mun)
                <option value="{{ $mun->id }}" {{$b->municipality_id  ? 'selected' : ''}}>{{ $mun->municipality}}</option>
              @endforeach
            </select>
            <span class="text-danger"><small id="municipality-error" class="error"></small></span>
          </div>      
        </div>     
        <div class="form-group">
          <label for="location_barangay_tags">Tags</label>
          <input id="location_barangay_tags" class="form-control location-barangay-field locationlib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="location_barangay_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="location_barangay_is_verified" name="is_verified" class="location-barangay-field form-check-input locationlib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="location_barangay_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="location_barangay_is_active" name="is_active" class="location-barangay-field form-check-input locationlib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_location_barangay" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_location_barangay" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>