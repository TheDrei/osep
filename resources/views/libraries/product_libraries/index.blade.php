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
        <a class="nav-link active" id="product_tab" data-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="true">Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="product_category_tab" data-toggle="tab" href="#product_category" role="tab" aria-controls="product_category" aria-selected="true">Product Catgory</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="product_libraries">
        <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product_tab">
          @include('libraries.product_libraries.product.index')                    
        </div>
        <div class="tab-pane fade" id="product_category" role="tabpanel" aria-labelledby="product_category_tab">
          @include('libraries.product_libraries.product_category.index')                    
        </div>
    </div>
  </div>
</div>

@include('libraries.product_libraries.product.modal')
@include('libraries.product_libraries.product_category.modal')

@endsection


@section('jscript')
    <script type="text/javascript" defer>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            @include('libraries.product_libraries.product.script')
            @include('libraries.product_libraries.product_category.script')
            @include('scripts.common_script')
        })   
    </script>
@endsection
 
