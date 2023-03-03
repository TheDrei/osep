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
        <a class="nav-link active" id="area_concern_tab" data-toggle="tab" href="#area_concern" role="tab" aria-controls="area_concern" aria-selected="true">Area Concern</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="award_tab" data-toggle="tab" href="#award" role="tab" aria-controls="award" aria-selected="true">Award</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="equipment_tab" data-toggle="tab" href="#equipment" role="tab" aria-controls="equipment" aria-selected="true">Equipment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="language_tab" data-toggle="tab" href="#language" role="tab" aria-controls="language" aria-selected="true">Language</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="publication_group_tab" data-toggle="tab" href="#publication_group" role="tab" aria-controls="publication_group" aria-selected="true">Publication Group</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="ranking_tab" data-toggle="tab" href="#ranking" role="tab" aria-controls="ranking" aria-selected="true">Ranking</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="work_activity_tab" data-toggle="tab" href="#work_activity" role="tab" aria-controls="work_activity" aria-selected="true">Work Activity</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="tab-content" id="other_libraries">
        <div class="tab-pane fade show active" id="area_concern" role="tabpanel" aria-labelledby="area_concern_tab">
          @include('libraries.other_libraries.area_concern.index')                    
        </div>
        <div class="tab-pane fade" id="award" role="tabpanel" aria-labelledby="award_tab">
          @include('libraries.other_libraries.award.index')                    
        </div>
        <div class="tab-pane fade" id="equipment" role="tabpanel" aria-labelledby="equipment_tab">
          @include('libraries.other_libraries.equipment.index')                    
        </div>
        <div class="tab-pane fade" id="language" role="tabpanel" aria-labelledby="language_tab">
          @include('libraries.other_libraries.language.index')                    
        </div>
        <div class="tab-pane fade" id="publication_group" role="tabpanel" aria-labelledby="publication_group_tab">
          @include('libraries.other_libraries.publication_group.index')                    
        </div>
        <div class="tab-pane fade" id="ranking" role="tabpanel" aria-labelledby="ranking_tab">
          @include('libraries.other_libraries.ranking.index')                    
        </div>
        <div class="tab-pane fade" id="work_activity" role="tabpanel" aria-labelledby="work_activity_tab">
          @include('libraries.other_libraries.work_activity.index')                    
        </div>
    </div>
  </div>
</div>

@include('libraries.other_libraries.area_concern.modal')
@include('libraries.other_libraries.award.modal')
@include('libraries.other_libraries.equipment.modal')
@include('libraries.other_libraries.language.modal')
@include('libraries.other_libraries.publication_group.modal')
@include('libraries.other_libraries.ranking.modal')
@include('libraries.other_libraries.work_activity.modal')

@endsection


@section('jscript')
    <script type="text/javascript" defer>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            @include('libraries.other_libraries.area_concern.script')
            @include('libraries.other_libraries.award.script')
            @include('libraries.other_libraries.equipment.script')
            @include('libraries.other_libraries.language.script')
            @include('libraries.other_libraries.publication_group.script')
            @include('libraries.other_libraries.ranking.script')
            @include('libraries.other_libraries.work_activity.script')
            @include('scripts.common_script')
        })   
    </script>
@endsection
 
