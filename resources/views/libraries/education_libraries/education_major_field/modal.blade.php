<!-- Modal -->
<div class="modal fade" id="education_major_field_modal" tabindex="-1" role="dialog" aria-labelledby="education_major_field_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="education_major_field_modal_header"></h5>
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
        <div class="form-group {{ $errors->has('education_major_field_name') ? 'has-error' : '' }}">
          <label for="education_major_field_name">Education Major Field</label>
          <input id="education_major_field_id" name="education_major_field_id" class="form-control education-major-field-field educationlib-field" type="text" hidden>
          <input id="education_major_field_name" type="text" class="form-control education-major-field-field educationlib-field" name="education_major_field_name" value="{{ old('education_major_field_name') }}" required autocomplete="education_major_field_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('education_major_field_name') }}</span>
        </div>      
        <div class="form-group">
          <label for="sector_id">Sector</label>
          <select id="sector_id" name="sector_id" class="form-control education-major-field-field select2 educationlib-field" disabled>
          </select>
        </div>  
        <div class="form-group">
          <label for="education_major_field_tags">Tags</label>
          <input id="education_major_field_tags" class="form-control education-major-field-field educationlib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="education_major_field_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="education_major_field_is_verified" name="is_verified" class="education-major-field-field form-check-input educationlib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="education_major_field_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="education_major_field_is_active" name="is_active" class="education-major-field-field form-check-input educationlib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_education_major_field" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_education_major_field" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>