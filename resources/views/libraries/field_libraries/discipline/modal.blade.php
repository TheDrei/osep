<!-- Modal -->
<div class="modal fade" id="discipline_modal" tabindex="-1" role="dialog" aria-labelledby="discipline_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="discipline_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('discipline_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="discipline_name">Discipline</label>
          <input id="discipline_id" name="discipline_id" class="form-control discipline-field fieldlib-fields" type="text" hidden>
          <input id="discipline_name" type="text" class="form-control discipline-field fieldlib-fields" name="discipline_name" value="{{ old('discipline_name') }}" required autocomplete="discipline_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('discipline_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('discipline_name') }}</small>
          @if ($errors->has('discipline_name'))
            <span class="invalid-feedback">{{ $errors->first('discipline_name') }}</span>
          @endif
        </div>        
        <div class="form-group">
          <label for="discipline_tags">Tags</label>
          <input id="discipline_tags" class="form-control discipline-field fieldlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="discipline_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="discipline_is_verified" name="is_verified" class="discipline-field form-check-input fieldlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="discipline_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="discipline_is_active" name="is_active" class="discipline-field form-check-input fieldlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_discipline" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_discipline" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>