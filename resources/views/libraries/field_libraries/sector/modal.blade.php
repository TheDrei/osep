<!-- Modal -->
<div class="modal fade" id="sector_modal" tabindex="-1" role="dialog" aria-labelledby="sector_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sector_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('sector_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="sector_name">Sector</label>
          <input id="sector_id" name="sector_id" class="form-control sector-field fieldlib-fields" type="text" hidden>
          <input id="sector_name" type="text" class="form-control sector-field fieldlib-fields" name="sector_name" value="{{ old('sector_name') }}" required autocomplete="sector_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('sector_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('sector_name') }}</small>
          @if ($errors->has('sector_name'))
            <span class="invalid-feedback">{{ $errors->first('sector_name') }}</span>
          @endif
        </div>        
        <div class="form-group">
          <label for="sector_tags">Tags</label>
          <input id="sector_tags" class="form-control sector-field fieldlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="sector_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="sector_is_verified" name="is_verified" class="sector-field form-check-input fieldlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="sector_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="sector_is_active" name="is_active" class="sector-field form-check-input fieldlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_sector" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_sector" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>