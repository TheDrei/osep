<!-- Modal -->
<div class="modal fade" id="project_designation_modal" tabindex="-1" role="dialog" aria-labelledby="project_designation_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="project_designation_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('project_designation_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="project_designation_name">project_designation</label>
          <input id="project_designation_id" name="project_designation_id" class="form-control project-designation-field projectlib-fields" type="text" hidden>
          <input id="project_designation_name" type="text" class="form-control project-designation-field projectlib-fields" name="project_designation_name" value="{{ old('project_designation_name') }}" required autocomplete="project_designation_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('project_designation_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('project_designation_name') }}</small>
          @if ($errors->has('project_designation_name'))
            <span class="invalid-feedback">{{ $errors->first('project_designation_name') }}</span>
          @endif
        </div>     
        <div class="form-group">
          <label for="project_designation_tags">Tags</label>
          <input id="project_designation_tags" class="form-control project-designation-field projectlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="project_designation_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="project_designation_is_verified" name="is_verified" class="project-designation-field form-check-input projectlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="project_designation_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="project_designation_is_active" name="is_active" class="project-designation-field form-check-input projectlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_project_designation" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_project_designation" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>