@extends('layouts.app')

@section('content')
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
              <div class="card-header bg-info text-center" >
                <h3 class="display-5">Proposals Table</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="proposals_table" class="table table-bordered table-striped w-100">
                    <thead>
                      <th>Proposal Type</th>
                      <th>Project/Program ID</th>
                      <th>Title</th>
                      <th>Duration</th>
                      <th>Date Forwarded (API)</th>
                      <th>Proposal Call</th>
                      <th>Status</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Modals -->
  <div class="modal fade" id="view_program_modal" tabindex="-1" role="dialog" aria-labelledby="view_program_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false"> 
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
            <ul id="dost_form_tabs" class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="form2a_tab" data-toggle="tab" href="#form2a" role="tab" aria-controls="form2a" aria-selected="true">Form 2A</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="form2b_tab" data-toggle="tab" href="#form2b" role="tab" aria-controls="form2b" aria-selected="true">Form 2B</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="program_files_tab" data-toggle="tab" href="#program_files" role="tab" aria-controls="program_files" aria-selected="true">Program Files</a>
              </li>
            </ul>
            <div class="tab-content" id="dost_form_program_content">
              <div class="tab-pane fade show active" id="form2a" role="tabpanel" aria-labelledby="form2a_tab">
                <div class="container">
                  <div class="row pt-3">
                    <div class="col-md-12">
                      <div class="form-content p-3">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="form2b" role="tabpanel" aria-labelledby="form2b_tab">
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
                        <li class="nav-item">
                          <a class="nav-link" id="program_project_lib_tab" data-toggle="tab" href="#program_project_lib" role="tab" aria-controls="program_project_lib" aria-selected="true">LIB</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="program_project_files_tab" data-toggle="tab" href="#program_project_files" role="tab" aria-controls="program_project_files" aria-selected="true">Project Files</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="program_project_content">
                        <div class="tab-pane fade show active" id="program_project_info" role="tabpanel" aria-labelledby="program_project_info_tab">
                          <div class="form-content project-info project-info-content p-3"></div>
                        </div>
                        <div class="tab-pane fade" id="program_project_lib" role="tabpanel" aria-labelledby="program_project_lib_tab">
                          <div class="lib-content project-info-content p-3">
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
                              <table class="table table-borderless project_ps_lib_content">
                                <thead>
                                  <tr>
                                    <th></th>
                                    <th class="text-center border-bottom">Implementing Agency</th>
                                    <th></th>
                                  </tr>
                                  <tr>
                                    <th></th>
                                    <th class="text-center border-top">Counterpart Funding</th>
                                    <th>DOST</th>
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
                                  <tr class="project_lib_ps_lib_implementing_agency">
                                    <th colspan="3" class="text-left">
                                      (Implementing Agency)
                                    </th>
                                  </tr>
                                  <tr class="project_lib_ps_lib_monitoring_agency">
                                    <th colspan="3" class="text-left">
                                      (Monitoring Agency)
                                    </th>
                                  </tr>
                                  <tr>
                                    <th>Sub-total for PS</th>
                                    <th class="text-center project_lib_ps_lib_counterpart_subtotal"></th>
                                    <th class="project_lib_ps_lib_dost_subtotal"></th>
                                  </tr>
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
                                  <tr class="project_lib_mooe_lib_implementing_agency">
                                    <th colspan="3" class="text-left">
                                      (Implementing Agency)
                                    </th>
                                  </tr>
                                  <tr class="project_lib_mooe_lib_monitoring_agency">
                                    <th colspan="3" class="text-left">
                                      (Monitoring Agency)
                                    </th>
                                  </tr>
                                  <tr>
                                    <th>Sub-total for MOOE</th>
                                    <th class="text-center project_lib_mooe_lib_counterpart_subtotal"></th>
                                    <th class="project_lib_mooe_lib_dost_subtotal"></th>
                                  </tr>
                                  <tr class="project_lib_eo_co_lib_direct_cost">
                                    <td colspan="3">
                                      <b>
                                        III. Equipment Outlay
                                      </b>
                                    </td>
                                  </tr>
                                  <tr>
                                    <th colspan="3" class="text-left text-underline">
                                      Indirect Cost
                                    </th>
                                  </tr>
                                  <tr class="project_lib_eo_co_lib_indirect_cost_monitoring_agency">
                                    <th colspan="3" class="text-left">
                                      (Monitoring Agency)
                                    </th>
                                  </tr>
                                  <tr>
                                    <th>Sub-total for EO</th>
                                    <th class="text-center project_lib_eo_co_lib_counterpart_subtotal"></th>
                                    <th class="project_lib_eo_co_lib_dost_subtotal"></th>
                                  </tr>
                                  <tr>
                                    <th>Grand Total</th>
                                    <th class="text-center project_lib_grand_total_counterpart"></th>
                                    <th class="project_lib_grand_total_dost"></th>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="program_project_files" role="tabpanel" aria-labelledby="project_files_tab">
                          <div class="text-center">
                            <h3>Project Files List</h3>
                          </div>
                          <ul id="program_projects_files_list" class="nav nav-pills proposal-info-list"></ul>
                        </div>
                      </div>
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
                      <ul id="program_files_list" class="proposal-info-list"></ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="print_program" type="button" class="btn btn-success">Print</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="view_project_modal" tabindex="-1" role="dialog" aria-labelledby="view_project_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false"> 
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
            <div class="row">
              <div class="col-md-12">
                <ul id="project_info_tabs" class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="project_info_tab" data-toggle="tab" href="#project_info" role="tab" aria-controls="project_info" aria-selected="true">Project Info</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="project_lib_tab" data-toggle="tab" href="#project_lib" role="tab" aria-controls="project_lib" aria-selected="true">LIB</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="project_files_tab" data-toggle="tab" href="#project_files" role="tab" aria-controls="project_files" aria-selected="true">Project Files</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="project_comments_tab" data-toggle="tab" href="#project_comments" role="tab" aria-controls="project_comments" aria-selected="true">Comments</a>
                  </li>
                </ul>
                <div class="tab-content" id="project_content">
                  <div class="tab-pane fade show active" id="project_info" role="tabpanel" aria-labelledby="project_info_tab">
                    <div class="form-content project-info-content p-3"></div>
                    <hr>
                    <div class="clearfix">
                      <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success print-project">Print</button>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="project_lib" role="tabpanel" aria-labelledby="project_lib_tab">
                    <div class="lib-content project-info-content p-3">
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
                        <table class="table table-borderless project_ps_lib_content">
                          <thead>
                            <tr>
                              <th></th>
                              <th class="text-center border-bottom">Implementing Agency</th>
                              <th></th>
                            </tr>
                            <tr>
                              <th></th>
                              <th class="text-center border-top">Counterpart Funding</th>
                              <th>DOST</th>
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
                            <tr class="project_lib_ps_lib_implementing_agency">
                              <th colspan="3" class="text-left">
                                (Implementing Agency)
                              </th>
                            </tr>
                            <tr class="project_lib_ps_lib_monitoring_agency">
                              <th colspan="3" class="text-left">
                                (Monitoring Agency)
                              </th>
                            </tr>
                            <tr>
                              <th>Sub-total for PS</th>
                              <th class="text-center project_lib_ps_lib_counterpart_subtotal"></th>
                              <th class="project_lib_ps_lib_dost_subtotal"></th>
                            </tr>
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
                            <tr class="project_lib_mooe_lib_implementing_agency">
                              <th colspan="3" class="text-left">
                                (Implementing Agency)
                              </th>
                            </tr>
                            <tr class="project_lib_mooe_lib_monitoring_agency">
                              <th colspan="3" class="text-left">
                                (Monitoring Agency)
                              </th>
                            </tr>
                            <tr>
                              <th>Sub-total for MOOE</th>
                              <th class="text-center project_lib_mooe_lib_counterpart_subtotal"></th>
                              <th class="project_lib_mooe_lib_dost_subtotal"></th>
                            </tr>
                            <tr class="project_lib_eo_co_lib_direct_cost">
                              <td colspan="3">
                                <b>
                                  III. Equipment Outlay
                                </b>
                              </td>
                            </tr>
                            <tr>
                              <th colspan="3" class="text-left text-underline">
                                Indirect Cost
                              </th>
                            </tr>
                            <tr class="project_lib_eo_co_lib_indirect_cost_monitoring_agency">
                              <th colspan="3" class="text-left">
                                (Monitoring Agency)
                              </th>
                            </tr>
                            <tr>
                              <th>Sub-total for EO</th>
                              <th class="text-center project_lib_eo_co_lib_counterpart_subtotal"></th>
                              <th class="project_lib_eo_co_lib_dost_subtotal"></th>
                            </tr>
                            <tr>
                              <th>Grand Total</th>
                              <th class="text-center project_lib_grand_total_counterpart"></th>
                              <th class="project_lib_grand_total_dost"></th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <hr>
                    <div class="clearfix">
                      <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success print-project">Print</button>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="project_files" role="tabpanel" aria-labelledby="project_files_tab">
                    <div class="text-center my-3">
                      <h3>Project Files List</h3>
                    </div>
                    <ul id="project_files_list" class="proposal-info-list">
                    </ul>
                    <hr>
                    <div class="clearfix">
                      <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="project_comments" role="tabpanel" aria-labelledby="project_comments_tab">
                    <div class="d-block">
                      <div class="text-center my-3">
                        <h3>Project Comments List</h3>
                      </div>
                      <ul id="project_comments_list" class="proposal-info-list">
                        <li class="py-1 text-break">
                          <a href="#" class="toggle-view-comments all-comments">View all comments</a>
                        </li>
                        <li class="py-1 text-break">
                          <a href="#" class="toggle-view-comments trd-comments">View comments by TRDs</a>
                        </li>
                        <li class="py-1 text-break">
                          <a href="#" class="toggle-view-comments trep-comments">View comments by TREP</a>
                        </li>
                        <li class="py-1 text-break">
                          <a href="#" class="toggle-view-comments gc-comments">View comments by GC</a>
                        </li>
                        <li class="py-1 text-break">
                          <a href="#" class="toggle-view-comments dc-comments">View comments by DC</a>
                        </li>
                      </ul>
                      <hr>
                      <div class="clearfix">
                        <div class="float-right">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                    <div class="d-none">
                      <div class="py-2">
                        <a href="#" class="toggle-view-comments"><u><i class="fas fa-angle-left"></i> Back</u></a>
                      </div>
                      <div class="form-content project-info-content p-3"></div>
                      <hr>
                      <div>
                        <h3 class="mb-0">
                          <span class="badge badge-info">
                            Write a comment:
                          </span>
                        </h3>
                        <textarea id="project_comment_area" class="summernote"></textarea>
                      </div>
                      <div class="clearfix">
                        <div class="float-right">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-success add-comment">Add comment</button>
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
            <div class="row">
              <div class="col-md-12">
                <div class="forward_proposal_divisions_fg form-group">
                  <label>
                    Division
                  </label>
                  <select id="forward_proposal_divisions" type="text" name="forward_proposal_divisions" class="form-control select2 required-field forward-proposal-field" multiple="multiple">
                    @foreach ($divisions as $division)
                      <option value="{{ $division->id }}"> {{ $division->division_acronym }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            @if(Auth::user()->privilege == 3)
            <div class="row">
              <div class="col-md-12">
                <div class="forward_proposal_users_fg form-group">
                  <label>
                    Users (TREP)
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
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="forward_proposal" type="button" class="btn btn-success">Forward</button>
        </div>
      </div>
    </div>
  </div>
  @endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
      var proposal_id = null;
      var proposals_table = $('#proposals_table').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('proposals.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'proposal_type', name: 'proposal_type'},
            {data: 'proposal_code', name: 'proposal_code'},
            {data: 'monitoring_agency_division', name: 'monitoring_agency_division'},
            {data: 'title', name: 'title'},
            {data: 'duration', name: 'duration'},
            {data: 'date_forwarded_through_api', name: 'date_forwarded_through_api'},
            {data: 'call_for_proposal', name: 'call_for_proposal'},
            {data: 'proposal_status', name: 'proposal_status'},
            {data: 'action', orderable: false, searchable: false}
        ]

      });

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

      function forward_proposal(forward_proposal_divisions, forward_proposal_users) {
        var request = $.ajax({
          url: "{{ route('proposals.forward_proposal_to_trd')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'forward_proposal_divisions' : forward_proposal_divisions,
            'forward_proposal_users' : forward_proposal_users
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

      function update_status(proposal_id, status){
        var request = $.ajax({
          url: "{{ route('proposals.update_status')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_id' : proposal_id,
            'status' : status
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

      

      function write_lib(data) {
        //for LIB
        //LIB header
        if(data['proposal_type'] == 2 || data['proposal_type'] == 4){
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
            //remove all lib contents
            $('.lib-item').remove()
            var ps_counterpart_amount = 0;
            var ps_dost_amount = 0;
            var mooe_counterpart_amount = 0;
            var mooe_dost_amount = 0;
            var eo_co_counterpart_amount = 0;
            var eo_co_dost_amount = 0;

            if(data['lib']['project_ps_lib'] != null && data['lib']['project_ps_lib'] != ''){
              var direct_cost_salaries = $('.project_lib_ps_lib_direct_cost_salaries')
              var direct_cost_honoraria = $('.project_lib_ps_lib_direct_cost_honoraria')
              var implementing_agency = $('.project_lib_ps_lib_implementing_agency')
              var monitoring_agency = $('.project_lib_ps_lib_monitoring_agency')

              
              //project direct cost salaries
              for (var i = 0; i < data['lib']['project_ps_lib']['direct_cost_salaries'].length; i++) {
                ps_counterpart_amount = ps_counterpart_amount + parseFloat((data['lib']['project_ps_lib']['direct_cost_salaries'][i]['counterpart_amount'] == '-' ? 0 : data['lib']['project_ps_lib']['direct_cost_salaries'][i]['counterpart_amount'].replace(/,/g, '')))
                ps_dost_amount = ps_dost_amount + parseFloat((data['lib']['project_ps_lib']['direct_cost_salaries'][i]['dost_amount'] == '-' ? 0 : data['lib']['project_ps_lib']['direct_cost_salaries'][i]['dost_amount'].replace(/,/g, '')))

                var dcs = '<tr class="lib-item"> <td class="pl-5">'+data['lib']['project_ps_lib']['direct_cost_salaries'][i]['description']+'</td><td class="text-center">'+data['lib']['project_ps_lib']['direct_cost_salaries'][i]['counterpart_amount']+'</td><td>'+data['lib']['project_ps_lib']['direct_cost_salaries'][i]['dost_amount']+'</td></tr>';
                $(dcs).insertAfter(direct_cost_salaries)
              }

              //project direct cost honoraria
              for (var i = 0; i < data['lib']['project_ps_lib']['direct_cost_honoraria'].length; i++) {
                ps_counterpart_amount = ps_counterpart_amount + parseFloat((data['lib']['project_ps_lib']['direct_cost_honoraria'][i]['counterpart_amount'] == '-' ? 0 : data['lib']['project_ps_lib']['direct_cost_honoraria'][i]['counterpart_amount'].replace(/,/g, '')))
                ps_dost_amount = ps_dost_amount + parseFloat((data['lib']['project_ps_lib']['direct_cost_honoraria'][i]['dost_amount'] == '-' ? 0 : data['lib']['project_ps_lib']['direct_cost_honoraria'][i]['dost_amount'].replace(/,/g, '')))

                var dch = '<tr class="lib-item"> <td class="pl-5">'+data['lib']['project_ps_lib']['direct_cost_honoraria'][i]['description']+'</td><td class="text-center">'+data['lib']['project_ps_lib']['direct_cost_honoraria'][i]['counterpart_amount']+'</td><td>'+data['lib']['project_ps_lib']['direct_cost_honoraria'][i]['dost_amount']+'</td></tr>';
                $(dch).insertAfter(direct_cost_honoraria)
              }

              //implementing angencies
              //creates header of implementing agencies
              for (var i = 0; i < data['lib']['project_ps_lib']['implementing_agencies'].length; i++) {
                salary_header_class = data['lib']['project_ps_lib']['implementing_agencies'][i]['implementing_agency_id'] + '-ps-implementing-agency-salary';
                honoraria_header_class = data['lib']['project_ps_lib']['implementing_agencies'][i]['implementing_agency_id'] + '-ps-implementing-agency-honoraria';
                agency_name = data['lib']['project_ps_lib']['implementing_agencies'][i]['implementing_agency_name'];

                salary_header_class = salary_header_class.replace('/\s/g', '')
                honoraria_header_class = honoraria_header_class.replace('/\s/g', '')

                implementing_agency_container = '<tr class="lib-item text-italicize"> <th colspan="3" class="pl-3"> \u2022 '+agency_name+'</th></tr><tr class="lib-item '+salary_header_class+'"> <th colspan="3" class="pl-4 ">Salaries</th></tr><tr class="lib-item '+honoraria_header_class+'"> <th colspan="3" class="pl-4">Honoraria</th></tr>';

                $(implementing_agency_container).insertAfter(implementing_agency)


              }
              //implementing agency salaries
              for (var i = 0; i < data['lib']['project_ps_lib']['implementing_agency_salaries'].length; i++) {
                ps_counterpart_amount = ps_counterpart_amount + parseFloat((data['lib']['project_ps_lib']['implementing_agency_salaries'][i]['counterpart_amount'] == '-' ? 0 : data['lib']['project_ps_lib']['implementing_agency_salaries'][i]['counterpart_amount'].replace(/,/g, '')))
                ps_dost_amount = ps_dost_amount + parseFloat((data['lib']['project_ps_lib']['implementing_agency_salaries'][i]['dost_amount'] == '-' ? 0 : data['lib']['project_ps_lib']['implementing_agency_salaries'][i]['dost_amount'].replace(/,/g, '')))

                salary_header = data['lib']['project_ps_lib']['implementing_agency_salaries'][i]['implementing_agency_id'] + '-ps-implementing-agency-salary';
                var implementing_agency_salary = $('tr.'+salary_header)
                var ias = '<tr class="lib-item"> <td class="pl-5">'+data['lib']['project_ps_lib']['implementing_agency_salaries'][i]['description']+'</td><td class="text-center">'+data['lib']['project_ps_lib']['implementing_agency_salaries'][i]['counterpart_amount']+'</td><td>'+data['lib']['project_ps_lib']['implementing_agency_salaries'][i]['dost_amount']+'</td></tr>';
                $(ias).insertAfter(implementing_agency_salary)
              }

              //implementing agency honoraria
              for (var i = 0; i < data['lib']['project_ps_lib']['implementing_agency_honoraria'].length; i++) {
                ps_counterpart_amount = ps_counterpart_amount + parseFloat((data['lib']['project_ps_lib']['implementing_agency_honoraria'][i]['counterpart_amount'] == '-' ? 0 : data['lib']['project_ps_lib']['implementing_agency_honoraria'][i]['counterpart_amount'].replace(/,/g, '')))
                ps_dost_amount = ps_dost_amount + parseFloat((data['lib']['project_ps_lib']['implementing_agency_honoraria'][i]['dost_amount'] == '-' ? 0 : data['lib']['project_ps_lib']['implementing_agency_honoraria'][i]['dost_amount'].replace(/,/g, '')))
                honoraria_header = data['lib']['project_ps_lib']['implementing_agency_honoraria'][i]['implementing_agency_id'] + '-ps-implementing-agency-honoraria';

                var implementing_agency_honoraria = $('tr.'+honoraria_header)
                var iah = '<tr class="lib-item"> <td class="pl-5">'+data['lib']['project_ps_lib']['implementing_agency_honoraria'][i]['description']+'</td><td class="text-center">'+data['lib']['project_ps_lib']['implementing_agency_honoraria'][i]['counterpart_amount']+'</td><td>'+data['lib']['project_ps_lib']['implementing_agency_honoraria'][i]['dost_amount']+'</td></tr>';
                $(iah).insertAfter(implementing_agency_honoraria)
              }

              //monitoring angencies
              //creates header of monitoring agencies
              for (var i = 0; i < data['lib']['project_ps_lib']['monitoring_agencies'].length; i++) {
                salary_header_class = data['lib']['project_ps_lib']['monitoring_agencies'][i]['monitoring_agency_id'] + '-ps-monitoring-agency-salary';
                honoraria_header_class = data['lib']['project_ps_lib']['monitoring_agencies'][i]['monitoring_agency_id'] + '-ps-monitoring-agency-honoraria';
                agency_name = data['lib']['project_ps_lib']['monitoring_agencies'][i]['monitoring_agency_name'];

                salary_header_class = salary_header_class.replace('/\s/g', '')
                honoraria_header_class = honoraria_header_class.replace('/\s/g', '')

                monitoring_agency_container = '<tr class="lib-item text-italicize"> <th colspan="3" class="pl-3"> \u2022 '+agency_name+'</th></tr><tr class="lib-item '+salary_header_class+'"> <th colspan="3" class="pl-4">Salaries</th></tr><tr class="lib-item '+honoraria_header_class+'"> <th colspan="3" class="pl-4">Honoraria</th></tr>';

                $(monitoring_agency_container).insertAfter(monitoring_agency)


              }
              //monitoring agency salaries
              for (var i = 0; i < data['lib']['project_ps_lib']['monitoring_agency_salaries'].length; i++) {
                ps_counterpart_amount = ps_counterpart_amount + parseFloat((data['lib']['project_ps_lib']['monitoring_agency_salaries'][i]['counterpart_amount'] == '-' ? 0 : data['lib']['project_ps_lib']['monitoring_agency_salaries'][i]['counterpart_amount'].replace(/,/g, '')))
                ps_dost_amount = ps_dost_amount + parseFloat((data['lib']['project_ps_lib']['monitoring_agency_salaries'][i]['dost_amount'] == '-' ? 0 : data['lib']['project_ps_lib']['monitoring_agency_salaries'][i]['dost_amount'].replace(/,/g, '')))
                salary_header = data['lib']['project_ps_lib']['monitoring_agency_salaries'][i]['monitoring_agency_id'] + '-ps-monitoring-agency-salary';

                var monitoring_agency_salary = $('tr.'+salary_header)

                var mas = '<tr class="lib-item"> <td class="pl-5">'+data['lib']['project_ps_lib']['monitoring_agency_salaries'][i]['description']+'</td><td class="text-center">'+data['lib']['project_ps_lib']['monitoring_agency_salaries'][i]['counterpart_amount']+'</td><td>'+data['lib']['project_ps_lib']['monitoring_agency_salaries'][i]['dost_amount']+'</td></tr>';
                $(mas).insertAfter(monitoring_agency_salary)
              }

              //monitoring agency honoraria
              for (var i = 0; i < data['lib']['project_ps_lib']['monitoring_agency_honoraria'].length; i++) {
                ps_counterpart_amount = ps_counterpart_amount + parseFloat((data['lib']['project_ps_lib']['monitoring_agency_honoraria'][i]['counterpart_amount'] == '-' ? 0 : data['lib']['project_ps_lib']['monitoring_agency_honoraria'][i]['counterpart_amount'].replace(/,/g, '')))
                ps_dost_amount = ps_dost_amount + parseFloat((data['lib']['project_ps_lib']['monitoring_agency_honoraria'][i]['dost_amount'] == '-' ? 0 : data['lib']['project_ps_lib']['monitoring_agency_honoraria'][i]['dost_amount'].replace(/,/g, '')))
                honoraria_header = data['lib']['project_ps_lib']['monitoring_agency_honoraria'][i]['monitoring_agency_id'] + '-ps-monitoring-agency-honoraria';

                var monitoring_agency_honoraria = $('tr.'+honoraria_header)
                var mah = '<tr class="lib-item"> <td class="pl-5">'+data['lib']['project_ps_lib']['monitoring_agency_honoraria'][i]['description']+'</td><td class="text-center">'+data['lib']['project_ps_lib']['monitoring_agency_honoraria'][i]['counterpart_amount']+'</td><td>'+data['lib']['project_ps_lib']['monitoring_agency_honoraria'][i]['dost_amount']+'</td></tr>';
                $(mah).insertAfter(monitoring_agency_honoraria)
              }

              //sub total for ps
              $('.project_lib_ps_lib_counterpart_subtotal').text(Number(ps_counterpart_amount).toLocaleString('en'))
              $('.project_lib_ps_lib_dost_subtotal').text(Number(ps_dost_amount).toLocaleString('en'))
            }
            //mooe
            if(data['lib']['project_mooe_lib'] != null && data['lib']['project_mooe_lib'] != ''){
              var direct_cost_mooe = $('.project_lib_mooe_lib_direct_cost')
              var implementing_agency = $('.project_lib_mooe_lib_implementing_agency')
              var monitoring_agency = $('.project_lib_mooe_lib_monitoring_agency')

              //direct cost
              for (var i = 0; i < data['lib']['project_mooe_lib']['direct_cost'].length; i++) {
                mooe_counterpart_amount = mooe_counterpart_amount + parseFloat((data['lib']['project_mooe_lib']['direct_cost'][i]['counterpart_amount'] == '-' ? 0 : data['lib']['project_mooe_lib']['direct_cost'][i]['counterpart_amount'].replace(/,/g, '')))
                mooe_dost_amount = mooe_dost_amount + parseFloat((data['lib']['project_mooe_lib']['direct_cost'][i]['dost_amount'] == '-' ? 0 : data['lib']['project_mooe_lib']['direct_cost'][i]['dost_amount'].replace(/,/g, '')))

                classification_header_class = data['lib']['project_mooe_lib']['direct_cost'][i]['classification_id'] + '-mooe-direct-cost-classification'
                subcategory_header_class = data['lib']['project_mooe_lib']['direct_cost'][i]['subcategory_id'] + '-mooe-direct-cost-subcategory'
                classification_header = data['lib']['project_mooe_lib']['direct_cost'][i]['classification']
                subcategory_header = data['lib']['project_mooe_lib']['direct_cost'][i]['subcategory']

                classification_header_class = classification_header_class.replace('/\s/g', '')
                subcategory_header_class = subcategory_header_class.replace('/\s/g', '')

                if(!$('tr.'+classification_header_class).length) {
                  classification_container = '<tr class="lib-item text-italicize '+classification_header_class+'"> <th colspan="3" class="pl-3"> \u2022 '+classification_header+'</th></tr>';
                  $(classification_container).insertAfter(direct_cost_mooe)
                }

                if(!$('tr.'+subcategory_header_class).length) {
                  subcategory_container = '<tr class="lib-item '+subcategory_header_class+'"> <th colspan="3" class="pl-4"> -'+subcategory_header+'</th></tr>';
                  $(subcategory_container).insertAfter($('tr.'+classification_header_class))
                }

                var subcategory_container = $('tr.'+subcategory_header_class)
                var dcm = '<tr class="lib-item"> <td class="pl-5">'+data['lib']['project_mooe_lib']['direct_cost'][i]['description']+'</td><td class="text-center">'+data['lib']['project_mooe_lib']['direct_cost'][i]['counterpart_amount']+'</td><td>'+data['lib']['project_mooe_lib']['direct_cost'][i]['dost_amount']+'</td></tr>';
                $(dcm).insertAfter(subcategory_container)
              }

              //indirect cost implementing agency
              for (var i = 0; i < data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'].length; i++) {
                mooe_counterpart_amount = mooe_counterpart_amount + parseFloat((data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'][i]['counterpart_amount'] == '-' ? 0 : data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'][i]['counterpart_amount'].replace(/,/g, '')))
                mooe_dost_amount = mooe_dost_amount + parseFloat((data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'][i]['dost_amount'] == '-' ? 0 : data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'][i]['dost_amount'].replace(/,/g, '')))

                agency_header_class = data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'][i]['implementing_agency_id'] + '-mooe-implementing-agency'
                classification_header_class = data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'][i]['classification_id'] + '-mooe-implementing-agency-classification'
                subcategory_header_class = data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'][i]['subcategory_id'] + '-mooe-implementing-agency-subcategory'

                agency_header = data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'][i]['implementing_agency_name']
                classification_header = data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'][i]['classification']
                subcategory_header = data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'][i]['subcategory']

                agency_header_class = agency_header_class.replace('/\s/g', '')
                classification_header_class = classification_header_class.replace('/\s/g', '')
                subcategory_header_class = subcategory_header_class.replace('/\s/g', '')

                if(!$('tr.'+agency_header_class).length) {
                  agency_container = '<tr class="lib-item text-italicize '+agency_header_class+'"> <th colspan="3" class="pl-3">'+agency_header+'</th></tr>';
                  $(agency_container).insertAfter(implementing_agency)
                }

                var indirect_cost_implementing_agency_mooe = $('tr.'+agency_header_class)
                if(!$('tr.'+classification_header_class).length) {
                  classification_container = '<tr class="lib-item text-italicize '+classification_header_class+'"> <th colspan="3" class="pl-3"> \u2022 '+classification_header+'</th></tr>';
                  $(classification_container).insertAfter(indirect_cost_implementing_agency_mooe)
                }

                if(!$('tr.'+subcategory_header_class).length) {
                  subcategory_container = '<tr class="lib-item '+subcategory_header_class+'"> <th colspan="3" class="pl-4"> -'+subcategory_header+'</th></tr>';
                  $(subcategory_container).insertAfter($('tr.'+classification_header_class))
                }

                var subcategory_container = $('tr.'+subcategory_header_class)
                var ici = '<tr class="lib-item"> <td class="pl-5">'+data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'][i]['description']+'</td><td class="text-center">'+data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'][i]['counterpart_amount']+'</td><td>'+data['lib']['project_mooe_lib']['indirect_cost_implementing_agency'][i]['dost_amount']+'</td></tr>';
                $(ici).insertAfter(subcategory_container)
              }

              //indirect cost monitoring agency
              for (var i = 0; i < data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'].length; i++) {
                mooe_counterpart_amount = mooe_counterpart_amount + parseFloat((data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'][i]['counterpart_amount'] == '-' ? 0 : data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'][i]['counterpart_amount'].replace(/,/g, '')))
                mooe_dost_amount = mooe_dost_amount + parseFloat((data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'][i]['dost_amount'] == '-' ? 0 : data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'][i]['dost_amount'].replace(/,/g, '')))

                agency_header_class = data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'][i]['monitoring_agency_id'] + '-mooe-monitoring-agency'
                classification_header_class = data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'][i]['classification_id'] + '-mooe-monitoring-agency-classification'
                subcategory_header_class = data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'][i]['subcategory_id'] + '-mooe-monitoring-agency-subcategory'

                agency_header = data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'][i]['monitoring_agency_name']
                classification_header = data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'][i]['classification']
                subcategory_header = data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'][i]['subcategory']

                agency_header_class = agency_header_class.replace('/\s/g', '')
                classification_header_class = classification_header_class.replace('/\s/g', '')
                subcategory_header_class = subcategory_header_class.replace('/\s/g', '')

                if(!$('tr.'+agency_header_class).length) {
                  agency_container = '<tr class="lib-item text-italicize '+agency_header_class+'"> <th colspan="3" class="pl-3">'+agency_header+'</th></tr>';
                  $(agency_container).insertAfter(monitoring_agency)
                }

                var indirect_cost_monitoring_agency_mooe = $('tr.'+agency_header_class)
                if(!$('tr.'+classification_header_class).length) {
                  classification_container = '<tr class="lib-item text-italicize '+classification_header_class+'"> <th colspan="3" class="pl-3"> \u2022 '+classification_header+'</th></tr>';
                  $(classification_container).insertAfter(indirect_cost_monitoring_agency_mooe)
                }

                if(!$('tr.'+subcategory_header_class).length) {
                  subcategory_container = '<tr class="lib-item '+subcategory_header_class+'"> <th colspan="3" class="pl-4"> -'+subcategory_header+'</th></tr>';
                  $(subcategory_container).insertAfter($('tr.'+classification_header_class))
                }

                var subcategory_container = $('tr.'+subcategory_header_class)
                var icm = '<tr class="lib-item"> <td class="pl-5">'+data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'][i]['description']+'</td><td class="text-center">'+data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'][i]['counterpart_amount']+'</td><td>'+data['lib']['project_mooe_lib']['indirect_cost_monitoring_agency'][i]['dost_amount']+'</td></tr>';
                $(icm).insertAfter(subcategory_container)
              }

              //sub total for mooe
              $('.project_lib_mooe_lib_counterpart_subtotal').text(Number(mooe_counterpart_amount).toLocaleString('en'))
              $('.project_lib_mooe_lib_dost_subtotal').text(Number(mooe_dost_amount).toLocaleString('en'))
            }


            //eo_co
            if(data['lib']['project_eo_co_lib'] != null && data['lib']['project_eo_co_lib'] != ''){
              var direct_cost_eo_co = $('.project_lib_eo_co_lib_direct_cost')
              var monitoring_agency = $('.project_lib_eo_co_lib_indirect_cost_monitoring_agency')

              for (var i = 0; i < data['lib']['project_eo_co_lib']['direct_cost'].length; i++) {
                eo_co_counterpart_amount = eo_co_counterpart_amount + parseFloat((data['lib']['project_eo_co_lib']['direct_cost'][i]['counterpart_amount'] == '-' ? 0 : data['lib']['project_eo_co_lib']['direct_cost'][i]['counterpart_amount'].replace(/,/g, '')))
                eo_co_dost_amount = eo_co_dost_amount + parseFloat((data['lib']['project_eo_co_lib']['direct_cost'][i]['dost_amount'] == '-' ? 0 : data['lib']['project_eo_co_lib']['direct_cost'][i]['dost_amount'].replace(/,/g, '')))

                var dc = '<tr class="lib-item"> <td class="pl-5">'+data['lib']['project_eo_co_lib']['direct_cost'][i]['description']+'</td><td class="text-center">'+data['lib']['project_eo_co_lib']['direct_cost'][i]['counterpart_amount']+'</td><td>'+data['lib']['project_eo_co_lib']['direct_cost'][i]['dost_amount']+'</td></tr>';

                $(dc).insertAfter(direct_cost_eo_co)
                
              }

              for (var i = 0; i < data['lib']['project_eo_co_lib']['indirect_cost'].length; i++) {
                eo_co_counterpart_amount = eo_co_counterpart_amount + parseFloat((data['lib']['project_eo_co_lib']['indirect_cost'][i]['counterpart_amount'] == '-' ? 0 : data['lib']['project_eo_co_lib']['indirect_cost'][i]['counterpart_amount'].replace(/,/g, '')))
                
                eo_co_dost_amount = eo_co_dost_amount + parseFloat((data['lib']['project_eo_co_lib']['indirect_cost'][i]['dost_amount'] == '-' ? 0 : data['lib']['project_eo_co_lib']['indirect_cost'][i]['dost_amount'].replace(/,/g, '')))

                agency_header_class = data['lib']['project_eo_co_lib']['indirect_cost'][i]['monitoring_agency_id'] + '-eo-co-monitoring-agency'
                agency_header = data['lib']['project_eo_co_lib']['indirect_cost'][i]['monitoring_agency_name']
                agency_header_class = agency_header_class.replace('/\s/g', '')
                if(!$('tr.'+agency_header_class).length) {
                  agency_container = '<tr class="lib-item text-italicize '+agency_header_class+'"> <th colspan="3" class="pl-3">'+agency_header+'</th></tr>';
                  $(agency_container).insertAfter(monitoring_agency)
                }

                var indirect_eo_co_monitoring_agency = $('tr.'+agency_header_class)
                var ic = '<tr class="lib-item"> <td class="pl-5">'+data['lib']['project_eo_co_lib']['indirect_cost'][i]['description']+'</td><td class="text-center">'+data['lib']['project_eo_co_lib']['indirect_cost'][i]['counterpart_amount']+'</td><td>'+data['lib']['project_eo_co_lib']['indirect_cost'][i]['dost_amount']+'</td></tr>';

                $(ic).insertAfter(indirect_eo_co_monitoring_agency)
                
              }

              //sub total for eo_co
              $('.project_lib_eo_co_lib_counterpart_subtotal').text(Number(eo_co_counterpart_amount).toLocaleString('en'))
              $('.project_lib_eo_co_lib_dost_subtotal').text(Number(eo_co_dost_amount).toLocaleString('en'))

            }

            //grand total
            grand_total_counterpart = parseFloat(ps_counterpart_amount) + parseFloat(mooe_counterpart_amount) + parseFloat(eo_co_counterpart_amount)
            grand_total_dost = parseFloat(ps_dost_amount) + parseFloat(mooe_dost_amount) + parseFloat(eo_co_dost_amount)

            $('.project_lib_grand_total_counterpart').text(Number(grand_total_counterpart).toLocaleString('en'))
            $('.project_lib_grand_total_dost').text(Number(grand_total_dost).toLocaleString('en'))

          }
        }
      }

      $('.select2#forward_proposal_divisions').select2({
        dropdownParent: $('.forward_proposal_divisions_fg'),
        width: '100%',
        theme: 'bootstrap'
      })

      $('.select2#forward_proposal_users').select2({
        dropdownParent: $('.forward_proposal_users_fg'),
        width: '100%',
        theme: 'bootstrap'
      })
      
      $('.summernote').summernote();

      $('#proposals_table').on('click', '.view-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')
        loader.open()
        var request = view_proposal(proposal_id);
        request.then(function(data) {
          loader.close()
          if(data['status'] == 1){

            $('#project_lib_tab').removeClass('d-none')
            if(data['proposal_type'] == 1) {
              //program
              $('#form2a_tab').removeClass('d-none')
              $('#form2a .form-content').html(data['form2a'])
              $('#program_projects_files_list').empty()
              for (var i = 0; i < data['projects'].length; i++) {
                $('#project_list').append('<li data-id="'+data['projects'][i]['id']+'" class="py-1 text-break"><a href="#">'+data['projects'][i]['proposal_project_title']+'</a></li>')
              }

              for (var i = 0; i < data['proposal_files'].length; i++) {
                $('#program_files_list').append('<li class="py-1 text-break"><a href="'+data['proposal_files'][i]['file_src']+'">'+data['proposal_files'][i]['file_name']+' ('+data['proposal_files'][i]['dpmis_document_type']+')</a></li>')
              }              

              $('#view_program_modal').modal('toggle')
            } else {
              //project (rd or non rd)
              if(data['proposal_type'] == 2){
                $('#view_project_modal .form-content').html(data['form2b'])
              } else if(data['proposal_type'] == 3 || data['proposal_type'] == 4){
                if(data['proposal_type'] == 3) $('#project_lib_tab').addClass('d-none')
                $('#view_project_modal .form-content').html(data['form3'])
              }
              $('#project_files_list').empty()
              if(data['proposal_files'].length > 0){
              for (var i = 0; i < data['proposal_files'].length; i++) {
                  $('#project_files_list').append('<li class="py-1 text-break"><a href="'+data['proposal_files'][i]['file_src']+'">'+data['proposal_files'][i]['file_name']+' ('+data['proposal_files'][i]['dpmis_document_type']+')</a></li>')
                }  
              } else {
                $('#project_files_list').append('<div class="text-center"><h3>None</h3></div>')
              }

              write_lib(data)
              
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
          content: 'Are you sure you want to receive this proposal?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = update_status(proposal_id, 7);
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
                } else {
                  $.alert({
                    title: 'Notification',
                    content: data['view']
                  })
                }
              })
            },
            No: function(){

            }
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
            $('#forward_proposal_modal').modal('toggle')
          }
        });
      })

      $('#forward_proposal_to_trd').on('click', function(e) {
        // alert("prop_check");
        e.preventDefault();
        var request_forward_status = update_status(proposal_id, 8);
        var request_forward = forward_proposal($('#forward_proposal_divisions').val(), $('#forward_proposal_users').val());
        request_forward.then(function(data_forward) {
          if(data_forward['status'] == 1) {
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
            $.alert({
              title: 'Notification',
              content: data_forward['view']
            })
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
                } else {
                  $.alert({
                    title: 'Notification',
                    content: data['view']
                  })
                }
              })
            },
            No: function(){

            }
          }
        })
      })
      $('#proposals_table').on('click', '.consolidate-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to consolidate the comments of this proposal?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = update_status(proposal_id, 9);
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
                } else {
                  $.alert({
                    title: 'Notification',
                    content: data['view']
                  })
                }
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

        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to approve this proposal?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = update_status(proposal_id, 10);
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
                } else {
                  $.alert({
                    title: 'Notification',
                    content: data['view']
                  })
                }
              })
            },
            No: function(){

            }
          }
        })
      })

      $('#proposals_table').on('click', '.revise-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to request for revision for this proposal?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = update_status(proposal_id, 11);
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
                } else {
                  $.alert({
                    title: 'Notification',
                    content: data['view']
                  })
                }
              })
            },
            No: function(){

            }
          }
        })
      })

      $('#proposals_table').on('click', '.disapprove-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to disapprove this proposal?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = update_status(proposal_id, 12);
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
                } else {
                  $.alert({
                    title: 'Notification',
                    content: data['view']
                  })
                }
              })
            },
            No: function(){

            }
          }
        })
      })

      $('#proposals_table').on('click', '.refer-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to refer this proposal to other institution?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = update_status(proposal_id, 13);
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
                } else {
                  $.alert({
                    title: 'Notification',
                    content: data['view']
                  })
                }
              })
            },
            No: function(){

            }
          }
        })
      })

      $('#proposals_table').on('click', '.withdraw-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to withdraw this proposal?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = update_status(proposal_id, 14);
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
                } else {
                  $.alert({
                    title: 'Notification',
                    content: data['view']
                  })
                }
              })
            },
            No: function(){

            }
          }
        })
      })

      $('#proposals_table').on('click', '.review-proposal', function(e) {
        e.preventDefault()
        proposal_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to change the status of this proposal to "For Review"?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = update_status(proposal_id, 15);
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
                } else {
                  $.alert({
                    title: 'Notification',
                    content: data['view']
                  })
                }
              })
            },
            No: function(){

            }
          }
        })
      })

      $('#view_program_modal').on('click', '#project_list > li a', function(e) {
        e.preventDefault();
        $('#project_list > li a').removeClass('active');
        $(this).addClass('active')
        proposal_id = $(this).parents('li').attr('data-id')

        var request = view_proposal(proposal_id);
        request.then(function(data) {
          if(data['status'] == 1){
            $('#form2b .form-content.project-info').empty()
            $('#form2b .form-content.project-info').html(data['form2b'])
            $('#program_projects_files_list').empty()
            $('#program_project_info_tabs').removeClass('d-none')
            if(data['proposal_files'].length > 0){
              for (var i = 0; i < data['proposal_files'].length; i++) {
                $('#program_projects_files_list').append('<li class="py-1 text-break"><a href="'+data['proposal_files'][i]['file_src']+'>'+data['proposal_files'][i]['file_name']+'</a></li>')
              }  
            } else {
              $('#program_projects_files_list').append('<div class="text-center"><h3>None</h3></div>')
            }

            write_lib(data)
          }
        })
      })

      $('#print_program').on('click', function(e){
        if($('#form2a_tab').hasClass('active')){
          var divToPrint=$('#view_program_modal #form2a .form-content').html();
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<html><body onload="window.print()">'+divToPrint+'</body></html>');
          newWin.document.close();
        } else if($('#form2b_tab').hasClass('active')){
          if($('#program_project_info_tab').hasClass('active')){
            var divToPrint=$('#view_program_modal #form2b .form-content').html();
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

        }
      })

      $('.print-project').on('click', function(e){
        var divToPrint;
        if($('#project_info').hasClass('active')){
          divToPrint=$('#view_project_modal .form-content').html();
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<html><body onload="window.print()">'+divToPrint+'</body></html>');
          newWin.document.close();
        } 
        else if($('#project_lib').hasClass('active')){
          divToPrint=$('#view_project_modal .lib-content').html();
          var newWin=window.open('','Print-Window');
          newWin.document.open();
          newWin.document.write('<html><head><link href="' + '{{ asset("plugins/bootstrap/bootstrap.min.css") }}' + '" rel="stylesheet" type="text/css"></head><body onload="window.print()">'+divToPrint+'</body></html>');
          newWin.document.close();
        }
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
                $.alert({
                  title: 'Notification',
                  content: data['view']
                })
              })
            },
            No: function(){

            }
          }
        })
      })

      $('.toggle-view-comments').on('click', function(e) {
        $('#project_comments > div').each(function(index) {
          if($(this).hasClass('d-block')){
            hide_element($(this));
          } else if($(this).hasClass('d-none')){
            display_element($(this));
          }
        })
      })

      $('#view_program_modal').on('hidden.bs.modal', function() {
        $('#view_program_modal .form-content').empty()
        $('#view_program_modal #project_list').empty()
        $('#view_program_modal #program_files_list').empty()
        $('#program_project_info_tabs').addClass('d-none')
      })

      $('#view_project_modal').on('hidden.bs.modal', function() {
        $('#view_project_modal .form-content').empty()
        $('#view_project_modal #project_files_list').empty()
      })

      $('#forward_proposal_modal').on('hidden.bs.modal', function() {
        $('#forward_proposal_modal .forward-proposal-field').val('').change()
      })
    })
  </script>
@endsection
