<!-- Modal -->
<div class="modal fade" id="agency_class_modal" tabindex="-1" role="dialog" aria-labelledby="agency_class_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agency_class_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="class_name">Agency Class</label>
          <input id="agency_class_id" name="agency_class_id" class="form-control agency-class-field agencylib-fields" type="text" hidden>
          <input id="class_name" type="text" class="form-control agency-class-field agencylib-fields" name="class_name" value="{{ old('class_name') }}" required autocomplete="class_name" autofocus required>           
          <span class="text-danger"><small id="class-name-error" class="error"></small></span>
        </div>       
        <div class="form-group">
          <label for="agency_class_tags">Tags</label>
          <input id="agency_class_tags" class="form-control agency-class-field agencylib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="agency_class_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="agency_class_is_verified" name="is_verified" class="agency-class-field form-check-input agencylib-fields" 
              @foreach ($agency_classes as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach>
            </div>
            <div class="form-check form-check-inline">
              <label for="agency_class_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="agency_class_is_active" name="is_active" class="agency-class-field form-check-input agencylib-fields" 
              @foreach ($agency_classes as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_agency_class" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_agency_class" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>