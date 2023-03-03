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
        <a class="nav-link active" id="project_designation_tab" data-toggle="tab" href="#project_designation" role="tab" aria-controls="project_designation" aria-selected="true">Project Designation</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="project_sector_tab" data-toggle="tab" href="#project_sector" role="tab" aria-controls="project_sector" aria-selected="true">Project Sector</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="project_status_tab" data-toggle="tab" href="#project_status" role="tab" aria-controls="project_status" aria-selected="true">Project Status</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="project_libraries">
        <div class="tab-pane fade show active" id="project_designation" role="tabpanel" aria-labelledby="project_designation_tab">
          @include('libraries.project_libraries.project_designation.index')                    
        </div>
        <div class="tab-pane fade" id="project_sector" role="tabpanel" aria-labelledby="project_sector_tab">
          @include('libraries.project_libraries.project_sector.index')                    
        </div>
        <div class="tab-pane fade" id="project_status" role="tabpanel" aria-labelledby="project_status_tab">
          @include('libraries.project_libraries.project_status.index')                    
        </div>
    </div>
  </div>
</div>

@include('libraries.project_libraries.project_designation.modal')
@include('libraries.project_libraries.project_sector.modal')
@include('libraries.project_libraries.project_status.modal')

@endsection


@section('jscript')
    <script type="text/javascript" defer>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            @include('libraries.project_libraries.project_designation.script')
            @include('libraries.project_libraries.project_sector.script')
            @include('libraries.project_libraries.project_status.script')
            @include('scripts.common_script')
        })   
    </script>
@endsection
 
