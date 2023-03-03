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
              <div class="card-header bg-info text-center">
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
  <div class="modal fade" id="forward_project_status_to_dpmis_modal" tabindex="-1" role="dialog" aria-labelledby="forward_project_status_to_dpmis_modal_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="forward_project_status_to_dpmis_modal_label">Forward Project Staus To DPMIS</h5>
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
          url: "{{ route('proposals.forward_proposal')}}",
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

      
      $('.select2#forward_proposal_users').select2({
        dropdownParent: $('.forward_proposal_users_fg'),
        width: '100%',
        theme: 'bootstrap'
      })
      
      $('.summernote').summernote();

      $('#proposals_table').on('click', '.forward-project-status-to-dpmis', function(e) {
        alert("check");
        e.preventDefault()
        dpmis_code = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to forward project status to DPMIS?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = update_status(dpmis_code, 10);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        all_projects_table.ajax.reload(null, false)
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

    })
  </script>
@endsection
