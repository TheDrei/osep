<!-- Modal -->
<div class="modal fade" id="award_modal" tabindex="-1" role="dialog" aria-labelledby="award_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="award_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('award_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="award_name">award</label>
          <input id="award_id" name="award_id" class="form-control award-concern-field otherlib-fields" type="text" hidden>
          <input id="award_name" type="text" class="form-control award-concern-field otherlib-fields" name="award_name" value="{{ old('award_name') }}" required autocomplete="award_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('award_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('award_name') }}</small>
          @if ($errors->has('award_name'))
            <span class="invalid-feedback">{{ $errors->first('award_name') }}</span>
          @endif
        </div>        
        <div class="form-group">
          <label for="award_tags">Tags</label>
          <input id="award_tags" class="form-control award-concern-field otherlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="award_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="award_is_verified" name="is_verified" class="award-concern-field form-check-input otherlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="award_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="award_is_active" name="is_active" class="award-concern-field form-check-input otherlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_award" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_award" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>