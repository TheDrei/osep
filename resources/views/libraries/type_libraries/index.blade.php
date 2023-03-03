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
        <a class="nav-link active" id="authoring_type_tab" data-toggle="tab" href="#authoring_type" role="tab" aria-controls="authoring_type" aria-selected="true">Authoring Type</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="client_type_tab" data-toggle="tab" href="#client_type" role="tab" aria-controls="client_type" aria-selected="true">Client Type</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="document_type_tab" data-toggle="tab" href="#document_type" role="tab" aria-controls="document_type" aria-selected="true">Document Type</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="document_type_group_tab" data-toggle="tab" href="#document_type_group" role="tab" aria-controls="document_type_group" aria-selected="true">Document Type Group</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="type_libraries">
        <div class="tab-pane fade show active" id="authoring_type" role="tabpanel" aria-labelledby="authoring_type_tab">
          @include('libraries.type_libraries.authoring_type.index')                    
        </div>
        <div class="tab-pane fade" id="client_type" role="tabpanel" aria-labelledby="client_type_tab">
          @include('libraries.type_libraries.client_type.index')                    
        </div>
        <div class="tab-pane fade" id="document_type" role="tabpanel" aria-labelledby="document_type_tab">
          @include('libraries.type_libraries.document_type.index')                    
        </div>
        <div class="tab-pane fade" id="document_type_group" role="tabpanel" aria-labelledby="document_type_group_tab">
          @include('libraries.type_libraries.document_type_group.index')                    
        </div>
    </div>
  </div>
</div>

@include('libraries.type_libraries.authoring_type.modal')
@include('libraries.type_libraries.client_type.modal')
@include('libraries.type_libraries.document_type.modal')
@include('libraries.type_libraries.document_type_group.modal')

@endsection


@section('jscript')
    <script type="text/javascript" defer>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            @include('libraries.type_libraries.authoring_type.script')
            @include('libraries.type_libraries.client_type.script')
            @include('libraries.type_libraries.document_type.script')
            @include('libraries.type_libraries.document_type_group.script')
            @include('scripts.common_script')
        })   
    </script>
@endsection
 
