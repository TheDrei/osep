<!-- Modal -->
<div class="modal fade" id="employment_status_modal" tabindex="-1" role="dialog" aria-labelledby="employment_status_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="employment_status_modal_header"></h5>
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
        <div class="form-group {{ $errors->has('employment_status_name') ? 'has-error' : '' }}">
          <label for="employment_status_name">Employment Status</label>
          <input id="employment_status_id" name="employment_status_id" class="form-control employement-status-field employment-field" type="text" hidden>
          <input id="employment_status_name" type="text" class="form-control employment-status-field employmentlib-field" name="employment_status_name" value="{{ old('employment_status_name') }}" required autocomplete="employment_status_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('employment') }}</span>
        </div>
        <div class="form-group">
          <label for="employment_status_tags">Tags</label>
          <input id="employment_status_tags" class="form-control employment-status-field employmentlib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="employment_status_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="employment_status_is_verified" name="is_verified" class="employment-status-field form-check-input employmentlib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="employment_status_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="employment_status_is_active" name="is_active" class="employment-status-field form-check-input employmentlib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_employment_status" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_employment_status" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>