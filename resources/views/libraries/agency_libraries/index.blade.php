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
          <a class="nav-link active" id="agency_tab" data-toggle="tab" href="#agency" role="tab" aria-controls="agency" aria-selected="true">Agency</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="agency_category_tab" data-toggle="tab" href="#agency_category" role="tab" aria-controls="agency_category" aria-selected="false">Agency Category</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="agency_class_tab" data-toggle="tab" href="#agency_class" role="tab" aria-controls="agency_class" aria-selected="false">Agency Class</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="agency_group_tab" data-toggle="tab" href="#agency_group" role="tab" aria-controls="agency_group" aria-selected="false">Agency Group</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="agency_subcategory_tab" data-toggle="tab" href="#agency_subcategory" role="tab" aria-controls="agency_subcategory" aria-selected="false">Agency Sub-Category</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="agency_subgroup_tab" data-toggle="tab" href="#agency_subgroup" role="tab" aria-controls="agency_subgroup" aria-selected="false">Agency Sub-Group</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="agency_type_tab" data-toggle="tab" href="#agency_type" role="tab" aria-controls="agency_type" aria-selected="false">Agency Type</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="agency_libraries">
        <div class="tab-pane fade show active" id="agency" role="tabpanel" aria-labelledby="agency_tab">
            @include('libraries.agency_libraries.agency.index')                    
        </div>
        <div class="tab-pane fade" id="agency_category" role="tabpanel" aria-labelledby="agency_category_tab">
            @include('libraries.agency_libraries.agency_category.index')
        </div>
        <div class="tab-pane fade" id="agency_class" role="tabpanel" aria-labelledby="agency_class_tab">
            @include('libraries.agency_libraries.agency_class.index')
        </div>
        <div class="tab-pane fade" id="agency_group" role="tabpanel" aria-labelledby="agency_group_tab">
            @include('libraries.agency_libraries.agency_group.index')
        </div>
        <div class="tab-pane fade" id="agency_subcategory" role="tabpanel" aria-labelledby="agency_subcategory_tab">
            @include('libraries.agency_libraries.agency_subcategory.index')
        </div>
        <div class="tab-pane fade" id="agency_subgroup" role="tabpanel" aria-labelledby="agency_subgroup_tab">
            @include('libraries.agency_libraries.agency_subgroup.index')
        </div>
        <div class="tab-pane fade" id="agency_type" role="tabpanel" aria-labelledby="agency_type_tab">
            @include('libraries.agency_libraries.agency_type.index')
        </div>
    </div>
  </div>
</div>

@include('libraries.agency_libraries.agency.modal')   
@include('libraries.agency_libraries.agency_category.modal')
@include('libraries.agency_libraries.agency_class.modal')
@include('libraries.agency_libraries.agency_group.modal')
@include('libraries.agency_libraries.agency_subcategory.modal')
@include('libraries.agency_libraries.agency_subgroup.modal')
@include('libraries.agency_libraries.agency_type.modal')

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

            @include('libraries.agency_libraries.agency.script')
            @include('libraries.agency_libraries.agency_category.script')
            @include('libraries.agency_libraries.agency_class.script')
            @include('libraries.agency_libraries.agency_group.script')
            @include('libraries.agency_libraries.agency_subcategory.script')
            @include('libraries.agency_libraries.agency_subgroup.script')
            @include('libraries.agency_libraries.agency_type.script')
            @include('scripts.common_script')
            @include('scripts.location')
        })   
    </script>
@endsection
 
