<!-- Modal -->
<div class="modal fade" id="budget_type_modal" tabindex="-1" role="dialog" aria-labelledby="budget_type_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="budget_type_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="class_name">Budget Type</label>
          <input id="budget_type_id" name="budget_type_id" class="form-control budget-type-field budgetlib-fields" type="text" hidden>
          <input id="budget_type_name" type="text" class="form-control budget-type-field budgetlib-fields" name="budget_type_name" value="{{ old('budget_type_name') }}" required autocomplete="budget_type_name" autofocus required>           
          <span class="text-danger"><small id="budget-type-name-error" class="error"></small></span>
        </div>       
        <div class="form-group">
          <label for="budget_type_tags">Tags</label>
          <input id="budget_type_tags" class="form-control budget-type-field budgetlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="budget_type_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="budget_type_is_verified" name="is_verified" class="budget-type-field form-check-input budgetlib-fields" 
              @foreach ($budget_types as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach>
            </div>
            <div class="form-check form-check-inline">
              <label for="budget_type_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="budget_type_is_active" name="is_active" class="budget-type-field form-check-input budgetlib-fields" 
              @foreach ($budget_types as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_budget_type" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_budget_type" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>