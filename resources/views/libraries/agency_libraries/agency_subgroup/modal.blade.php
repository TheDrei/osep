<!-- Modal -->
<div class="modal fade" id="agency_subgroup_modal" tabindex="-1" role="dialog" aria-labelledby="agency_subgroup_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agency_subgroup_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          <label for="agency_subgroup_name">Agency Subgroup</label>
          <input id="agency_subgroup_id" name="agency_subgroup_id" class="form-control agency-subgroup-field agencylib-fields" type="text" hidden>
          <input id="agency_subgroup_name" type="text" class="form-control agency-subgroup-field agencylib-fields" name="agency_subgroup_name" value="{{ old('agency_subgroup_name') }}" required autocomplete="agency_subgroup_name" autofocus required>           
          <span class="text-danger"><small id="agency-subgroup-name-error" class="error"></small></span>
        </div>       
        <div class="form-group">
          <label for="agency_sub_group_id">Agency Group</label>
          <select id="agency_sub_group_id" name="agency_sub_group_id" class="form-control agency-subgroup-field select2 agencylib-fields">
            <option value="" selected hidden>Select Agency Group</option>
            @foreach ($agency_groups as $row)
              <option value="{{ $row->id }}"> {{ $row->agency_group }}</option>
            @endforeach
          </select>
        </div>         
        <div class="form-group">
          <label for="agency_subgroup_tags">Tags</label>
          <input id="agency_subgroup_tags" class="form-control agency-subgroup-field agencylib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="agency_subgroup_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="agency_subgroup_is_verified" name="is_verified" class="agency-subgroup-field form-check-input agencylib-fields" 
              @foreach ($agency_subgroups as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach>
            </div>
            <div class="form-check form-check-inline">
              <label for="agency_subgroup_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="agency_subgroup_is_active" name="is_active" class="agency-subgroup-field form-check-input agencylib-fields" 
              @foreach ($agency_subgroups as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_agency_subgroup" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_agency_subgroup" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>