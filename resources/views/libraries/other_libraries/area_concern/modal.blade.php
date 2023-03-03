<!-- Modal -->
<div class="modal fade" id="area_concern_modal" tabindex="-1" role="dialog" aria-labelledby="area_concern_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="area_concern_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('area_concern_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="area_concern_name">area_concern</label>
          <input id="area_concern_id" name="area_concern_id" class="form-control area-concern-field otherlib-fields" type="text" hidden>
          <input id="area_concern_name" type="text" class="form-control area-concern-field otherlib-fields" name="area_concern_name" value="{{ old('area_concern_name') }}" required autocomplete="area_concern_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('area_concern_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('area_concern_name') }}</small>
          @if ($errors->has('area_concern_name'))
            <span class="invalid-feedback">{{ $errors->first('area_concern_name') }}</span>
          @endif
        </div>        
        <div class="form-group">
          <label for="area_concern_tags">Tags</label>
          <input id="area_concern_tags" class="form-control area-concern-field otherlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="area_concern_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="area_concern_is_verified" name="is_verified" class="area-concern-field form-check-input otherlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="area_concern_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="area_concern_is_active" name="is_active" class="area-concern-field form-check-input otherlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_area_concern" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_area_concern" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>