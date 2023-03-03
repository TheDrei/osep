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
          <a class="nav-link active" id="employment_status_tab" data-toggle="tab" href="#employment_status" role="tab" aria-controls="employment_status" aria-selected="true">Employment Status</a>
      </li>     
      <li class="nav-item">
        <a class="nav-link" id="designation_tab" data-toggle="tab" href="#designation" role="tab" aria-controls="designation" aria-selected="true">Designation</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" id="designation_type_tab" data-toggle="tab" href="#designation_type" role="tab" aria-controls="designation_type" aria-selected="true">Designation Type</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" id="position_tab" data-toggle="tab" href="#position" role="tab" aria-controls="position" aria-selected="true">Position</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" id="position_category_tab" data-toggle="tab" href="#position_category" role="tab" aria-controls="position_category" aria-selected="true">Position Category</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" id="occupation_tab" data-toggle="tab" href="#occupation" role="tab" aria-controls="occupation" aria-selected="true">Occupation</a>
      </li> 
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="employment_libraries">
        <div class="tab-pane fade show active" id="employment_status" role="tabpanel" aria-labelledby="employment_status_tab">
          @include('libraries.employment_libraries.employment_status.index')                    
        </div>
        <div class="tab-pane fade" id="designation" role="tabpanel" aria-labelledby="designation_tab">
          @include('libraries.employment_libraries.designation.index')                    
        </div>
        <div class="tab-pane fade" id="designation_type" role="tabpanel" aria-labelledby="designation_type_tab">
          @include('libraries.employment_libraries.designation_type.index')                    
        </div>
        <div class="tab-pane fade" id="position" role="tabpanel" aria-labelledby="position_tab">
          @include('libraries.employment_libraries.position.index')                    
        </div>
        <div class="tab-pane fade" id="position_category" role="tabpanel" aria-labelledby="position_category_tab">
          @include('libraries.employment_libraries.position_category.index')                    
        </div>
        <div class="tab-pane fade" id="occupation" role="tabpanel" aria-labelledby="occupation_tab">
          @include('libraries.employment_libraries.occupation.index')                    
        </div>
    </div>
  </div>
</div>

@include('libraries.employment_libraries.employment_status.modal')  
@include('libraries.employment_libraries.designation.modal')  
@include('libraries.employment_libraries.designation_type.modal')  
@include('libraries.employment_libraries.position.modal')  
@include('libraries.employment_libraries.position_category.modal')  
@include('libraries.employment_libraries.occupation.modal')  

@endsection


@section('jscript')
    <script type="text/javascript" defer>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            @include('libraries.employment_libraries.employment_status.script')
            @include('libraries.employment_libraries.designation.script')
            @include('libraries.employment_libraries.designation_type.script')
            @include('libraries.employment_libraries.position.script')
            @include('libraries.employment_libraries.position_category.script')
            @include('libraries.employment_libraries.occupation.script')
            @include('scripts.common_script')
        })   
    </script>
@endsection
 
