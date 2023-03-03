<!-- Modal -->
<div class="modal fade" id="name_list_modal" tabindex="-1" role="dialog" aria-labelledby="name_list_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="name_list_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('name_list_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="name_list_name">name_list</label>
          <input id="name_list_id" name="name_list_id" class="form-control name-list-field personalinfolib-fields" type="text" hidden>
          <input id="name_list_name" type="text" class="form-control name-list-field personalinfolib-fields" name="name_list_name" value="{{ old('name_list_name') }}" required autocomplete="name_list_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('name_list_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('name_list_name') }}</small>
          @if ($errors->has('name_list_name'))
            <span class="invalid-feedback">{{ $errors->first('name_list_name') }}</span>
          @endif
        </div>        
        <div class="form-group">
          <label for="name_list_tags">Tags</label>
          <input id="name_list_tags" class="form-control name-list-field personalinfolib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="name_list_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="name_list_is_verified" name="is_verified" class="name-list-field form-check-input personalinfolib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="name_list_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="name_list_is_active" name="is_active" class="name-list-field form-check-input personalinfolib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_name_list" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_name_list" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>