<!-- Modal -->
<div class="modal fade" id="designation_modal" tabindex="-1" role="dialog" aria-labelledby="designation_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="designation_modal_header"></h5>
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
        <div class="form-group {{ $errors->has('designation_name') ? 'has-error' : '' }}">
          <label for="designation_name">Designation </label>
          <input id="designation_id" name="designation_id" class="form-controldesignation-field employment-field" type="text" hidden>
          <input id="designation_name" type="text" class="form-control designation-field employmentlib-field" name="designation_name" value="{{ old('designation_name') }}" required autocomplete="designation_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('employment') }}</span>
        </div>
        <div class="form-group">
          <label for="designation_tags">Tags</label>
          <input id="designation_tags" class="form-control designation-field employmentlib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="designation_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="designation_is_verified" name="is_verified" class="designation-field form-check-input employmentlib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="designation_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="designation_is_active" name="is_active" class="designation-field form-check-input employmentlib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_designation" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_designation" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>