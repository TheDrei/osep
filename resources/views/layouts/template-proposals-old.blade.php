@extends('layouts.app')

@section('content')
<head>
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
	<title>DOST Form 3 NON-R&D PROJECT PROPOSAL (Technology Transfer, S&T Promotion and Linkages, Policy Advocacy, Provision of S&T Services, Human Resource Development and Capacity-Building) </title>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<style type="text/css">
		@page{
			margin-top: 72pt;
		}
    .form4-title{
      font-weight:bold;
    }
		body.form4 > * {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}
		body.form4 {
			max-width: 1100pt;
			margin: auto;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 10pt;
			font-weight: normal;
		}
		table.form4 {
            text-indent: initial;
            white-space: normal;
            line-height: normal;
            font-weight: normal;
            font-style: normal;
            color: -internal-quirk-inherit;
            text-align: start;
            font-variant: normal;
            border-spacing: 0;
            width: 100%;
            margin: 0.5% 0;
            word-break: break-word;
        }

        img {
        	max-width: 100%;
	        max-height: 100%;
        }
        span.form4.comments-allow, p.form4.comments-allow { line-height: 2; }
        select.form4.versioning { color: white !important; background: #28a745!important; border-radius: 12px; padding-right: 5px; padding-left: 5px;}
        select.form4.versioning > option { font-weight: bold; }
        .form4.text-center { text-align: center !important; }
        .form4.font-weight-bold { font-weight: bold !important; }
        .form4.text-capital { text-transform: capitalize !important; }
        .form4.text-size-12 { font-size: 12pt !important; }
        .form4.text-size-10 { font-size: 10pt !important; }
        .form4.text-size-8 { font-size: 8pt !important; }
        .form4.font-italicize { font-style: italic !important; }
        .form4.font-color-dark-gray-3 { color: #767171; }
        .form4.border-none { border: none !important; }
        .form4.border-1px-solid-black { border: 1px solid black; }
        .form4.border-bottom-1px-solid-black { border-bottom: 1px solid black; content:'\00a0';}
        .form4.border-top-1px-solid-black { border-top: 1px solid black; }
        .form4.border-right-1px-solid-black { border-right: 1px solid black; }
        .form4.border-left-1px-solid-black { border-left: 1px solid black; }
        .form4.margin-0 { margin: 0; }
        .form4.text-justify { text-align: justify; }
        .form4.text-left { text-align: left; }
        .form4.padding-left-1per { padding-left: 1% !important; }
        .form4.padding-left-2per { padding-left: 2% !important; }
        .form4.padding-left-4per { padding-left: 4% !important; }
        .form4.padding-left-6per { padding-left: 6% !important; }
        .form4.padding-right-1per { padding-right: 1% !important; }
        .form4.padding-bottom-2per { padding-bottom: 2% !important; }
        .form4.min-height-15pt { min-height: 15pt !important; }
        .form4.width-65per { width: 65%; }
        .form4.width-50per { width: 50%; }
        .form4.width-35per { width: 35%; }
        .form4.width-25per { width: 25%; }
        .form4.width-10per { width: 10%; }
        .form4.align-top { vertical-align: top !important; }

        .form4.clearfix { clear: both; }
        .form4.wcol-2-20-78 > div:first-child {
            float: left;
            width: 20%;
            padding: 0 2px;
         }

         .form4.wcol-2-20-78 > div:nth-child(2) {
            float: left;
            width: 78%;
            padding: 0 2px;
         }
         .form4.wcol-2-78-20 > div:first-child {
            float: left;
            width: 78%;
            padding: 0 2px;
         }

         .form4.wcol-2-78-20 > div:nth-child(2) {
            float: left;
            width: 20%;
            padding: 0 2px;
         }

        .form4.pages {
        	page-break-after: always;
        }
        table.form4 p { padding: 1px; margin: 0; }
        .form4.proposal-gad-responsiveness { content: "\00a0"; }
        .form4.comment-header { padding-left: 0.8%; padding-bottom: 0.5%;}
        .form4.comment-section { padding-top: 1%;}
        .form4.comments-allow { text-align: justify; margin-top: 1%; margin-bottom: 1%; }
	</style>
</head>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Proposals</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Proposals</li>
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
                    <span class="proposal-monitoring-form" style="float:left;">
                          <img alt="DOST LOGO" src="{{ asset('storage/images/util/dost_logo.png') }}" style="width: 76.80px; height: 59.20px;">
                    </span>
                    <div class="text-center form4-title" style="font-weight:bold;">
                                    <div>
                                      <label>
                                        DOST Form 4
                                      </label>
                                    </div>
                                  
                                    <div class="text-uppercase">
                                      <label>
                                        DEPARTMENT OF SCIENCE AND TECHNOLOGY
                                      </label>
                                    </div>
                                    
                                    <div class="text-center" style="margin-left:70px;">
                                      <label>
                                        Project Line-Item Budget
                                      </label>
                                      <br/>
                                      <div class="text-center">
                                      <label>
                                      CY <span class="project_lib_duration_year"></span>
                                      </label>
                                      </div>
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
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>&nbsp
                      <div class="float-right lib-print">
                      <button type="button" class="btn btn-success print-project print-proposal">Print</button>
                     </div>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>&nbsp
                        <div class="float-right project-researchers-print">
                        <button type="button" class="btn btn-success print-resume">Print Resume</button>
                        </div>
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
        <h5 class="modal-title" id="forward_proposal_modal_label">Forward Proposal to TRDs for Evaluation</h5>
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
        <button id="forward_proposal_to_trd" type="button" class="btn btn-success">Forward</button>
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
    var testt
    $(document).ready(function() {
      var proposal_id = null;
      var proposal_years = null;
      var lead_trd = null;
      var comment = {
        style: '',
        order: '',
        uniqueName: '',
        text: '',
        comments : ''
      };
      var comments_allow;
      var comments_array;
      var multiple_element = false;
      var comment_type = ''
      var inside_comments_allow = false;
      var approved_implementation_start_date;
      var approved_implementation_end_date;

      $(".lib-print").hide();
      $(".project-researchers-print").hide();

      function forward_proposal_to_palihan(proposal_id) {
        console.log(approved_implementation_start_date)
        var request = $.ajax({
          url: "{{ route('proposals.forward_proposal_to_palihan')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'approved_implementation_start_date' : approved_implementation_start_date,
            'approved_implementation_end_date' : approved_implementation_end_date
          }
        })

        return request;
      }

      function view_proposal(proposal_id) {
        var request = $.ajax({
          url: "{{ route('proposals.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id
          }
        })

        return request;
      }

      function view_proposal_researcher(researcher_id) {
        var request = $.ajax({
          url: "{{ route('proposal_researchers.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'researcher_id' : researcher_id
          }
        })

        return request;
      }

      function view_lib_by_proposal_and_year(proposal_id, year) {
        var request = $.ajax({
          url: "{{ route('proposals.show_lib_by_proposal_and_year')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'year' : year
          }
        })

        return request;
      }

      function view_lib_by_proposal_per_year(proposal_id, proposal_years) {
        var request = $.ajax({
          url: "{{ route('proposals.show_lib_by_proposal_per_year')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'proposal_years' : proposal_years
          }
        })

        return request;
      }
      function download_proposal_files(proposal_id) {
        var request = $.ajax({
          url: "{{ route('proposals.download_proposal_files')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id
          }
        })

        return request;
      }

      function forward_proposal_to_trd(forward_proposal_divisions, forward_proposal_users, lead_division, status_remarks) {
        var request = $.ajax({
          url: "{{ route('proposals.forward_proposal_to_trd')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'lead_division': lead_division,
            'forward_proposal_divisions' : forward_proposal_divisions,
            'forward_proposal_users' : forward_proposal_users,
            'status_remarks' : status_remarks
          }
        })

        return request;
      }

      function view_forward_proposal(proposal_id) {
        var request = $.ajax({
          url: "{{ route('proposals.view_forward_proposal')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id
          }
        })

        return request;

      }

      function view_lib_document_type() {
        var request = $.ajax({
          url: "{{ route('document_types.show_all')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}'
          }
        })

        return request; 
      }

      function update_status(proposal_id, status, remarks){
        var request = $.ajax({
          url: "{{ route('proposals.update_status')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'approved_implementation_start_date' : approved_implementation_start_date,
            'approved_implementation_end_date' : approved_implementation_end_date,
            'status' : status,
            'remarks' : remarks
          }
        })

        return request;
      }

      function view_implementation_date(proposal_id) {
        var request = $.ajax({
          url: "{{ route('proposal_implementation_date.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id
          }
        })

        return request; 
      }
      function export_statuses_to_dpmis(){
        var request = $.ajax({
          url: "{{ route('proposals.export_statuses_to_dpmis')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}'
          }
        })

        return request;
      }

      function clear_selection() {
        if ( document.selection ) {
          document.selection.empty();
        } else if ( window.getSelection ) {
          window.getSelection().removeAllRanges();
        }
      }

      function compute_lib_total(project_lib_item_structure, lib_item_class, sub_total_text, is_sub_total){
        var sub_total_item = $(project_lib_item_structure).clone();
        var desc = (is_sub_total) ? ('Sub-total for ' + sub_total_text) : 'Total '
        $(sub_total_item).addClass('project_lib_sub_total')
        $(sub_total_item).find('td:first-child').addClass('font-weight-bold').text(desc)
        $(sub_total_item).find('td:not(:first-child)').each(function(index1, sub_total) {
          var funding_agency_amount = 0;
          var counterpart_agency_amount = 0;

          if($(sub_total).attr('data-counterpart-agency-id') != null) {
            $(lib_item_class).find('[data-counterpart-agency-id="'+$(this).attr('data-counterpart-agency-id')+'"]').each(function(index2, lib_amount) {
              var lib_item_amount = ($(lib_amount).text().replace(/[^\d.]/g,'') == "-" || $(lib_amount).text().replace(/[^\d.]/g,'') == "") ? 0 : $(lib_amount).text().replace(/[^\d.]/g,'')
              counterpart_agency_amount = counterpart_agency_amount + parseFloat(lib_item_amount)
            })
            $(sub_total).text('\u20B1' + Number(counterpart_agency_amount).toLocaleString('en'))
          } else {
            $(lib_item_class).find('[data-funding-agency-id="'+$(this).attr('data-funding-agency-id')+'"]').each(function(index2, lib_amount) {
              var lib_item_amount = ($(lib_amount).text().replace(/[^\d.]/g,'') == "-" || $(lib_amount).text().replace(/[^\d.]/g,'') == "") ? 0 : $(lib_amount).text().replace(/[^\d.]/g,'')
              funding_agency_amount = funding_agency_amount + parseFloat(lib_item_amount)
            })
            $(sub_total).text('\u20B1' + Number(funding_agency_amount).toLocaleString('en'))
          }
          
        })
        return sub_total_item
      }

      function write_lib(data) {
        //for LIB
        //LIB header
        if(data['proposal_type'] == 2 || data['proposal_type'] == 4 || data['proposal_type'] == 6){
          data['project']['proposal_program_title'] != null ? $('.project_lib_program_title').text(data['project']['proposal_program_title']) : $('.project_lib_program_title').text('N/A')
          data['project']['proposal_project_title'] != null ? $('.project_lib_project_title').text(data['project']['proposal_project_title']) : $('.project_lib_program_title').text('N/A')
          data['project']['proposal_implementing_agencys'] != null ? $('.project_lib_implementing_agencys').text(data['project']['proposal_implementing_agencys']) : $('.project_lib_implementing_agencys').text('N/A')
          data['project']['proposal_total_duration'] != null ? $('.project_lib_total_duration').text(data['project']['proposal_total_duration']) : $('.project_lib_total_duration').text('N/A')
          data['project']['proposal_cooperating_agencys'] != null ? $('.project_lib_cooperating_agencys').text(data['project']['proposal_cooperating_agencys']) : $('.project_lib_cooperating_agencys').text('N/A')
          data['project']['proposal_program_leader'] != null ? $('.project_lib_program_leader').text(data['project']['proposal_program_leader']) : $('.project_lib_program_leader').text('N/A')
          data['project']['proposal_project_leader'] != null ? $('.project_lib_project_leader').text(data['project']['proposal_project_leader']) : $('.project_lib_project_leader').text('N/A')
          data['project']['proposal_duration_year'] != null ? $('.project_lib_duration_year').text(data['project']['proposal_duration_year']) : $('.project_lib_duration_year').text('N/A')

          $('.project_lib_project_title').text(data['project']['proposal_project_title'])
          //PS
          if(data['lib']){
            $('.lib-content').collapse('show')
            $('.lib-item').remove()

            var project_lib_header = $('.project_lib_headers_row')
            var project_lib_item_structure = $('<tr>', {class: 'lib-item'}).append($('<td></td>'))
            if(data['lib']['project_lib_imp_mon_agencies'] != null && data['lib']['project_lib_imp_mon_agencies'] != ''){
              //implementing angencies
              //creates header of implementing agencies
              var ps_implementing_agency = $('.project_lib_ps_lib_implementing_agency')
              var mooe_implementing_agency = $('.project_lib_mooe_lib_implementing_agency')
              var eo_co_implementing_agency = $('.project_lib_eo_co_lib_implementing_agency')

              for (var i = 0; i < data['lib']['project_lib_imp_mon_agencies'].length; i++) {
                ps_salary_header_class = data['lib']['project_lib_imp_mon_agencies'][i]['imp_mon_agency_id'] + '-ps-implementing-agency-salary';
                ps_honoraria_header_class = data['lib']['project_lib_imp_mon_agencies'][i]['imp_mon_agency_id'] + '-ps-implementing-agency-honoraria';
                agency_name = data['lib']['project_lib_imp_mon_agencies'][i]['imp_mon_agency'];

                ps_salary_header_class = ps_salary_header_class.replace('/\s/g', '')
                ps_honoraria_header_class = ps_honoraria_header_class.replace('/\s/g', '')

                ps_implementing_agency_container = '<tr class="lib-item text-italicize"> <th class="pl-3"> '+agency_name+'</th></tr><tr class="lib-item '+ps_salary_header_class+'"> <th class="pl-4 ">Salaries</th></tr><tr class="lib-item '+ps_honoraria_header_class+'"> <th class="pl-4">Honoraria</th></tr>';

                $(ps_implementing_agency_container).insertAfter(ps_implementing_agency)

                mooe_header_class = data['lib']['project_lib_imp_mon_agencies'][i]['imp_mon_agency_id'] + '-mooe-implementing-agency';
                mooe_implementing_agency_container = '<tr class="lib-item text-italicize '+mooe_header_class+'"> <th class="pl-3"> '+agency_name+'</th></tr>';

                $(mooe_implementing_agency_container).insertAfter(mooe_implementing_agency)

                eo_co_header_class = data['lib']['project_lib_imp_mon_agencies'][i]['imp_mon_agency_id'] + '-eo-co-implementing-agency';
                eo_co_implementing_agency_container = '<tr class="lib-item text-italicize '+eo_co_header_class+'"> <th class="pl-3"> '+agency_name+'</th></tr>';

                $(eo_co_implementing_agency_container).insertAfter(eo_co_implementing_agency)

                //project lib header imp mon agencies
                if(!$(project_lib_item_structure).find('[data-funding-agency-id="' + data['lib']['project_lib_imp_mon_agencies'][i]['imp_mon_agency_id'] + '"]').length) continue;
                var fah = '<th class="lib-item font-weight-bold text-center">'+data['lib']['project_lib_imp_mon_agencies'][i]['imp_mon_agency']+'</th>';
                var fad = '<td class="lib-item text-center" data-funding-agency-id="'+data['lib']['project_lib_imp_mon_agencies'][i]['imp_mon_agency_id']+'"></td>';
                $(project_lib_header).append(fah)
                $(project_lib_item_structure).append(fad)
              }

            }
            if(data['lib']['project_lib_funding_agencies'] != null && data['lib']['project_lib_funding_agencies'] != ''){
              //project lib header funding agencies
              for (var i = 0; i < data['lib']['project_lib_funding_agencies'].length; i++) {
                if($(project_lib_header).find('[data-funding-agency-id="' + data['lib']['project_lib_funding_agencies'][i]['funding_agency_id'] + '"]').length) continue;
                var fah = '<th class="lib-item font-weight-bold text-center">'+data['lib']['project_lib_funding_agencies'][i]['funding_agency']+'</th>';
                var fad = '<td class="lib-item text-center" data-funding-agency-id="'+data['lib']['project_lib_funding_agencies'][i]['funding_agency_id']+'"></td>';
                $(project_lib_header).append(fah)
                $(project_lib_item_structure).append(fad)
              }
            }

            var direct_cost_salaries = $('.project_lib_ps_lib_direct_cost_salaries')
            var direct_cost_honoraria = $('.project_lib_ps_lib_direct_cost_honoraria')
            var ps_lib_subtotal = $('.project_lib_ps_lib_subtotal')
            if(data['lib']['project_ps_lib'] != null && data['lib']['project_ps_lib'] != ''){
              //ps lib
              for (var i = 0; i < data['lib']['project_ps_lib'].length; i++) {
                var ps_lib_item = $(project_lib_item_structure).clone()
                var ps_lib_item_amount = (data['lib']['project_ps_lib'][i]['amount'] == "" || data['lib']['project_ps_lib'][i]['amount'] == null) ? '-' : data['lib']['project_ps_lib'][i]['amount']

                $(ps_lib_item).addClass('ps-lib-item')
                $(ps_lib_item).find('td:first-child').addClass('pl-5')
                $(ps_lib_item).find('td:first-child').text(data['lib']['project_ps_lib'][i]['description'])

                if($(ps_lib_item).find('[data-funding-agency-id="' + data['lib']['project_ps_lib'][i]['funding_agency_id'] + '"]').length) $(ps_lib_item).find('[data-funding-agency-id="' + data['lib']['project_ps_lib'][i]['funding_agency_id'] + '"]').text(ps_lib_item_amount)
                else $(ps_lib_item).find('[data-funding-agency-id="' + data['lib']['project_ps_lib'][i]['funding_agency_id'] + '"]').text('-')
                
                if(data['lib']['project_ps_lib'][i]['cost_type'] == 0 && data['lib']['project_ps_lib'][i]['ps_type'] == 0) $(ps_lib_item).insertAfter(direct_cost_salaries)
                else if(data['lib']['project_ps_lib'][i]['cost_type'] == 0 && data['lib']['project_ps_lib'][i]['ps_type'] == 1) $(ps_lib_item).insertAfter(direct_cost_honoraria)

                else if(data['lib']['project_ps_lib'][i]['cost_type'] == 1 && data['lib']['project_ps_lib'][i]['ps_type'] == 0) {
                  salary_header = (data['lib']['project_ps_lib'][i]['imp_mon_agency_id'] == null || data['lib']['project_ps_lib'][i]['imp_mon_agency_id'] == '') ? ((data['lib']['project_ps_lib'][i]['counterpart_agency_id'] == null || data['lib']['project_ps_lib'][i]['counterpart_agency_id'] == '') ? data['lib']['project_ps_lib'][i]['funding_agency_id'] + '-ps-implementing-agency-salary' : data['lib']['project_ps_lib'][i]['counterpart_agency_id'] + '-ps-implementing-agency-salary') : (data['lib']['project_ps_lib'][i]['imp_mon_agency_id'] + '-ps-implementing-agency-salary');
                  var implementing_agency_salary = $('tr.'+salary_header)
                  $(ps_lib_item).insertAfter(implementing_agency_salary)
                } else if(data['lib']['project_ps_lib'][i]['cost_type'] == 1 && data['lib']['project_ps_lib'][i]['ps_type'] == 1) {
                  honoraria_header = (data['lib']['project_ps_lib'][i]['imp_mon_agency_id'] == null || data['lib']['project_ps_lib'][i]['imp_mon_agency_id'] == '') ? ((data['lib']['project_ps_lib'][i]['counterpart_agency_id'] == null || data['lib']['project_ps_lib'][i]['counterpart_agency_id'] == '') ? data['lib']['project_ps_lib'][i]['funding_agency_id'] + '-ps-implementing-agency-honoraria' : data['lib']['project_ps_lib'][i]['counterpart_agency_id'] + '-ps-implementing-agency-honoraria') : (data['lib']['project_ps_lib'][i]['imp_mon_agency_id'] + '-ps-implementing-agency-honoraria');
                  var implementing_agency_honoraria = $('tr.'+honoraria_header)
                  $(ps_lib_item).insertAfter(implementing_agency_honoraria)
                }
              }
            }
            //sub total for ps
            sub_total_for_ps = compute_lib_total(project_lib_item_structure, $('.ps-lib-item'), 'PS', true)
            var project_border = $(project_lib_item_structure).clone()
            $(project_border).css({'content': '\00a0', 'border-bottom' : '2px solid black'})
            $(project_border).insertBefore(ps_lib_subtotal)
            $(sub_total_for_ps).insertAfter(ps_lib_subtotal)

            //mooe
            var direct_cost_mooe = $('.project_lib_mooe_lib_direct_cost')
            var mooe_lib_subtotal = $('.project_lib_mooe_lib_subtotal')
            if(data['lib']['project_mooe_lib'] != null && data['lib']['project_mooe_lib'] != ''){

              for (var i = 0; i < data['lib']['project_mooe_lib'].length; i++) {

                classification_header_class = (data['lib']['project_mooe_lib'][i]['cost_type'] == 0) ? (data['lib']['project_mooe_lib'][i]['mooe_classification_id'] + '-mooe-direct-cost-classification') : (data['lib']['project_mooe_lib'][i]['mooe_classification_id'] + '-mooe-indirect-cost-classification')
                subcategory_header_class = (data['lib']['project_mooe_lib'][i]['cost_type'] == 0) ? (data['lib']['project_mooe_lib'][i]['mooe_subcategory_id'] + '-mooe-direct-cost-subcategory') : (data['lib']['project_mooe_lib'][i]['mooe_subcategory_id'] + '-mooe-indirect-cost-subcategory')
                classification_header = data['lib']['project_mooe_lib'][i]['mooe_classification']
                subcategory_header = data['lib']['project_mooe_lib'][i]['mooe_subcategory']

                classification_container = null;
                subcategory_container = null;
                classification_header_class = classification_header_class.replace('/\s/g', '')
                subcategory_header_class = subcategory_header_class.replace('/\s/g', '')

                header = (data['lib']['project_mooe_lib'][i]['imp_mon_agency_id'] == null || data['lib']['project_mooe_lib'][i]['imp_mon_agency_id'] == '') ? ((data['lib']['project_mooe_lib'][i]['counterpart_agency_id'] == null || data['lib']['project_mooe_lib'][i]['counterpart_agency_id'] == '') ? data['lib']['project_mooe_lib'][i]['funding_agency_id'] + '-mooe-implementing-agency' : data['lib']['project_mooe_lib'][i]['counterpart_agency_id'] + '-mooe-implementing-agency') : (data['lib']['project_mooe_lib'][i]['imp_mon_agency_id'] + '-mooe-implementing-agency');
                var ia = $('tr.'+header)

                if(!$('tr.'+classification_header_class).length) {
                  classification_container = '<tr class="lib-item text-italicize '+classification_header_class+'"> <th colspan="3" class="pl-4"> \u2022 '+classification_header+'</th></tr>';
                  if(data['lib']['project_mooe_lib'][i]['cost_type'] == 0) $(classification_container).insertAfter(direct_cost_mooe)
                  else if(data['lib']['project_mooe_lib'][i]['cost_type'] == 1) $(classification_container).insertAfter(ia)
                }

                if(!$('tr.'+subcategory_header_class).length) {
                  subcategory_container = '<tr class="lib-item '+subcategory_header_class+'"> <th colspan="3" class="pl-4"> -'+subcategory_header+'</th></tr>';
                  $(subcategory_container).insertAfter($('tr.'+classification_header_class))
                }

                var subcategory_container = $('tr.'+subcategory_header_class)

                var mooe_lib_item = $(project_lib_item_structure).clone()
                var mooe_lib_item_amount = (data['lib']['project_mooe_lib'][i]['amount'] == "" || data['lib']['project_mooe_lib'][i]['amount'] == null) ? '-' : data['lib']['project_mooe_lib'][i]['amount']

                $(mooe_lib_item).addClass('mooe-lib-item')
                $(mooe_lib_item).find('td:first-child').addClass('pl-5')
                $(mooe_lib_item).find('td:first-child').text(data['lib']['project_mooe_lib'][i]['mooe_specification'])


                if($(mooe_lib_item).find('[data-funding-agency-id="' + data['lib']['project_mooe_lib'][i]['funding_agency_id'] + '"]').length) $(mooe_lib_item).find('[data-funding-agency-id="' + data['lib']['project_mooe_lib'][i]['funding_agency_id'] + '"]').text(mooe_lib_item_amount)
                else $(mooe_lib_item).find('[data-funding-agency-id="' + data['lib']['project_mooe_lib'][i]['funding_agency_id'] + '"]').text('-')
                
                $(mooe_lib_item).insertAfter(subcategory_container)
              }
            }
            //sub total for mooe
            sub_total_for_mooe = compute_lib_total(project_lib_item_structure, $('.mooe-lib-item'), 'MOOE', true)
            var project_border = $(project_lib_item_structure).clone()
            $(project_border).css({'content': '\00a0', 'border-bottom' : '2px solid black'})
            $(project_border).insertBefore(mooe_lib_subtotal)
            $(sub_total_for_mooe).insertAfter(mooe_lib_subtotal)
            //eo_co
            var direct_cost_eo_co = $('.project_lib_eo_co_lib_direct_cost')
            var eo_co_lib_subtotal = $('.project_lib_eo_co_lib_subtotal')
            if(data['lib']['project_eo_co_lib'] != null && data['lib']['project_eo_co_lib'] != ''){

              for (var i = 0; i < data['lib']['project_eo_co_lib'].length; i++) {
                var eo_co_lib_item = $(project_lib_item_structure).clone()
                var eo_co_lib_item_amount = (data['lib']['project_eo_co_lib'][i]['amount'] == "" || data['lib']['project_eo_co_lib'][i]['amount'] == null) ? '-' : data['lib']['project_eo_co_lib'][i]['amount']

                $(eo_co_lib_item).addClass('eo-co-lib-item')
                $(eo_co_lib_item).find('td:first-child').addClass('pl-5')
                $(eo_co_lib_item).find('td:first-child').text(data['lib']['project_eo_co_lib'][i]['description'])

                if($(eo_co_lib_item).find('[data-funding-agency-id="' + data['lib']['project_eo_co_lib'][i]['funding_agency_id'] + '"]').length) $(eo_co_lib_item).find('[data-funding-agency-id="' + data['lib']['project_eo_co_lib'][i]['funding_agency_id'] + '"]').text(eo_co_lib_item_amount)
                else $(eo_co_lib_item).find('[data-funding-agency-id="' + data['lib']['project_eo_co_lib'][i]['funding_agency_id'] + '"]').text('-')
                
                if(data['lib']['project_eo_co_lib'][i]['cost_type'] == 0) $(eo_co_lib_item).insertAfter(direct_cost_eo_co)
                else if(data['lib']['project_eo_co_lib'][i]['cost_type'] == 1) {
                  eo_co_implementing_agency_header = (data['lib']['project_eo_co_lib'][i]['imp_mon_agency_id'] == null || data['lib']['project_eo_co_lib'][i]['imp_mon_agency_id'] == '') ? ((data['lib']['project_eo_co_lib'][i]['counterpart_agency_id'] == null || data['lib']['project_eo_co_lib'][i]['counterpart_agency_id'] == '') ? data['lib']['project_eo_co_lib'][i]['funding_agency_id'] + '-eo-co-implementing-agency' : data['lib']['project_eo_co_lib'][i]['counterpart_agency_id'] + '-eo-co-implementing-agency') : (data['lib']['project_eo_co_lib'][i]['imp_mon_agency_id'] + '-eo-co-implementing-agency');
                  var implementing_agency_eo_co_implementing_agency = $('tr.'+eo_co_implementing_agency_header)
                  $(eo_co_lib_item).insertAfter(implementing_agency_eo_co_implementing_agency)
                }
                
              }

            }
            //sub total for eo_co
            sub_total_for_eo_co = compute_lib_total(project_lib_item_structure, $('.eo-co-lib-item'), 'EO', true)
            var project_border = $(project_lib_item_structure).clone()
            $(project_border).css({'content': '\00a0', 'border-bottom' : '2px solid black'})
            $(project_border).insertBefore(eo_co_lib_subtotal)
            $(sub_total_for_eo_co).insertAfter(eo_co_lib_subtotal)


            grand_total_lib = $('.project_lib_grand_total')
            //grand total
            grand_total = compute_lib_total(project_lib_item_structure, $('.project_lib_sub_total'), 'Grand Total', false)
            var project_border = $(project_lib_item_structure).clone()
            $(project_border).css({'content': '\00a0', 'border-bottom' : '2px solid black'})
            $(project_border).insertBefore(grand_total_lib)
            $(grand_total).insertAfter(grand_total_lib)
            //grand total
            // grand_total_counterpart = parseFloat(ps_counterpart_amount) + parseFloat(mooe_counterpart_amount) + parseFloat(eo_co_counterpart_amount)
            // grand_total_dost = parseFloat(ps_dost_amount) + parseFloat(mooe_dost_amount) + parseFloat(eo_co_dost_amount)

            // $('.project_lib_grand_total_counterpart').text(Number(grand_total_counterpart).toLocaleString('en'))
            // $('.project_lib_grand_total_dost').text(Number(grand_total_dost).toLocaleString('en'))

          }
        }
      }

      function wrap_all_text_nodes(node) {
        var n, a=[], walk=document.createTreeWalker(node,NodeFilter.SHOW_TEXT,null,false);
        while(n=walk.nextNode()) {
          if((n.nodeValue.length == 1 && n.nodeValue == ' ') ||  (n.nodeValue === 'get_index_of_here') || ($(n).hasClass('highlight-part'))) continue;
          $(n).wrap('<span class="highlighted-part"></span>')
        }
      }

      function highlight_nodes(element, container) {
        //traverses childnodes of element and appends to container
        if($(element)[0].hasChildNodes()){
          $(element)[0].childNodes.forEach(function(child) {
            $(container).append(highlight_nodes(child, element))
          })
        } else return element
        return container

      }

      function create_outline_comments(proposal_id, outline_comments) {
        var request = $.ajax({
          url: "{{ route('proposals_comment.store_outline_comments')}}",
          method: 'POST',
          data: {
            '_token': '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'outline_comments' : outline_comments
          }
        })

        return request;
      }

      function create_inline_comments(proposal_id, inline_comments) {
        var request = $.ajax({
          url: "{{ route('proposals_comment.store_inline_comments')}}",
          method: 'POST',
          data: {
            '_token': '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'inline_comments' : inline_comments
          }
        })

        return request;
      }

      function add_inline_comments(inline_comments) {
        loader.open()
        var request = create_inline_comments(proposal_id, inline_comments)
        request.then(function(data_inline_comments) {
          loader.close();
          show_notif(data_inline_comments['view'])
        })
      }

      function add_outline_comment(outline_comment) {
        loader.open()
        var request =  create_outline_comments(proposal_id, outline_comment);
        request.then(function(data_outline_comment) {
          loader.close()
          if(data_outline_comment['status'] == 1) {
            display_outline_comments_by_proposal(proposal_id, comment_type)
          }
          show_notif(data_outline_comment['view'])  
        })
      }

      function update_inline_comment(comment) {
        var request = $.ajax({
          url: "{{ route('proposals_comment.update')}}",
          method: 'POST',
          data: {
            '_token': '{{ csrf_token() }}',
            'comment': comment,
            'is_inline' : 1
          }
        })

        return request;
      }

      function update_outline_comment(comment) {
        var request = $.ajax({
          url: "{{ route('proposals_comment.update')}}",
          method: 'POST',
          data: {
            '_token': '{{ csrf_token() }}',
            'comment': comment,
            'is_inline' : 0
          }
        })

        return request;
      }

      function view_all_comments_by_proposal(proposal_id){
        var request = $.ajax({
          url: "{{ route('proposals_comment.show_all_comments_by_proposal')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id
          }
        })

        return request;
      }

      function view_inline_comments_by_proposal(proposal_id, comment_type){
        var request = $.ajax({
          url: "{{ route('proposals_comment.show_inline_comments_by_proposal')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'comment_type' : comment_type
          }
        })

        return request;
      }

      function view_outline_comments_by_proposal(proposal_id, comment_type){
        var request = $.ajax({
          url: "{{ route('proposals_comment.show_outline_comments_by_proposal')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'comment_type' : comment_type
          }
        })

        return request;
      }

      function view_user_outline_comments_by_proposal(proposal_id){
        var request = $.ajax({
          url: "{{ route('proposals_comment.show_user_outline_comments_by_proposal')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'comment_type' : comment_type
          }
        })

        return request;
      }

      function display_outline_comments_by_proposal(proposal_id, comment_type) {
        current_proposal_modal = $('.view-proposal-modal.modal.show')
        $(current_proposal_modal).find('.outline-comments').empty()
        //gets all outline comments
        var request_outline_comments = view_outline_comments_by_proposal(proposal_id, comment_type);
        request_outline_comments.then(function(data_outline_comments){
          if(data_outline_comments['status'] == 1) {
            if(data_outline_comments['outline_comments'].length > 0){
              for (var i = 0; i < data_outline_comments['outline_comments'].length; i++){
                field_version = $(current_proposal_modal)
                  .find('.comments-tab .comments-outline div[data-proposal-field-id="'+data_outline_comments['outline_comments'][i]['proposal_field_id']+'"]')
                  .parent('.container-versioning')
                  .find('select.versioning > option:selected')
                  .text()

                if(field_version != null && field_version != '') {
                  list_item = $('<li data-outline-comment-id="'+data_outline_comments['outline_comments'][i]['idproposal_comments']+'" class="list-group-item list-group-item-info"><h5><i>'+data_outline_comments['outline_comments'][i]['username']+'</i> commented ('+data_outline_comments['outline_comments'][i]['date_commented']+'): </h5><h4 class="pl-4 font-weight-bold font-italic outline-comment-header">On '+data_outline_comments['outline_comments'][i]['comment_section'] + ' ('+data_outline_comments['outline_comments'][i]['proposal_field']+' ('+field_version+'))' +':</h4><blockquote class="p-4 outline-comment-comments">'+data_outline_comments['outline_comments'][i]['comments']+'</blockquote></li>');

                } else {
                  list_item = $('<li data-outline-comment-id="'+data_outline_comments['outline_comments'][i]['idproposal_comments']+'" class="list-group-item list-group-item-info"><h5><i>'+data_outline_comments['outline_comments'][i]['username']+'</i> commented ('+data_outline_comments['outline_comments'][i]['date_commented']+'): </h5><h4 class="pl-4 font-weight-bold font-italic outline-comment-header">On '+data_outline_comments['outline_comments'][i]['comment_section'] + ' ('+data_outline_comments['outline_comments'][i]['proposal_field']+')' +':</h4><blockquote class="p-4 outline-comment-comments">'+data_outline_comments['outline_comments'][i]['comments']+'</blockquote></li>')
                }

                if(data_outline_comments['has_access']){
                  $('.comments-classification').text(`(${data_outline_comments['comments_classification']})`)
                  display_element($('.proposal_outline_comments_all_comments'))
                  list_item.prepend($('<div class="text-right"><span class="px-1"><a href="#" class="update-outline-comments">Update</a></span><span class="px-1"><a href="#" class="delete-outline-comments">Delete</a></span></div>'))
                } else hide_element($('.proposal_outline_comments_all_comments'))

                 $(current_proposal_modal).find('.outline-comments.proposal-outline-all-comments').append(list_item)
              } 
            } else {
              $(current_proposal_modal).find('.outline-comments.proposal-outline-all-comments').append('<div class="text-center"><h4>None</h4></div>')
            } 
          }
        })
        //gets all user's outline comments
        var request_user_outline_comments = view_user_outline_comments_by_proposal(proposal_id);
        request_user_outline_comments.then(function(data_user_outline_comments){
          if(data_user_outline_comments['status'] == 1) {
            if(data_user_outline_comments['user_outline_comments'].length > 0){
              for (var i = 0; i < data_user_outline_comments['user_outline_comments'].length; i++){
                field_version = $(current_proposal_modal)
                  .find('.comments-tab .comments-outline div[data-proposal-field-id="'+data_user_outline_comments['user_outline_comments'][i]['proposal_field_id']+'"]')
                  .parent('.container-versioning')
                  .find('select.versioning > option:selected')
                  .text()

                if(field_version != null && field_version != '') $(current_proposal_modal).find('.outline-comments.proposal-outline-user-comments').append('<li data-outline-comment-id="'+data_user_outline_comments['user_outline_comments'][i]['idproposal_comments']+'" class="list-group-item list-group-item-info"><div class="text-right"><span class="px-1"><a href="#" class="update-outline-comments">Update</a></span><span class="px-1"><a href="#" class="delete-outline-comments">Delete</a></span></div><h5><i>'+data_user_outline_comments['user_outline_comments'][i]['username']+'</i> commented ('+data_user_outline_comments['user_outline_comments'][i]['date_commented']+'): </h5><h4 class="pl-4 font-weight-bold font-italic outline-comment-header">On '+data_user_outline_comments['user_outline_comments'][i]['comment_section'] + ' ('+data_user_outline_comments['user_outline_comments'][i]['proposal_field']+' ('+field_version+') )' +':</h4><blockquote class="p-4 outline-comment-comments">'+data_user_outline_comments['user_outline_comments'][i]['comments']+'</blockquote></li>')  

                else $(current_proposal_modal).find('.outline-comments.proposal-outline-user-comments').append('<li data-outline-comment-id="'+data_user_outline_comments['user_outline_comments'][i]['idproposal_comments']+'" class="list-group-item list-group-item-info"><div class="text-right"><span class="px-1"><a href="#" class="update-outline-comments">Update</a></span><span class="px-1"><a href="#" class="delete-outline-comments">Delete</a></span></div><h5><i>'+data_user_outline_comments['user_outline_comments'][i]['username']+'</i> commented ('+data_user_outline_comments['user_outline_comments'][i]['date_commented']+'): </h5><h4 class="pl-4 font-weight-bold font-italic outline-comment-header">On '+data_user_outline_comments['user_outline_comments'][i]['comment_section'] + ' ('+data_user_outline_comments['user_outline_comments'][i]['proposal_field']+')' +':</h4><blockquote class="p-4 outline-comment-comments">'+data_user_outline_comments['user_outline_comments'][i]['comments']+'</blockquote></li>') 
              }
            } else {
              $(current_proposal_modal).find('.outline-comments.proposal-outline-user-comments').append('<div class="text-center"><h4>None</h4></div>')
            } 
          }
        })
      }
      
      function display_inline_comments_by_proposal(proposal_id, comment_type) {
        var request_comments = view_inline_comments_by_proposal(proposal_id, comment_type);
        request_comments.then(function(data_inline_comments){
          if(data_inline_comments['inline_comments'] != null && data_inline_comments['inline_comments'] != ''){
            //start at 0
            comments_array = []
            init_proposal_field_class = '.view-proposal-modal.modal.show .comments-tab .' + $(data_inline_comments['inline_comments'][0]['proposal_field_class']).attr('class').replace(/ /g, '.')
            comments_allow = $(init_proposal_field_class)
            comments_allow.marker({
              minimum: 1,
              overlap: true,
              colorPicker: false,
              activeRemove: false,
              data : function(e, data) {
                if(data.length > 0) comments_array = data;
              },
              debug : function(e, data) {
                show_inline_comment($(e.originalEvent.target))
              },
              add: function() {
                if($('.new-highlight').length > 1) multiple_element = true;
                else multiple_element = false;
                highlight_selected_text(this)
              }
            });

            if(data_inline_comments['inline_comments'].length == 1) {
              var load_comment = {
                style: data_inline_comments['inline_comments'][0]['style'],
                order: data_inline_comments['inline_comments'][0]['comment_order'],
                uniqueName: data_inline_comments['inline_comments'][0]['uniqueName'],
                text : data_inline_comments['inline_comments'][0]['comment_text']
              }
              comments_array.push(load_comment)
              comments_allow.marker('restore', comments_array)
            } else {
              for (var i = 0; i < data_inline_comments['inline_comments'].length; i++) {
                proposal_field_class = '.view-proposal-modal.modal.show .comments-tab .' + $(data_inline_comments['inline_comments'][i]['proposal_field_class']).attr('class').replace(/ /g, '.')
                if(i > 0 && init_proposal_field_class != proposal_field_class) {
                  init_proposal_field_class = proposal_field_class
                  comments_allow.marker('restore', comments_array)
                  comments_array = []
                  comments_allow = $(proposal_field_class)
                  comments_allow.marker({
                    minimum: 1,
                    overlap: true,
                    colorPicker: false,
                    activeRemove: false,
                    data : function(e, data) {
                      if(data.length > 0) comments_array = data;
                    },
                    debug : function(e, data) {
                      show_inline_comment($(e.originalEvent.target))
                    },
                    add: function() {
                      if($('.new-highlight').length > 1) multiple_element = true;
                      else multiple_element = false;
                      highlight_selected_text(this)
                    }
                  });
                  

                } 
                var load_comment = {
                  style: data_inline_comments['inline_comments'][i]['style'],
                  order: data_inline_comments['inline_comments'][i]['comment_order'],
                  uniqueName: data_inline_comments['inline_comments'][i]['uniqueName'],
                  text : data_inline_comments['inline_comments'][i]['comment_text']
                }
                comments_array.push(load_comment)

                if(i+1 == data_inline_comments['inline_comments'].length) {
                  comments_allow.marker('restore', comments_array)
                } 
              }
            }
            
            
            

            //38
            // var current_highlight_count = 0
            // var comment_section_class = null;
            // var start_highlight;
            // var highlight_length;
            // var comment_section_text;
            // var start_part, highlighted_part, end_part;

            // for (var i = 0; i < data_comments['comments'].length; i++) {
            //   highlight_part = '<span class="highlighted-part" data-comment-id="'+data_comments['comments'][i]['idproposal_comments']+'"></span>'
            //   highlighted_offset = (comment_section_class != data_comments['comments'][i]['comment_section']) ? 0 : highlighted_offset + highlight_part.length
            //   comment_section_class = data_comments['comments'][i]['comment_section']
            //   start_highlight = data_comments['comments'][i]['start_highlight'] + (highlighted_offset)
            //   highlight_length = data_comments['comments'][i]['length']
            //   comment_section_text = $(comment_section_class).html();

            //   start_part = comment_section_text.substring(0, start_highlight)
            //   highlighted_part = comment_section_text.substring(start_highlight, start_highlight + highlight_length)
            //   end_part = comment_section_text.substring(start_highlight + highlight_length, comment_section_text.length)

            //   comment_section_text = start_part.concat('<span class="highlighted-part" ', 'data-comment-id="', data_comments['comments'][i]['idproposal_comments'], '">',highlighted_part, '</span>', end_part)

            //   $(comment_section_class).html(comment_section_text)

            // }
          }
        })

      }
      function delete_comments_by_proposal(proposal_id, comment_section){
        var request = $.ajax({
          url: "{{ route('proposals_comment.delete_comments_by_proposal')}}",
          method: 'DELETE',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'comment_section' : comment_section
          }
        })

        return request;
      }

      function delete_comment(comment){
        var request = $.ajax({
          url: "{{ route('proposals_comment.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'comment' : comment,
          }
        })

        return request;
      }

      function view_inline_comment(uniqueName){
       var request = $.ajax({
          url: "{{ route('proposals_comment.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'uniqueName' : uniqueName,
            'is_inline' : 1
          }
        })

        return request;
      }

      function view_outline_comment(comment_id) {
        var request = $.ajax({
          url: "{{ route('proposals_comment.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'comment_id' : comment_id,
            'is_inline' : 0
          }
        })

        return request;
      }

      function highlight_selected_text(element) {
        //highlights inline comment
        current_proposal_modal = $('.view-proposal-modal.modal.show')
        inline_comment_section_id = $(element).parents('.comment-section').attr('data-comments-section-id')
        version_id = $(element).parents('.container-versioning').find('.versioning').val()
        proposal_field_id = (typeof $(element).attr('data-proposal-field-id') == 'undefined') ? $(element).parents('.comment-section').attr('data-proposal-field-id') : $(element).attr('data-proposal-field-id')
        inline_comment_section = $(element).parents('.comment-section').find('.comment-header').text()
        proposal_field_class = '.' + $(element).attr('class').replace(/ /g, '.')
        proposal_field = ($(current_proposal_modal).find('.container-comment-section select.comment-section').find('option[value="'+proposal_field_id+'"].d-block').text())
        selected_text = '';
        $('.new-highlight').each(function(){
          selected_text += $(this).html() + "<br>";
        })

        comments_allow.marker('data')

        $.alert({
          title: 'Notification',
          content: '<div id="inline_highlighted_part" class="bg-quoted rounded container-comment-summernote"><h4 class="font-weight-bold font-italic">'+inline_comment_section+':</h4><blockquote class="p-4">'+selected_text+'</blockquote><div id="update_inline_comment" class="summernote"></div></div>',
          buttons: {
            add_outline_comment : {
              text: 'Add Comment',
              btnClass: 'btn btn-success highlighted',
              action: function(){
                inline_comments = []
                for (var i = 0; i < comments_array.length; i++) {
                  comment = {
                    version_id : version_id,
                    comment_section_id : inline_comment_section_id,
                    proposal_field_id : proposal_field_id,
                    uniqueName: comments_array[i].uniqueName,
                    proposal_field : proposal_field,
                    proposal_field_class : proposal_field_class,
                    comment_section : inline_comment_section,
                    order: comments_array[i].order,
                    text: comments_array[i].text,
                    comments : $('#update_inline_comment').summernote('code'),
                    style: comments_array[i].style,
                    is_inline: 1
                  };
                  inline_comments.push(comment)
                }
                add_inline_comments(inline_comments)
                $('.new-highlight').removeClass('new-highlight')
              }
            },
            Cancel: function(){
              comments_allow.marker('clear')
              display_inline_comments_by_proposal(proposal_id, comment_type)
              //restore comments here
              // selected_text = $('#project_comments tr' + comment_section_class).html().match(/<span class="highlighted-part new-highlight">get_index_of_here(.*)<\/span>/g);

              // txt = $('#project_comments tr' + comment_section_class).html().replace(/<span class="highlighted-part new-highlight">get_index_of_here(.*)<\/span>/g, selected_text)
              // $('#project_comments tr' + comment_section_class).html(txt)

            }
          },
          onOpen : function(){
            $('#update_inline_comment').summernote({
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#update_inline_comment').summernote('destroy')
          }
        })
      }

      function show_inline_comment(element){
        current_proposal_modal = $('.view-proposal-modal.modal.show')
        uniqueName = $(element).attr('data-unique-name')
        var request_comment = view_inline_comment(uniqueName);
        request_comment.then(function(data_comment){
          if(data_comment['status'] == 1) {
            comment_header = $(element).parents('.comment-section').find('.comment-header').text()
            inline_comment_section_id = $(element).parents('.comment-section').attr('data-comments-section-id')
            version_id = $(element).parents('.container-versioning').find('.versioning').val()
            proposal_field_id = (typeof $(element).attr('data-proposal-field-id') == 'undefined') ? $(element).parents('.comment-section').attr('data-proposal-field-id') : $(element).attr('data-proposal-field-id')
            inline_comment_section = $(element).parents('.comment-section').find('.comment-header').text()
            proposal_field_class = '.' + $(element).attr('class').replace(/ /g, '.')
            proposal_field = ($(current_proposal_modal).find('.container-comment-section select.comment-section').find('option[value="'+proposal_field_id+'"].d-block').text())
            selected_text = data_comment['comment']['comment_text']


            $.alert({
              title: 'Notification',
              content: '<div id="update_highlighted_part" class="bg-quoted rounded container-comment-summernote"><h4 class="font-weight-bold font-italic">'+inline_comment_section+':</h4><blockquote class="p-4">'+selected_text+'</blockquote><div id="update_inline_comment" class="summernote"></div></div>',
              buttons: {
                update_comment : {
                  text: 'Update Comment',
                  btnClass: 'btn btn-info highlighted',
                  action: function(){
                    comment = {
                      style: data_comment['comment']['style'],
                      order: data_comment['comment']['order'],
                      uniqueName: data_comment['comment']['uniqueName'],
                      text: data_comment['comment']['text'],
                      comments : $('#update_inline_comment').summernote('code')
                    };
                    //update comment here
                    var request_update_inline_comment = update_inline_comment(comment);
                    request_update_inline_comment.then(function(data_update_inline_comment) {
                      show_notif(data_update_inline_comment['view'])
                    })

                  }
                },
                Cancel: function(){}
              },
              onOpen : function(){
                $('#update_inline_comment').summernote({
                  height: 150,  
                  toolbar: [
                      ['style', ['bold', 'italic', 'underline']],
                    ],
                  dialogsInBody: true
                })
                $('#update_inline_comment').summernote('code', data_comment['comment']['comments'])
              },
              onClose: function() {
                $('#update_inline_comment').summernote('destroy')
              }
            })
          }
        })
      }

      function view_proposal_version(target_table, version) {
       var request = $.ajax({
          url: "{{ route('proposals.show_proposal_version')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'target_table' : target_table,
            'version' : version
          }
        })

        return request;
      }

      function upload_proposal_file(proposal_file_upload, proposal_id, document_type){
        var formData = new FormData();
        formData.append('proposal_id', proposal_id);
        formData.append('document_type', document_type);
        formData.append('proposal_file', $(proposal_file_upload).prop('files')[0]);
        formData.append('_token', '{{ csrf_token() }}');
        var request = $.ajax({
          method: 'POST',
          url: "{{ route('proposals.upload_files') }}",
          contentType: false,
          processData: false,
          data: formData
        })
        return request;
      }

      function forward_comments_to_dpmis(proposal_id, comments) {
        var request = $.ajax({
          url: "{{ route('proposals_comment.forward_comments_to_dpmis')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'comments' : comments
          }
        })

        return request;
      }

      $('.select2#forward_proposal_divisions').select2({
        dropdownParent: $('.forward_proposal_divisions_fg'),
        width: '100%',
        theme: 'bootstrap'
      })

      $('.select2#lead_division').select2({
        dropdownParent: $('.lead_division_fg'),
        width: '100%',
        theme: 'bootstrap'
      })

      $('.select2#forward_proposal_users').select2({
        dropdownParent: $('.forward_proposal_users_fg'),
        width: '100%',
        theme: 'bootstrap'
      })

      $('#forward_proposal_remarks').summernote({
        placeholder: 'Remarks here...',
        height: 150,  
        toolbar: [
          ['style', ['bold', 'italic', 'underline']],
        ],
        dialogsInBody: true
      })
      
      $('.summernote').summernote({
        height: 500,
        toolbar: [
          ['style', ['bold', 'italic', 'underline']],
          ['table', ['table']]
        ],
      })

      //Added by Drei
      $('#proposals_table').on('click', '.endorse-for-dost-gia', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        loader.open()
        var request_implementation_date = view_implementation_date(proposal_id);
        request_implementation_date.then(function(data_implementation_date) {
          loader.close();
          if(data_implementation_date['status'] == 1) {
            $.confirm({
              title: 'Notification!',
              content: `
                ${data_implementation_date['view']}
              `,
              buttons: {
                No: function(){

                },
                Continue: function() {
                  $.confirm({
                    title: 'Notification!',
                    content: `
                      <div class="py-2">
                        Are you sure you want to approve this proposal?
                      </div>
                      <textarea id="approve_proposal_remarks"></textarea>`,
                    buttons: {
                      Yes: function(){
                        if(error_checking($('.approve-proposal-required-field'))) {
                          show_notif('Please fill up the selected fields');
                          return false;
                        }
                        loader.open()
                        var status_remarks = $('#approve_proposal_remarks').summernote('code')
                        var request = update_status(proposal_id, 48, status_remarks);
                        request.then(function(data){
                          loader.close()
                          if(data['status'] == 1){
                            $.alert({
                              title: 'Notification',
                              content: data['view'],
                              buttons:{
                                Confirm: function(){
                                  proposals_table.ajax.reload(null, false)
                                }
                              }
                            })
                          } else show_notif(data['view'])
                        })
                      }
                    },
                    onOpen : function(){
                      $('#approve_proposal_remarks').summernote({
                        placeholder: 'Remarks here...',
                        height: 150,  
                        toolbar: [
                          ['style', ['bold', 'italic', 'underline']],
                        ],
                        dialogsInBody: true
                      })
                    },
                    onClose: function() {
                      $('#approve_proposal_remarks').summernote('destroy')
                    }
                  })

                },
                No : function() {}
              }
            })
          } else {
            show_notif(data_implementation_date['view'])
          }
        })
      })

      $('#proposals_table').on('click', '.exclude-from-program', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        loader.open()
        var request_implementation_date = view_implementation_date(proposal_id);
        request_implementation_date.then(function(data_implementation_date) {
          loader.close();
          if(data_implementation_date['status'] == 1) {
            $.confirm({
              title: 'Notification!',
              content: `
                ${data_implementation_date['view']}
              `,
              buttons: {
                No: function(){

                },
                Continue: function() {
                  $.confirm({
                    title: 'Notification!',
                    content: `
                      <div class="py-2">
                        Are you sure you want to approve this proposal as separate project?
                      </div>
                      <textarea id="approve_proposal_remarks"></textarea>`,
                    buttons: {
                      Yes: function(){
                        if(error_checking($('.approve-proposal-required-field'))) {
                          show_notif('Please fill up the selected fields');
                          return false;
                        }
                        loader.open()
                        var status_remarks = $('#approve_proposal_remarks').summernote('code')
                        var request = update_status(proposal_id, 40, status_remarks);
                        request.then(function(data){
                          loader.close()
                          if(data['status'] == 1){
                            $.alert({
                              title: 'Notification',
                              content: data['view'],
                              buttons:{
                                Confirm: function(){
                                  proposals_table.ajax.reload(null, false)
                                }
                              }
                            })
                          } else show_notif(data['view'])
                        })
                      }
                    },
                    onOpen : function(){
                      $('#approve_proposal_remarks').summernote({
                        placeholder: 'Remarks here...',
                        height: 150,  
                        toolbar: [
                          ['style', ['bold', 'italic', 'underline']],
                        ],
                        dialogsInBody: true
                      })
                    },
                    onClose: function() {
                      $('#approve_proposal_remarks').summernote('destroy')
                    }
                  })

                },
                No : function() {}
              }
            })
          } else {
            show_notif(data_implementation_date['view'])
          }
        })
      })

      //End Added by Drei

      $('#proposals_table').on('click', '.view-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')
        loader.open()
        var request = view_proposal(proposal_id);
        request.then(function(data) {
          loader.close()
          if(data['status'] == 1){
            $('.lib-content').collapse('hide')
            $('#project_lib_tab').removeClass('d-none')
            if(data['proposal_type'] == 3) $('#project_lib_tab').addClass('d-none')
            if(data['proposal_type'] == 1 || data['proposal_type'] == 3 || data['proposal_type'] == 5) {
              //program
              $('#dost_form1_tab').removeClass('d-none')
              $('#dost_form1 .form-content').html(data['dost_form1'])
              $('#program_comments .form-content').html(data['dost_form1'])
              $('#program_monitoring_form .form-content').html(data['program_monitoring_form'])
              for (var i = 0; i < data['projects'].length; i++) $('#project_list').append('<li data-id="'+data['projects'][i]['idproposal']+'" class="py-1 text-break"><a href="#">'+data['projects'][i]['proposal_project_title']+'</a></li>')
              for (var i = 0; i < data['proposal_timeline'].length; i++) $('#program_timeline_list').append('<li class="proposal-timeline-item"><span class="font-weight-bold">'+data['proposal_timeline'][i]['status']+'</span><span class="float-right font-weight-bold text-underline">'+data['proposal_timeline'][i]['status_date']+'</span><blockquote class="rounded text-dark">'+data['proposal_timeline'][i]['remarks']+'</blockquote></li>')
              $('.program_files_count').text(data['proposal_files'].length)
              if(data['proposal_files'].length > 0){
                for (var i = 0; i < data['proposal_files'].length; i++) {
                  proposal_file = '<li class="py-1 text-break"> <b>From <i>('+data['proposal_files'][i]['proposal_code']+' (Date uploaded: '+data['proposal_files'][i]['dpmis_date_uploaded']+') ):<i></b> <a class="text-dark proposal-file-link" href="'+data['proposal_files'][i]['file_src']+'" target="_blank">'+data['proposal_files'][i]['file_name']+' ('+data['proposal_files'][i]['document_type']+') Date uploaded: '+data['proposal_files'][i]['dpmis_date_uploaded']+'</a></li>'
                  if(data['proposal_files'][i]['dpmis_doc_id'] == null || data['proposal_files'][i]['dpmis_doc_id'] == '') $('#internal_program_files_list').append(proposal_file)
                  else $('#dpmis_program_files_list').append(proposal_file)
                }
              } else {
               $('#dpmis_program_files_list').append('<div class="text-center"><h3>None</h3></div>')
               $('#internal_program_files_list').append('<div class="text-center"><h3>None</h3></div>') 
              }

              if(data['proposal_researchers'].length > 0){
                
                for (var i = 0; i < data['proposal_researchers'].length; i++) {
                  if(data['proposal_researchers'][i]['is_lead'] == 1) researcher = '<li class="py-1 text-break proposal-researcher"><b><a class="text-dark" href="#" data-id="'+data['proposal_researchers'][i]['dpmis_researcher_id']+'">'+data['proposal_researchers'][i]['hr_last_name']+', '+data['proposal_researchers'][i]['hr_first_name']+' (Lead) </a> </b>'+'</li>';
                  else researcher = '<li class="py-1 text-break proposal-researcher"><a class="text-dark" href="#" data-id="'+data['proposal_researchers'][i]['dpmis_researcher_id']+'">'+data['proposal_researchers'][i]['hr_last_name']+', '+data['proposal_researchers'][i]['hr_first_name']+'</a>'+'</li>';
                  $('#program_researchers_list').append(researcher)
                } 
              } else {
               $('#program_researchers_list').append('<div class="text-center"><h3>None</h3></div>')
              }

              $('#view_program_modal').modal('toggle')
            } else {
              //project (rd or non rd)
              if(data['proposal_type'] == 2) $('#view_project_modal .form-content.project-info-content').html(data['dost_form2_ba_research'])
              else if(data['proposal_type'] == 4) $('#view_project_modal .form-content.project-info-content').html(data['dost_form3'])
              else if(data['proposal_type'] == 6) $('#view_project_modal .form-content.project-info-content').html(data['dost_form2_startups'])

              $('#view_project_modal #project_comment_section_outline optgroup').each(function(index, element) {
                if($(this).attr('data-proposal-type-id') == data['proposal_type']) display_element($(this))
                else hide_element($(this))
              })

              $('#project_monitoring_form .form-content').html(data['project_monitoring_form'])
              for (var i = 0; i < data['proposal_timeline'].length; i++) $('#project_timeline_list').append('<li class="proposal-timeline-item font-weight-bold"><span>'+data['proposal_timeline'][i]['status']+'</span><span class="float-right font-weight-bold text-underline">'+data['proposal_timeline'][i]['status_date']+'</span><blockquote class="rounded text-dark">'+data['proposal_timeline'][i]['remarks']+'</blockquote></li>')
              $('.project_files_count').text(data['proposal_files'].length)
              if(data['proposal_files'].length > 0){
                for (var i = 0; i < data['proposal_files'].length; i++) {
                  proposal_file = '<li class="py-1 text-break"> <b>From <i>('+data['proposal_files'][i]['proposal_code']+' (Date uploaded: '+data['proposal_files'][i]['dpmis_date_uploaded']+') ):<i></b> <a class="text-dark proposal-file-link" href="'+data['proposal_files'][i]['file_src']+'" target="_blank">'+data['proposal_files'][i]['file_name']+' ('+data['proposal_files'][i]['document_type']+') </a></li>'
                  if(data['proposal_files'][i]['dpmis_doc_id'] == null || data['proposal_files'][i]['dpmis_doc_id'] == '') $('#internal_project_files_list').append(proposal_file)
                  else $('#dpmis_project_files_list').append(proposal_file)
                } 
              } else {
               $('#dpmis_project_files_list').append('<div class="text-center"><h3>None</h3></div>')
               $('#internal_project_files_list').append('<div class="text-center"><h3>None</h3></div>') 
              }

              if(data['proposal_researchers'].length > 0){
                for (var i = 0; i < data['proposal_researchers'].length; i++) {
                  if(data['proposal_researchers'][i]['is_lead'] == 1) researcher = '<li class="py-1 text-break proposal-researcher"><b><a class="text-dark" href="#" data-id="'+data['proposal_researchers'][i]['dpmis_researcher_id']+'">'+data['proposal_researchers'][i]['hr_last_name']+', '+data['proposal_researchers'][i]['hr_first_name']+' (Lead) </a> </b>'+'</li>';
                  else researcher = '<li class="py-1 text-break proposal-researcher"><a class="text-dark" href="#" data-id="'+data['proposal_researchers'][i]['dpmis_researcher_id']+'">'+data['proposal_researchers'][i]['hr_last_name']+', '+data['proposal_researchers'][i]['hr_first_name']+'</a>'+'</li>';
                  $('#project_researchers_list').append(researcher)
                } 
              } else {
               $('#project_researchers_list').append('<div class="text-center"><h3>None</h3></div>')
              }
              proposal_years = data['project']['proposal_years'];
              for (var i = 0; i < data['project']['proposal_years']; i++)$('#project_lib_year').append('<option value="'+(i+1)+'">Year '+(i+1)+'</option>')
              $('#view_project_modal').modal('toggle')
            }
          }
        })
      })

      $('#proposals_table').on('click', '.receive-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2 font-weight-bold">Are you sure you want to receive this proposal?</div><textarea id="receive_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#receive_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 7, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            },
          },
          onOpen : function(){
            $('#receive_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#receive_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.forward-proposal-to-trd', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        var request_view_forward_proposal = view_forward_proposal(proposal_id);
        request_view_forward_proposal.then(function(data_view_forward_proposal) {
          if(data_view_forward_proposal['status'] == 1) {
            $('#forward_proposal_divisions').val(data_view_forward_proposal['forward_proposal_divisions']).change()
            $('#forward_proposal_users').val(data_view_forward_proposal['forward_proposal_users']).change()
            $('#lead_division').val(data_view_forward_proposal['lead_division']).change()
            if(data_view_forward_proposal['lead_division'][0] != null) {
              lead_trd_text = $('#forward_proposal_divisions').find('option[value="'+data_view_forward_proposal['lead_division'][0]+'"]').text()
            } else lead_trd_text = 'No Lead TRD yet';
            $('.proposal-lead-trd').text(lead_trd_text)
            $('#forward_proposal_modal').modal('toggle')
          }
        });
      })

      $('#forward_proposal_to_trd').on('click', function(e) {        
        e.preventDefault();
        var forwarded_to = $('#forward_proposal_divisions').find('option:selected').text().trim().replace(' ',', ');
        var lead_forwarded_to = $('#lead_division').find('option:selected').text()
        var trep_to = ($('#forward_proposal_users').val() == null || $('#forward_proposal_users').val() == '') ? 'N/A' : $('#forward_proposal_users').find('option:selected').text()

       //  var monitoring_cluster = "";
       //  var monitoring_division = "";

       // var status_remarks = 'Assigned lead TRD: ' + lead_forwarded_to +'<br> Monitoring Cluster: ' + monitoring_cluster + '<br> Monitoring Division: ' + monitoring_division + '<br> Forwarded to (Division/s): ' + forwarded_to +  '<br> Forwarded to (TREP/s): ' + trep_to + '<br> Other remarks:' + $('#forward_proposal_remarks').summernote('code');

        var status_remarks = 'Assigned lead TRD: ' + lead_forwarded_to + '<br> Forwarded to (Division/s): ' +forwarded_to +  '<br> Forwarded to (TREP/s): ' + trep_to + '<br> Other remarks:' + $('#forward_proposal_remarks').summernote('code');
        loader.open();
        var request_forward = forward_proposal_to_trd($('#forward_proposal_divisions').val(), $('#forward_proposal_users').val(), $('#lead_division').val(), status_remarks);
        request_forward.then(function(data_forward) {
          if(data_forward['status'] == 1) {
            loader.close()
            $.alert({
              title: 'Notification',
              content: data_forward['view'],
              buttons:{
                Confirm: function(){
                  proposals_table.ajax.reload(null, false)
                }
              }
            })
          } else {
            show_notif(data_forward['view'])
          }
        })
        $('#forward_proposal_modal').modal('toggle')
      })

      $('#proposals_table').on('click', '.forapi-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to api the comments of this proposal?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = update_status(proposal_id, 6);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          }
        })
      })
      $('#proposals_table').on('click', '.consolidate-comments-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: 
          `
            <div class="py-2">Are you sure you want to consolidate the comments on this proposal?</div>
            <div class="form-group">
              <label>Implementation start date</label>
              <input id="approved_implementation_start_date" type="date" class="form-control consolidate-comments-required-field"></input>
            </div>
            <div class="form-group">
              <label>Implementation end date</label>
              <input id="approved_implementation_end_date" type="date" class="form-control consolidate-comments-required-field"></input>
            </div>
            <textarea id="consolidate_proposal_remarks"></textarea>
          `,
          buttons: {
            Yes: function(){
              if(error_checking($('.consolidate-comments-required-field'))) {
                show_notif('Please fill up the selected fields');
                return false;
              }
              approved_implementation_start_date = $('#approved_implementation_start_date').val()
              approved_implementation_end_date = $('#approved_implementation_end_date').val()
              loader.open()
              var status_remarks = $('#consolidate_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 16, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  proposals_table.ajax.reload(null, false)
                  var request_consolidate_comments = view_all_comments_by_proposal(proposal_id);
                  request_consolidate_comments.then(function(data_consolidate_comments){
                    if(data_consolidate_comments['status'] == 1) {
                      if(data_consolidate_comments['user_privilege'] > 2) hide_element($('#forward_comments_to_dpmis'))
                      $('#consolidate_comments_proposal_modal .consolidated-comments').html(data_consolidate_comments['comment_form']);
                      $('#consolidate_comments_proposal_modal').modal('toggle')
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#consolidate_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#consolidate_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.forward-comments-to-dpmis', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        var request_consolidate_comments = view_all_comments_by_proposal(proposal_id);
        request_consolidate_comments.then(function(data_consolidate_comments){
          if(data_consolidate_comments['status'] == 1) {
            if(data_consolidate_comments['user_privilege'] == 1) display_element($('#forward_comments_to_dpmis'))
            $('#consolidate_comments_proposal_modal .consolidated-comments').html(data_consolidate_comments['comment_form']);
            $('#consolidate_comments_proposal_modal').modal('toggle')
          }
        })
      })

      $('#proposals_table').on('click', '.forward-proposal-to-palihan', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')
        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to approve this proposal?</div>',
          buttons: {
            Yes: function(){
              loader.open()
              var request_forward = forward_proposal_to_palihan(proposal_id);
              request_forward.then(function(data){
                loader.close()
                if(data == 1){
                  $.alert({
                    title: 'Notification',
                    content: 'Forward to Palihan testing successful!',
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif('Forward to Palihan testing failed')
              })
            },
            No: function(){

            }
          }
        })
        
      })

      $('#proposals_table').on('click', '.approve-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        loader.open()
        var request_implementation_date = view_implementation_date(proposal_id);
        request_implementation_date.then(function(data_implementation_date) {
          loader.close();
          if(data_implementation_date['status'] == 1) {
            $.confirm({
              title: 'Notification!',
              content: `
                ${data_implementation_date['view']}
              `,
              buttons: {
                No: function(){

                },
                Continue: function() {
                  $.confirm({
                    title: 'Notification!',
                    content: `
                      <div class="py-2">
                        Are you sure you want to approve this proposal?
                      </div>
                      <textarea id="approve_proposal_remarks"></textarea>`,
                    buttons: {
                      Yes: function(){
                        if(error_checking($('.approve-proposal-required-field'))) {
                          show_notif('Please fill up the selected fields');
                          return false;
                        }
                        loader.open()
                        var status_remarks = $('#approve_proposal_remarks').summernote('code')
                        var request = update_status(proposal_id, 15, status_remarks);
                        request.then(function(data){
                          loader.close()
                          if(data['status'] == 1){
                            $.alert({
                              title: 'Notification',
                              content: data['view'],
                              buttons:{
                                Confirm: function(){
                                  proposals_table.ajax.reload(null, false)
                                }
                              }
                            })
                          } else show_notif(data['view'])
                        })
                      }
                    },
                    onOpen : function(){
                      $('#approve_proposal_remarks').summernote({
                        placeholder: 'Remarks here...',
                        height: 150,  
                        toolbar: [
                          ['style', ['bold', 'italic', 'underline']],
                        ],
                        dialogsInBody: true
                      })
                    },
                    onClose: function() {
                      $('#approve_proposal_remarks').summernote('destroy')
                    }
                  })

                },
                No : function() {}
              }
            })
          } else {
            show_notif(data_implementation_date['view'])
          }
        })
      })
      
      $('#proposals_table').on('click', '.endorse-to-dc-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to endorse this proposal to the DC?</div><textarea id="endorse_to_dc_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#endorse_to_dc_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 17, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#endorse_to_dc_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#endorse_to_dc_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.dc-endorsed-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to change the status of this proposal to "DC Endorsed"?</div><textarea id="dc_endorsed_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#dc_endorsed_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 28, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#dc_endorsed_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#dc_endorsed_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.dc-approved-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to change the status of this proposal to "DC Approved"?</div><textarea id="dc_approved_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#dc_approved_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 29, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#dc_approved_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#dc_approved_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.dc-disapproved-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to change the status of this proposal to "DC disapproved"?</div><textarea id="dc_disapproved_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#dc_disapproved_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 30, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#dc_disapproved_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#dc_disapproved_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.endorsed-to-usec-rd-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to endorse this proposal to the Usec. for R&D?</div><textarea id="endorsed_to_usec_rd_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#endorsed_to_usec_rd_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 31, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#endorsed_to_usec_rd_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#endorsed_to_usec_rd_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.approved-by-usec-rd-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to change the status of this proposal to "Approved by Usec. for R&D"?</div><textarea id="approved_by_user_rd_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#approved_by_user_rd_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 32, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#approved_by_user_rd_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#approved_by_user_rd_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.disapproved-by-usec-rd-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to change the status of this proposal to "Disapproved by Usec. for R&D"?</div><textarea id="disapproved_by_user_rd_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#disapproved_by_user_rd_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 33, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#disapproved_by_user_rd_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#disapproved_by_user_rd_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.gc-endorsed-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to change the status of this proposal to "GC Endorsed"?</div><textarea id="gc_endorsed_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#gc_endorsed_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 34, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#gc_endorsed_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#gc_endorsed_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.gc-approved-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to change the status of this proposal to "GC Approved"?</div><textarea id="gc_approved_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#gc_approved_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 35, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#gc_approved_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#gc_approved_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.gc-disapproved-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to change the status of this proposal to "GC disapproved"?</div><textarea id="gc_disapproved_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#gc_disapproved_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 36, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#gc_disapproved_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#gc_disapproved_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.execom-endorsed-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to change the status of this proposal to "Execom Endorsed"?</div><textarea id="execom_endorsed_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#execom_endorsed_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 37, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#execom_endorsed_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#execom_endorsed_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.execom-approved-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to change the status of this proposal to "Execom Approved"?</div><textarea id="execom_approved_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#execom_approved_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 38, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#execom_approved_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#execom_approved_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.execom-disapproved-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to change the status of this proposal to "Execom disapproved"?</div><textarea id="execom_disapproved_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#execom_disapproved_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 39, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#execom_disapproved_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#execom_disapproved_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.revise-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to request for revision for this proposal?</div><textarea id="revise_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#revise_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 18, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#revise_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#revise_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.return-s4c-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to return this proposal?</div><textarea id="return_s4c_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#return_s4c_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 27, status_remarks);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#return_s4c_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#return_s4c_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.disapprove-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2 font-weight-bold">Are you sure you want to disapprove this proposal?</div><textarea id="disapprove_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#disapprove_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 20, status_remarks)
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#disapprove_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#disapprove_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.refer-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2 font-weight-bold">Are you sure you want to refer this proposal to other institution?</div><textarea id="refer_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#refer_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 21, status_remarks)
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#refer_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#refer_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.withdraw-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2 font-weight-bold">Are you sure you want to withdraw this proposal?</div><textarea id="withdraw_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#withdraw_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 22, status_remarks)
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#withdraw_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#withdraw_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#proposals_table').on('click', '.review-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2 font-weight-bold">Are you sure you want to change the status of this proposal to "For Review"?</div><textarea id="review_proposal_remarks"></textarea>',
          buttons: {
            Yes: function(){
              loader.open()
              var status_remarks = $('#review_proposal_remarks').summernote('code')
              var request = update_status(proposal_id, 23, status_remarks)
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        proposals_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else show_notif(data['view'])
              })
            },
            No: function(){

            }
          },
          onOpen : function(){
            $('#review_proposal_remarks').summernote({
              placeholder: 'Remarks here...',
              height: 150,  
              toolbar: [
                ['style', ['bold', 'italic', 'underline']],
              ],
              dialogsInBody: true
            })
          },
          onClose: function() {
            $('#review_proposal_remarks').summernote('destroy')
          }
        })
      })

      $('#lead_division').on('select2:selecting', function(e) {
        lead_trd = $('#lead_division').val() 
      })

      $('#lead_division').on('change', function(e) {
        if($('#lead_division').val() == ''){
          $('#forward_proposal_divisions').prop("disabled", true)
          $('#forward_proposal_divisions').val('').change();
        } else {
          current_forward_proposal_value = $('#forward_proposal_divisions').val();
          current_forward_proposal_set = new Set(current_forward_proposal_value)
          current_forward_proposal_set.delete(lead_trd)
          current_forward_proposal_set.add($('#lead_division').val())
          current_forward_proposal_value = Array.from(current_forward_proposal_set)

          $('#forward_proposal_divisions').val('').change();
          $('#forward_proposal_divisions').val(current_forward_proposal_value).change();
          $('#forward_proposal_divisions').prop("disabled", false)
        }

      })

      $('#view_program_modal').on('click', '#project_list > li a', function(e) {
        e.preventDefault();
        $('#project_list > li a').removeClass('active');
        $(this).addClass('active')
        proposal_id = $(this).parents('li').attr('data-id')

        var request = view_proposal(proposal_id);
        request.then(function(data) {
          if(data['status'] == 1){
            $('#dost_form2 .form-content.project-info').empty()
            if(data['proposal_type'] == 2) $('#dost_form2 .form-content.project-info').html(data['dost_form2_ba_research'])
            else if(data['proposal_type'] == 4) $('#dost_form2 .form-content.project-info').html(data['dost_form3'])
            else if(data['proposal_type'] == 6) $('#dost_form2 .form-content.project-info').html(data['dost_form2_startups'])
            $('#dost_form2 .form-content.project-info').html(data['dost_form2'])
            $('#program_project_info_tabs').removeClass('d-none')
            write_lib(data)
          }
        })
      })
      $('body').on('click', '.add-outline-comment', function(e) {
        current_proposal_modal = $('.view-proposal-modal.modal.show')
        
        outline_comment_section_select = $(current_proposal_modal).find('.container-comment-section select.comment-section')
        comment_section_id = $(outline_comment_section_select).find('option:selected').parent('optgroup').attr('data-comments-section-id')
        comment_section = $(outline_comment_section_select).find('option:selected').parent('optgroup').attr('label')

        proposal_field_id = $(outline_comment_section_select).val()
        proposal_field = $(outline_comment_section_select).find('option:selected').text()

        version_id = $(current_proposal_modal)
                      .find('.comments-tab .comments-outline div[data-proposal-field-id="'+proposal_field_id+'"]')
                      .parent('.container-versioning')
                      .find('select.versioning')
                      .val()
        comments = $(current_proposal_modal).find('.proposals-outline-comment').summernote('code')

        $(outline_comment_section_select).css('border', '1px solid #ced4da')
        if(proposal_field_id == '' || proposal_field_id == null) {
          $(outline_comment_section_select).css('border', '1px solid red')
          show_notif('Please select a section.')
          return;
        }
        comment = {
          style: '',
          order: '',
          uniqueName: '',
          text: '',
          comment_section_id: comment_section_id,
          proposal_field_id: proposal_field_id,
          proposal_field: proposal_field,
          proposal_field_class: '',
          version_id: version_id,
          comment_section : comment_section,
          comments : comments,
          is_inline: 0
        };
        add_outline_comment(comment)
      })
      $('.print-program').on('click', function(e){
        if($('#dost_form1_tab').hasClass('active')){
          cloned_program_info = $('#view_program_modal #dost_form1 .form-content').clone()
          $(cloned_program_info).find('.versioning').remove()
          divToPrint=$(cloned_program_info).html();
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<html><body onload="window.print()">'+divToPrint+'</body></html>');
          newWin.document.close();
        } else if($('#dost_form2_tab').hasClass('active')){
          if($('#program_project_info_tab').hasClass('active')){
            var divToPrint=$('#view_program_modal #dost_form2 .form-content').html();
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<html><body onload="window.print()">'+divToPrint+'</body></html>');
            newWin.document.close();

          } 
          else if($('#program_project_lib_tab').hasClass('active')){
            var divToPrint=$('#view_program_modal #program_project_lib .lib-content').html();
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<html><head><link href="' + '{{ asset("plugins/bootstrap/bootstrap.min.css") }}' + '" rel="stylesheet" type="text/css"></head><body onload="window.print()">'+divToPrint+'</body></html>');
            newWin.document.close();
          } 

        } else if($('#program_monitoring_form').hasClass('active')){
          divToPrint=$('#view_program_modal #program_monitoring_form .form-content').html();
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<html><head><link href="' + '{{ asset("plugins/bootstrap/bootstrap.min.css") }}' + '" rel="stylesheet" type="text/css"></head><body onload="window.print()">'+divToPrint+'</body></html>');
          newWin.document.close();
        }
      })

      $('.print-project').on('click', function(e){
        var divToPrint;
        if($('#project_info').hasClass('active')){
          cloned_project_info = $('#view_project_modal #project_info .project-info-content').clone()
          $(cloned_project_info).find('.versioning').remove()
          divToPrint=$(cloned_project_info).html();
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<html><head></head><body onload="window.print()">'+divToPrint+'</body></html>');
          newWin.document.close();
        } 
        else if($('#project_lib').hasClass('active')){
          divToPrint=$('#view_project_modal #project_lib .lib-content').html();
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<html><head><link href="' + '{{ asset("plugins/bootstrap/bootstrap.min.css") }}' + '" rel="stylesheet" type="text/css"></head><body onload="window.print()">'+divToPrint+'</body></html>');
          newWin.document.close();
        } 
        else if($('#project_monitoring_form').hasClass('active')){
          divToPrint=$('#view_project_modal #project_monitoring_form .form-content').html();
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<html><head><link href="' + '{{ asset("plugins/bootstrap/bootstrap.min.css") }}' + '" rel="stylesheet" type="text/css"></head><body onload="window.print()">'+divToPrint+'</body></html>');
          newWin.document.close();
        }
      })
      
      $('#print_consolidated_comments_proposal').on('click', function(e) {
        var divToPrint=$('#consolidate_comments_proposal_modal .consolidated-comments').html();
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write('<html><head><link href="' + '{{ asset("plugins/bootstrap/bootstrap.min.css") }}' + '" rel="stylesheet" type="text/css"></head><body onload="window.print()">'+divToPrint+'</body></html>');
        newWin.document.close();
      })

      $('.print-resume').on('click', function(e) {
        current_proposal_modal = $('.view-proposal-modal.modal.show');
        var divToPrint=$(current_proposal_modal).find('.proposal-researcher-info').html();
        var newWin=window.open('','Print-Window');
        newWin.document.open();
          newWin.document.write('<html><head><link href="' + '{{ asset("plugins/bootstrap/bootstrap.min.css") }}' + '" rel="stylesheet" type="text/css"></head><body onload="window.print()">'+divToPrint+'</body></html>');
        newWin.document.close();
      })

      $('#forward_comments_to_dpmis').on('click', function(e) {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to forward the comments to DPMIS?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = forward_comments_to_dpmis(proposal_id, $('#consolidate_comments_proposal_modal .consolidated-comments').html());
              request.then(function(data){
                loader.close()
                proposals_table.ajax.reload(null, false)
                show_notif(data['view'])
              })
            },
            No: function(){

            }
          }
        })
      })

      $('#export_statuses_to_dpmis').on('click', function(e){
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to export the statuses to DPMIS?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = export_statuses_to_dpmis();
              request.then(function(data){
                loader.close()
                show_notif(data['view'])
              })
            },
            No: function(){

            }
          }
        })
      })
      $('body').on('click', '.note-editing-area', function(e) {
        // $('#highlighted_part .note-icon-bold').parents('#highlighted_part .btn.note-btn-bold').trigger('click')
        // $('#highlighted_part .note-icon-bold').parents('#highlighted_part .btn.note-btn-bold').trigger('click')
        $('.container-comment-summernote .note-icon-bold').trigger('click')
        $('.container-comment-summernote .note-icon-bold').trigger('click')
        
      })

      $('.toggle-view-comments').on('click', function(e) {
        target_comments_display = $(this).attr('data-target-comments-display')
        $(this).parents('.comments-tab').children('div').each(function(index, element) {
          if($(element).hasClass('d-block')) hide_element($(element));
          else if($(element).hasClass('d-none') && $(element).hasClass(target_comments_display)){
            display_element($(element));
          } 
        })

        //view comments
        comment_type = $(this).attr('data-comment-type')
        if($(this).hasClass('back-button')) return;
        if($(this).hasClass('toggle-outline-comments-buttons')) display_outline_comments_by_proposal(proposal_id, comment_type)
        if($(this).hasClass('toggle-inline-comments-buttons')) display_inline_comments_by_proposal(proposal_id, comment_type)
      })
      
      $('comments-tab .comments-inline').on('mouseup', '.comments-allow', function(e) {
        console.log(e.target)
      })

      $('comments-tab .comments-inline').on('mousemove', '.comments-allow', function(e) {
        console.log(e.target)
      })

      $('.comments-tab .comments-inline').on('mousedown', '.comments-allow', function(e) {
        //listener for inline comments
        console.log($(e.target).hasClass('marker'))
        comments_allow = $(this)
        comments_allow.marker({
          minimum: 1,
          overlap: true,
          colorPicker: false,
          activeRemove: false,
          data : function(e, data) {
            if(data.length > 0) comments_array = data;
          },
          debug : function(e, data) {
            show_inline_comment($(e.originalEvent.target))
          },
          add: function() {
            if($('.new-highlight').length > 1) multiple_element = true;
            else multiple_element = false;
            highlight_selected_text(this)
          }
        });

      })

      $('.comments-tab .comments-outline').on('click', '.update-outline-comments', function(e) {
        outline_comment_list_item = $(this).parents('li')
        outline_comment_selected_header = $(outline_comment_list_item).find('.outline-comment-header').text()
        outline_comment_selected_comment = $(outline_comment_list_item).find('.outline-comment-comments').html()
        comment_id = $(outline_comment_list_item).attr('data-outline-comment-id')
        $.alert({
          title: 'Notification',
          content: '<div id="outline_comment_selected" class="bg-quoted rounded container-comment-summernote"><h4 class="font-weight-bold font-italic">'+outline_comment_selected_header+':</h4><blockquote class="p-4">'+outline_comment_selected_comment+'</blockquote><div id="update_outline_comment_selected" class="summernote"></div></div>',
          buttons: {
            update_outline_comment : {
              text: 'Update Comment',
              btnClass: 'btn btn-info update-outline-comment-button',
              action: function(){
                comment = {
                  comment_id: comment_id,
                  comments : $('#update_outline_comment_selected').summernote('code')
                };

                var request_update_outline_comment = update_outline_comment(comment);
                request_update_outline_comment.then(function(data_update_outline_comment) {
                  if(data_update_outline_comment['status'] == 1) {
                    display_outline_comments_by_proposal(proposal_id, comment_type)
                  }
                  show_notif(data_update_outline_comment['view'])
                })
              }
            },
            Cancel: function(){}
          },
          onOpen : function(){
            $('#update_outline_comment_selected').summernote({
              height: 150,  
              toolbar: [
                  ['style', ['bold', 'italic', 'underline']],
                ],
              dialogsInBody: true
            })
            $('#update_outline_comment_selected').summernote('code', outline_comment_selected_comment)
          },
          onClose: function() {
            $('#update_outline_comment_selected').summernote('destroy')
          }
        })
      })
      $('.comments-tab .comments-outline').on('click', '.delete-outline-comments', function(e) {
        outline_comment_list_item = $(this).parents('li')
        outline_comment_selected_header = $(outline_comment_list_item).find('.outline-comment-header').text()
        outline_comment_selected_comment = $(outline_comment_list_item).find('.outline-comment-comments').html()
        comment_id = $(outline_comment_list_item).attr('data-outline-comment-id')

        $.alert({
          title: 'Notification',
          content: 'Are you sure you want to delete this comment?',
          buttons: {
            delete_outline_comment : {
              text: 'Delete Comment',
              btnClass: 'btn btn-danger delete-outline-comment-button',
              action: function(){
                comment = {
                  comment_id: comment_id
                };

                var request_delete_outline_comment = delete_comment(comment);
                request_delete_outline_comment.then(function(data_delete_outline_comment) {
                  if(data_delete_outline_comment['status'] == 1) {
                    display_outline_comments_by_proposal(proposal_id, comment_type)
                  }
                  show_notif(data_delete_outline_comment['view'])
                })
              }
            },
            Cancel: function(){}
          }
        })
      })
      $('body').on('change', '.versioning', function(e) {
        target_html = $(this).attr('data-replace-html');
        target_table = $(this).attr('data-table');
        version = $(this).val()

        var request_version = view_proposal_version(target_table, version)
        request_version.then(function(data_version) {
          if(data_version['status'] == 1){
            show_notif(data_version['view'])
            if(data_version['target_html'].length > 0) $('.view-proposal-modal.modal.show .' + target_html).html(data_version['target_html']);
          }
        })

      })

      $('#upload_project_file, #upload_program_file').on('change', function(e){
        proposal_file_upload = $(this)
        current_proposal_modal = $('.view-proposal-modal.modal.show')
        var request = view_lib_document_type()
        request.then(function(data_document_type){
          if(data_document_type['status'] == 1){
            document_type_select = $('<select></select>');
            $(document_type_select).addClass('form-control')
            $(document_type_select).addClass('form-control-sm')
            $(document_type_select).attr('id', 'document_type_select')
            option = '<option value="" selected disabled hidden>N/A</option>';
            $(document_type_select).append($(option))
            for (var i = 0; i < data_document_type['document_types'].length; i++) {
              option = '<option value="'+data_document_type['document_types'][i]['idlib_document_type']+'">' + data_document_type['document_types'][i]['document_type']+'</option>';
              $(document_type_select).append($(option))
            }

            $.alert({
              title: 'Notification',
              content: '<div class="py-2"><h3 class="font-weight-bold text-center">Please select document type</h3></div>'+$(document_type_select)[0].outerHTML,
              buttons: {
                Yes : function() {
                  $('#document_type_select').css('border', '1px solid #ced4da')
                  if(is_value_null($('#document_type_select').val())) {
                    show_element_error_notif($('#document_type_select'), 'Please select a document type');
                    proposal_file_upload.val('')
                    return false;
                  } else {
                    var request_upload_file = upload_proposal_file($(proposal_file_upload), proposal_id, $('#document_type_select').val()); 
                    request_upload_file.then(function(data_upload_file) {
                      proposal_file_upload.val('')
                      if(data_upload_file['status'] == 1) {
                        proposal_file = '<li class="py-1 text-break"><b>From <i>('+data_upload_file['file']['proposal_code']+'):<i></b> <a class="text-dark" href="'+data_upload_file['file']['file_src']+'" target="_blank">'+data_upload_file['file']['file_name']+' ('+data_upload_file['file']['document_type']+')</a></li>'
                        $(current_proposal_modal).find('.internal-files-list').append(proposal_file)
                      }
                      show_notif(data_upload_file['view']);
                    })
                  }
                },
                No : function() {}
              }
            })
          }  
        })
      })
    

      $('#project_lib_year').on('change', function(e){
        $('.lib-print').show();
        if(is_value_null($(this).val())) show_element_error_notif($(this), 'Please select a year');
        else {
          var request_lib_proposal = view_lib_by_proposal_and_year(proposal_id, $(this).val());
          loader.open()
          request_lib_proposal.then(function(data_lib_proposal) {
            if(data_lib_proposal['status'] == 1){
              loader.close()
              write_lib(data_lib_proposal)              
            }
          })
        }

      })

      $('.researchers-list').on('click', '.proposal-researcher', function(e) {
        $(".project-researchers-print").show();
        dpmis_researcher_id = $(this).find('a').attr('data-id');
        var request = view_proposal_researcher(dpmis_researcher_id);
        loader.open()
        request.then(function(data_request) {
          if(data_request['status'] == 1) {
            current_proposal_modal = $('.view-proposal-modal.modal.show');
            $(current_proposal_modal).find('.proposal-researcher-info').html(data_request['cv']);
            loader.close()
          }
          show_notif(data_request['view']);
        })
      })

      $('#view_program_modal').on('hidden.bs.modal', function() {
        $('#view_program_modal .form-content').empty()
        $('#view_program_modal #project_list').empty()
        $('#view_program_modal #dpmis_program_files_list').empty()
        $('#view_program_modal #internal_program_files_list').empty()
        $('#view_program_modal #program_timeline_list').empty()
        $('#view_program_modal .proposal-researcher-info').empty()
        $('#view_program_modal .researchers-list').empty()
        $('#program_comments .versioning').remove()
        $('#program_project_info_tabs').addClass('d-none')
        $('#view_program_modal .comments-tab > div.d-block a.back-button').trigger('click')
      })

      $('#view_project_modal').on('hidden.bs.modal', function() {
        $('#view_project_modal .form-content').empty()
        $('#view_project_modal #dpmis_project_files_list').empty()
        $('#view_project_modal #internal_project_files_list').empty()
        $('#view_project_modal #project_timeline_list').empty()
        $('#view_project_modal .proposal-researcher-info').empty()
        $('#view_project_modal .researchers-list').empty()
        $('#view_project_modal .lib-content').collapse('hide')
        $('#project_lib_year').find('option:not(:first-child)').remove()
        $('#project_lib_year').val('').change()
        $('#project_comments .versioning').remove()
        $('#view_project_modal .comments-tab > div.d-block a.back-button').trigger('click')
        reset_input_css($('#project_lib_year'));
      })

      $('#forward_proposal_modal').on('hidden.bs.modal', function() {
        $('#forward_proposal_modal .forward-proposal-field').val('').change()
        $('#forward_proposal_modal #forward_proposal_remarks').summernote('code', '');
      })
      
      $('#dost_form_tabs a.nav-link').on('click', function() {
        if($(this).attr('id') == "program_comments_tab" || $(this).attr('id') == "project_comments_tab") {
          $('#print_program').addClass('d-none')
          $('#print_project').addClass('d-none')
        } else {
          $('#print_program').removeClass('d-none')
          $('#print_project').removeClass('d-none')
        }
      })

      function download_html_element(element, title) {
        var hiddenElement = document.createElement('a');
        hiddenElement.href = 'data:text/html;charset=UTF-8,'+encodeURIComponent(element);
        hiddenElement.target = '_blank';
        hiddenElement.download = title+'.html';
        hiddenElement.click();
      }

      $('.download-proposal-files').on('click', function(e) {
        current_proposal_modal = $('.view-proposal-modal.modal.show');
        $(current_proposal_modal).find('.proposal-file-link').each(function(index, element) { $(this).get(0).click() })
        //OSEP-rendered elements
        divToPrint = '';
        //form 1 or 2
        $(current_proposal_modal).find('.proposal-download-form .proposal-download-content').each(function(index, element) {
          cloned_project_info = $(element).clone()
          $(cloned_project_info).find('.versioning').remove()
          divToPrint+=$(cloned_project_info).html();
        })
        //lib
        if(proposal_years < 1 || $(current_proposal_modal).attr('id') == 'view_program_modal') {
          dpmis_researcher_id = $(current_proposal_modal).find('.researchers-list > li:first-child a').attr('data-id');
          var request = view_proposal_researcher(dpmis_researcher_id);
          request.then(function(data_request) {
            if(data_request['status'] == 1) {
              $(current_proposal_modal).find('.proposal-researcher-info').html(data_request['cv']);
              cloned_project_info = $(current_proposal_modal).find('.proposal-researcher-info').clone()
              $(current_proposal_modal).find('.proposal-researcher-info').empty();
              $(cloned_project_info).find('.versioning').remove()
              divToPrint+=$(cloned_project_info).html();
            }
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<html><head><title>Proposal Package</title><link href="' + '{{ asset("plugins/bootstrap/bootstrap.min.css") }}' + '" rel="stylesheet" type="text/css"></head><body onload="window.print()">'+divToPrint+'</body></html>');
            newWin.document.close();
          })
        } else {
          var request_lib_proposal = view_lib_by_proposal_per_year(proposal_id, proposal_years);
          request_lib_proposal.then(function(data_lib_proposal) {
            if(data_lib_proposal['status'] == 1){
              $.each(data_lib_proposal['lib'], function(index, value) {
                data = [];
                data['project'] = data_lib_proposal['project'];
                data['proposal_type'] = data_lib_proposal['proposal_type'];
                data['lib'] = data_lib_proposal['lib'][index];
                write_lib(data);
                cloned_project_info = $('.proposal-download-form .lib-content').clone()
                $(cloned_project_info).find('.versioning').remove()
                divToPrint+=$(cloned_project_info).html();
              })

              dpmis_researcher_id = $(current_proposal_modal).find('.researchers-list > li:first-child a').attr('data-id');
              var request = view_proposal_researcher(dpmis_researcher_id);
              request.then(function(data_request) {
                if(data_request['status'] == 1) {
                  $(current_proposal_modal).find('.proposal-researcher-info').html(data_request['cv']);
                  cloned_project_info = $(current_proposal_modal).find('.proposal-researcher-info').clone()
                  $(current_proposal_modal).find('.proposal-researcher-info').empty();
                  $(cloned_project_info).find('.versioning').remove()
                  divToPrint+=$(cloned_project_info).html();
                }
                var newWin=window.open('','Print-Window');
                newWin.document.open();
                newWin.document.write('<html><head><title>Proposal Package</title><link href="' + '{{ asset("plugins/bootstrap/bootstrap.min.css") }}' + '" rel="stylesheet" type="text/css"></head><body onload="window.print()">'+divToPrint+'</body></html>');
                newWin.document.close();
              })
            }
          })
        }
      })

      $('.downlad-researcher-files').on('click', function(e) {
        current_proposal_modal = $('.view-proposal-modal.modal.show');
   
      })
      // $('#proposals_table').on( 'draw.dt', function () {
      //   $('#proposals_table tr[data-id="1"]').find('.view-proposal').trigger('click');
      // })


      //hides inline comments temporarily
      hide_element($('.toggle-inline-comments-buttons'))
      hide_element($('.toggle-inline-comments-buttons').parent())
    })
  </script>
@endsection
