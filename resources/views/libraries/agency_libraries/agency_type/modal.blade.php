<!-- Modal -->
<div class="modal fade" id="agency_type_modal" tabindex="-1" role="dialog" aria-labelledby="agency_type_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agency_type_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="agency_type_name">Agency Type</label>
          <input id="agency_type_id" name="agency_type_id" class="form-control agency-type-field agencylib-fields" type="text" hidden>
          <input id="agency_type_name" type="text" class="form-control agency-subcategory-field agencylib-fields" name="agency_type_name" value="{{ old('agency_type_name') }}" required autocomplete="agency_type_name" autofocus required>           
          <span class="text-danger"><small id="agency-type-name-error" class="error"></small></span>
        </div>
        <div class="form-group">
          <label for="agency_type_tags">Tags</label>
          <input id="agency_type_tags" class="form-control agency-field  agencylib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="agency_type_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="agency_type_is_verified" name="is_verified" class="agency-type-field form-check-input agencylib-fields" 
              @foreach ($agencies as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach>
            </div>
            <div class="form-check form-check-inline">
              <label for="agency_type_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="agency_type_is_active" name="is_active" class="agency-type-field form-check-input agencylib-fields" 
              @foreach ($agencies as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_agency_type" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_agency_type" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>