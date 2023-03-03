<!-- Modal -->
<div class="modal fade" id="agency_subcategory_modal" tabindex="-1" role="dialog" aria-labelledby="agency_subcategory_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agency_subcategory_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="agency_subcategory_name">Agency Subcategory</label>
          <input id="agency_subcategory_id" name="agency_subcategory_id" class="form-control agency-subcategory-field agencylib-fields" type="text" hidden>
          <input id="agency_subcategory_name" type="text" class="form-control agency-subcategory-field agencylib-fields" name="agency_subcategory_name" value="{{ old('agency_subcategory_name') }}" required autocomplete="agency_subcategory_name" autofocus required>           
          <span class="text-danger"><small id="agency-subcategory-name-error" class="error"></small></span>
        </div>
        <div class="form-group">
          <label for="agency_subcategory_acronym">Subcategory Acronym</label>
          <input id="agency_subcategory_acronym" class="form-control agency-subcategory-field agencylib-fields" type="text" required>
        </div>        
        <div class="form-group ">
          <label for="agency_sub_category_id">Agency Catgory</label>
          <select id="agency_sub_category_id" name="agency_sub_category_id" class="form-control agency-subcategory-field select2 agencylib-fields">
            <option value="" selected hidden>Select Agency Category</option>
            @foreach ($agency_categories as $row)
              <option value="{{ $row->id }}"> {{ $row->agency_category }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="agency_subcategory_tags">Tags</label>
          <input id="agency_subcategory_tags" class="form-control agency-subcategory-field agencylib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="agency_subcategory_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="agency_subcategory_is_verified" name="is_verified" class="agency-subcategory-field form-check-input agencylib-fields" 
              @foreach ($agency_subcategories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach>
            </div>
            <div class="form-check form-check-inline">
              <label for="agency_subcategory_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="agency_subcategory_is_active" name="is_active" class="agency-subcategory-field form-check-input agencylib-fields" 
              @foreach ($agency_subcategories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_agency_subcategory" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_agency_subcategory" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>