<!-- Modal -->
<div class="modal fade" id="education_degree_modal" tabindex="-1" role="dialog" aria-labelledby="education_degree_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="education_degree_modal_header"></h5>
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
        <div class="form-group {{ $errors->has('education_degree_name') ? 'has-error' : '' }}">
          <label for="education_degree_name">Education Degree</label>
          <input id="education_degree_id" name="education_degree_id" class="form-control education-degree-field educationlib-field" type="text" hidden>
          <input id="education_degree_name" type="text" class="form-control education-degree-field educationlib-field" name="education_degree_name" value="{{ old('education_degree_name') }}" required autocomplete="education_degree_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('education_degree_name') }}</span>
        </div>
        <div class="form-group">
          <label for="education_degree_acronym">Acronym</label>
          <input id="education_degree_acronym" class="form-control education-degree-field educationlib-field" type="text">
        </div>
        <div class="form-group">
          <label for="education_degree_tags">Tags</label>
          <input id="education_degree_tags" class="form-control education-degree-field educationlib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="education_degree_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="education_degree_is_verified" name="is_verified" class="education-degree-field form-check-input educationlib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="education_degree_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="education_degree_is_active" name="is_active" class="education-degree-field form-check-input educationlib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_education_degree" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_education_degree" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>