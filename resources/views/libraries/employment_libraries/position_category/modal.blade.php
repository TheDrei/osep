<!-- Modal -->
<div class="modal fade" id="position_category_modal" tabindex="-1" role="dialog" aria-labelledby="position_category_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="position_category_modal_header"></h5>
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
        <div class="form-group {{ $errors->has('position_category_name') ? 'has-error' : '' }}">
          <label for="position_category_name">Position Category </label>
          <input id="position_category_id" name="position_category_id" class="form-control position-category-field employment-field" type="text" hidden>
          <input id="position_category_name" type="text" class="form-control position-category-field employmentlib-field" name="position_category_name" value="{{ old('position_category_name') }}" required autocomplete="position_category_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('position_category') }}</span>
        </div>
        <div class="form-group">
          <label for="position_category_abbreviation">Abbreviation</label>
          <input id="position_category_abbreviation" class="form-control position-category-field employmentlib-field" type="text">
        </div>
        <div class="form-group">
          <label for="position_category_tags">Tags</label>
          <input id="position_category_tags" class="form-control position-category-field employmentlib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="position_category_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="position_category_is_verified" name="is_verified" class="position-category-field form-check-input employmentlib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="position_category_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="position_category_is_active" name="is_active" class="position-category-field form-check-input employmentlib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_position_category" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_position_category" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>