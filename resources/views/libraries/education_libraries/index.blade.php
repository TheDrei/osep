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
          <a class="nav-link active" id="education_degree_tab" data-toggle="tab" href="#education_degree" role="tab" aria-controls="education_degree" aria-selected="true">Education Degree</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="education_major_field_tab" data-toggle="tab" href="#education_major_field" role="tab" aria-controls="education_major_field" aria-selected="true">Education Major Field</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="education_status_tab" data-toggle="tab" href="#education_status" role="tab" aria-controls="education_status" aria-selected="true">Education Status</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="education_libraries">
        <div class="tab-pane fade show active" id="education_degree" role="tabpanel" aria-labelledby="education_degree_tab">
            @include('libraries.education_libraries.education_degree.index')                    
        </div>
        <div class="tab-pane fade" id="education_major_field" role="tabpanel" aria-labelledby="education_major_field_tab">
            @include('libraries.education_libraries.education_major_field.index')   
        </div>
        <div class="tab-pane fade" id="education_status" role="tabpanel" aria-labelledby="education_status_tab">
            @include('libraries.education_libraries.education_status.index')                    
        </div>
    </div>
  </div>
</div>

@include('libraries.education_libraries.education_degree.modal')  
@include('libraries.education_libraries.education_major_field.modal')  
@include('libraries.education_libraries.education_status.modal')  

@endsection

@section('jscript')
    <script type="text/javascript" defer>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            @include('libraries.education_libraries.education_degree.script')
            @include('libraries.education_libraries.education_major_field.script')
            @include('libraries.education_libraries.education_status.script')
            @include('scripts.common_script')
        })   
    </script>
@endsection
 
