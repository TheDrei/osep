<!-- Modal -->
<div class="modal fade" id="product_category_modal" tabindex="-1" role="dialog" aria-labelledby="product_category_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="product_category_modal_header"></h5>
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
        {{-- <div class="form-group {{ $errors->has('product_category_name') ? 'has-error' : '' }}"> --}}
        <div class="form-group">
          <label for="product_category_name">product_category</label>
          <input id="product_category_id" name="product_category_id" class="form-control product-category-field productlib-fields" type="text" hidden>
          <input id="product_category_name" type="text" class="form-control product-category-field productlib-fields" name="product_category_name" value="{{ old('product_category_name') }}" required autocomplete="product_category_name" autofocus required>           
          {{-- <span class="text-danger">{{ $errors->first('product_category_name') }}</span> --}}
          <small class="text-danger">{{ $errors->first('product_category_name') }}</small>
          @if ($errors->has('product_category_name'))
            <span class="invalid-feedback">{{ $errors->first('product_category_name') }}</span>
          @endif
        </div>    
        <div class="form-group">
          <label for="product_category_acronym">Acronym</label>
          <input id="product_category_acronym" class="form-control product-category-field productlib-fields" type="text">
        </div>    
        <div class="form-group">
          <label for="product_category_tags">Tags</label>
          <input id="product_category_tags" class="form-control product-category-field productlib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="product_category_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="product_category_is_verified" name="is_verified" class="product-category-field form-check-input productlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="product_category_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="product_category_is_active" name="is_active" class="product-category-field form-check-input productlib-fields" >
              {{-- @foreach ($agency_categories as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_product_category" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_product_category" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>