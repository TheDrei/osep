<!-- Modal -->
<div class="modal fade" id="user_modal" tabindex="-1" role="dialog" aria-labelledby="user_label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="user_modal_header"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>            
      <div class="modal-body">
        <div class="form-group">
          <label for="first_name">First Name</label>
          <input id="first_name" type="text" class="form-control user-field" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus required >           
        </div> 
        <div class="form-group">
          <label for="last_name">Last Name</label>
          <input id="last_name" type="text" class="form-control user-field" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus required >           
        </div> 
        <div class="form-group">
          <label for="username">Username</label>
          <input id="username" type="text" class="form-control user-field" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus required >           
          <span class="text-danger"><small id="username-error" class="error"></small></span>
        </div>          
        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" name="password" class="form-control user-field" type="password">
          <span class="text-danger"><small id="password-error" class="error"></small></span>
        </div>
        <div class="row">
          <div class="col">            
            <div class="form-check form-check-inline">
              <label for="user_is_pcaarrd">Is PCAARRD</label>&nbsp;
              <input type="checkbox" id="user_is_pcaarrd" name="is_pcaarrd" class="user-field form-check-input"> 
              {{-- @foreach ($agencies as $row)
                {{ $row->is_verified=="1"?true:false }}
              @endforeach> --}}
            </div>
            <div class="form-check form-check-inline">
              <label for="user_is_active">Is Active</label>&nbsp;
              <input type="checkbox" id="user_is_active" name="is_active" class="user-field form-check-input">
              {{-- @foreach ($agencies as $row)
                {{ $row->is_active=="yes"?true:false }}
              @endforeach> --}}
            </div>
          </div>
        </div>
      </div>      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="add_user" type="button" class="btn btn-primary save-buttons d-none">Save</button>
        <button id="update_user" type="button" class="btn btn-primary save-buttons d-none" value="update">Save changes</button>
      </div>
    </div>
  </div>
</div>