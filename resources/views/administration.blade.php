@extends('layouts.app')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Administration</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Administration</li>
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
          <div class="card-body">
            <div class="row">
              <div class="col-md-3">
                <ul class="nav flex-column nav-pills mb-3 text-center" id="administration_tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="users_pills_tab" data-toggle="pill" href="#users_pills" role="tab" aria-controls="users_pills" aria-selected="true">Users</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="user_privileges_tab" data-toggle="pill" href="#user_privileges_pills" role="tab" aria-controls="user_privileges_pills" aria-selected="true">User Privileges</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="beneficiary_pills_tab" data-toggle="pill" href="#beneficiary_pills" role="tab" aria-controls="beneficiary_pills" aria-selected="true">Beneficiary</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="call_for_proposals_pills_tab" data-toggle="pill" href="#call_for_proposals_pills" role="tab" aria-controls="call_for_proposals_pills" aria-selected="true">Call for Proposals</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="document_types_pills_tab" data-toggle="pill" href="#document_types_pills" role="tab" aria-controls="document_types_pills" aria-selected="true">Document Types</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="impact_types_pills_tab" data-toggle="pill" href="#impact_types_pills" role="tab" aria-controls="impact_types_pills" aria-selected="true">Impact Types</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="output_types_pills_tab" data-toggle="pill" href="#output_types_pills" role="tab" aria-controls="output_types_pills" aria-selected="true">Output Types</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="research_types_pills_tab" data-toggle="pill" href="#research_types_pills" role="tab" aria-controls="research_types_pills" aria-selected="true">Research Types</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="proposal_types_pills_tab" data-toggle="pill" href="#proposal_types_pills" role="tab" aria-controls="proposal_types_pills" aria-selected="true">Proposal Types</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="proposal_status_pills_tab" data-toggle="pill" href="#proposal_status_pills" role="tab" aria-controls="proposal_status_pills" aria-selected="true">Proposal Status</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="rd_policy_pills_tab" data-toggle="pill" href="#rd_policy_pills" role="tab" aria-controls="rd_policy_pills" aria-selected="true">R & D Policy</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="rd_policy_status_pills_tab" data-toggle="pill" href="#rd_policy_status_pills" role="tab" aria-controls="rd_policy_status_pills" aria-selected="true">R & D Policy Status</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="rd_policy_areas_pills_tab" data-toggle="pill" href="#rd_policy_areas_pills" role="tab" aria-controls="rd_policy_areas_pills" aria-selected="true">R & D Policy Areas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="rd_policy_programs_pills_tab" data-toggle="pill" href="#rd_policy_programs_pills" role="tab" aria-controls="rd_policy_programs_pills" aria-selected="true">R & D Policy Programs</a>
                  </li>
                </ul>
                <!-- <div class="text-center">
                  <p>The library module is currently under maintenance. </p>
                  <img src="{{ URL::asset('storage/images/repair_gif.gif')}}" width="100" height="100">
                </div> -->
              </div>
              <div class="col-md-9">
                <div class="tab-content" id="administration_tabs_content">
                  <div class="tab-pane fade show active" id="users_pills" role="tabpanel" aria-labelledby="users_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">Users Table</h2>
                      </div>
                      <!-- <div class="clearfix mb-3">
                        <button id="export_pmt_to_dpmis" type="button" name="button" class="btn btn-success float-right float-right text-white">Export PMT to DPMIS</button>
                      </div> -->
                      <div class="clearfix mb-3">
                        <button id="export_pmt_assigned_proposal_to_dpmis" type="button" name="button" class="btn btn-success float-right float-right text-white">Export PMT assigned proposal to DPMIS</button>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_user" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add User</button>
                      </div>
                      <div class="table-responsive">
                        <table id="users_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Division</th>
                            <th>Privileges</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="user_privileges_pills" role="tabpanel" aria-labelledby="user_privileges_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">User Privileges Table</h2>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_user_privilege" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add User Privileges</button>
                      </div>
                      <div class="table-responsive">
                        <table id="user_privileges_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Is Active?</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="beneficiary_pills" role="tabpanel" aria-labelledby="beneficiary_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">Beneficiary Table</h2>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_beneficiary" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add Beneficiary</button>
                      </div>
                      <div class="table-responsive">
                        <table id="beneficiary_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Beneficiary</th>
                            <th>Is Active?</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="call_for_proposals_pills" role="tabpanel" aria-labelledby="call_for_proposals_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">Call for Proposals Table</h2>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_call_for_proposal" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add Call for Proposal</button>
                      </div>
                      <div class="table-responsive">
                        <table id="call_for_proposals_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Call Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Is DOST call?</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="document_types_pills" role="tabpanel" aria-labelledby="document_types_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">Document Types Table</h2>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_document_type" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add Document Type</button>
                      </div>
                      <div class="table-responsive">
                        <table id="document_types_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Document Type</th>
                            <th>Is Active?</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="impact_types_pills" role="tabpanel" aria-labelledby="impact_types_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">Impact Types Table</h2>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_impact_type" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add Impact Type</button>
                      </div>
                      <div class="table-responsive">
                        <table id="impact_types_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Impact Type Group</th>
                            <th>Impact Type</th>
                            <th>Description</th>
                            <th>Is Active?</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="output_types_pills" role="tabpanel" aria-labelledby="output_types_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">Output Types Table</h2>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_output_type" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add Output Type</button>
                      </div>
                      <div class="table-responsive">
                        <table id="output_types_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Output Type Group</th>
                            <th>Output Type</th>
                            <th>Description</th>
                            <th>Is Active?</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="research_types_pills" role="tabpanel" aria-labelledby="research_types_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">Research Types Table</h2>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_research_type" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add Research Type</button>
                      </div>
                      <div class="table-responsive">
                        <table id="research_types_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Research Type</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="proposal_types_pills" role="tabpanel" aria-labelledby="proposal_types_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">Proposal Types Table</h2>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_proposal_type" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add Proposal Type</button>
                      </div>
                      <div class="table-responsive">
                        <table id="proposal_types_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Proposal Type</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="proposal_status_pills" role="tabpanel" aria-labelledby="proposal_status_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">Proposal Status Table</h2>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_proposal_status" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add Proposal Status</button>
                      </div>
                      <div class="table-responsive">
                        <table id="proposal_status_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Allowed Transitions</th>
                            <th>Is Active?</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="rd_policy_pills" role="tabpanel" aria-labelledby="rd_policy_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">R & D Policy Table</h2>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_rd_policy" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add R & D Policy</button>
                      </div>
                      <div class="table-responsive">
                        <table id="rd_policy_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Policy Name</th>
                            <th>Label</th>
                            <th>Description</th>
                            <th>Is Active?</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="rd_policy_status_pills" role="tabpanel" aria-labelledby="rd_policy_status_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">R & D Policy Status Table</h2>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_rd_policy_status" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add R & D Policy Status</button>
                      </div>
                      <div class="table-responsive">
                        <table id="rd_policy_status_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Is Active?</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="rd_policy_areas_pills" role="tabpanel" aria-labelledby="rd_policy_areas_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">R & D Policy Areas Table</h2>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_rd_policy_areas" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add R & D Policy Area</button>
                      </div>
                      <div class="table-responsive">
                        <table id="rd_policy_areas_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Label</th>
                            <th>Description</th>
                            <th>Is Active?</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="rd_policy_programs_pills" role="tabpanel" aria-labelledby="rd_policy_programs_pills_tab">
                    <div>
                      <div class="text-center">
                        <h2 class="display-3">R & D Policy Programs Table</h2>
                      </div>
                      <div class="clearfix mb-3">
                        <button id="add_rd_policy_programs" type="button" name="button" class="btn btn-primary float-right float-right text-white">Add R & D Policy Program</button>
                      </div>
                      <div class="table-responsive">
                        <table id="rd_policy_programs_table" class="table table-bordered w-100">
                          <thead>
                            <th>ID</th>
                            <th>Label</th>
                            <th>Description</th>
                            <th>Is Active?</th>
                            <th>Action</th>
                          </thead>
                          <tbody></tbody>
                        </table>
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
</section>
<div class="modal fade" id="user_modal" tabindex="-1" role="dialog" aria-labelledby="user_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="user_modal_label">User Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="user_username">Username:</label>
                <input id="user_username" type="text" name="user_username" class="form-control user-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group user_employee_code_fg">
                <label for="user_employee_code">Employee code (for PCAARRD):</label>
                <button id="reset_user_employee_code" type="button" class="btn btn-info btn-sm">Reset</button>
                <select id="user_employee_code" class="form-control user-field select2">
                  <option value="" selected disabled hidden> </option>
                  @foreach($pcaarrd_employees as $employee)
                    <option value="{{ $employee->fldEmpCode }}" data-first-name="{{ $employee->fldEmpFName }}" data-last-name="{{ $employee->fldEmpLName }}">{{ $employee->fldEmpLName }}, {{ $employee->fldEmpFName }} ({{ $employee->fldEmpCode }})</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="user_first_name">First Name:</label>
                <input id="user_first_name" type="text" name="user_first_name" class="form-control user-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="user_middle_name">Middle Name: (Optional)</label>
                <input id="user_middle_name" type="text" name="user_middle_name" class="form-control user-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="user_last_name">Last Name:</label>
                <input id="user_last_name" type="text" name="user_last_name" class="form-control user-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group user_expertise_fg">
                <label for="user_expertise">Expertise:</label>
                <select id="user_expertise" type="text" name="user_expertise" class="form-control select2 required-field user-field" multiple="multiple">
                  @foreach($expertises as $expertise)
                    <option value="{{ $expertise->id }}">{{ $expertise->field_of_specialization }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group user_area_assignment_fg">
                <label for="user_area_assignment">Area assignment:</label>
                <select id="user_area_assignment" type="text" name="user_area_assignment" class="form-control select2 required-field user-field" multiple="multiple">
                  @foreach($area_assignments as $area_assignment)
                    <option value="{{ $area_assignment->idlib_dpmis_area_assignment }}">{{ $area_assignment->area_assignment }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group user_privilege_fg">
                <label for="user_privilege">Privilege:</label>
                <select id="user_privilege" class="form-control user-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Admin</option>
                  <option value="2">Cluster</option>
                  <option value="3">Division</option>
                  <option value="4">TREP</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group user_division_fg">
                <label for="user_division">Division:</label>
                <select id="user_division" class="form-control user-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  @foreach($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->division_acronym }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="user_password">Password:</label>
                <input id="user_password" type="password" name="user_password" class="form-control user-field required-field">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="user_privileges_modal" tabindex="-1" role="dialog" aria-labelledby="user_privileges_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="user_privileges_modal_label">User Privileges Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="user_privilege_description">User Privilege Description:</label>
                <input id="user_privilege_description" type="text" name="user_privilege_description" class="form-control user-privilege-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group user_privilege_is_active_fg">
                <label for="user_privilege_is_active">Is Active?</label>
                <select id="user_privilege_is_active" class="form-control user-privilege-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="beneficiary_modal" tabindex="-1" role="dialog" aria-labelledby="beneficiary_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="beneficiary_modal_label">Beneficiary Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="beneficiary_description">Beneficiary:</label>
                <input id="beneficiary_description" type="text" name="beneficiary_description" class="form-control beneficiary-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group beneficiary_is_active_fg">
                <label for="beneficiary_is_active">Is Active?</label>
                <select id="beneficiary_is_active" class="form-control beneficiary-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="call_for_proposal_modal" tabindex="-1" role="dialog" aria-labelledby="call_for_proposal_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="call_for_proposal_modal_label">Beneficiary Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="call_name">Call Name:</label>
                <input id="call_name" type="text" name="call_name" class="form-control call-for-proposal-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="call_for_proposal_start_date">Start Date:</label>
                <input id="call_for_proposal_start_date" type="date" name="call_for_proposal_start_date" pattern="\d{4}-\d{2}-\d{2}" class="form-control call-for-proposal-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="call_for_proposal_end_date">End Date:</label>
                <input id="call_for_proposal_end_date" type="date" name="call_for_proposal_end_date" class="form-control call-for-proposal-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group call_for_proposal_is_dost_call_fg">
                <label for="call_for_proposal_is_dost_call">Is DOST-CO Call?</label>
                <select id="call_for_proposal_is_dost_call" class="form-control beneficiary-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="document_type_modal" tabindex="-1" role="dialog" aria-labelledby="document_type_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="document_type_modal_label">Document Type Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="document_type">Document Type:</label>
                <input id="document_type" type="text" name="document_type" class="form-control document-type-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group document_type_is_active_fg">
                <label for="document_type_is_active">Is Active?</label>
                <select id="document_type_is_active" class="form-control document-type-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="impact_type_modal" tabindex="-1" role="dialog" aria-labelledby="impact_type_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="impact_type_modal_label">impact Type Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="impact_type_group">Impact Type Group:</label>
                <input id="impact_type_group" type="text" name="impact_type_group" class="form-control impact-type-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="impact_type">Impact Type:</label>
                <input id="impact_type" type="text" name="impact_type" class="form-control impact-type-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="impact_type_description">Description:</label>
                <input id="impact_type_description" type="text" name="impact_type_description" class="form-control impact-type-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group impact_type_is_active_fg">
                <label for="impact_type_is_active">Is Active?</label>
                <select id="impact_type_is_active" class="form-control impact-type-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="output_type_modal" tabindex="-1" role="dialog" aria-labelledby="output_type_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="output_type_modal_label">Output Type Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="output_type_group">Output Type Group:</label>
                <input id="output_type_group" type="text" name="output_type_group" class="form-control output-type-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="output_type">Output Type:</label>
                <input id="output_type" type="text" name="output_type" class="form-control output-type-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="output_type_description">Description:</label>
                <input id="output_type_description" type="text" name="output_type_description" class="form-control output-type-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group output_type_is_active_fg">
                <label for="output_type_is_active">Is Active?</label>
                <select id="output_type_is_active" class="form-control output-type-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="research_type_modal" tabindex="-1" role="dialog" aria-labelledby="research_type_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="research_type_modal_label">Research Type Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="research_type">Research Type:</label>
                <input id="research_type" type="text" name="research_type" class="form-control research-type-field required-field">
              </div>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group research_type_is_active_fg">
                <label for="research_type_is_active">Is Active?</label>
                <select id="research_type_is_active" class="form-control research-type-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div> -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="proposal_type_modal" tabindex="-1" role="dialog" aria-labelledby="proposal_type_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="proposal_type_modal_label">Proposal Type Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="proposal_type">Proposal Type:</label>
                <input id="proposal_type" type="text" name="proposal_type" class="form-control proposal-type-field required-field">
              </div>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group proposal_type_is_active_fg">
                <label for="proposal_type_is_active">Is Active?</label>
                <select id="proposal_type_is_active" class="form-control proposal-type-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div> -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="proposal_status_modal" tabindex="-1" role="dialog" aria-labelledby="proposal_status_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="proposal_status_modal_label">Proposal Status Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="proposal_status">Proposal Status:</label>
                <input id="proposal_status" type="text" name="proposal_status" class="form-control proposal-status-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="proposal_status_description">Status Description:</label>
                <input id="proposal_status_description" type="text" name="proposal_status_description" class="form-control proposal-status-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group proposal_status_is_active_fg">
                <label for="proposal_status_is_active">Is Active?</label>
                <select id="proposal_status_is_active" class="form-control proposal-status-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <label for="proposal_status_allowed_transitions">Allowed Transitions to:</label>
              <div class="row">
                <div class="col-md-6">
                  @for ($i = 0; $i < count($proposal_statuses)/2; $i++)
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input proposal-status-field proposal-status-allowed-transitions" value="{{ $proposal_statuses[$i]->idlib_proposal_status }}">{{ $proposal_statuses[$i]->status }}
                      </label>
                    </div>
                  @endfor
                </div>
                <div class="col-md-6">
                  @for ($i = (count($proposal_statuses)/2) + 1; $i < count($proposal_statuses); $i++)
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input proposal-status-field proposal-status-allowed-transitions" value="{{ $proposal_statuses[$i]->idlib_proposal_status }}">{{ $proposal_statuses[$i]->status }}
                      </label>
                    </div>
                  @endfor
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="rd_policy_modal" tabindex="-1" role="dialog" aria-labelledby="rd_policy_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rd_policy_modal_label">R & D Policy Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rd_policy_name">Policy Name:</label>
                <input id="rd_policy_name" type="text" name="rd_policy_name" class="form-control rd-policy-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rd_policy_label">Label:</label>
                <input id="rd_policy_label" type="text" name="rd_policy_label" class="form-control rd-policy-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rd_policy_description">Description:</label>
                <input id="rd_policy_description" type="text" name="rd_policy_description" class="form-control rd-policy-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group rd_policy_is_active_fg">
                <label for="rd_policy_is_active">Is Active?</label>
                <select id="rd_policy_is_active" class="form-control rd-policy-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="rd_policy_status_modal" tabindex="-1" role="dialog" aria-labelledby="rd_policy_status_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rd_policy_status_modal_label">R & D Policy Status Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rd_policy_status">R & D Policy Status:</label>
                <input id="rd_policy_status" type="text" name="rd_policy_status" class="form-control rd-policy-status-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rd_policy_status_description">Description:</label>
                <input id="rd_policy_status_description" type="text" name="rd_policy_status_description" class="form-control rd-policy-status-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group rd_policy_status_is_active_fg">
                <label for="rd_policy_status_is_active">Is Active?</label>
                <select id="rd_policy_status_is_active" class="form-control rd-policy-status-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="rd_policy_areas_modal" tabindex="-1" role="dialog" aria-labelledby="rd_policy_areas_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rd_policy_areas_modal_label">R & D Policy Areas Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rd_policy_areas_label">R & D Policy Areas Label:</label>
                <input id="rd_policy_areas_label" type="text" name="rd_policy_areas_label" class="form-control rd-policy-areas-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rd_policy_areas_description">Description:</label>
                <input id="rd_policy_areas_description" type="text" name="rd_policy_areas_description" class="form-control rd-policy-areas-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group rd_policy_areas_is_active_fg">
                <label for="rd_policy_areas_is_active">Is Active?</label>
                <select id="rd_policy_areas_is_active" class="form-control rd-policy-areas-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="rd_policy_programs_modal" tabindex="-1" role="dialog" aria-labelledby="rd_policy_programs_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rd_policy_programs_modal_label">R & D Policy Programs Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rd_policy_programs_label">R & D Policy Programs Label:</label>
                <input id="rd_policy_programs_label" type="text" name="rd_policy_programs_label" class="form-control rd-policy-programs-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group">
                <label for="rd_policy_programs_description">Description:</label>
                <input id="rd_policy_programs_description" type="text" name="rd_policy_programs_description" class="form-control rd-policy-programs-field required-field">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="form-group rd_policy_programs_is_active_fg">
                <label for="rd_policy_programs_is_active">Is Active?</label>
                <select id="rd_policy_programs_is_active" class="form-control rd-policy-programs-field required-field select2">
                  <option value="" selected disabled hidden> </option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-button">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
      var user_id = null;
      var user_privilege_id = null;
      var beneficiary_id = null;
      var users_table = $('#users_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('users.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'username', name: 'username'},
            {data: 'first_name', name: 'first_name'},
            {data: 'middle_name', name: 'middle_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'division_acronym', name: 'division_acronym'},
            {data: 'user_privilege', name: 'user_privilege'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var user_privileges_table = $('#user_privileges_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('user_privileges.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'idlib_user_privilege', name: 'idlib_user_privilege'},
            {data: 'user_privilege', name: 'user_privilege'},
            {data: 'is_active_text', name: 'is_active_text'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var beneficiary_table = $('#beneficiary_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('beneficiary.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'idlib_beneficiary', name: 'idlib_beneficiary'},
            {data: 'beneficiary', name: 'beneficiary'},
            {data: 'is_active_text', name: 'is_active_text'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var call_for_proposals_table = $('#call_for_proposals_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('call_for_proposals.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'idlib_call_for_proposal', name: 'idlib_call_for_proposal'},
            {data: 'call_name', name: 'call_name'},
            {data: 'call_start_date', name: 'call_start_date'},
            {data: 'call_end_date', name: 'call_end_date'},
            {data: 'is_dostco_call_text', name: 'is_dostco_call_text'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var document_types_table = $('#document_types_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('document_types.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'idlib_document_type', name: 'idlib_document_type'},
            {data: 'document_type', name: 'document_type'},
            {data: 'is_active_text', name: 'is_active_text'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var impact_types_table = $('#impact_types_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('impact_types.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'idlib_impact_type', name: 'idlib_impact_type'},
            {data: 'impact_type_group', name: 'impact_type_group'},
            {data: 'impact_type', name: 'impact_type'},
            {data: 'description', name: 'description'},
            {data: 'is_active_text', name: 'is_active_text'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var output_types_table = $('#output_types_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('output_types.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'idlib_output_type', name: 'idlib_output_type'},
            {data: 'output_type_group', name: 'output_type_group'},
            {data: 'output_type', name: 'output_type'},
            {data: 'description', name: 'description'},
            {data: 'is_active_text', name: 'is_active_text'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var research_types_table = $('#research_types_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('research_types.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'idlib_research_type', name: 'idlib_research_type'},
            {data: 'research_type', name: 'research_type'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var proposal_types_table = $('#proposal_types_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('proposal_types.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'idlib_proposal_type', name: 'idlib_proposal_type'},
            {data: 'proposal_type', name: 'proposal_type'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var proposal_status_table = $('#proposal_status_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('proposal_status.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'idlib_proposal_status', name: 'idlib_proposal_status'},
            {data: 'status', name: 'status'},
            {data: 'description', name: 'description'},
            {
              data: 'allowed_transitions', name: 'allowed_transitions',
              "render": function(data, type, row){
                if (data == null) return '';
                return data.split("; ").join(",<br/>");
              }
            },
            {data: 'is_active_text', name: 'is_active_text'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var rd_policy_table = $('#rd_policy_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('rd_policy.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'idlib_rd_policy', name: 'idlib_rd_policy'},
            {data: 'policy_name', name: 'policy_name'},
            {data: 'label', name: 'label'},
            {data: 'description', name: 'description'},
            {data: 'is_active_text', name: 'is_active_text'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var rd_policy_status_table = $('#rd_policy_status_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('rd_policy_status.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'idlib_rd_policy_status', name: 'idlib_rd_policy_status'},
            {data: 'status', name: 'status'},
            {data: 'description', name: 'description'},
            {data: 'is_active_text', name: 'is_active_text'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var rd_policy_areas_table = $('#rd_policy_areas_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('rd_policy_areas.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'idlib_rd_policy_area', name: 'idlib_rd_policy_area'},
            {data: 'label', name: 'label'},
            {data: 'description', name: 'description'},
            {data: 'is_active_text', name: 'is_active_text'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      var rd_policy_programs_table = $('#rd_policy_programs_table').DataTable({
        processing: true,
        serverSide: true,
        data: {
          "_token": "{{ csrf_token() }}"
        },
        ajax: {
          url: "{{ route('rd_policy_programs.table') }}",
          method: "GET"
        },
        columns: [
            {data: 'idlib_rd_policy_program', name: 'idlib_rd_policy_program'},
            {data: 'label', name: 'label'},
            {data: 'description', name: 'description'},
            {data: 'is_active_text', name: 'is_active_text'},
            {data: 'action', orderable: false, searchable: false}
        ]
      });

      $('.select2#user_division').select2({
        dropdownParent: $('.user_division_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      $('.select2#user_employee_code').select2({
        dropdownParent: $('.user_employee_code_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      $('.select2#user_privilege').select2({
        dropdownParent: $('.user_privilege_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      $('.select2#user_expertise').select2({
        dropdownParent: $('.user_expertise_fg'),
        theme: 'bootstrap',
        width: '100%'
      })
      
      $('.select2#user_area_assignment').select2({
        dropdownParent: $('.user_area_assignment_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

       $('.select2#user_privilege_is_active').select2({
        dropdownParent: $('.user_privilege_is_active_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      $('.select2#beneficiary_is_active').select2({
        dropdownParent: $('.beneficiary_is_active_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      $('.select2#call_for_proposal_is_dost_call').select2({
        dropdownParent: $('.call_for_proposal_is_dost_call_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      $('.select2#document_type_is_active').select2({
        dropdownParent: $('.document_type_is_active_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      $('.select2#impact_type_is_active').select2({
        dropdownParent: $('.impact_type_is_active_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      $('.select2#output_type_is_active').select2({
        dropdownParent: $('.output_type_is_active_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      // $('.select2#research_type_is_active').select2({
      //   dropdownParent: $('.research_type_is_active_fg'),
      //   theme: 'bootstrap',
      //   width: '100%'
      // })

      // $('.select2#proposal_type_is_active').select2({
      //   dropdownParent: $('.proposal_type_is_active_fg'),
      //   theme: 'bootstrap',
      //   width: '100%'
      // })

      $('.select2#proposal_status_is_active').select2({
        dropdownParent: $('.proposal_status_is_active_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      $('.select2#rd_policy_is_active').select2({
        dropdownParent: $('.rd_policy_is_active_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      $('.select2#rd_policy_status_is_active').select2({
        dropdownParent: $('.rd_policy_status_is_active_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      $('.select2#rd_policy_areas_is_active').select2({
        dropdownParent: $('.rd_policy_areas_is_active_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      $('.select2#rd_policy_programs_is_active').select2({
        dropdownParent: $('.rd_policy_programs_is_active_fg'),
        theme: 'bootstrap',
        width: '100%'
      })

      function export_pmt_to_dpmis() {
        var request = $.ajax({
          url: "{{ route('users.export_pmt_to_dpmis')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}'
          }
        })

        return request;
      }

      function export_pmt_assigned_proposal_to_dpmis() {
        var request = $.ajax({
          url: "{{ route('users.export_pmt_assigned_proposal_to_dpmis')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}'
          }
        })

        return request;
      }

      // USER FUNCTIONS AND BUTTON FUNCTIONS
      function add_user() {
        var request = $.ajax({
          url: "{{ route('users.store')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'username' : $('#user_username').val(),
            'employee_code' : $('#user_employee_code').val(),
            'first_name' : $('#user_first_name').val(),
            'middle_name' : $('#user_middle_name').val(),
            'last_name' : $('#user_last_name').val(),
            'expertise' : $('#user_expertise').val(),
            'area_assignment' : $('#user_area_assignment').val(),
            'privilege' : $('#user_privilege').val(),
            'division' : $('#user_division').val(),
            'password' : $('#user_password').val()
          }
        })

        return request;
      }
      function update_user(user_id){
        var request = $.ajax({
          url: "{{ route('users.update')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'user_id' : user_id,
            'username' : $('#user_username').val(),
            'employee_code' : $('#user_employee_code').val(),
            'first_name' : $('#user_first_name').val(),
            'middle_name' : $('#user_middle_name').val(),
            'last_name' : $('#user_last_name').val(),
            'expertise' : $('#user_expertise').val(),
            'area_assignment' : $('#user_area_assignment').val(),
            'privilege' : $('#user_privilege').val(),
            'division' : $('#user_division').val(),
            'password' : $('#user_password').val()
          }
        })

        return request;
      }

      function view_user(user_id) {
        var request = $.ajax({
          url: "{{ route('users.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'user_id' : user_id
          }
        })

        return request;
      }

      function delete_user(user_id){
        var request = $.ajax({
          url: "{{ route('users.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'user_id' : user_id
          }
        })

        return request;
      }

      //add functions
      $('#add_user').on('click', function(){
        $('#user_modal').modal('toggle')
        $('#user_modal .save-button').removeClass('save-update-user')
        $('#user_modal .save-button').addClass('save-add-user')
      })

      $('#user_modal').on('click', '.save-add-user', function(){
        var request = add_user();

        request.then(function(data){
          if(data['status'] == 1){
            $.alert({
              title: 'Notification!',
              content: data['view'],
              buttons:{
                Confirm: function(){
                  users_table.ajax.reload()
                  $('#user_modal').modal('toggle')
                }
              }
            })
          }
        })
      })

      $('#user_modal').on('click', '.save-update-user', function(){
        var request = update_user(user_id);

        request.then(function(data){
          if(data['status'] == 1){
            $.alert({
              title: 'Notification!',
              content: data['view'],
              buttons:{
                Confirm: function(){
                  users_table.ajax.reload()
                  $('#user_modal').modal('toggle')
                }
              }
            })
          }
        })
      })

      $('#users_table').on('click', '.view-user', function(e) {
        e.preventDefault()
        user_id = $(this).parents('tr').attr('data-id')

        var request = view_user(user_id);
        request.then(function(data) {
          if(data['status'] == 1){
            $('#user_username').val(data['user']['username']).change()
            $('#user_privilege').val(data['user']['privilege']).change()
            $('#user_employee_code').val(data['user']['employee_code']).change()
            $('#user_first_name').val(data['user']['first_name']).change()
            $('#user_middle_name').val(data['user']['middle_name']).change()
            $('#user_last_name').val(data['user']['last_name']).change()
            $('#user_expertise').val(data['expertise']).change()
            $('#user_area_assignment').val(data['area_assignment']).change()
            $('#user_privilege').val(data['user']['privilege']).change()
            $('#user_division').val(data['user']['division']).change()
            $('#user_modal .save-button').removeClass('save-add-user')
            $('#user_modal .save-button').addClass('save-update-user')
            $('#user_modal').modal('toggle')
            $.alert({
              title: 'Notification',
              content: data['view']
            })
            
          }
        })
      })

      $('#users_table').on('click', '.delete-user', function(e) {
        e.preventDefault()
        user_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to delete this user?',
          buttons:{
            Yes: function(){
              var request = delete_user(user_id);
              request.then(function(data) {
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        users_table.ajax.reload()
                      }
                    }
                  })
                  
                }
              })
            },
            No: function(){}
          }
        })
        
      })

      $('#user_modal').on('hidden.bs.modal', function() {
        $('#user_modal .user-field').val('').change()
        $('#user_modal .save-button').removeClass('save-update-user')
        $('#user_modal .save-button').removeClass('save-add-user')
      })

      //USER PRIVILEGE FUNCTIONS AND BUTTON FUNCTIONS
      function add_user_privilege() {
        var request = $.ajax({
          url: "{{ route('user_privileges.store')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'user_privilege' : $('#user_privilege_description').val(),
            'user_privilege_is_active' : $('#user_privilege_is_active').val()
          }
        })

        return request;
      }
      function update_user_privilege(user_privilege_id){
        var request = $.ajax({
          url: "{{ route('user_privileges.update')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'user_privilege_id' : user_privilege_id,
            'user_privilege' : $('#user_privilege_description').val(),
            'user_privilege_is_active' : $('#user_privilege_is_active').val()
          }
        })

        return request;
      }

      function view_user_privilege(user_privilege_id) {
        var request = $.ajax({
          url: "{{ route('user_privileges.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'user_privilege_id' : user_privilege_id
          }
        })

        return request;
      }

      function delete_user_privilege(user_privilege_id){
        var request = $.ajax({
          url: "{{ route('user_privileges.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'user_privilege_id' : user_privilege_id
          }
        })

        return request;
      }

      //add functions
      $('#add_user_privilege').on('click', function(){
        $('#user_privileges_modal').modal('toggle')
        $('#user_privileges_modal .save-button').removeClass('save-update-user-privilege')
        $('#user_privileges_modal .save-button').addClass('save-add-user-privilege')
      })

      $('#user_privileges_modal').on('click', '.save-add-user-privilege', function(){
        var request = add_user_privilege();

        request.then(function(data){
          if(data['status'] == 1){
            $.alert({
              title: 'Notification!',
              content: data['view'],
              buttons:{
                Confirm: function(){
                  user_privileges_table.ajax.reload()
                  $('#user_privileges_modal').modal('toggle')
                }
              }
            })
          }
        })
      })

      $('#user_privileges_modal').on('click', '.save-update-user-privilege', function(){
        var request = update_user_privilege(user_privilege_id);

        request.then(function(data){
          if(data['status'] == 1){
            $.alert({
              title: 'Notification!',
              content: data['view'],
              buttons:{
                Confirm: function(){
                  user_privileges_table.ajax.reload()
                  $('#user_privileges_modal').modal('toggle')
                }
              }
            })
          }
        })
      })

      $('#user_privileges_table').on('click', '.view-user-privilege', function(e) {
        e.preventDefault()
        user_privilege_id = $(this).parents('tr').attr('data-id')

        var request = view_user_privilege(user_privilege_id);
        request.then(function(data) {
          if(data['status'] == 1){
            $('#user_privilege_description').val(data['user_privilege']['user_privilege']).change();
            $('#user_privilege_is_active').val(data['user_privilege']['is_active']).change();
            $('#user_privileges_modal .save-button').removeClass('save-add-user-privilege')
            $('#user_privileges_modal .save-button').addClass('save-update-user-privilege')
            $('#user_privileges_modal').modal('toggle')
            $.alert({
              title: 'Notification',
              content: data['view']
            })
            
          }
        })
      })

      $('#user_privileges_table').on('click', '.delete-user-privilege', function(e) {
        e.preventDefault()
        user_privilege_id = $(this).parents('tr').attr('data-id')

        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to delete this user privilege?',
          buttons:{
            Yes: function(){
              var request = delete_user_privilege(user_privilege_id);
              request.then(function(data) {
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        user_privileges_table.ajax.reload()
                      }
                    }
                  })
                  
                }
              })
            },
            No: function(){}
          }
        })
        
      })

      $('#user_privileges_modal').on('hidden.bs.modal', function() {
        $('#user_privileges_modal .user-field').val('').change()
        $('#user_privileges_modal .save-button').removeClass('save-update-user-privilege')
        $('#user_privileges_modal .save-button').removeClass('save-add-user-privilege')
      })


      //BENEFICIARY FUNCTIONS AND BUTTON FUNCTIONS
      function view_beneficiary(beneficiary_id){
        var request = $.ajax({
          url: "{{ route('beneficiary.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'beneficiary_id' : beneficiary_id
          }
        })

        return request;        
      }

      function add_beneficiary(){
        var request = $.ajax({
          url: "{{ route('beneficiary.store')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'beneficiary' : $('#beneficiary_description').val(),
            'beneficiary_is_active' : $('#beneficiary_is_active').val(),
          }
        })

        return request; 
      }

      function update_beneficiary(beneficiary_id){
        var request = $.ajax({
          url: "{{ route('beneficiary.update')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'beneficiary_id' : beneficiary_id,
            'beneficiary' : $('#beneficiary_description').val(),
            'beneficiary_is_active' : $('#beneficiary_is_active').val(),
          }
        })

        return request; 
      }

      function delete_beneficiary(beneficiary_id) {
        var request = $.ajax({
          url: "{{ route('beneficiary.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'beneficiary_id' : beneficiary_id,
          }
        })

        return request 
      }

      $('#beneficiary_table').on('click', '.view-beneficiary', function(e) {
        e.preventDefault()
        beneficiary_id = $(this).parents('tr').attr('data-id')
        var request = view_beneficiary(beneficiary_id)

        request.then(function(data){
          $.alert({
            title: 'Notification!',
            content: data['view']
          })
          if(data['status'] == 1){
            $('#beneficiary_modal .save-button').removeClass('save-add-beneficiary')
            $('#beneficiary_modal .save-button').addClass('save-update-beneficiary')
            $('#beneficiary_description').val(data['beneficiary']['beneficiary']).change();
            $('#beneficiary_is_active').val(data['beneficiary']['is_active']).change();
            $('#beneficiary_modal').modal('toggle')
          }
        })
      })

      $('#beneficiary_modal').on('click', '.save-update-beneficiary', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to update this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = update_beneficiary(beneficiary_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#beneficiary_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Beneficiary successfully updated!',
                      buttons: {
                        Confirm : function(){
                          beneficiary_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })
      $('#beneficiary_modal').on('click', '.save-add-beneficiary', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to save this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = add_beneficiary()
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#beneficiary_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Beneficiary successfully added!',
                      buttons: {
                        Confirm : function(){
                          beneficiary_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })

      $('#beneficiary_table').on('click', '.delete-beneficiary', function(e) {
        e.preventDefault()
        beneficiary_id = $(this).parents('tr').attr('data-id')
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to delete this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = delete_beneficiary(beneficiary_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $.alert({
                      title: 'Notification!',
                      content: 'Beneficiary successfully deleted!',
                      buttons: {
                        Confirm : function(){
                          beneficiary_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              } 
            }
          }
        })
      })

      $('#add_beneficiary').on('click', function(e) {
        $('#beneficiary_modal .save-button').removeClass('save-update-beneficiary')
        $('#beneficiary_modal .save-button').addClass('save-add-beneficiary')
        $('#beneficiary_modal').modal('toggle')
      })

      //DOCUMENT TYPES FUNCTIONS AND BUTTON FUNCTIONS
      function view_document_type(document_type_id){
        var request = $.ajax({
          url: "{{ route('document_types.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'document_type_id' : document_type_id
          }
        })

        return request;        
      }

      function add_document_type(){
        var request = $.ajax({
          url: "{{ route('document_types.store')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'document_type' : $('#document_type').val(),
            'document_type_is_active' : $('#document_type_is_active').val()
          }
        })

        return request; 
      }

      function update_document_type(document_type_id){
        var request = $.ajax({
          url: "{{ route('document_types.update')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'document_type_id' : document_type_id,
            'document_type' : $('#document_type').val(),
            'document_type_is_active' : $('#document_type_is_active').val()
          }
        })

        return request; 
      }

      function delete_document_type(document_type_id) {
        var request = $.ajax({
          url: "{{ route('document_types.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'document_type_id' : document_type_id
          }
        })

        return request 
      }

      $('#document_types_table').on('click', '.view-document-type', function(e) {
        e.preventDefault()
        document_type_id = $(this).parents('tr').attr('data-id')
        var request = view_document_type(document_type_id)

        request.then(function(data){
          $.alert({
            title: 'Notification!',
            content: data['view']
          })
          if(data['status'] == 1){
            $('#document_type_modal .save-button').removeClass('save-add-document-type')
            $('#document_type_modal .save-button').addClass('save-update-document-type')
            $('#document_type').val(data['document_type']['document_type']).change();
            $('#document_type_is_active').val(data['document_type']['is_active']).change();
            $('#document_type_modal').modal('toggle')
          }
        })
      })

      $('#document_type_modal').on('click', '.save-update-document-type', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to update this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = update_document_type(document_type_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#document_type_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Document Type successfully updated!',
                      buttons: {
                        Confirm : function(){
                          document_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })
      $('#document_type_modal').on('click', '.save-add-document-type', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to save this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = add_document_type()
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#document_type_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Document Type successfully added!',
                      buttons: {
                        Confirm : function(){
                          document_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })

      $('#document_types_table').on('click', '.delete-document-type', function(e) {
        e.preventDefault()
        document_type_id = $(this).parents('tr').attr('data-id')
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to delete this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = delete_document_type(document_type_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $.alert({
                      title: 'Notification!',
                      content: 'Document Type successfully deleted!',
                      buttons: {
                        Confirm : function(){
                          document_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              } 
            }
          }
        })
      })
      $('#add_document_type').on('click', function(e) {
        $('#document_type_modal .save-button').removeClass('save-update-document-type')
        $('#document_type_modal .save-button').addClass('save-add-document-type')
        $('#document_type_modal').modal('toggle')
      })

      //CALL FOR PROPOSALS FUNCTIONS AND BUTTON FUNCTIONS
      $('#add_call_for_proposal').on('click', function(e) {
        $('#call_for_proposal_modal .save-button').removeClass('save-update-call-for-proposal')
        $('#call_for_proposal_modal .save-button').addClass('save-add-call-for-proposal')
        $('#call_for_proposal_modal').modal('toggle')
      })

      //IMPACT TYPES FUNCTIONS AND BUTTON FUNCTIONS
      function view_impact_type(impact_type_id){
        var request = $.ajax({
          url: "{{ route('impact_types.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'impact_type_id' : impact_type_id
          }
        })

        return request;        
      }

      function add_impact_type(){
        var request = $.ajax({
          url: "{{ route('impact_types.store')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'impact_type_group' : $('#impact_type_group').val(),
            'impact_type' : $('#impact_type').val(),
            'impact_description' : $('#impact_description').val(),
            'impact_type_is_active' : $('#impact_type_is_active').val()
          }
        })

        return request; 
      }

      function update_impact_type(impact_type_id){
        var request = $.ajax({
          url: "{{ route('impact_types.update')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'impact_type_id' : impact_type_id,
            'impact_type_group' : $('#impact_type_group').val(),
            'impact_type' : $('#impact_type').val(),
            'impact_description' : $('#impact_type_description').val(),
            'impact_type_is_active' : $('#impact_type_is_active').val()
          }
        })

        return request; 
      }

      function delete_impact_type(impact_type_id) {
        var request = $.ajax({
          url: "{{ route('impact_types.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'impact_type_id' : impact_type_id
          }
        })

        return request 
      }

      $('#impact_types_table').on('click', '.view-impact-type', function(e) {
        e.preventDefault()
        impact_type_id = $(this).parents('tr').attr('data-id')
        var request = view_impact_type(impact_type_id)

        request.then(function(data){
          $.alert({
            title: 'Notification!',
            content: data['view']
          })
          if(data['status'] == 1){
            $('#impact_type_modal .save-button').removeClass('save-add-impact-type')
            $('#impact_type_modal .save-button').addClass('save-update-impact-type')
            $('#impact_type_group').val(data['impact_type']['impact_type_group']).change();
            $('#impact_type').val(data['impact_type']['impact_type']).change();
            $('#impact_type_description').val(data['impact_type']['description']).change();
            $('#impact_type_is_active').val(data['impact_type']['is_active']).change();
            $('#impact_type_modal').modal('toggle')
          }
        })
      })

      $('#impact_type_modal').on('click', '.save-update-impact-type', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to update this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = update_impact_type(impact_type_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#impact_type_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Impact Type successfully updated!',
                      buttons: {
                        Confirm : function(){
                          impact_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })
      $('#impact_type_modal').on('click', '.save-add-impact-type', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to save this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = add_impact_type()
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#impact_type_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Impact Type successfully added!',
                      buttons: {
                        Confirm : function(){
                          impact_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })

      $('#impact_types_table').on('click', '.delete-impact-type', function(e) {
        e.preventDefault()
        impact_type_id = $(this).parents('tr').attr('data-id')
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to delete this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = delete_impact_type(impact_type_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $.alert({
                      title: 'Notification!',
                      content: 'Impact Type successfully deleted!',
                      buttons: {
                        Confirm : function(){
                          impact_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              } 
            }
          }
        })
      })
      $('#add_impact_type').on('click', function(e) {
        $('#impact_type_modal .save-button').removeClass('save-update-impact-type')
        $('#impact_type_modal .save-button').addClass('save-add-impact-type')
        $('#impact_type_modal').modal('toggle')
      })

      //OUTPUT TYPES FUNCTIONS AND BUTTON FUNCTIONS
      function view_output_type(output_type_id){
        var request = $.ajax({
          url: "{{ route('output_types.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'output_type_id' : output_type_id
          }
        })

        return request;        
      }

      function add_output_type(){
        var request = $.ajax({
          url: "{{ route('output_types.store')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'output_type_group' : $('#output_type_group').val(),
            'output_type' : $('#output_type').val(),
            'output_type_description' : $('#output_type_description').val(),
            'output_type_is_active' : $('#output_type_is_active').val()
          }
        })

        return request; 
      }

      function update_output_type(output_type_id){
        var request = $.ajax({
          url: "{{ route('output_types.update')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'output_type_id' : output_type_id,
            'output_type_group' : $('#output_type_group').val(),
            'output_type' : $('#output_type').val(),
            'output_type_description' : $('#output_type_description').val(),
            'output_type_is_active' : $('#output_type_is_active').val()
          }
        })

        return request; 
      }

      function delete_output_type(output_type_id) {
        var request = $.ajax({
          url: "{{ route('output_types.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'output_type_id' : output_type_id
          }
        })

        return request 
      }

      $('#output_types_table').on('click', '.view-output-type', function(e) {
        e.preventDefault()
        output_type_id = $(this).parents('tr').attr('data-id')
        var request = view_output_type(output_type_id)

        request.then(function(data){
          $.alert({
            title: 'Notification!',
            content: data['view']
          })
          if(data['status'] == 1){
            $('#output_type_modal .save-button').removeClass('save-add-output-type')
            $('#output_type_modal .save-button').addClass('save-update-output-type')
            $('#output_type_group').val(data['output_type']['output_type_group']).change();
            $('#output_type').val(data['output_type']['output_type']).change();
            $('#output_type_description').val(data['output_type']['description']).change();
            $('#output_type_is_active').val(data['output_type']['is_active']).change();
            $('#output_type_modal').modal('toggle')
          }
        })
      })

      $('#output_type_modal').on('click', '.save-update-output-type', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to update this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = update_output_type(output_type_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#output_type_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Output Type successfully updated!',
                      buttons: {
                        Confirm : function(){
                          output_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })
      $('#output_type_modal').on('click', '.save-add-output-type', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to save this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = add_output_type()
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#output_type_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Output Type successfully added!',
                      buttons: {
                        Confirm : function(){
                          output_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })

      $('#output_types_table').on('click', '.delete-output-type', function(e) {
        e.preventDefault()
        output_type_id = $(this).parents('tr').attr('data-id')
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to delete this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = delete_output_type(output_type_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $.alert({
                      title: 'Notification!',
                      content: 'Output Type successfully deleted!',
                      buttons: {
                        Confirm : function(){
                          output_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              } 
            }
          }
        })
      })
      $('#add_output_type').on('click', function(e) {
        $('#output_type_modal .save-button').removeClass('save-update-output-type')
        $('#output_type_modal .save-button').addClass('save-add-output-type')
        $('#output_type_modal').modal('toggle')
      })

      //RESEARCH TYPES FUNCTIONS AND BUTTON FUNCTIONS
      function view_research_type(research_type_id){
        var request = $.ajax({
          url: "{{ route('research_types.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'research_type_id' : research_type_id
          }
        })

        return request;        
      }

      function add_research_type(){
        var request = $.ajax({
          url: "{{ route('research_types.store')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'research_type' : $('#research_type').val(),
          }
        })

        return request; 
      }

      function update_research_type(research_type_id){
        var request = $.ajax({
          url: "{{ route('research_types.update')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'research_type_id' : research_type_id,
            'research_type' : $('#research_type').val(),
          }
        })

        return request; 
      }

      function delete_research_type(research_type_id) {
        var request = $.ajax({
          url: "{{ route('research_types.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'research_type_id' : research_type_id
          }
        })

        return request 
      }

      $('#research_types_table').on('click', '.view-research-type', function(e) {
        e.preventDefault()
        research_type_id = $(this).parents('tr').attr('data-id')
        var request = view_research_type(research_type_id)

        request.then(function(data){
          $.alert({
            title: 'Notification!',
            content: data['view']
          })
          if(data['status'] == 1){
            $('#research_type_modal .save-button').removeClass('save-add-research-type')
            $('#research_type_modal .save-button').addClass('save-update-research-type')
            $('#research_type').val(data['research_type']['research_type']).change();
            $('#research_type_modal').modal('toggle')
          }
        })
      })

      $('#research_type_modal').on('click', '.save-update-research-type', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to update this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = update_research_type(research_type_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#research_type_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Research Type successfully updated!',
                      buttons: {
                        Confirm : function(){
                          research_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })
      $('#research_type_modal').on('click', '.save-add-research-type', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to save this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = add_research_type()
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#research_type_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Research Type successfully added!',
                      buttons: {
                        Confirm : function(){
                          research_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })

      $('#research_type_modal').on('click', '.delete-research-type', function(e) {
        e.preventDefault()
        research_type_id = $(this).parents('tr').attr('data-id')
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to delete this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = delete_research_type(research_type_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $.alert({
                      title: 'Notification!',
                      content: 'Research Type successfully deleted!',
                      buttons: {
                        Confirm : function(){
                          research_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              } 
            }
          }
        })
      })
      $('#add_research_type').on('click', function(e) {
        $('#research_type_modal .save-button').removeClass('save-update-research-type')
        $('#research_type_modal .save-button').addClass('save-add-research-type')
        $('#research_type_modal').modal('toggle')
      })

      //PROPOSAL TYPES FUNCTIONS AND BUTTON FUNCTIONS
      function view_proposal_type(proposal_type_id){
        var request = $.ajax({
          url: "{{ route('proposal_types.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_type_id' : proposal_type_id
          }
        })

        return request;        
      }

      function add_proposal_type(){
        var request = $.ajax({
          url: "{{ route('proposal_types.store')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_type' : $('#proposal_type').val(),
            // 'proposal_type_is_active' : $('#proposal_type_is_active').val()
          }
        })

        return request; 
      }

      function update_proposal_type(proposal_type_id){
        var request = $.ajax({
          url: "{{ route('proposal_types.update')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_type_id' : proposal_type_id,
            'proposal_type' : $('#proposal_type').val(),
            // 'proposal_type_is_active' : $('#proposal_type_is_active').val()
          }
        })

        return request; 
      }

      function delete_proposal_type(proposal_type_id) {
        var request = $.ajax({
          url: "{{ route('proposal_types.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_type_id' : proposal_type_id
          }
        })

        return request 
      }

      $('#proposal_types_table').on('click', '.view-proposal-type', function(e) {
        e.preventDefault()
        proposal_type_id = $(this).parents('tr').attr('data-id')
        var request = view_proposal_type(proposal_type_id)

        request.then(function(data){
          $.alert({
            title: 'Notification!',
            content: data['view']
          })
          if(data['status'] == 1){
            $('#proposal_type_modal .save-button').removeClass('save-add-proposal-type')
            $('#proposal_type_modal .save-button').addClass('save-update-proposal-type')
            $('#proposal_type').val(data['proposal_type']['proposal_type']).change();
            // $('#proposal_type_is_active').val(data['proposal_type']['is_active']).change();
            $('#proposal_type_modal').modal('toggle')
          }
        })
      })

      $('#proposal_type_modal').on('click', '.save-update-proposal-type', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to update this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = update_proposal_type(proposal_type_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#proposal_type_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Proposal Type successfully updated!',
                      buttons: {
                        Confirm : function(){
                          proposal_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })
      $('#proposal_type_modal').on('click', '.save-add-proposal-type', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to save this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = add_proposal_type()
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#proposal_type_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Proposal Type successfully added!',
                      buttons: {
                        Confirm : function(){
                          proposal_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })

      $('#proposal_type_modal').on('click', '.delete-proposal-type', function(e) {
        e.preventDefault()
        proposal_type_id = $(this).parents('tr').attr('data-id')
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to delete this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = delete_proposal_type(proposal_type_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $.alert({
                      title: 'Notification!',
                      content: 'Proposal Type successfully deleted!',
                      buttons: {
                        Confirm : function(){
                          proposal_types_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              } 
            }
          }
        })
      })
      $('#add_proposal_type').on('click', function(e) {
        $('#proposal_type_modal .save-button').removeClass('save-update-proposal-type')
        $('#proposal_type_modal .save-button').addClass('save-add-proposal-type')
        $('#proposal_type_modal').modal('toggle')
      })

      //PROPOSAL STATUS FUNCTIONS AND BUTTON FUNCTIONS
      function view_proposal_status(proposal_status_id){
        var request = $.ajax({
          url: "{{ route('proposal_status.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_status_id' : proposal_status_id
          }
        })

        return request;        
      }

      function add_proposal_status(allowed_transitions_array){
        var request = $.ajax({
          url: "{{ route('proposal_status.store')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_status' : $('#proposal_status').val(),
            'proposal_status_description' : $('#proposal_status_description').val(),
            'proposal_status_allowed_transitions' : allowed_transitions_array,
            'proposal_status_is_active' : $('#proposal_status_is_active').val()
          }
        })

        return request; 
      }

      function update_proposal_status(proposal_status_id, allowed_transitions_array){
        var request = $.ajax({
          url: "{{ route('proposal_status.update')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_status_id' : proposal_status_id,
            'proposal_status' : $('#proposal_status').val(),
            'proposal_status_description' : $('#proposal_status_description').val(),
            'proposal_status_allowed_transitions' : allowed_transitions_array,
            'proposal_status_is_active' : $('#proposal_status_is_active').val()
          }
        })

        return request; 
      }

      function delete_proposal_status(proposal_status_id) {
        var request = $.ajax({
          url: "{{ route('proposal_status.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'proposal_status_id' : proposal_status_id
          }
        })

        return request 
      }

      $('#proposal_status_table').on('click', '.view-proposal-status', function(e) {
        e.preventDefault()
        proposal_status_id = $(this).parents('tr').attr('data-id')
        var request = view_proposal_status(proposal_status_id)

        request.then(function(data){
          $.alert({
            title: 'Notification!',
            content: data['view']
          })
          if(data['status'] == 1){
            $('#proposal_status_modal .save-button').removeClass('save-add-proposal-status')
            $('#proposal_status_modal .save-button').addClass('save-update-proposal-status')
            $('#proposal_status').val(data['proposal_status']['status']).change();
            $('#proposal_status_description').val(data['proposal_status']['description']).change();
            $('#proposal_status_is_active').val(data['proposal_status']['is_active']).change();


            for(i = 0; i < data['proposal_status_allowed_transitions'].length; i++) {$('.proposal-status-allowed-transitions[value='+data['proposal_status_allowed_transitions'][i]['to_lib_proposal_status_idlib_proposal_status']+']').prop('checked', true)}

            $('#proposal_status_modal').modal('toggle')
          }
        })
      })

      $('#proposal_status_modal').on('click', '.save-update-proposal-status', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to update this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                allowed_transitions_array = [];
                $('.proposal-status-allowed-transitions:checkbox:checked').each(function(e) {allowed_transitions_array.push($(this).val())})
                var request = update_proposal_status(proposal_status_id, allowed_transitions_array)
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#proposal_status_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Proposal Status successfully updated!',
                      buttons: {
                        Confirm : function(){
                          proposal_status_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })
      $('#proposal_status_modal').on('click', '.save-add-proposal-status', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to save this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                allowed_transitions_array = []
                $('.proposal-status-allowed-transitions:checkbox:checked').each(function(e) {allowed_transitions_array.push($(this).val()) })
                var request = add_proposal_status(allowed_transitions_array)
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#proposal_status_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'Proposal Status successfully added!',
                      buttons: {
                        Confirm : function(){
                          proposal_status_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })

      $('#proposal_status_table').on('click', '.delete-proposal-status', function(e) {
        e.preventDefault()
        proposal_status_id = $(this).parents('tr').attr('data-id')
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to delete this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = delete_proposal_status(proposal_status_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $.alert({
                      title: 'Notification!',
                      content: 'Proposal Status successfully deleted!',
                      buttons: {
                        Confirm : function(){
                          proposal_status_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              } 
            }
          }
        })
      })
      $('#add_proposal_status').on('click', function(e) {

        $('#proposal_status_modal .save-button').removeClass('save-update-proposal-status')
        $('#proposal_status_modal .save-button').addClass('save-add-proposal-status')
        $('#proposal_status_modal').modal('toggle')
      })

      //R & D POLICY FUNCTIONS AND BUTTON FUNCTIONS
      function view_rd_policy(rd_policy_id){
        var request = $.ajax({
          url: "{{ route('rd_policy.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_id' : rd_policy_id
          }
        })

        return request;        
      }

      function add_rd_policy(){
        var request = $.ajax({
          url: "{{ route('rd_policy.store')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_name' : $('#rd_policy_name').val(),
            'rd_policy_label' : $('#rd_policy_label').val(),
            'rd_policy_description' : $('#rd_policy_description').val(),
            'rd_policy_is_active' : $('#rd_policy_is_active').val()
          }
        })

        return request; 
      }

      function update_rd_policy(rd_policy_id){
        var request = $.ajax({
          url: "{{ route('rd_policy.update')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_id' : rd_policy_id,
            'rd_policy_name' : $('#rd_policy_name').val(),
            'rd_policy_label' : $('#rd_policy_label').val(),
            'rd_policy_description' : $('#rd_policy_description').val(),
            'rd_policy_is_active' : $('#rd_policy_is_active').val()
          }
        })

        return request; 
      }

      function delete_rd_policy(rd_policy_id) {
        var request = $.ajax({
          url: "{{ route('rd_policy.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_id' : rd_policy_id
          }
        })

        return request 
      }

      $('#rd_policy_table').on('click', '.view-rd-policy', function(e) {
        e.preventDefault()
        rd_policy_id = $(this).parents('tr').attr('data-id')
        var request = view_rd_policy(rd_policy_id)

        request.then(function(data){
          $.alert({
            title: 'Notification!',
            content: data['view']
          })
          if(data['status'] == 1){
            $('#rd_policy_modal .save-button').removeClass('save-add-rd-policy')
            $('#rd_policy_modal .save-button').addClass('save-update-rd-policy')
            $('#rd_policy_name').val(data['rd_policy']['policy_name']).change();
            $('#rd_policy_label').val(data['rd_policy']['label']).change();
            $('#rd_policy_description').val(data['rd_policy']['description']).change();
            $('#rd_policy_is_active').val(data['rd_policy']['is_active']).change();
            $('#rd_policy_modal').modal('toggle')
          }
        })
      })

      $('#rd_policy_modal').on('click', '.save-update-rd-policy', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to update this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = update_rd_policy(rd_policy_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#rd_policy_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'R & D Policy successfully updated!',
                      buttons: {
                        Confirm : function(){
                          rd_policy_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })
      $('#rd_policy_modal').on('click', '.save-add-rd-policy', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to save this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = add_rd_policy()
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#rd_policy_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'R & D Policy successfully added!',
                      buttons: {
                        Confirm : function(){
                          rd_policy_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })

      $('#rd_policy_table').on('click', '.delete-rd-policy', function(e) {
        e.preventDefault()
        rd_policy_id = $(this).parents('tr').attr('data-id')
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to delete this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = delete_rd_policy(rd_policy_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $.alert({
                      title: 'Notification!',
                      content: 'R & D Policy successfully deleted!',
                      buttons: {
                        Confirm : function(){
                          rd_policy_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              } 
            }
          }
        })
      })
      $('#add_rd_policy').on('click', function(e) {
        $('#rd_policy_modal .save-button').removeClass('save-update-rd-policy')
        $('#rd_policy_modal .save-button').addClass('save-add-rd-policy')
        $('#rd_policy_modal').modal('toggle')
      })

      //R & D POLICY STATUS FUNCTIONS AND BUTTON FUNCTIONS
      function view_rd_policy_status(rd_policy_status_id){
        var request = $.ajax({
          url: "{{ route('rd_policy_status.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_status_id' : rd_policy_status_id
          }
        })

        return request;        
      }

      function add_rd_policy_status(){
        var request = $.ajax({
          url: "{{ route('rd_policy_status.store')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_status' : $('#rd_policy_status').val(),
            'rd_policy_status_description' : $('#rd_policy_status_description').val(),
            'rd_policy_status_is_active' : $('#rd_policy_status_is_active').val()
          }
        })

        return request; 
      }

      function update_rd_policy_status(rd_policy_status_id){
        var request = $.ajax({
          url: "{{ route('rd_policy_status.update')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_status_id' : rd_policy_status_id,
            'rd_policy_status' : $('#rd_policy_status').val(),
            'rd_policy_status_description' : $('#rd_policy_status_description').val(),
            'rd_policy_status_is_active' : $('#rd_policy_status_is_active').val()
          }
        })

        return request; 
      }

      function delete_rd_policy_status(rd_policy_status_id) {
        var request = $.ajax({
          url: "{{ route('rd_policy_status.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_status_id' : rd_policy_status_id
          }
        })

        return request 
      }

      $('#rd_policy_status_table').on('click', '.view-rd-policy-status', function(e) {
        e.preventDefault()
        rd_policy_status_id = $(this).parents('tr').attr('data-id')
        var request = view_rd_policy_status(rd_policy_status_id)

        request.then(function(data){
          $.alert({
            title: 'Notification!',
            content: data['view']
          })
          if(data['status'] == 1){
            $('#rd_policy_status_modal .save-button').removeClass('save-add-rd-policy-status')
            $('#rd_policy_status_modal .save-button').addClass('save-update-rd-policy-status')
            $('#rd_policy_status').val(data['rd_policy_status']['status']).change();
            $('#rd_policy_status_description').val(data['rd_policy_status']['description']).change();
            $('#rd_policy_status_is_active').val(data['rd_policy_status']['is_active']).change();
            $('#rd_policy_status_modal').modal('toggle')
          }
        })
      })

      $('#rd_policy_status_modal').on('click', '.save-update-rd-policy-status', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to update this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = update_rd_policy_status(rd_policy_status_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#rd_policy_status_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'R & D Policy Status successfully updated!',
                      buttons: {
                        Confirm : function(){
                          rd_policy_status_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })
      $('#rd_policy_status_modal').on('click', '.save-add-rd-policy-status', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to save this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = add_rd_policy_status()
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#rd_policy_status_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'R & D Policy Status successfully added!',
                      buttons: {
                        Confirm : function(){
                          rd_policy_status_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })

      $('#rd_policy_status_table').on('click', '.delete-rd-policy-status', function(e) {
        e.preventDefault()
        rd_policy_status_id = $(this).parents('tr').attr('data-id')
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to delete this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = delete_rd_policy_status(rd_policy_status_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $.alert({
                      title: 'Notification!',
                      content: 'R & D Policy Status successfully deleted!',
                      buttons: {
                        Confirm : function(){
                          rd_policy_status_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              } 
            }
          }
        })
      })
      $('#add_rd_policy_status').on('click', function(e) {
        $('#rd_policy_status_modal .save-button').removeClass('save-update-rd-policy-status')
        $('#rd_policy_status_modal .save-button').addClass('save-add-rd-policy-status')
        $('#rd_policy_status_modal').modal('toggle')
      })

      //R & D POLICY AREAS FUNCTIONS AND BUTTON FUNCTIONS
      function view_rd_policy_area(rd_policy_area_id){
        var request = $.ajax({
          url: "{{ route('rd_policy_areas.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_area_id' : rd_policy_area_id
          }
        })

        return request;        
      }

      function add_rd_policy_area(){
        var request = $.ajax({
          url: "{{ route('rd_policy_areas.store')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_areas_label' : $('#rd_policy_areas_label').val(),
            'rd_policy_status_description' : $('#rd_policy_status_description').val(),
            'rd_policy_status_is_active' : $('#rd_policy_status_is_active').val()
          }
        })

        return request; 
      }

      function update_rd_policy_area(rd_policy_area_id){
        var request = $.ajax({
          url: "{{ route('rd_policy_areas.update')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_area_id' : rd_policy_area_id,
            'rd_policy_areas_label' : $('#rd_policy_areas_label').val(),
            'rd_policy_areas_description' : $('#rd_policy_areas_description').val(),
            'rd_policy_areas_is_active' : $('#rd_policy_areas_is_active').val()
          }
        })

        return request; 
      }

      function delete_rd_policy_area(rd_policy_area_id) {
        var request = $.ajax({
          url: "{{ route('rd_policy_areas.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_area_id' : rd_policy_area_id
          }
        })

        return request 
      }

      $('#rd_policy_areas_table').on('click', '.view-rd-policy-area', function(e) {
        e.preventDefault()
        rd_policy_area_id = $(this).parents('tr').attr('data-id')
        var request = view_rd_policy_area(rd_policy_area_id)

        request.then(function(data){
          $.alert({
            title: 'Notification!',
            content: data['view']
          })
          if(data['status'] == 1){
            $('#rd_policy_area_modal .save-button').removeClass('save-add-rd-policy-area')
            $('#rd_policy_area_modal .save-button').addClass('save-update-rd-policy-area')
            $('#rd_policy_areas_label').val(data['rd_policy_area']['label']).change();
            $('#rd_policy_areas_description').val(data['rd_policy_area']['description']).change();
            $('#rd_policy_areas_is_active').val(data['rd_policy_area']['is_active']).change();
            $('#rd_policy_areas_modal').modal('toggle')
          }
        })
      })

      $('#rd_policy_areas_modal').on('click', '.save-update-rd-policy-area', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to update this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = update_rd_policy_area(rd_policy_area_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#rd_policy_status_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'R & D Policy Areas successfully updated!',
                      buttons: {
                        Confirm : function(){
                          rd_policy_areas_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })
      $('#rd_policy_areas_modal').on('click', '.save-add-rd-policy-area', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to save this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = add_rd_policy_status()
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#rd_policy_areas_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'R & D Policy Areas successfully added!',
                      buttons: {
                        Confirm : function(){
                          rd_policy_areas_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })

      $('#rd_policy_areas_modal').on('click', '.delete-rd-policy-area', function(e) {
        e.preventDefault()
        rd_policy_area_id = $(this).parents('tr').attr('data-id')
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to delete this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = delete_rd_policy_area(rd_policy_area_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $.alert({
                      title: 'Notification!',
                      content: 'R & D Policy Area successfully deleted!',
                      buttons: {
                        Confirm : function(){
                          rd_policy_areas_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              } 
            }
          }
        })
      })
      $('#add_rd_policy_areas').on('click', function(e) {
        $('#rd_policy_areas_modal .save-button').removeClass('save-update-rd-policy-area')
        $('#rd_policy_areas_modal .save-button').addClass('save-add-rd-policy-area')
        $('#rd_policy_areas_modal').modal('toggle')
      })

      //R & D POLICY PROGRAMS FUNCTIONS AND BUTTON FUNCTIONS
      function view_rd_policy_program(rd_policy_program_id){
        var request = $.ajax({
          url: "{{ route('rd_policy_programs.show')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_program_id' : rd_policy_program_id
          }
        })

        return request;        
      }

      function add_rd_policy_program(){
        var request = $.ajax({
          url: "{{ route('rd_policy_programs.store')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_programs_label' : $('#rd_policy_programs_label').val(),
            'rd_policy_status_description' : $('#rd_policy_status_description').val(),
            'rd_policy_status_is_active' : $('#rd_policy_status_is_active').val()
          }
        })

        return request; 
      }

      function update_rd_policy_program(rd_policy_program_id){
        var request = $.ajax({
          url: "{{ route('rd_policy_programs.update')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_program_id' : rd_policy_program_id,
            'rd_policy_programs_label' : $('#rd_policy_programs_label').val(),
            'rd_policy_programs_description' : $('#rd_policy_programs_description').val(),
            'rd_policy_programs_is_active' : $('#rd_policy_programs_is_active').val()
          }
        })

        return request; 
      }

      function delete_rd_policy_program(rd_policy_program_id) {
        var request = $.ajax({
          url: "{{ route('rd_policy_programs.delete')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'rd_policy_program_id' : rd_policy_program_id
          }
        })

        return request 
      }

      $('#rd_policy_programs_table').on('click', '.view-rd-policy-program', function(e) {
        e.preventDefault()
        rd_policy_program_id = $(this).parents('tr').attr('data-id')
        var request = view_rd_policy_program(rd_policy_program_id)

        request.then(function(data){
          $.alert({
            title: 'Notification!',
            content: data['view']
          })
          if(data['status'] == 1){
            $('#rd_policy_program_modal .save-button').removeClass('save-add-rd-policy-program')
            $('#rd_policy_program_modal .save-button').addClass('save-update-rd-policy-program')
            $('#rd_policy_programs_label').val(data['rd_policy_program']['label']).change();
            $('#rd_policy_programs_description').val(data['rd_policy_program']['description']).change();
            $('#rd_policy_programs_is_active').val(data['rd_policy_program']['is_active']).change();
            $('#rd_policy_programs_modal').modal('toggle')
          }
        })
      })

      $('#rd_policy_programs_modal').on('click', '.save-update-rd-policy-program', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to update this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = update_rd_policy_program(rd_policy_program_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#rd_policy_status_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'R & D Policy programs successfully updated!',
                      buttons: {
                        Confirm : function(){
                          rd_policy_programs_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })
      $('#rd_policy_programs_modal').on('click', '.save-add-rd-policy-program', function() {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to save this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = add_rd_policy_program()
                request.then(function(data){
                  if(data['status'] == 1){
                    $('#rd_policy_programs_modal').modal('toggle')
                    $.alert({
                      title: 'Notification!',
                      content: 'R & D Policy programs successfully added!',
                      buttons: {
                        Confirm : function(){
                          rd_policy_programs_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              }
            }
          }
        })
      })

      $('#rd_policy_programs_modal').on('click', '.delete-rd-policy-program', function(e) {
        e.preventDefault()
        rd_policy_program_id = $(this).parents('tr').attr('data-id')
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to delete this?',
          buttons: {
            No :function(){},
            Yes : {
              btnClass: 'btn-primary',
              action: function(){
                var request = delete_rd_policy_program(rd_policy_program_id)
                request.then(function(data){
                  if(data['status'] == 1){
                    $.alert({
                      title: 'Notification!',
                      content: 'R & D Policy program successfully deleted!',
                      buttons: {
                        Confirm : function(){
                          rd_policy_programs_table.ajax.reload()
                        }
                      }
                    })
                  }
                })
              } 
            }
          }
        })
      })
      $('#add_rd_policy_programs').on('click', function(e) {
        $('#rd_policy_programs_modal .save-button').removeClass('save-update-rd-policy-program')
        $('#rd_policy_programs_modal .save-button').addClass('save-add-rd-policy-program')
        $('#rd_policy_programs_modal').modal('toggle')
      })
      $('#export_pmt_to_dpmis').on('click', function(e) {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to export the PMTs to DPMIS?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = export_pmt_to_dpmis();
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
      $('#export_pmt_assigned_proposal_to_dpmis').on('click', function(e) {
        $.confirm({
          title: 'Notification!',
          content: 'Are you sure you want to export the PMTs to DPMIS?',
          buttons: {
            Yes: function(){
              loader.open()
              var request = export_pmt_assigned_proposal_to_dpmis();
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
      $('#proposal_status_modal').on('hidden.bs.modal', function(e) {
        $('#proposal_status').val('').change()
        $('#proposal_status_description').val('').change()
        $('#proposal_status_is_active').val(0).change()
        $('.proposal-status-allowed-transitions:checkbox:checked').each(function(e) {$(this).prop('checked', false)})
      })

      $('#user_privileges_modal').on('hidden.bs.modal', function(e) {
        $('#user_privileges_modal .required-field').val('').change()
      })

      $('#user_employee_code').on('change', function(e) {
        $('#user_first_name').val($(this).find('option:selected').attr('data-first-name')).change()
        $('#user_last_name').val($(this).find('option:selected').attr('data-last-name')).change()
      })

      $('#reset_user_employee_code').on('click', function(e) {
        $('#user_employee_code').val('').change()
      })
    })
  
  </script>
@endsection
