<!-- Modal -->
<div class="modal fade" id="occupation_modal" tabindex="-1" role="dialog" aria-labelledby="occupation_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="occupation_modal_header"></h5>
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
        <div class="form-group {{ $errors->has('occupation_name') ? 'has-error' : '' }}">
          <label for="occupation_name">Occupation </label>
          <input id="occupation_id" name="occupation_id" class="form-controloccupation-field employment-field" type="text" hidden>
          <input id="occupation_name" type="text" class="form-control occupation-field employmentlib-field" name="occupation_name" value="{{ old('occupation_name') }}" required autocomplete="occupation_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('occupation_name') }}</span>
        </div>
        <div class="form-group">
          <label for="occupation_abbreviation">Abbreviation</label>
          <input id="occupation_abbreviation" class="form-control occupation-field employmentlib-field" type="text">
        </div>
        <div class="form-group">
          <label for="occupation_tags">Tags</label>
          <input id="occupation_tags" class="form-control occupation-field employmentlib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="occupation_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="occupation_is_verified" name="is_verified" class="occupation-field form-check-input employmentlib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="occupation_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="occupation_is_active" name="is_active" class="occupation-field form-check-input employmentlib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_occupation" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_occupation" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>