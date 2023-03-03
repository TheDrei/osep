<!-- Modal -->
<div class="modal fade" id="equipment_modal" tabindex="-1" role="dialog" aria-labelledby="equipment_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="equipment_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
        @endif
        {{ csrf_field() }}
        {{-- <div class="form-group {{ $errors->has('equipment_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="equipment_name">equipment</label>
          <input id="equipment_id" name="equipment_id" class="form-control equipment-field otherlib-fields" type="text" hidden>
          <input id="equipment_name" type="text" class="form-control equipment-field otherlib-fields" name="equipment_name" value="{{ old('equipment_name') }}" required autocomplete="equipment_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('equipment_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('equipment_name') }}</small>
          @if ($errors->has('equipment_name'))
            <span class="invalid-feedback">{{ $errors->first('equipment_name') }}</span>
          @endif
        </div>        
        <div class="form-group">
          <label for="equipment_tags">Tags</label>
          <input id="equipment_tags" class="form-control equipment-field otherlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="equipment_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="equipment_is_verified" name="is_verified" class="equipment-field form-check-input otherlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="equipment_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="equipment_is_active" name="is_active" class="equipment-field form-check-input otherlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_equipment" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_equipment" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>