<!-- Modal -->
<div class="modal fade" id="position_modal" tabindex="-1" role="dialog" aria-labelledby="position_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="position_modal_header"></h5>
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
        <div class="form-group {{ $errors->has('position_name') ? 'has-error' : '' }}">
          <label for="position_name">Position </label>
          <input id="position_id" name="position_id" class="form-control position-field employmentlib-field" type="text" hidden>
          <input id="position_name" type="text" class="form-control position-field employmentlib-field" name="position_name" value="{{ old('position_name') }}" required autocomplete="position_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('position_name') }}</span>
        </div>
        <div class="form-group">
          <label for="position_description">Description</label>
          <input id="position_description" name="position_description" class="form-control position-field employmentlib-field" type="text">
        </div> 
        <div class="row">
          <div class="form-group col">
            <label for="position_acronym">Acronym</label>
            <input id="position_acronym" class="form-control position-field employmentlib-field" type="text">
          </div>                 
          <div class="form-group col">
            <label for="position_abbreviation">Abbreviation</label>
            <input id="position_abbreviation" class="form-control position-field employmentlib-field" type="text">
          </div>
          <div class="form-group col">
            <label for="salary_grade">Salary Grade</label>
            <select id="salary_grade" name="salary_grade" class="form-control position-field select2 employmentlib-field" disabled>     
             
            </select>
          </div>         
        </div>
        <div class="form-group">
          <label for="position_tags">Tags</label>
          <input id="position_tags" class="form-control position-field employmentlib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="position_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="position_is_verified" name="is_verified" class="position-field form-check-input employmentlib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="position_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="position_is_active" name="is_active" class="position-field form-check-input employmentlib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_position" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_position" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>