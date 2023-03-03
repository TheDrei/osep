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
          <a class="nav-link active" id="budget_type_tab" data-toggle="tab" href="#budget_type" role="tab" aria-controls="budget_type" aria-selected="true">Budget Type</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="fund_source_type_tab" data-toggle="tab" href="#fund_source_type" role="tab" aria-controls="fund_source_type" aria-selected="false">Fund Source Type</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" id="fund_source_tab" data-toggle="tab" href="#fund_source" role="tab" aria-controls="fund_source" aria-selected="false">Fund Source</a>
      </li>     
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="budgetfunds_libraries">
        <div class="tab-pane fade show active" id="budget_type" role="tabpanel" aria-labelledby="budget_type_tab">
            @include('libraries.budgetfunds_libraries.budget_type.index')                    
        </div>
        <div class="tab-pane fade" id="fund_source_type" role="tabpanel" aria-labelledby="fund_source_type_tab">
            @include('libraries.budgetfunds_libraries.fund_source_type.index')
        </div>
        <div class="tab-pane fade" id="fund_source" role="tabpanel" aria-labelledby="fund_source_tab">
            @include('libraries.budgetfunds_libraries.fund_source.index')
        </div>
    </div>
  </div>
</div>

@include('libraries.budgetfunds_libraries.budget_type.modal')   
@include('libraries.budgetfunds_libraries.fund_source_type.modal')
@include('libraries.budgetfunds_libraries.fund_source.modal')
@endsection

@section('jscript')
    <script type="text/javascript" defer>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            @include('libraries.budgetfunds_libraries.budget_type.script')   
            @include('libraries.budgetfunds_libraries.fund_source_type.script')
            @include('libraries.budgetfunds_libraries.fund_source.script')
            @include('scripts.common_script')
        })   
    </script>
@endsection
 
