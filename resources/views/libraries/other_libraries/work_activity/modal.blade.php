<!-- Modal -->
<div class="modal fade" id="work_activity_modal" tabindex="-1" role="dialog" aria-labelledby="work_activity_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="work_activity_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('work_activity_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="work_activity_name">work_activity</label>
          <input id="work_activity_id" name="work_activity_id" class="form-control work-activity-field otherlib-fields" type="text" hidden>
          <input id="work_activity_name" type="text" class="form-control work-activity-field otherlib-fields" name="work_activity_name" value="{{ old('work_activity_name') }}" required autocomplete="work_activity_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('work_activity_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('work_activity_name') }}</small>
          @if ($errors->has('work_activity_name'))
            <span class="invalid-feedback">{{ $errors->first('work_activity_name') }}</span>
          @endif
        </div>        
        <div class="form-group">
          <label for="work_activity_tags">Tags</label>
          <input id="work_activity_tags" class="form-control work-activity-field otherlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="work_activity_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="work_activity_is_verified" name="is_verified" class="work-activity-field form-check-input otherlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="work_activity_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="work_activity_is_active" name="is_active" class="work-activity-field form-check-input otherlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_work_activity" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_work_activity" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>