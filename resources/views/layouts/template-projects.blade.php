@extends('layouts.app')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Projects</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Projects</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<hr>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="card">
          @yield('table-content')
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Modals -->
<div class="modal fade view-proposal-modal" id="view_program_modal" tabindex="-1" role="dialog" aria-labelledby="view_program_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false"> 
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="view_program_modal_label">View Program</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row py-1">
            <div class="col-md-12">
              <button type="button" class="btn btn-success float-right download-program-files download-proposal-files">Download all program files</button>
            </div>
          </div>
          <ul id="dost_form_tabs" class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="dost_form1_tab" data-toggle="tab" href="#dost_form1" role="tab" aria-controls="dost_form1" aria-selected="true">Form 1 (Program Info)</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="dost_form2_tab" data-toggle="tab" href="#dost_form2" role="tab" aria-controls="dost_form2" aria-selected="true">Form 2 (Project Info)</a>
            </li>
            @if(Auth::user()->privilege == 1 || Auth::user()->privilege == 2)
            <li>
              <a class="nav-link" id="program_monitoring_form_tab" data-toggle="tab" href="#program_monitoring_form" role="tab" aria-controls="program_monitoring_form" aria-selected="true">Monitoring Form</a>
            </li>
            @else
            <li>
              <a class="nav-link d-none" id="program_monitoring_form_tab" data-toggle="tab" href="#program_monitoring_form" role="tab" aria-controls="program_monitoring_form" aria-selected="true">Monitoring Form</a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" id="program_files_tab" data-toggle="tab" href="#program_files" role="tab" aria-controls="program_files" aria-selected="true">Program Files</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="program_researchers_tab" data-toggle="tab" href="#program_researchers" role="tab" aria-controls="program_researchers" aria-selected="true">Program Researchers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="program_comments_tab" data-toggle="tab" href="#program_comments" role="tab" aria-controls="program_comments" aria-selected="true">Comments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="program_timeline_tab" data-toggle="tab" href="#program_timeline" role="tab" aria-controls="program_timeline" aria-selected="true">Timeline</a>
            </li>
          </ul>
          <div class="tab-content" id="dost_form_program_content">
            <div class="tab-pane fade show active proposal-info-tab proposal-download-form" id="dost_form1" role="tabpanel" aria-labelledby="dost_form1_tab">
              <div class="container">
                <div class="row pt-3">
                  <div class="col-md-12">
                    <div class="proposal-info-content proposal-download-content">
                      <div class="form-content p-3">
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="clearfix">
                  <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success print-program print-proposal">Print</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="dost_form2" role="tabpanel" aria-labelledby="dost_form2_tab">
              <div class="container">
                <div class="row pt-3">
                  <div class="col-md-3">
                    <div class="text-center">
                      <h3>Project List</h3>
                    </div>
                    <ul id="project_list" class="proposal-info-list">
                    </ul>
                  </div>
                  <div class="col-md-9">
                    <ul id="program_project_info_tabs" class="nav nav-tabs d-none" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="program_project_info_tab" data-toggle="tab" href="#program_project_info" role="tab" aria-controls="program_project_info" aria-selected="true">Project Info</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="program_project_content">
                      <div class="tab-pane fade show active" id="program_project_info" role="tabpanel" aria-labelledby="program_project_info_tab">
                        <div class="form-content project-info project-info-content p-3"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="clearfix">
                  <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade proposal-monitoring-form proposal-download-form" id="program_monitoring_form" role="tabpanel" aria-labelledby="program_monitoring_form_tab">
              <div class="container">
                <div class="row pt-3">
                  <div class="col-md-12">
                    <div class="proposal-info-content">
                      <div class="form-content p-3">
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="clearfix">
                  <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success print-program print-proposal">Print</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="program_files" role="tabpanel" aria-labelledby="program_files_tab">
              <div class="container">
                <div class="row pt-3">
                  <div class="col-md-12">
                    <div class="text-center">
                      <h3>Program Files List</h3>
                    </div>
                    <hr>
                  </div>
                </div>
                <div class="clearfix py-2">
                  <label class="btn btn-success float-right">
                    Upload | <i class="fas fa-caret-down"></i> 
                    <input id="upload_program_file" type="file" hidden>
                  </label>
                </div>
                <div class="alert alert-files proposal-info-list">
                  <h4>From DPMIS</h4>
                  <div>
                    <small>
                      <b>
                        <i>
                          <span>File count: </span>
                          <span class="program_files_count">0</span>
                        </i>
                      </b>
                    </small>
                  </div>
                  <ul id="dpmis_program_files_list"></ul>
                </div>
                <hr>
                <div class="alert alert-files proposal-info-list">
                  <h4>Internal Files</h4>
                  <ul id="internal_program_files_list" class="internal-files-list"></ul>
                </div>
                <hr>
                <div class="clearfix">
                  <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="program_researchers" role="tabpanel" aria-labelledby="program_researchers_tab">
              <div class="container">
                <div class="row pt-3">
                  <div class="col-md-3">
                    <div class="text-center">
                      <h3>Program Researchers</h3>
                    </div>
                    <ul id="program_researchers_list" class="proposal-info-list researchers-list">
                  </div>
                  <div class="col-md-9">
                    <ul id="program_researcher_info_tabs" class="nav nav-tabs d-none" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="program_researcher_info_tab" data-toggle="tab" href="#program_researcher_info" role="tab" aria-controls="program_researcher_info" aria-selected="true">Researcher Info</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="program_researcher_content">
                      <div class="tab-pane fade show active" id="program_researcher_info" role="tabpanel" aria-labelledby="program_researcher_info_tab">
                        <div class="form-content proposal-researcher-info program-researcher-info program-researcher-info-content p-3"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="clearfix">
                  <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success print-resume">Print Resume</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade comments-tab" id="program_comments" role="tabpanel" aria-labelledby="program_comments_tab">
              <div class="d-block comments-list">
                <div class="text-center my-3">
                  <h3>Program Comments List</h3>
                </div>
                <ul id="program_comments_list" class="proposal-info-list proposal-comments-list">
                  <li class="py-1 text-break">
                    <a href="#" class="toggle-view-comments toggle-inline-comments-buttons all-inline-comments" data-target-comments-display="comments-inline">View <b>all</b> <i>inline</i> comments</a>
                  </li>
                  <li class="py-1 text-break">
                    <a href="#" class="toggle-view-comments toggle-outline-comments-buttons all-outline-comments" data-target-comments-display="comments-outline">View <b>all</b> <i>outline</i> comments</a>
                  </li>
                  <li class="py-1 text-break">
                    <a href="#" class="toggle-view-comments toggle-inline-comments-buttons trd-inline-comments" data-target-comments-display="comments-inline" data-comment-type="3">View <i>inline</i> comments by <b>TRDs</b></a>
                  </li>
                  <li class="py-1 text-break">
                    <a href="#" class="toggle-view-comments toggle-outline-comments-buttons trd-outline-comments" data-target-comments-display="comments-outline" data-comment-type="3">View <i>outline</i> comments by <b>TRDs</b></a>
                  </li>
                  <li class="py-1 text-break">
                    <a href="#" class="toggle-view-comments toggle-inline-comments-buttons trep-inline-comments" data-target-comments-display="comments-inline" data-comment-type="4">View <i>inline</i> comments by <b>TREP</b></a>
                  </li>
                  <li class="py-1 text-break">
                    <a href="#" class="toggle-view-comments toggle-outline-comments-buttons trep-outline-comments" data-target-comments-display="comments-outline" data-comment-type="4">View <i>outline</i> comments by <b>TREP</b></a>
                  </li>
                </ul>
                <hr>
                <div class="clearfix">
                  <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
              <div class="d-none comments-inline">
                <div class="py-2">
                  <a href="#" class="toggle-view-comments back-button" data-target-comments-display="comments-list"><u><i class="fas fa-angle-left"></i> Back</u></a>
                </div>
                <div class="form-content program-info-content p-3"></div>
                <hr>
              </div>
              <div class="d-none comments-outline">
                <div class="py-2">
                  <a href="#" class="toggle-view-comments back-button" data-target-comments-display="comments-list"><u><i class="fas fa-angle-left"></i> Back</u></a>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-content program-info-content p-3"></div>
                    <hr>
                    <div class="card">
                      <div class="card-header bg-info">
                        <div class="text-center">
                          <h4 class="py-2">Outline comments <br> <span class="comments-classification">(All comments)<span></h4>
                        </div>
                      </div>
                      <div class="card-body">
                        <ul id="program_outline_comments" class="list-group list-group-flush proposal-info-list proposal-outline-all-comments outline-comments">
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card container-comment-section">
                      <div class="card-header bg-info">
                        <div class="text-center">
                          <h4 class="py-2">Write a comment <br>(Please select a field):</h4>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="rounded bg-light my-2 p-2">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <select id="program_comment_section_outline" class="form-control form-control comment-section ml-1">
                                  <option value="" selected disabled hidden>N/A</option>
                                  <option value="0">Overall</option>
                                  <optgroup data-proposal-type-id="1" data-comments-section-id="1" label="DOST Form 1 (Program Proposal)">
                                    <optgroup class="pl-1" label="(1) Program Profile">
                                      <option class="pl-2 d-block" value="1">Program Title</option>
                                      <option class="pl-2 d-block" value="2">Program Leader/Sex</option>
                                      <option class="pl-2 d-block" value="3">Program Duration (number of months)</option>
                                      <option class="pl-2 d-block" value="4">Program Start Date</option>
                                      <option class="pl-2 d-block" value="5">Program End Date</option>
                                      <option class="pl-2 d-block" value="6">Implementing Agency</option>
                                      <option class="pl-2 d-block" value="7">Address/Telephone/Fax/Email</option>
                                      <option class="pl-2 d-block" value="8">Title of Component Projects</option>
                                    </optgroup>
                                    <optgroup class="pl-1" data-comments-section-id="2" label="(2) Program Summary">
                                      <option class="pl-2 d-block" value="9">Objectives (General)</option>
                                      <option class="pl-2 d-block" value="10">Objectives (Specific)</option>
                                      <option class="pl-2 d-block" value="11">Significance/Impact to knowledge advancement and to the society</option>
                                      <option class="pl-2 d-block" value="12">Methodology</option>
                                      <option class="pl-2 d-block" value="13">Conceptual Framework (how the projects are interrelated)</option>
                                      <option class="pl-2 d-block" value="14">Discussion of possible complementation or utilization of related DOST-GIA funded Programs/projects previously handled by the same Program Leader (if any)</option>
                                      <option class="pl-2 d-block" value="15">Gender Sensitivity/Responsiveness</option>
                                    </optgroup>
                                    <optgroup class="pl-1" data-comments-section-id="3" label="(3) Budget Summary for the Whole Program">
                                      <option class="pl-2 d-block" value="16">Budget Summary for the Whole Program</option>
                                    </optgroup>
                                    <optgroup class="pl-1" data-comments-section-id="4" label="(4) Number of Personnel Requirement">
                                      <option class="pl-2 d-block" value="17">Number of Personnel Requirement</option>
                                    </optgroup>
                                    <optgroup class="pl-1" data-comments-section-id="5" label="(5) Summary of Equipment Relevant to the Program">
                                      <option class="pl-2 d-block" value="18">Summary of Equipment Relevant to the Program</option>
                                    </optgroup>
                                    <optgroup class="pl-1" data-comments-section-id="6" label="(6) Other ongoing Programs being handled by the Program Leader">
                                      <option class="pl-2 d-block" value="19">Other ongoing Programs being handled by the Program Leader</option>
                                    </optgroup>
                                    <optgroup class="pl-1" data-comments-section-id="7" label="(7) Submitted by/Endorsed by">
                                    </optgroup>
                                  </optgroup>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <textarea id="program_comment_overall" class="summernote proposals-outline-comment"></textarea>
                        </div>
                        <hr>
                        <div class="clearfix">
                          <div class="float-right">
                            <button type="button" class="btn btn-success add-outline-comment">Add comment</button>
                          </div>  
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header bg-info">
                        <div class="text-center">
                          <h4 class="py-2">Outline comments <br> (your comments)</h4>
                        </div>
                      </div>
                      <div class="card-body">
                        <ul id="program_outline_comments" class="list-group list-group-flush proposal-info-list proposal-outline-user-comments outline-comments">
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="clearfix">
                  <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="program_timeline" role="tabpanel" aria-labelledby="program_timeline_tab">
              <div class="container">
                <div class="row pt-3">
                  <div class="col-md-12">
                    <div class="text-center">
                      <h3>Program Timeline</h3>
                    </div>
                    <div class="proposal-info-list">
                      <ul id="program_timeline_list" class="rounded bg-info p-5 proposal-timeline">
                      </ul>
                    </div>
                    <hr>
                    <div class="clearfix">
                      <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade view-proposal-modal" id="view_project_modal" tabindex="-1" role="dialog" aria-labelledby="view_project_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false"> 
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="view_project_modal_label">View Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row py-1">
            <div class="col-md-12">
              <button type="button" class="btn btn-success float-right download-project-files download-proposal-files">Download all project files</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <ul id="project_info_tabs" class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="project_info_tab" data-toggle="tab" href="#project_info" role="tab" aria-controls="project_info" aria-selected="true">Project Info</a>
                </li>
                @if(Auth::user()->privilege == 1 || Auth::user()->privilege == 2)
                <li>
                  <a class="nav-link" id="project_monitoring_form_tab" data-toggle="tab" href="#project_monitoring_form" role="tab" aria-controls="project_monitoring_form" aria-selected="true">Monitoring Form</a>
                </li>
                @else
                <li>
                  <a class="nav-link d-none" id="project_monitoring_form_tab" data-toggle="tab" href="#project_monitoring_form" role="tab" aria-controls="project_monitoring_form" aria-selected="true">Monitoring Form</a>
                </li>
                @endif
                <li class="nav-item">
                  <a class="nav-link" id="project_lib_tab" data-toggle="tab" href="#project_lib" role="tab" aria-controls="project_lib" aria-selected="true">LIB</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="project_files_tab" data-toggle="tab" href="#project_files" role="tab" aria-controls="project_files" aria-selected="true">Project Files</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="project_researchers_tab" data-toggle="tab" href="#project_researchers" role="tab" aria-controls="project_researchers" aria-selected="true">Researchers</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="project_comments_tab" data-toggle="tab" href="#project_comments" role="tab" aria-controls="project_comments" aria-selected="true">Comments</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="project_timeline_tab" data-toggle="tab" href="#project_timeline" role="tab" aria-controls="project_timeline" aria-selected="true">Timeline</a>
                </li>
              </ul>
              <div class="tab-content" id="project_content">
                <div class="tab-pane fade show active proposal-info-tab proposal-download-form" id="project_info" role="tabpanel" aria-labelledby="project_info_tab">
                  <div class="proposal-info-content">
                    <div class="form-content project-info-content p-3 proposal-download-content"></div>
                  </div>
                  <hr>
                  <div class="clearfix">
                    <div class="float-right">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-success print-project print-proposal">Print</button>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade proposal-monitoring-form proposal-download-form" id="project_monitoring_form" role="tabpanel" aria-labelledby="project_monitoring_form_tab">
                  <div class="proposal-info-content">
                    <div class="form-content project-info-content p-3"></div>
                  </div>
                  <hr>
                  <div class="clearfix">
                    <div class="float-right">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-success print-project print-proposal">Print</button>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade proposal-download-form" id="project_lib" role="tabpanel" aria-labelledby="project_lib_tab">
                  <div class="form-group">
                    <label for="project_lib_year">Please select:</label>
                    <select class="form-control" id="project_lib_year">
                      <option hidden selected disabled value="">Select year...</option>
                    </select>
                  </div>
                  <div class="collapse lib-content p-3 project-info-content">
                    <div class="text-center">
                      <div>
                        <label>
                          DOST Form A
                        </label>
                      </div>
                      <div class="text-uppercase">
                        <label>
                          DEPARTMENT OF SCIENCE AN TECHNOLOGY
                        </label>
                      </div>
                      <div>
                        <label>
                          Project Line-Item Budget
                        </label>
                      </div>
                      <div>
                        <label>
                          CY <span class="project_lib_duration_year"></span>
                        </label>
                      </div>
                    </div>
                    <div class="project_lib_content">
                      <div class="project_lib_header">
                        <div class="row">
                          <div class="col-md-2">
                            <label>
                              Program Title:
                            </label>
                          </div>
                          <div class="col-md-10">
                            <span class="project_lib_program_title"></span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2">
                            <label>
                              Project Title:
                            </label>
                          </div>
                          <div class="col-md-10">
                            <span class="project_lib_project_title"></span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2">
                            <label>
                              Implementing Agency:
                            </label>
                          </div>
                          <div class="col-md-10">
                            <span class="project_lib_implementing_agencys"></span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2">
                            <label>
                              Total Duration:
                            </label>
                          </div>
                          <div class="col-md-10">
                            <span class="project_lib_total_duration"></span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2">
                            <label>
                              Current Duration:
                            </label>
                          </div>
                          <div class="col-md-10">
                            <span class="project_lib_current_duration"></span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2">
                            <label>
                              Cooperating Agency:
                            </label>
                          </div>
                          <div class="col-md-10">
                            <span class="project_lib_cooperating_agencys"></span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2">
                            <label>
                              Program Leader:
                            </label>
                          </div>
                          <div class="col-md-10">
                            <span class="project_lib_program_leader"></span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2">
                            <label>
                              Project Leader:
                            </label>
                          </div>
                          <div class="col-md-10">
                            <span class="project_lib_project_leader"></span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-2">
                            <label>
                              Monitoring Agency:
                            </label>
                          </div>
                          <div class="col-md-10">
                            <span class="project_lib_monitoring_agency"></span>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive" style="page-break-after: always;">
                        <table class="table table-borderless project_lib_table_content">
                          <thead>
                            <tr class="project_lib_headers_row">
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th colspan="3">
                                <b>
                                  I. Personal Services
                                </b>
                              </th>
                            </tr>
                            <tr>
                              <th colspan="3" class="text-left text-underline">
                                Direct Cost
                              </th>
                            </tr>
                            <tr class="project_lib_ps_lib_direct_cost_salaries">
                              <th colspan="3" class="text-left">
                                <i>
                                  Salaries
                                </i>
                              </th>
                            </tr>
                            <tr class="project_lib_ps_lib_direct_cost_honoraria">
                              <th colspan="3" class="text-left">
                                <i>
                                  Honoraria
                                </i>
                              </th>
                            </tr>
                            <tr>
                              <th colspan="3" class="text-left text-underline">
                                Indirect Cost
                              </th>
                            </tr>
                            <tr class="project_lib_implementing_agency project_lib_ps_lib_implementing_agency"></tr>
                            <tr class="project_lib_ps_lib_subtotal"></tr>
                            <tr>
                              <th colspan="3">
                                <b>
                                  II. Maintenance and Other Operating Expenses
                                </b>
                              </th>
                            </tr>
                            <tr class="project_lib_mooe_lib_direct_cost">
                              <th colspan="3" class="text-left text-underline">
                                Direct Cost
                              </th>
                            </tr>
                            <tr>
                              <th colspan="3" class="text-left text-underline">
                                Indirect Cost
                              </th>
                            </tr>
                            <tr class="project_lib_implementing_agency project_lib_mooe_lib_implementing_agency"></tr>
                            <tr class="project_lib_mooe_lib_subtotal"></tr>
                            <tr>
                              <th colspan="3">
                                <b>
                                  III. Equipment Outlay
                                </b>
                              </th>
                            </tr>
                            <tr>
                              <th colspan="3" class="text-left text-underline">
                                Direct Cost
                              </th>
                            </tr>
                            <tr class="project_lib_eo_co_lib_direct_cost"></tr>
                            <tr>
                              <th colspan="3" class="text-left text-underline">
                                Indirect Cost
                              </th>
                            </tr>
                            <tr class="project_lib_implementing_agency project_lib_eo_co_lib_implementing_agency"></tr>
                            <tr class="project_lib_eo_co_lib_subtotal"></tr>
                            <tr class="project_lib_grand_total"></tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="clearfix">
                    <div class="float-right">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-success print-project print-proposal">Print</button>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="project_files" role="tabpanel" aria-labelledby="project_files_tab">
                  <div class="text-center my-3">
                    <h3>Project Files List</h3>
                  </div>
                  <hr>
                  <div class="clearfix py-2">
                    <label class="btn btn-success float-right">
                        Upload | <i class="fas fa-caret-down"></i> 
                        <input id="upload_project_file" type="file" hidden>
                    </label>
                  </div>
                  <div class="alert alert-files proposal-info-list">
                    <h4>From DPMIS</h4>
                    <div>
                      <small>
                        <b>
                          <i>
                            <span>File count: </span>
                            <span class="project_files_count">0</span>
                          </i>
                        </b>
                      </small>
                    </div>
                    <ul id="dpmis_project_files_list"></ul>
                  </div>
                  <div class="alert alert-files proposal-info-list">
                    <h4>Internal Files</h4>
                    <ul id="internal_project_files_list" class="internal-files-list"></ul>
                  </div>
                  <hr>
                  <div class="clearfix">
                    <div class="float-right">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="project_researchers" role="tabpanel" aria-labelledby="project_researchers_tab">
                  <div class="container">
                    <div class="row pt-3">
                      <div class="col-md-3">
                        <div class="text-center">
                          <h3>Project Researchers</h3>
                        </div>
                        <ul id="project_researchers_list" class="proposal-info-list researchers-list">
                        </ul>
                      </div>
                      <div class="col-md-9">
                        <ul id="project_researcher_info_tabs" class="nav nav-tabs d-none" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="project_researcher_info_tab" data-toggle="tab" href="#project_researcher_info" role="tab" aria-controls="project_researcher_info" aria-selected="true">Researcher Info</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="project_researcher_content">
                          <div class="tab-pane fade show active" id="project_researcher_info" role="tabpanel" aria-labelledby="project_researcher_info_tab">
                            <div class="form-content proposal-researcher-info project-researcher-info project-researcher-info-content p-3"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="clearfix">
                      <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success print-resume">Print Resume</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade comments-tab" id="project_comments" role="tabpanel" aria-labelledby="project_comments_tab">
                  <div class="d-block comments-list">
                    <div class="text-center my-3">
                      <h3>Project Comments List</h3>
                    </div>
                    <ul id="project_comments_list" class="proposal-info-list proposal-comments-list">
                      <li class="py-1 text-break">
                        <a href="#" class="toggle-view-comments toggle-inline-comments-buttons all-inline-comments" data-target-comments-display="comments-inline">View <b>all</b> <i>inline</i> comments</a>
                      </li>
                      <li class="py-1 text-break">
                        <a href="#" class="toggle-view-comments toggle-outline-comments-buttons all-outline-comments" data-target-comments-display="comments-outline">View <b>all</b> <i>outline</i> comments</a>
                      </li>
                      <li class="py-1 text-break">
                        <a href="#" class="toggle-view-comments toggle-inline-comments-buttons trd-inline-comments" data-target-comments-display="comments-inline" data-comment-type="3">View <i>inline</i> comments by <b>TRDs</b></a>
                      </li>
                      <li class="py-1 text-break">
                        <a href="#" class="toggle-view-comments toggle-outline-comments-buttons trd-outline-comments" data-target-comments-display="comments-outline" data-comment-type="3">View <i>outline</i> comments by <b>TRDs</b></a>
                      </li>
                      <li class="py-1 text-break">
                        <a href="#" class="toggle-view-comments toggle-inline-comments-buttons trep-inline-comments" data-target-comments-display="comments-inline" data-comment-type="4">View <i>inline</i> comments by <b>TREP</b></a>
                      </li>
                      <li class="py-1 text-break">
                        <a href="#" class="toggle-view-comments toggle-outline-comments-buttons trep-outline-comments" data-target-comments-display="comments-outline" data-comment-type="4">View <i>outline</i> comments by <b>TREP</b></a>
                      </li>
                    </ul>
                    <hr>
                    <div class="clearfix">
                      <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                  <div class="d-none comments-inline">
                    <div class="py-2">
                      <a href="#" class="toggle-view-comments back-button"  data-target-comments-display="comments-list"><u><i class="fas fa-angle-left"></i> Back</u></a>
                    </div>
                    <div class="form-content project-info-content p-3"></div>
                  </div>
                  <div class="d-none comments-outline">
                    <div class="py-2">
                      <a href="#" class="toggle-view-comments back-button" data-target-comments-display="comments-list"><u><i class="fas fa-angle-left"></i> Back</u></a>
                    </div>
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-content project-info-content p-3"></div>
                        <hr>
                        <div class="card proposal_outline_comments_all_comments">
                          <div class="card-header bg-info">
                            <div class="text-center">
                              <h4 class="py-2">Outline comments (All comments)</h4>
                            </div>
                          </div>
                          <div class="card-body">
                            <ul id="project_outline_comments" class="list-group list-group-flush proposal-info-list proposal-outline-all-comments outline-comments">
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card container-comment-section">
                          <div class="card-header bg-info">
                            <div class="text-center">
                              <h4 class="py-2">Write a comment <br> (Please select a field):</h4>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="rounded bg-light my-2 p-2">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <select id="project_comment_section_outline" class="form-control form-control-sm comment-section ml-1">
                                      <option value="" selected disabled hidden>N/A</option>
                                      <option value="0">Overall</option>
                                      <optgroup data-proposal-type-id="2" label="DOST Form 2 (for Basic and Applied Research)">
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(1) Project Profile">
                                          <option class="pl-2" value="1">Program Title</option>
                                          <option class="pl-2" value="2">Project Title</option>
                                          <option class="pl-2" value="3">Project Leader/Sex</option>
                                          <option class="pl-2" value="4">Project Start Date</option>
                                          <option class="pl-2" value="5">Project End Date</option>
                                          <option class="pl-2" value="6">Implementing Agency</option>
                                          <option class="pl-2" value="7">Address/Telephone/Fax/Email</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(2) Cooperating Agency/ies">
                                          <option class="pl-2" value="8">Cooperating Agency/ies</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(3) Sites(s) of Implementation">
                                          <option class="pl-2" value="9">Sites(s) of Implementation</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(4) Type of Research">
                                          <option class="pl-2" value="10">Basic</option>
                                          <option class="pl-2" value="11">Applied</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(5) R&D Priority Area & Program (based on HNRDA 2017-2022)">
                                          <option class="pl-2" value="12">Agriculture, Aquatic and Natural Resources</option>
                                          <option class="pl-2" value="13">Agriculture, Aquatic and Natural Resources Commodity</option>
                                          <option class="pl-2" value="14">Health Priority</option>
                                          <option class="pl-2" value="15">Health Priority Topic</option>
                                          <option class="pl-2" value="16">Industry, Energy and Emerging Technology</option>
                                          <option class="pl-2" value="17">Industry, Energy and Emerging Technology Sector</option>
                                          <option class="pl-2" value="18">Disaster Risk Reduction and Climate Change Adaptation</option>
                                          <option class="pl-2" value="20">Basic Research</option>
                                          <option class="pl-2" value="21">Basic Research Sector</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="Sustainable Development Goal (SDG) Addressed">
                                          <option class="pl-2" value="22">Sustainable Development Goal (SDG) Addressed</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(6) Executive Summary">
                                          <option class="pl-2" value="23">Executive Summary</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(7) Introduction">
                                          <optgroup data-proposal-type-id="2" class="pl-2" label="(7.1) Rationale/Significance">
                                            <option class="pl-3" value="24">Rationale/Significance</option>
                                          </optgroup>
                                          <optgroup data-proposal-type-id="2" class="pl-2" label="(7.2) Scientific Basis/Theoretical Framework">
                                            <option class="pl-3" value="25">Scientific Basis/Theoretical Framework</option>
                                          </optgroup>
                                          <optgroup data-proposal-type-id="2" class="pl-2" label="(7.3) Objectives">
                                            <option class="pl-3" value="26">General</option>
                                            <option class="pl-3" value="27">Specific</option>
                                          </optgroup>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(8) Review of Literature">
                                          <option class="pl-2" value="28">Review of Literature</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(9) Methodology">
                                          <option class="pl-2" value="29">Methodology</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(10) Technology Roadmap">
                                          <option class="pl-2" value="30">Technology Roadmap</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(11) Expected Outputs(6Ps)">
                                          <option class="pl-2" value="31">Publication</option>
                                          <option class="pl-2" value="32">Patent</option>
                                          <option class="pl-2" value="33">Product</option>
                                          <option class="pl-2" value="34">People</option>
                                          <option class="pl-2" value="35">Place</option>
                                          <option class="pl-2" value="36">Policy</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(12) Potential Outcomes">
                                          <option class="pl-2" value="37">Potential Outcomes</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(13) Potential Impacts">
                                          <option class="pl-2" value="38">Social Impact</option>
                                          <option class="pl-2" value="39">Economic Impact</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" data-proposal-type-id="2" class="pl-1" label="(14) Target Beneficiaries">
                                          <option class="pl-2" value="40">Target Beneficiaries</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(15) Sustainability Plan">
                                          <option class="pl-2" value="41">Sustainability Plan</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(16) Gender and Development (GAD) score">
                                          <option class="pl-2" value="42">Gender and Development (GAD) score</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(17) Limitations of the Project">
                                          <option class="pl-2" value="43">Limitations of the Project</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(18) Lists of Risks and Assumptions Risk Management Plan">
                                          <option class="pl-2" value="44">Lists of Risks and Assumptions Risk Management Plan</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(19) Literature Cited">
                                          <option class="pl-2" value="45">Literature Cited</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(20) Personnel Requirement">
                                          <option class="pl-2" value="46">Personnel Requirement</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(21) Budget by Implementing Agency">
                                          <option class="pl-2" value="47">Budget by Implementing Agency</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(22) Other Ongoing Projects being handled by the Project Leader">
                                          <option class="pl-2" value="48">Other Ongoing Projects being handled by the Project Leader</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="2" class="pl-1" label="(23) Other Supporting Documents">
                                          <option class="pl-2" value="49">Other Supporting Documents</option>
                                        </optgroup>
                                      </optgroup>
                                      <optgroup data-proposal-type-id="6" label="DOST Form 2 (for Startups)">
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(1) Project Profile">
                                          <option class="pl-2" value="1">Program Title</option>
                                          <option class="pl-2" value="2">Project Title</option>
                                          <option class="pl-2" value="3">Project Leader/Sex</option>
                                          <option class="pl-2" value="4">Project Start Date</option>
                                          <option class="pl-2" value="5">Project End Date</option>
                                          <option class="pl-2" value="6">Implementing Agency</option>
                                          <option class="pl-2" value="7">Address/Telephone/Fax/Email</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(2) Cooperating Agency/ies">
                                          <option class="pl-2" value="8">Cooperating Agency/ies</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(3) Sites(s) of Implementation">
                                          <option class="pl-2" value="9">Sites(s) of Implementation</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(4) Type of Research">
                                          <option class="pl-2" value="10">Pre-commercialization</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(5) R&D Priority Area & Program (based on HNRDA 2017-2022)">
                                          <option class="pl-2" value="11">Agriculture, Aquatic and Natural Resources</option>
                                          <option class="pl-2" value="12">Agriculture, Aquatic and Natural Resources Commodity</option>
                                          <option class="pl-2" value="13">Health Priority</option>
                                          <option class="pl-2" value="14">Health Priority Topic</option>
                                          <option class="pl-2" value="15">Industry, Energy and Emerging Technology</option>
                                          <option class="pl-2" value="16">Industry, Energy and Emerging Technology Sector</option>
                                          <option class="pl-2" value="17">Disaster Risk Reduction and Climate Change Adaptation</option>
                                          <option class="pl-2" value="19">Basic Research</option>
                                          <option class="pl-2" value="20">Basic Research Sector</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="Sustainable Development Goal (SDG) Addressed">
                                          <option class="pl-2" value="21">Sustainable Development Goal (SDG) Addressed</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(6) Executive Summary">
                                          <option class="pl-2" value="22">Executive Summary</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="Startup Background">
                                          <option class="pl-2" value="23">Startup Background</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(7) Introduction">
                                          <optgroup data-proposal-type-id="6" class="pl-2" label="(7.1) Rationale/Significance">
                                            <option class="pl-3" value="24">Rationale/Significance</option>
                                          </optgroup>
                                          <optgroup data-proposal-type-id="6" class="pl-2" label="(7.2) Scientific Basis/Theoretical Framework">
                                            <option class="pl-3" value="25">Scientific Basis/Theoretical Framework</option>
                                          </optgroup>
                                          <optgroup data-proposal-type-id="6" class="pl-2" label="(7.3) Objectives">
                                            <option class="pl-3" value="26">General</option>
                                            <option class="pl-3" value="27">Specific</option>
                                          </optgroup>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(8) Review of Literature">
                                          <option class="pl-2" value="28">Review of Literature</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(9) Marketing and Commercial Viability">
                                          <option class="pl-2" value="29">Marketing and Commercial Viability</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(10) Methodology">
                                          <option class="pl-2" value="30">Methodology</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(11) Technology Roadmap">
                                          <option class="pl-2" value="31">Technology Roadmap</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(12) Expected Outputs(6Ps)">
                                          <option class="pl-2" value="32">Publication</option>
                                          <option class="pl-2" value="33">Patent</option>
                                          <option class="pl-2" value="34">Product</option>
                                          <option class="pl-2" value="35">People</option>
                                          <option class="pl-2" value="36">Place</option>
                                          <option class="pl-2" value="37">Policy</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(13) Potential Outcomes">
                                          <option class="pl-2" value="38">Potential Outcomes</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(14) Potential Impacts">
                                          <option class="pl-2" value="39">Social Impact</option>
                                          <option class="pl-2" value="40">Economic Impact</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(15) Target Beneficiaries">
                                          <option class="pl-2" value="41">Target Beneficiaries</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(16) Sustainability Plan">
                                          <option class="pl-2" value="42">Sustainability Plan</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(17) Gender and Development (GAD) score">
                                          <option class="pl-2" value="43">Gender and Development (GAD) score</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(18) Limitations of the Project">
                                          <option class="pl-2" value="44">Limitations of the Project</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(19) Lists of Risks and Assumptions Risk Management Plan">
                                          <option class="pl-2" value="45">Lists of Risks and Assumptions Risk Management Plan</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(20) Literature Cited">
                                          <option class="pl-2" value="46">Literature Cited</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(21) Personnel Requirement">
                                          <option class="pl-2" value="47">Personnel Requirement</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(22) Budget by Implementing Agency">
                                          <option class="pl-2" value="48">Budget by Implementing Agency</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(23) Other Ongoing Projects being handled by the Project Leader">
                                          <option class="pl-2" value="49">Other Ongoing Projects being handled by the Project Leader</option>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="6" class="pl-1" label="(24) Other Supporting Documents">
                                          <option class="pl-2" value="50">Other Supporting Documents</option>
                                        </optgroup>
                                      </optgroup>
                                      <optgroup data-proposal-type-id="4" label="DOST Form 3 (Non-R&D Project Proposal)">
                                        <optgroup data-proposal-type-id="4" class="pl-1" label="I. Project Profile">
                                          <optgroup data-proposal-type-id="4" class="pl-2" label="(1) Program Title">
                                            <option class="pl-2" value="1">Program Title</option>
                                            <option class="pl-2" value="2">Project Title</option>
                                          </optgroup>
                                          <optgroup data-proposal-type-id="4" class="pl-2" label="(2) Project Leader/Sex">
                                            <option class="pl-3" value="3">Project Leader/Sex</option>
                                            <option class="pl-3" value="4">Agency</option>
                                            <option class="pl-3" value="5">Address/Telephone/Fax/Email</option>
                                          </optgroup>
                                          <optgroup data-proposal-type-id="4" class="pl-2" label="(3) Cooperating Agency/ies">
                                            <option class="pl-3" value="6">Cooperating Agency/ies</option>
                                          </optgroup>
                                          <optgroup data-proposal-type-id="4" class="pl-2" label="(4) Implementing Agency">
                                            <option class="pl-3" value="7">Implementing Agency</option>
                                            <option class="pl-3" value="8">Base Station</option>
                                            <option class="pl-3" value="9">Other Implementation Site (s)</option>
                                          </optgroup>
                                          <optgroup data-proposal-type-id="4" class="pl-2" label="(5) Project Duration">
                                            <option class="pl-3" value="10">Project Duration</option>
                                            <option class="pl-3" value="11">Project Start Date</option>
                                            <option class="pl-3" value="12">Project End Date</option>
                                          </optgroup>
                                          <optgroup class="pl-2" label="(6) Total Project Cost">
                                            <option class="pl-3" value="13">Total Project Cost</option>
                                            <option class="pl-3" value="14">Implementing Agency/ies</option>
                                          </optgroup>
                                        </optgroup>
                                        <optgroup data-proposal-type-id="4" class="pl-2" label="II. Project Summary">
                                          <optgroup data-proposal-type-id="4" class="pl-3" label="(7) Executive Summary">
                                            <option class="pl-4" value="15">Executive Summary</option>
                                          </optgroup>
                                          <optgroup data-proposal-type-id="4" class="pl-3" label="(8) Introduction">
                                            <option class="pl-4" value="16">Introduction</option>
                                            <option class="pl-4" value="17">Rationale/Significance</option>
                                            <option class="pl-4" value="18">Objectives (General)</option>
                                            <option class="pl-4" value="19">Objectives (Specific)</option>
                                            <option class="pl-4" value="20">For Startups</option>
                                            <option class="pl-4" value="21">Methodology</option>
                                            <optgroup data-proposal-type-id="4" class="pl-4" label="Expected Outputs (6Ps)">
                                              <option class="pl-5" value="22">Publication</option>
                                              <option class="pl-5" value="23">Patent</option>
                                              <option class="pl-5" value="24">Product</option>
                                              <option class="pl-5" value="25">People</option>
                                              <option class="pl-5" value="26">Place</option>
                                              <option class="pl-5" value="27">Policy</option>
                                            </optgroup>
                                            <optgroup data-proposal-type-id="4" class="pl-4">
                                              <option class="pl-4" value="28">Potential Outcomes</option>
                                            </optgroup>
                                            <optgroup data-proposal-type-id="4" class="pl-4" label="Potential Impacts (2Is)">
                                              <option class="pl-5" value="29">Social Impact</option>
                                              <option class="pl-5" value="30">Economic Impact</option>
                                            </optgroup>
                                            <optgroup data-proposal-type-id="4" class="pl-4">
                                              <option class="pl-4" value="31">Discussion</option>
                                              <option class="pl-4" value="32">Target Beneficiaries</option>
                                              <option class="pl-4" value="33">Sustainability Plan</option>
                                              <option class="pl-4" value="34">Gender and Development (GAD) Score</option>
                                            </optgroup>
                                          </optgroup>
                                          <optgroup data-proposal-type-id="4" class="pl-3" label="(9) Workplan">
                                            <option class="pl-4" value="35">Workplan</option>
                                          </optgroup>
                                          <optgroup data-proposal-type-id="4" class="pl-3" label="(10) Project Management">
                                            <option class="pl-4" value="36">Workplan</option>
                                          </optgroup>
                                        </optgroup>
                                      </optgroup>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div>
                              <textarea id="program_comment_overall" class="summernote proposals-outline-comment"></textarea>
                            </div>
                            <hr>
                            <div class="clearfix">
                              <div class="float-right">
                                <button type="button" class="btn btn-success add-outline-comment">Add comment</button>
                              </div>  
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header bg-info">
                            <div class="text-center">
                              <h4 class="py-2">Outline comments <br> (your comments)</h4>
                            </div>
                          </div>
                          <div class="card-body">
                            <ul id="program_outline_comments" class="list-group list-group-flush proposal-info-list proposal-outline-user-comments outline-comments">
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="clearfix">
                      <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="project_timeline" role="tabpanel" aria-labelledby="project_timeline_tab">
                  <div class="container">
                    <div class="row pt-3">
                      <div class="col-md-12">
                        <div class="text-center">
                          <h3>Project Timeline</h3>
                        </div>
                        <div class="rounded bg-info p-3 proposal-info-list">
                          <ul id="project_timeline_list" class="proposal-timeline">
                          </ul>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="clearfix">
                      <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="forward_proposal_modal" tabindex="-1" role="dialog" aria-labelledby="forward_proposal_modal_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="forward_proposal_modal_label">Forward Proposal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          @if(Auth::user()->privilege == 1 || Auth::user()->privilege == 2)
          <div class="row">
            <div class="col-md-12">
              <div class="lead_division_fg form-group">
                <label>
                  Assign Lead TRD
                </label>
                <select id="lead_division" type="text" name="lead_division" class="form-control select2 required-field forward-proposal-field">
                  @foreach ($divisions as $division)
                    <option value="{{ $division->id }}"> {{ $division->division_acronym }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          @else
          <div class="row">
            <div class="col-md-12">
              <div class="lead_division_fg form-group">
                <label>
                  Lead TRD :
                </label>
                <span class="proposal-lead-trd text-italicize">
                  
                </span>
              </div>
            </div>
          </div>
          @endif
          @if(Auth::user()->privilege == 3)
          <div class="row">
            <div class="col-md-12">
              <div class="forward_proposal_users_fg form-group">
                <label>
                  Users (PMT)
                </label>
                <select id="forward_proposal_users" type="text" name="forward_proposal_users" class="form-control select2 required-field forward-proposal-field" multiple="multiple">
                  @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }} ({{ $user->first_name }} {{ $user->last_name }})</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          @endif
          <div class="row">
            <div class="col-md-12">
              <div class="forward_proposal_divisions_fg form-group">
                <label>
                  Division
                </label>
                <select id="forward_proposal_divisions" type="text" name="forward_proposal_divisions" class="form-control select2 required-field forward-proposal-field" disabled="disabled" multiple="multiple">
                  @foreach ($divisions as $division)
                    <option value="{{ $division->id }}"> {{ $division->division_acronym }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="forward_proposal_remarks_fg form-group">
                <label>
                  Remarks:
                </label>
                <textarea id="forward_proposal_remarks"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="forward_proposal" type="button" class="btn btn-success">Forward</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="consolidate_comments_proposal_modal" tabindex="-1" role="dialog" aria-labelledby="consolidate_comments_proposal_modal_label" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="consolidate_comments_proposal_modal_label">Consolidated Comments</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="form-content consolidated-comments"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="forward_comments_to_dpmis" type="button" class="btn btn-info">Forward Comments to DPMIS</button>
        <button id="print_consolidated_comments_proposal" type="button" class="btn btn-success">Print</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  @yield('table-initialize')
  <script type="text/javascript">
    $(document).ready(function() {
      
    })
  </script>
@endsection
