<!-- Modal -->
<div class="modal fade" id="user_role_modal" tabindex="-1" role="dialog" aria-labelledby="user_role_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="user_role_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('user_role_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="user_role_name">user_role</label>
          <input id="user_role_id" name="user_role_id" class="form-control user-role-field personalinfo-fields" type="text" hidden>
          <input id="user_role_name" type="text" class="form-control user-role-field personalinfo-fields" name="user_role_name" value="{{ old('user_role_name') }}" required autocomplete="user_role_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('user_role_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('user_role_name') }}</small>
          @if ($errors->has('user_role_name'))
            <span class="invalid-feedback">{{ $errors->first('user_role_name') }}</span>
          @endif
        </div>        
        <div class="form-group">
          <label for="user_role_tags">Tags</label>
          <input id="user_role_tags" class="form-control user-role-field personalinfo-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="user_role_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="user_role_is_verified" name="is_verified" class="user-role-field form-check-input personalinfo-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="user_role_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="user_role_is_active" name="is_active" class="user-role-field form-check-input personalinfo-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_user_role" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_user_role" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>