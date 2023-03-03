<!-- Modal -->
<div class="modal fade" id="language_modal" tabindex="-1" role="dialog" aria-labelledby="language_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="language_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('language_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="language_name">language</label>
          <input id="language_id" name="language_id" class="form-control language-field otherlib-fields" type="text" hidden>
          <input id="language_name" type="text" class="form-control language-field otherlib-fields" name="language_name" value="{{ old('language_name') }}" required autocomplete="language_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('language_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('language_name') }}</small>
          @if ($errors->has('language_name'))
            <span class="invalid-feedback">{{ $errors->first('language_name') }}</span>
          @endif
        </div>        
        <div class="form-group">
          <label for="language_tags">Tags</label>
          <input id="language_tags" class="form-control language-field otherlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="language_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="language_is_verified" name="is_verified" class="language-field form-check-input otherlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="language_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="language_is_active" name="is_active" class="language-field form-check-input otherlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_language" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_language" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>