<!-- Modal -->
<div class="modal fade" id="fund_source_type_modal" tabindex="-1" role="dialog" aria-labelledby="fund_source_type_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fund_source_type_modal_header"></h5>
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
        <div class="form-group {{ $errors->has('fund_source_type_name') ? 'has-error' : '' }}">
          <label for="fund_source_type_name">Fund Source Type</label>
          <input id="fund_source_type_id" name="fund_source_type_id" class="form-control fund-source-type-field budgetlib-field" type="text" hidden>
          <input id="fund_source_type_name" type="text" class="form-control fund-source-type-field budgetlib-field" name="fund_source_type_name" value="{{ old('fund_source_type_name') }}" required autocomplete="fund_source_name" autofocus required>           
          <span class="text-danger status-message">{{ $errors->first('fund_source_type_name') }}</span>
        </div>          
        <div class="form-group">
          <label for="fund_source_type_tags">Tags</label>
          <input id="fund_source_type_tags" class="form-control fund-source-type-field budgetlib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="fund_source_type_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="fund_source_type_is_verified" name="fund_source_type_is_verified" class="fund-source-type-field form-check-input budgetlib-field" >
              {{-- @foreach ($agencies as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="fund_source_type_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="fund_source_type_is_active" name="fund_source_type_is_active" class="fund-source-type-field form-check-input budgetlib-field" >
              {{-- @foreach ($agencies as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_fund_source_type" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_fund_source_type" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>