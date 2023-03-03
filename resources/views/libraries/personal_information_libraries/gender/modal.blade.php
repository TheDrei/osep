<!-- Modal -->
<div class="modal fade" id="gender_modal" tabindex="-1" role="dialog" aria-labelledby="gender_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gender_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('gender_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="gender_name">gender</label>
          <input id="gender_id" name="gender_id" class="form-control gender-field personalinfolib-fields" type="text" hidden>
          <input id="gender_name" type="text" class="form-control gender-field personalinfolib-fields" name="gender_name" value="{{ old('gender_name') }}" required autocomplete="gender_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('gender_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('gender_name') }}</small>
          @if ($errors->has('gender_name'))
            <span class="invalid-feedback">{{ $errors->first('gender_name') }}</span>
          @endif
        </div>        
        <div class="form-group">
          <label for="gender_tags">Tags</label>
          <input id="gender_tags" class="form-control gender-field personalinfolib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="gender_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="gender_is_verified" name="is_verified" class="gender-field form-check-input personalinfolib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="gender_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="gender_is_active" name="is_active" class="gender-field form-check-input personalinfolib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_gender" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_gender" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>