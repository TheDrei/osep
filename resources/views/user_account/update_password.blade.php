@extends('layouts.app')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Update Password</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Update Password</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<hr>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="user_current_password">
                                        Current Password:
                                    </label>
                                    <input id="user_current_password" type="password" name="user_current_password" class="form-control user-password-field required-field">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="user_new_password">
                                        New Password:
                                    </label>
                                    <input id="user_new_password" type="password" name="user_new_password" class="form-control user-password-field required-field">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="user_confirm_password">
                                        Confirm Password
                                    </label>
                                    <input id="user_confirm_password" type="password" name="user_confirm_password" class="form-control user-password-field required-field">
                                </div>
                            </div>
                        </div>
                        <button id="save_update_password" type="button" class="btn btn-primary btn-lg">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            

            //error_checking
            function update_password(current_password, new_password, confirm_password) {
                var request = $.ajax({
                  url: "{{ route('users.update_password')}}",
                  method: 'POST',
                  data: {
                    '_token' : '{{ csrf_token() }}',
                    'current_password': current_password,
                    'new_password': new_password,
                    'confirm_password': confirm_password
                  }
                });
                return request;
            }

            $('#save_update_password').on('click', function(e) {
                var current_password = $('#user_current_password').val();
                var new_password = $('#user_new_password').val();  
                var confirm_password = $('#user_confirm_password').val();
                if(error_checking($('.required-field'))) {
                    show_notif('Please fill out the required fields.')
                    return
                }
                var request = update_password(current_password, new_password, confirm_password);
                request.then(function(data) {
                    show_notif(data['view']);
                    $('.user-password-field').val('').change();
                })
            })
        })        
    </script>
@endsection