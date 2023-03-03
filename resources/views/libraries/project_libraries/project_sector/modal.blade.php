<!-- Modal -->
<div class="modal fade" id="project_sector_modal" tabindex="-1" role="dialog" aria-labelledby="project_sector_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="project_sector_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('project_sector_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="project_sector_name">project_sector</label>
          <input id="project_sector_id" name="project_sector_id" class="form-control project-sector-field projectlib-fields" type="text" hidden>
          <input id="project_sector_name" type="text" class="form-control project-sector-field projectlib-fields" name="project_sector_name" value="{{ old('project_sector_name') }}" required autocomplete="project_sector_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('project_sector_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('project_sector_name') }}</small>
          @if ($errors->has('project_sector_name'))
            <span class="invalid-feedback">{{ $errors->first('project_sector_name') }}</span>
          @endif
        </div>    
        <div class="form-group">
          <label for="project_sector_acronym">Acronym</label>
          <input id="project_sector_acronym" class="form-control project-sector-field projectlib-fields" type="text">
        </div>    
        <div class="form-group">
          <label for="project_sector_tags">Tags</label>
          <input id="project_sector_tags" class="form-control project-sector-field projectlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="project_sector_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="project_sector_is_verified" name="is_verified" class="project-sector-field form-check-input projectlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="project_sector_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="project_sector_is_active" name="is_active" class="project-sector-field form-check-input projectlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_project_sector" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_project_sector" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>