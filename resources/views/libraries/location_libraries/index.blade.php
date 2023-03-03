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
          <a class="nav-link active" id="location_barangay_tab" data-toggle="tab" href="#location_barangay" role="tab" aria-controls="location_barangay" aria-selected="true">Barangay</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="location_municipality_tab" data-toggle="tab" href="#location_municipality" role="tab" aria-controls="location_municipality" aria-selected="true">Municipality</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="location_province_tab" data-toggle="tab" href="#location_province" role="tab" aria-controls="location_province" aria-selected="true">Province</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="location_region_tab" data-toggle="tab" href="#location_region" role="tab" aria-controls="location_province" aria-selected="true">Region</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="location_cluster_tab" data-toggle="tab" href="#location_cluster" role="tab" aria-controls="location_cluster" aria-selected="true">Location Cluster</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="location_district_tab" data-toggle="tab" href="#location_district" role="tab" aria-controls="location_district" aria-selected="true">Location Disctrict</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="location_category_tab" data-toggle="tab" href="#location_category" role="tab" aria-controls="location_category" aria-selected="true">Location Category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="location_type_tab" data-toggle="tab" href="#location_type" role="tab" aria-controls="location_type" aria-selected="true">Location Type</a>
      </li>  
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="location_libraries">
        <div class="tab-pane fade show active" id="location_barangay" role="tabpanel" aria-labelledby="location_barangay_tab">
            @include('libraries.location_libraries.location_barangay.index')                    
        </div>   
        <div class="tab-pane fade" id="location_municipality" role="tabpanel" aria-labelledby="location_municipality_tab">
          @include('libraries.location_libraries.location_municipality.index')                    
        </div>  
        <div class="tab-pane fade" id="location_province" role="tabpanel" aria-labelledby="location_province_tab">
          @include('libraries.location_libraries.location_province.index')                    
        </div> 
        <div class="tab-pane fade" id="location_region" role="tabpanel" aria-labelledby="location_region_tab">
          @include('libraries.location_libraries.location_region.index')                    
        </div>   
        <div class="tab-pane fade" id="location_cluster" role="tabpanel" aria-labelledby="location_cluster_tab">
          @include('libraries.location_libraries.location_cluster.index')                    
        </div>   
        <div class="tab-pane fade" id="location_district" role="tabpanel" aria-labelledby="location_district_tab">
          @include('libraries.location_libraries.location_district.index')                    
        </div>     
        <div class="tab-pane fade" id="location_category" role="tabpanel" aria-labelledby="location_category_tab">
          @include('libraries.location_libraries.location_category.index')                    
        </div>   
        <div class="tab-pane fade" id="location_type" role="tabpanel" aria-labelledby="location_type_tab">
          @include('libraries.location_libraries.location_type.index')                    
        </div>    
    </div>
  </div>
</div>

@include('libraries.location_libraries.location_barangay.modal')   
@include('libraries.location_libraries.location_municipality.modal')   
@include('libraries.location_libraries.location_province.modal')   
@include('libraries.location_libraries.location_region.modal')   
@include('libraries.location_libraries.location_cluster.modal')   
@include('libraries.location_libraries.location_district.modal')   
@include('libraries.location_libraries.location_category.modal')   
@include('libraries.location_libraries.location_type.modal')   

@endsection


@section('jscript')
    <script type="text/javascript" defer>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            @include('libraries.location_libraries.location_barangay.script')
            @include('libraries.location_libraries.location_municipality.script')
            @include('libraries.location_libraries.location_province.script')
            @include('libraries.location_libraries.location_region.script')
            @include('libraries.location_libraries.location_cluster.script')
            @include('libraries.location_libraries.location_district.script')
            @include('libraries.location_libraries.location_category.script')
            @include('libraries.location_libraries.location_type.script')
            @include('scripts.common_script')
            @include('scripts.location')
        })   
    </script>
@endsection
 
