<!-- Modal -->
<div class="modal fade" id="field_of_specialization_group_modal" tabindex="-1" role="dialog" aria-labelledby="field_of_specialization_group_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="field_of_specialization_group_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('field_of_specialization_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="field_of_specialization_group_name">Field Specialization</label>
          <input id="field_of_specialization_group_id" name="field_of_specialization_group_id" class="form-control field-of-specialization-group-field fieldlib-fields" type="text" hidden>
          <input id="field_of_specialization_group_name" type="text" class="form-control field-of-specialization-group-field fieldlib-fields" name="field_of_specialization_group_name" value="{{ old('field_of_specialization_group_name') }}" required autocomplete="field_of_specialization_group_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('field_of_specialization_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('field_of_specialization_group_name') }}</small>
          @if ($errors->has('field_of_specialization_group_name'))
            <span class="invalid-feedback">{{ $errors->first('field_of_specialization_group_name') }}</span>
          @endif
        </div>  
        <div class="form-group">
          <label for="field_of_specialization_group_tags">Tags</label>
          <input id="field_of_specialization_group_tags" class="form-control field-of-specialization-group-field fieldlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="field_of_specialization_group_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="field_of_specialization_group_is_verified" name="is_verified" class="field-of-specialization-group-field form-check-input fieldlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="field_of_specialization_group_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="field_of_specialization_group_is_active" name="is_active" class="field-of-specialization-group-field form-check-input fieldlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_field_of_specialization_group" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_field_of_specialization_group" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>