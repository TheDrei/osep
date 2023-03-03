<!-- Modal -->
<div class="modal fade" id="agency_category_modal" tabindex="-1" role="dialog" aria-labelledby="agency_category_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agency_category_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="validate_form">
          @CSRF
          <div class="form-group">
            <label for="agency_category_name">Agency Category</label>
            <input id="agency_category_id" name="agency_category_id" class="form-control agency-category-field agencylib-fields" type="text" hidden>
            <input id="agency_category_name" type="text" class="form-control agency-category-field agencylib-fields" name="agency_category_name" value="{{ old('agency_category_name') }}" required autocomplete="agency_category_name" autofocus required>           
            <span class="text-danger"><small id="category-name-error" class="error"></small></span>
          </div>
          <div class="form-group">
            <label for="agency_category_acronym">Category Acronym</label>
            <input id="agency_category_acronym" class="form-control agency-category-field agencylib-fields" type="text">
          </div>    
          <div class="form-group">
            <label for="agency_category_tags">Tags</label>
            <input id="agency_category_tags" class="form-control agency-category-field agencylib-fields" type="text">
          </div>
          <div class="row">
            <div class="col">
              <div class="form-check form-check-inline">
                <label for="agency_category_is_verified">Is Verified</label>&nbsp;
                <input type="checkbox" id="agency_category_is_verified" name="agency_category_is_verified" class="agency-category-field form-check-input agencylib-fields"
                @foreach ($agency_categories as $row)
                  {{ $row->is_verified=="1"?true:false }}
                @endforeach>
              </div>
              <div class="form-check form-check-inline">
                <label for="agency_category_is_active">Is Active</label>&nbsp;
                <input type="checkbox" id="agency_category_is_active" name="agency_category_is_active" class="agency-category-field form-check-input agencylib-fields"
                @foreach ($agency_categories as $row)
                  {{ $row->is_active=="yes"?true:false }}
                @endforeach>
              </div>
            </div>
          </div>
        </form>
      </div>      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_agency_category" type="button" class="submit btn btn-primary save-buttons d-none">Save</button>
        <button id="update_agency_category" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>