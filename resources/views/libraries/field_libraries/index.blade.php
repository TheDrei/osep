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
          <a class="nav-link active" id="field_of_specialization_tab" data-toggle="tab" href="#field_of_specialization" role="tab" aria-controls="field_of_specialization" aria-selected="true">Field Specialization</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="field_of_specialization_group_tab" data-toggle="tab" href="#field_of_specialization_group" role="tab" aria-controls="field_of_specialization_group" aria-selected="true">Field Specialization Group</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="discipline_tab" data-toggle="tab" href="#discipline" role="tab" aria-controls="discipline" aria-selected="true">Discipline</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="sector_tab" data-toggle="tab" href="#sector" role="tab" aria-controls="sector" aria-selected="true">Sector</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="field_libraries">
        <div class="tab-pane fade show active" id="field_of_specialization" role="tabpanel" aria-labelledby="field_of_specialization_tab">
            @include('libraries.field_libraries.field_specialization.index')                    
        </div>
        <div class="tab-pane fade" id="field_of_specialization_group" role="tabpanel" aria-labelledby="field_of_specialization_group_tab">
          @include('libraries.field_libraries.field_specialization_group.index')                    
        </div>
        <div class="tab-pane fade" id="discipline" role="tabpanel" aria-labelledby="discipline_tab">
          @include('libraries.field_libraries.discipline.index')                    
        </div>
        <div class="tab-pane fade" id="sector" role="tabpanel" aria-labelledby="sector_tab">
          @include('libraries.field_libraries.sector.index')                    
        </div>
    </div>
  </div>
</div>

@include('libraries.field_libraries.field_specialization.modal')   
@include('libraries.field_libraries.field_specialization_group.modal')   
@include('libraries.field_libraries.discipline.modal')   
@include('libraries.field_libraries.sector.modal')   

@endsection


@section('jscript')
    <script type="text/javascript" defer>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            @include('libraries.field_libraries.field_specialization.script')
            @include('libraries.field_libraries.field_specialization_group.script')
            @include('libraries.field_libraries.discipline.script')
            @include('libraries.field_libraries.sector.script')
            @include('scripts.common_script')
        })   
    </script>
@endsection
 
