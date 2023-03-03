<!-- Modal -->
<div class="modal fade" id="commodity_product_modal" tabindex="-1" role="dialog" aria-labelledby="commodity_product_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commodity_product_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- <div class="row">
          <div class="col">
            <div class="status-message"></div>
          </div>
        </div> --}}
        <div class="form-group">
          <label for="commodity_id">Commodity</label>
          <input id="commodity_product_id" name="commodity_product_id" class="form-control commodity-product-field commoditylib-field" hidden>
          <select id="commodity_id" name="commodity_id" class="form-control commodity-product-field select2 commoditylib-field" disabled>
          </select>
        </div> 
        <div class="form-group">
          <label for="product_id">Product</label>
          <select id="product_id" name="product_id" class="form-control commodity-product-field select2 commoditylib-field" disabled>
          </select>
        </div>   
        <div class="form-group">
          <label for="commodity_product_tags">Tags</label>
          <input id="commodity_product_tags" class="form-control commodity-product-field commoditylib-field" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="commodity_product_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="commodity_is_verified" name="is_verified" class="commodity-product-field form-check-input commoditylib-field" >
            </div>
            <div class="form-check form-check-inline">
              <label for="commodity_product_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="commodity_is_active" name="is_active" class="commodity-product-field form-check-input commoditylib-field" >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_commodity_product" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_commodity_product" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>