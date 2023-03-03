<!-- Modal -->
<div class="modal fade" id="agency_modal" tabindex="-1" role="dialog" aria-labelledby="agency_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agency_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>            
      <div class="modal-body">
        <div class="form-group">
          <label for="agency_name">Agency Name</label>
          <input id="agency_id" name="agency_id" class="form-control agency-field agencylib-fields" type="text" hidden>
          <input id="agency_name" type="text" class="form-control agency-field agencylib-fields" name="agency_name" value="{{ old('agency_name') }}" required autocomplete="agency_name" autofocus required >           
          <span class="text-danger"><small id="agency-name-error" class="error"></small></span>
        </div>          
        <div class="form-group">
          <label for="agency_acronym">Agency Acronym</label>
          <input id="agency_acronym" class="form-control agency-field agencylib-fields" type="text">
        </div>
        <div class="row">
          <div class="form-group col">
            <label for="street">Street</label>
            <input id="street" class="form-control agency-field agencylib-fields" type="text">
          </div>
          <div class="form-group col">
            <label for="province_id">Province</label>
            <select id="province_id" name="province_id" class="form-control agency-field select2 agencylib-fields" required>
              <option value="" hidden>Select Province</option>
              @foreach ($location_provinces as $prov)
                <option value="{{ $prov->id }}"> {{ $prov->province }}</option>
              @endforeach
            </select>
            <span class="text-danger"><small id="province-error" class="error"></small></span>
          </div>         
          <div class="form-group col">
            <label for="municipality_id">Municipality</label>
            <select id="municipality_id" name="municipality_id" class="form-control agency-field select2 agencylib-fields" disabled
              @foreach ($agencies as $agency)
                {{ $agency->municipality_id ? 'selected' : ''}}               
              @endforeach>
              @foreach($location_municipalities as $mun)
                <option value="{{ $mun->id }}" {{$agency->municipality_id  ? 'selected' : ''}}>{{ $mun->municipality}}</option>
              @endforeach
            </select>
            <span class="text-danger"><small id="municipality-error" class="error"></small></span>
          </div>
          <div class="form-group col">
            <label for="barangay_id">Barangay</label>
            <select id="barangay_id" name="barangay_id" class="form-control agency-field select2 agencylib-fields" disabled
              @foreach ($agencies as $agency)
                {{ $agency->barangay_id ? 'selected' : ''}}               
              @endforeach>>   
            </select>
            <span class="text-danger"><small id="barangay-error" class="error"></small></span>
          </div>         
        </div>
        <div class="row">
          <div class="form-group col">
            <label for="telno">Telephone Number</label>
            <input id="telno" name="telno"  class="form-control agency-field agencylib-fields" type="text">
            <span class="text-danger"><small id="telno-error" class="error"></small></span>
          </div>
          <div class="form-group col">
            <label for="faxno">Fax Number</label>
            <input id="faxno" class="form-control agency-field agencylib-fields" type="text">
          </div>
        </div>
        <div class="row">
          <div class="form-group col">
            <label for="email">Email</label>
            <input id="email" name="email" class="form-control agency-field agencylib-fields" type="text">
            <span class="text-danger"><small id="email-error" class="error"></small></span>
          </div>
          <div class="form-group col">
            <label for="website">Website</label>
            <input id="website" class="form-control agency-field agencylib-fields" type="text">
          </div>         
        </div>
        <div class="form-group">
          <label for="head_agency_id">Head Agency</label>
          <select id="head_agency_id" class="form-control agency-field select2 agencylib-fields">                
          </select>
        </div>
        <div class="row">         
          <div class="form-group col">
            <label for="consortium_type_id">Consortium Type</label>
            <select id="consortium_type_id" class="form-control agency-field select2 agencylib-fields">              
            </select>
          </div>  
          <div class="form-group col">
            <label for="agency_category_id">Agency Category</label>
            <select id="head_agency_id" class="form-control agency-field select2 agencylib-fields">                
            </select>
          </div>               
        </div>
        <div class="row">
          <div class="form-group col">
            <label for="agency_class_id">Agency Class</label>
            <select id="agency_class_id" class="form-control agency-field select2 agencylib-fields">
              <option value="" selected hidden>Select Agency Class</option>
              @foreach ($agency_classes as $row)
                <option value="{{ $row->id }}"> {{ $row->agency_class }}</option>
              @endforeach
            </select>
          </div>  
          <div class="form-group col">
            <label for="agency_type_id">Agency Type</label>
            <select id="agency_type_id" class="form-control agency-field select2 agencylib-fields">
              <option value="" selected hidden>Select Agency Type</option>
              @foreach ($agency_types as $row)
                <option value="{{ $row->id }}"> {{ $row->agency_type }}</option>
              @endforeach
            </select>
          </div>         
        </div>
        <div class="row">
          <div class="form-group col">
            <label for="agency_group_id">Agency Group</label>
            <select id="agency_group_id" class="form-control agency-field select2 agencylib-fields">
              <option value="" selected hidden>Select Agency Group</option>
              @foreach ($agency_groups as $row)
                <option value="{{ $row->id }}"> {{ $row->agency_group }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col">
            <label for="agency_subgroup_id">Agency Sub-Group</label>
            <select id="agency_subgroup_id" class="form-control agency-field select2 agencylib-fields">           
            </select>
          </div>         
        </div>
        <div class="form-group">
          <label for="agency_tags">Tags</label>
          <input id="agency_tags" class="form-control agency-field agencylib-fields" type="text">
        </div>
        <div class="row">
          <div class="col">
            <div class="form-check form-check-inline">
              <label for="agency_is_verified">Is Verified</label>&nbsp;
              <input type="checkbox" id="agency_is_verified" name="is_verified" class="agency-field form-check-input agencylib-fields" 
              @foreach ($agencies as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach>
            </div>
            <div class="form-check form-check-inline">
              <label for="agency_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="agency_is_active" name="is_active" class="agency-field form-check-input agencylib-fields" 
              @foreach ($agencies as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach>
            </div>
          </div>
        </div>
      </div>      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_agency" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_agency" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>