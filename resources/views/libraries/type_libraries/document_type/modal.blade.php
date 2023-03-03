<!-- Modal -->
<div class="modal fade" id="document_type_modal" tabindex="-1" role="dialog" aria-labelledby="document_type_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="document_type_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('document_type_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="document_type_name">document_type</label>
          <input id="document_type_id" name="document_type_id" class="form-control document-type-field typelib-fields" type="text" hidden>
          <input id="document_type_name" type="text" class="form-control document-type-field typelib-fields" name="document_type_name" value="{{ old('document_type_name') }}" required autocomplete="document_type_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('document_type_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('document_type_name') }}</small>
          @if ($errors->has('document_type_name'))
            <span class="invalid-feedback">{{ $errors->first('document_type_name') }}</span>
          @endif
        </div>    
        <div class="form-group">
          <label for="document_type_acronym">Acronym</label>
          <input id="document_type_acronym" class="form-control document-type-field typelib-fields" type="text">
        </div>    
        <div class="form-group">
          <label for="document_type_tags">Tags</label>
          <input id="document_type_tags" class="form-control document-type-field typelib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="document_type_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="document_type_is_verified" name="is_verified" class="document-type-field form-check-input typelib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="document_type_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="document_type_is_active" name="is_active" class="document-type-field form-check-input typelib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_document_type" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_document_type" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>