<!-- Modal -->
<div class="modal fade" id="civil_status_modal" tabindex="-1" role="dialog" aria-labelledby="civil_status_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="civil_status_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('civil_status_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="civil_status_name">civil_status</label>
          <input id="civil_status_id" name="civil_status_id" class="form-control civil-status-field personalinfolib-fields" type="text" hidden>
          <input id="civil_status_name" type="text" class="form-control civil-status-field personalinfolib-fields" name="civil_status_name" value="{{ old('civil_status_name') }}" required autocomplete="civil_status_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('civil_status_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('civil_status_name') }}</small>
          @if ($errors->has('civil_status_name'))
            <span class="invalid-feedback">{{ $errors->first('civil_status_name') }}</span>
          @endif
        </div>        
        <div class="form-group">
          <label for="civil_status_tags">Tags</label>
          <input id="civil_status_tags" class="form-control civil-status-field personalinfolib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="civil_status_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="civil_status_is_verified" name="is_verified" class="civil-status-field form-check-input personalinfolib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="civil_status_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="civil_status_is_active" name="is_active" class="civil-status-field form-check-input personalinfolib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_civil_status" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_civil_status" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>