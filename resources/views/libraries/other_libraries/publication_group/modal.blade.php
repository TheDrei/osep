<!-- Modal -->
<div class="modal fade" id="publication_group_modal" tabindex="-1" role="dialog" aria-labelledby="publication_group_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="publication_group_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('publication_group_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="publication_group_name">publication_group</label>
          <input id="publication_group_id" name="publication_group_id" class="form-control publication-group-field otherlib-fields" type="text" hidden>
          <input id="publication_group_name" type="text" class="form-control publication-group-field otherlib-fields" name="publication_group_name" value="{{ old('publication_group_name') }}" required autocomplete="publication_group_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('publication_group_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('publication_group_name') }}</small>
          @if ($errors->has('publication_group_name'))
            <span class="invalid-feedback">{{ $errors->first('publication_group_name') }}</span>
          @endif
        </div>        
        <div class="form-group">
          <label for="publication_group_tags">Tags</label>
          <input id="publication_group_tags" class="form-control publication-group-field otherlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="publication_group_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="publication_group_is_verified" name="is_verified" class="publication-group-field form-check-input otherlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="publication_group_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="publication_group_is_active" name="is_active" class="publication-group-field form-check-input otherlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_publication_group" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_publication_group" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>