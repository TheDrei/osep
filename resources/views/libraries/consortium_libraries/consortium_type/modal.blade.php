<!-- Modal -->
<div class="modal fade" id="consortium_type_modal" tabindex="-1" role="dialog" aria-labelledby="consortium_type_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="consortium_type_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('consortium_type_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="consortium_type_name">consortium_type</label>
          <input id="consortium_type_id" name="consortium_type_id" class="form-control consortium-type-field consortium-type-fields" type="text" hidden>
          <input id="consortium_type_name" type="text" class="form-control consortium-type-field consortium-type-fields" name="consortium_type_name" value="{{ old('consortium_type_name') }}" required autocomplete="consortium_type_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('consortium_type_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('consortium_type_name') }}</small>
          @if ($errors->has('consortium_type_name'))
            <span class="invalid-feedback">{{ $errors->first('consortium_type_name') }}</span>
          @endif
        </div>    
        <div class="form-group">
          <label for="consortium_type_acronym">Acronym</label>
          <input id="consortium_type_acronym" class="form-control consortium-type-field consortium-type-fields" type="text">
        </div>    
        <div class="form-group">
          <label for="consortium_type_tags">Tags</label>
          <input id="consortium_type_tags" class="form-control consortium-type-field consortium-type-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="consortium_type_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="consortium_type_is_verified" name="is_verified" class="consortium-type-field form-check-input consortium-type-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="consortium_type_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="consortium_type_is_active" name="is_active" class="consortium-type-field form-check-input consortium-type-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_consortium_type" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_consortium_type" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>