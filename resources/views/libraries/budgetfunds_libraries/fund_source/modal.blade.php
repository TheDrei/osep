<!-- Modal -->
<div class="modal fade" id="fund_source_modal" tabindex="-1" role="dialog" aria-labelledby="fund_source_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fund_source_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="fund_source_name">Fund Source</label>
          <input id="fund_source_id" name="fund_source_id" class="form-control fund-source-field budgetlib-fields" type="text" hidden>
          <input id="fund_source_name" type="text" class="form-control fund-source-field budgetlib-fields" name="fund_source_name" value="{{ old('fund_source_name') }}" required autocomplete="fund_source_name" autofocus required>           
          <span class="text-danger"><small id="fund-source-name-error" class="error"></small></span>
        </div>      
        <div class="form-group ">
          <label for="fund_source_id">Fund Source Type</label>
          <select id="fund_source_id" name="fund_source_id" class="form-control fund-source-field select2 budgetlib-fields">
            <option value="" selected hidden>Select Fund Source Type</option>
            @foreach ($fund_source_types as $row)
              <option value="{{ $row->id }}"> {{ $row->fund_source_type }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="fund_source_tags">Tags</label>
          <input id="fund_source_tags" class="form-control fund-source-field budgetlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="fund_source_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="fund_source_is_verified" name="is_verified" class="fund-source-field form-check-input budgetlib-fields" 
              @foreach ($fund_sources as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach>
            </div>
            <div class="form-check form-check-inline">
              <label for="fund_source_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="fund_source_is_active" name="is_active" class="fund-source-field form-check-input budgetlib-fields" 
              @foreach ($fund_sources as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_fund_source" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_fund_source" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>