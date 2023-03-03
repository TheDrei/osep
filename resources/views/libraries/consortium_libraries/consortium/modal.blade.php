<!-- Modal -->
<div class="modal fade" id="consortium_modal" tabindex="-1" role="dialog" aria-labelledby="consortium_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="consortium_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('consortium_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="consortium_name">consortium</label>
          <input id="consortium_id" name="consortium_id" class="form-control consortium-field consortium-fields" type="text" hidden>
          <input id="consortium_name" type="text" class="form-control consortium-field consortium-fields" name="consortium_name" value="{{ old('consortium_name') }}" required autocomplete="consortium_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('consortium_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('consortium_name') }}</small>
          @if ($errors->has('consortium_name'))
            <span class="invalid-feedback">{{ $errors->first('consortium_name') }}</span>
          @endif
        </div>    
        <div class="form-group">
          <label for="consortium_acronym">Acronym</label>
          <input id="consortium_acronym" class="form-control consortium-field consortium-fields" type="text">
        </div>    
        <div class="form-group">
          <label for="consortium_tags">Tags</label>
          <input id="consortium_tags" class="form-control consortium-field consortium-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="consortium_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="consortium_is_verified" name="is_verified" class="consortium-field form-check-input consortium-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="consortium_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="consortium_is_active" name="is_active" class="consortium-field form-check-input consortium-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_consortium" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_consortium" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>