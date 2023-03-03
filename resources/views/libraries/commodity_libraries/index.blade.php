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
          <a class="nav-link active" id="commodity_tab" data-toggle="tab" href="#commodity" role="tab" aria-controls="commodity" aria-selected="true">Commodity</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="commodity_group_tab" data-toggle="tab" href="#commodity_group" role="tab" aria-controls="commodity_group" aria-selected="false">Commodity Group</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="commodity_individual_tab" data-toggle="tab" href="#commodity_individual" role="tab" aria-controls="commodity_individual" aria-selected="false">Commodity Individual</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="commodity_individual_product_tab" data-toggle="tab" href="#commodity_individual_product" role="tab" aria-controls="commodity_individual_product" aria-selected="false">Commodity Individual Product</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="commodity_product_tab" data-toggle="tab" href="#commodity_product" role="tab" aria-controls="commodity_product" aria-selected="false">Commodity Product</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="commodity_specific_tab" data-toggle="tab" href="#commodity_specific" role="tab" aria-controls="commodity_specific" aria-selected="false">Commodity Specific</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="commodity_libraries">
        <div class="tab-pane fade show active" id="commodity" role="tabpanel" aria-labelledby="commodity_tab">
            @include('libraries.commodity_libraries.commodity.index')                    
        </div>
        <div class="tab-pane fade" id="commodity_group" role="tabpanel" aria-labelledby="commodity_group_tab">
            @include('libraries.commodity_libraries.commodity_group.index')
        </div>
        <div class="tab-pane fade" id="commodity_individual" role="tabpanel" aria-labelledby="commodity_individual_tab">
            @include('libraries.commodity_libraries.commodity_individual.index')
        </div>
        <div class="tab-pane fade" id="commodity_individual_product" role="tabpanel" aria-labelledby="commodity_individual_product_tab">
            {{-- @include('libraries.commodity_libraries.commodity_individual_product.index') --}}
        </div>
        <div class="tab-pane fade" id="commodity_product" role="tabpanel" aria-labelledby="commodity_product_tab">
            @include('libraries.commodity_libraries.commodity_product.index')
        </div>
        <div class="tab-pane fade" id="commodity_specific" role="tabpanel" aria-labelledby="commodity_specific_tab">
            @include('libraries.commodity_libraries.commodity_specific.index')
        </div>
    </div>
  </div>
</div>

@include('libraries.commodity_libraries.commodity.modal')   
@include('libraries.commodity_libraries.commodity_group.modal')
@include('libraries.commodity_libraries.commodity_individual.modal')
{{--  @include('libraries.commodity_libraries.commodity_individual_product.modal')  --}}
@include('libraries.commodity_libraries.commodity_product.modal')
 @include('libraries.commodity_libraries.commodity_specific.modal') 

@endsection

@section('jscript')
    <script type="text/javascript" defer>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            @include('libraries.commodity_libraries.commodity.script')
            @include('libraries.commodity_libraries.commodity_group.script')
            @include('libraries.commodity_libraries.commodity_individual.script')
            @include('libraries.commodity_libraries.commodity_product.script')
            @include('libraries.commodity_libraries.commodity_specific.script')
            @include('scripts.common_script')
        })   
    </script>
@endsection
 
