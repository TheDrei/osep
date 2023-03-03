@extends('layouts.app')

@section('main-content')
    {{ csrf_field() }}
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">User Accounts</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                <button id="add_new_user" type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#user_modal">
                    Add User
                </button>
                </div>
            </div>
            <div class="row py-3">
                <div class="col">
                    <table id="users_table" class="table table-bordered table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                            <th>First Name</th>
                            <th>Last Name</th>                               
                            <th>Agency</th>   
                            <th>Username</th>  
                            <th>User Role</th>  
                            <th>Is PCAARRD</th>
                            <th>Is Active</th>
                            <th width="110px"></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('administration.users.modal')   
@endsection

@section('jscript')
    <script type="text/javascript" defer>
        $(document).ready(function(){            
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }) 
            $('#validate_form').parsley();
           
            @include('administration.users.script')
            @include('scripts.common_script')
            @include('scripts.location')
        })   
    </script>
@endsection
