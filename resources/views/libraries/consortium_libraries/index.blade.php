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
        <a class="nav-link active" id="consortium_tab" data-toggle="tab" href="#consortium" role="tab" aria-controls="consortium" aria-selected="true">Consortium</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="consortium_type_tab" data-toggle="tab" href="#consortium_type" role="tab" aria-controls="consortium_type" aria-selected="true">Consortium Type</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="consortium_libraries">
        <div class="tab-pane fade show active" id="consortium" role="tabpanel" aria-labelledby="consortium_tab">
          @include('libraries.consortium_libraries.consortium.index')                    
        </div>
        <div class="tab-pane fade" id="consortium_type" role="tabpanel" aria-labelledby="consortium_type_tab">
          @include('libraries.consortium_libraries.consortium_type.index')                    
        </div>
    </div>
  </div>
</div>

@include('libraries.consortium_libraries.consortium.modal')
@include('libraries.consortium_libraries.consortium_type.modal')

@endsection


@section('jscript')
    <script type="text/javascript" defer>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            @include('libraries.consortium_libraries.consortium.script')
            @include('libraries.consortium_libraries.consortium_type.script')
            @include('scripts.common_script')
        })   
    </script>
@endsection
 
