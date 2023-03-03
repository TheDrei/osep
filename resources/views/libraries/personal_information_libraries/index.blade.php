@extends('layouts.app')
<!-- @section('title')
  {{ config('app.name') }} | Agency Libraries
@endsection -->

@section('main-content')
{{ csrf_field() }}
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs" id="libraries_nav_tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="civil_status_tab" data-toggle="tab" href="#civil_status" role="tab" aria-controls="civil_status" aria-selected="true">Civil Status</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="gender_tab" data-toggle="tab" href="#gender" role="tab" aria-controls="gender" aria-selected="true">Gender</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="name_list_tab" data-toggle="tab" href="#name_list" role="tab" aria-controls="name_list" aria-selected="true">Names</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="user_role_tab" data-toggle="tab" href="#user_role" role="tab" aria-controls="user_role" aria-selected="true">User Roles</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="personal_information_libraries">
        <div class="tab-pane fade show active" id="civil_status" role="tabpanel" aria-labelledby="civil_status_tab">
          @include('libraries.personal_information_libraries.civil_status.index')                    
        </div>
        <div class="tab-pane fade" id="gender" role="tabpanel" aria-labelledby="gender_tab">
          @include('libraries.personal_information_libraries.gender.index')                    
        </div>
        <div class="tab-pane fade" id="name_list" role="tabpanel" aria-labelledby="name_list_tab">
          @include('libraries.personal_information_libraries.name_list.index')                    
        </div>
        <div class="tab-pane fade" id="user_role" role="tabpanel" aria-labelledby="user_role_tab">
          @include('libraries.personal_information_libraries.user_role.index')                    
        </div>
    </div>
  </div>
</div>

@include('libraries.personal_information_libraries.civil_status.modal')
@include('libraries.personal_information_libraries.gender.modal')
@include('libraries.personal_information_libraries.name_list.modal')
@include('libraries.personal_information_libraries.user_role.modal')

@endsection


@section('jscript')
    <script type="text/javascript" defer>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            @include('libraries.personal_information_libraries.civil_status.script')
            @include('libraries.personal_information_libraries.gender.script')
            @include('libraries.personal_information_libraries.name_list.script')
            @include('libraries.personal_information_libraries.user_role.script')
            @include('scripts.common_script')
        })   
    </script>
@endsection
 
