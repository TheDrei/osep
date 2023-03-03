<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'PagesController@login')->middleware('check_user');
Route::get('/register', 'PagesController@login')->middleware('check_user');

Route::get('/home', 'PagesController@home')->name('home')->middleware('check_user');
Route::get('/administration', 'PagesController@administration')->name('administration')->middleware('check_user');
Route::get('/logout', 'Auth\LoginController@logout')->name('user.logout')->middleware('check_user');

// Route::get('/palihan', 'PagesController@palihan')->name('home')->middleware('check_user');

// Route::get('/', function () {
//     return redirect()->route('/login');
// }

//Proposals
Route::get('/proposals', 'PagesController@proposals')->name('proposals')->middleware('check_user');
Route::get('/completed_projects', 'PagesController@completed_projects')->name('completed_projects'); //drei
Route::get('/received_proposals', 'PagesController@received_proposals')->name('received_proposals')->middleware('check_user');
Route::get('/from_dpmis_proposals', 'PagesController@from_dpmis_proposals')->name('from_dpmis_proposals')->middleware('check_user');
Route::get('/for_evaluation_proposals', 'PagesController@for_evaluation_proposals')->name('for_evaluation_proposals')->middleware('check_user');
Route::get('/approved_proposals', 'PagesController@approved_proposals')->name('approved_proposals')->middleware('check_user');
Route::get('/forward_comments_to_dpmis_proposals', 'PagesController@forward_comments_to_dpmis_proposals')->name('forward_comments_to_dpmis_proposals')->middleware('check_user');
Route::get('/consolidated_comments_forwarded_to_dpmis_proposals', 'PagesController@consolidated_comments_forwarded_to_dpmis_proposals')->name('consolidated_comments_forwarded_to_dpmis_proposals')->middleware('check_user');
Route::get('/update_password', 'PagesController@update_password')->name('update_password')->middleware('check_user');

//Projects maine
Route::get('/projects', 'PagesController@projects')->name('projects')->middleware('check_user');
Route::get('/table/all_projects', 'ProjectsController@all_projects')->name('projects.all_projects');
Route::post('/projects/forward_project_status_to_dpmis', 'ProjectsController@forward_project_status_to_dpmis')->name('projects.forward_project_status_to_dpmis');

//Proposals Table
Route::get('/proposals/table/all_proposals', 'ProposalsController@table_all_proposals')->name('proposals.table_all_proposals');
Route::get('/proposals/table/received_proposals', 'ProposalsController@table_received_proposals')->name('proposals.table_received_proposals');
Route::get('/proposals/table/from_dpmis_proposals', 'ProposalsController@table_from_dpmis_proposals')->name('proposals.table_from_dpmis_proposals');
Route::get('/proposals/table/for_evaluation_proposals', 'ProposalsController@table_for_evaluation_proposals')->name('proposals.table_for_evaluation_proposals');
Route::get('/proposals/table/forward_comments_to_dpmis_proposals', 'ProposalsController@table_forward_comments_to_dpmis_proposals')->name('proposals.table_forward_comments_to_dpmis_proposals');
Route::get('/proposals/table/consolidated_comments_forwarded_to_dpmis_proposals', 'ProposalsController@table_consolidated_comments_forwarded_to_dpmis_proposals')->name('proposals.table_consolidated_comments_forwarded_to_dpmis_proposals');
Route::get('/proposals/table/approved_proposals', 'ProposalsController@table_approved_proposals')->name('proposals.table_approved_proposals');

Route::get('/table/completed_projects', 'JSONController@allcompletedprojects')->name('allcompletedprojects'); //drei

Route::get('/proposals/show', 'ProposalsController@show')->name('proposals.show');
Route::get('/proposals/view_forward_proposal', 'ProposalsController@view_forward_proposal')->name('proposals.view_forward_proposal');
Route::post('/proposals/update_status', 'ProposalsController@update_status')->name('proposals.update_status');
Route::post('/proposals/export_statuses_to_dpmis', 'ProposalsController@export_statuses_to_dpmis')->name('proposals.export_statuses_to_dpmis');
Route::post('/proposals/forward_proposal_to_trd', 'ProposalsController@forward_proposal_to_trd')->name('proposals.forward_proposal_to_trd');
Route::post('/proposals/upload_files', 'ProposalsController@upload_files')->name('proposals.upload_files');
Route::get('/proposals/show_lib_by_proposal_and_year', 'ProposalsController@show_lib_by_proposal_and_year')->name('proposals.show_lib_by_proposal_and_year');
Route::get('/proposals/show_lib_by_proposal_per_year', 'ProposalsController@show_lib_by_proposal_per_year')->name('proposals.show_lib_by_proposal_per_year');
Route::get('/proposals/show_proposal_version', 'ProposalsController@show_proposal_version')->name('proposals.show_proposal_version');
// Route::post('/proposals/forward_proposal_to_palihan', 'ProposalsController@forward_proposal_to_palihan')->name('proposals.forward_proposal_to_palihan');
Route::post('/proposals/forward_proposal_to_palihan', 'ProposalsController@forward_proposal_to_palihan')->name('proposals.forward_proposal_to_palihan');
Route::get('/proposals/download_proposal_files', 'ProposalsController@download_proposal_files')->name('proposals.download_proposal_files');


Route::post('/proposals/forward_proposal_to_palihan_direct', 'ProposalsController@forward_proposal_to_palihan_direct')->name('proposals.forward_proposal_to_palihan_direct');


//Proposal Implementation date
Route::get('/proposal_implementation_date/show', 'ProposalImplementationDateController@show')->name('proposal_implementation_date.show');

//Researchers
Route::get('/proposal_researchers/show', 'ProposalResearchersController@show')->name('proposal_researchers.show');

Route::get('/proposals_comment/show_all_comments_by_proposal', 'ProposalsCommentController@show_all_comments_by_proposal')->name('proposals_comment.show_all_comments_by_proposal');
Route::get('/proposals_comment/show_inline_comments_by_proposal', 'ProposalsCommentController@show_inline_comments_by_proposal')->name('proposals_comment.show_inline_comments_by_proposal');
Route::get('/proposals_comment/show_outline_comments_by_proposal', 'ProposalsCommentController@show_outline_comments_by_proposal')->name('proposals_comment.show_outline_comments_by_proposal');
Route::get('/proposals_comment/show_user_outline_comments_by_proposal', 'ProposalsCommentController@show_user_outline_comments_by_proposal')->name('proposals_comment.show_user_outline_comments_by_proposal');
Route::get('/proposals_comment/show', 'ProposalsCommentController@show')->name('proposals_comment.show');
Route::post('/proposals_comment/store_outline_comments', 'ProposalsCommentController@store_outline_comments')->name('proposals_comment.store_outline_comments');
Route::post('/proposals_comment/store_inline_comments', 'ProposalsCommentController@store_inline_comments')->name('proposals_comment.store_inline_comments');
Route::post('/proposals_comment/update', 'ProposalsCommentController@update')->name('proposals_comment.update');
Route::post('/proposals_comment/delete', 'ProposalsCommentController@delete')->name('proposals_comment.delete');
Route::post('/proposals_comment/forward_comments_to_dpmis', 'ProposalsCommentController@forward_comments_to_dpmis')->name('proposals_comment.forward_comments_to_dpmis');
Route::delete('/proposals_comment/delete_comments_by_proposal', 'ProposalsCommentController@delete_comments_by_proposal')->name('proposals_comment.delete_comments_by_proposal');
//Users
Route::get('/users/table', 'UsersController@table')->name('users.table')->middleware('check_user');
Route::get('/users/show', 'UsersController@show')->name('users.show')->middleware('check_user');
Route::post('/users/export_pmt_to_dpmis', 'UsersController@export_pmt_to_dpmis')->name('users.export_pmt_to_dpmis')->middleware('check_user');
Route::post('/users/update_password', 'UsersController@update_password')->name('users.update_password')->middleware('check_user');
Route::post('/users/update', 'UsersController@update')->name('users.update')->middleware('check_user');
Route::post('/users/store', 'UsersController@store')->name('users.store')->middleware('check_user');
Route::post('/users/delete', 'UsersController@delete')->name('users.delete')->middleware('check_user');

Route::post('/users_proposals/export_pmt_assigned_proposal_to_dpmis', 'UsersController@export_pmt_assigned_proposal_to_dpmis')->name('users.export_pmt_assigned_proposal_to_dpmis')->middleware('check_user');


//Libraries

//User Privileges
Route::get('/user_privileges/table', 'LibUserPrivilegesController@table')->name('user_privileges.table')->middleware('check_user');
Route::get('/user_privileges/show', 'LibUserPrivilegesController@show')->name('user_privileges.show')->middleware('check_user');
Route::post('/user_privileges/update', 'LibUserPrivilegesController@update')->name('user_privileges.update')->middleware('check_user');
Route::post('/user_privileges/store', 'LibUserPrivilegesController@store')->name('user_privileges.store')->middleware('check_user');
Route::post('/user_privileges/delete', 'LibUserPrivilegesController@delete')->name('user_privileges.delete')->middleware('check_user');
//Beneficiary
Route::get('/beneficiary/table', 'LibBeneficiaryController@table')->name('beneficiary.table')->middleware('check_user');
Route::get('/beneficiary/show', 'LibBeneficiaryController@show')->name('beneficiary.show')->middleware('check_user');
Route::post('/beneficiary/update', 'LibBeneficiaryController@update')->name('beneficiary.update')->middleware('check_user');
Route::post('/beneficiary/store', 'LibBeneficiaryController@store')->name('beneficiary.store')->middleware('check_user');
Route::post('/beneficiary/delete', 'LibBeneficiaryController@delete')->name('beneficiary.delete')->middleware('check_user');

//Call For Proposals
Route::get('/call_for_proposals/table', 'LibCallForProposalsController@table')->name('call_for_proposals.table')->middleware('check_user');
Route::get('/call_for_proposals/show', 'LibCallForProposalsController@show')->name('call_for_proposals.show')->middleware('check_user');
Route::post('/call_for_proposals/update', 'LibCallForProposalsController@update')->name('call_for_proposals.update')->middleware('check_user');
Route::post('/call_for_proposals/store', 'LibCallForProposalsController@store')->name('call_for_proposals.store')->middleware('check_user');
Route::post('/call_for_proposals/delete', 'LibCallForProposalsController@delete')->name('call_for_proposals.delete')->middleware('check_user');

//Document Types
Route::get('/document_types/show_all', 'LibDocumentTypesController@show_all')->name('document_types.show_all')->middleware('check_user');
Route::get('/document_types/table', 'LibDocumentTypesController@table')->name('document_types.table')->middleware('check_user');
Route::get('/document_types/show', 'LibDocumentTypesController@show')->name('document_types.show')->middleware('check_user');
Route::post('/document_types/update', 'LibDocumentTypesController@update')->name('document_types.update')->middleware('check_user');
Route::post('/document_types/store', 'LibDocumentTypesController@store')->name('document_types.store')->middleware('check_user');
Route::post('/document_types/delete', 'LibDocumentTypesController@delete')->name('document_types.delete')->middleware('check_user');

//Impact Types
Route::get('/impact_types/table', 'LibImpactTypesController@table')->name('impact_types.table')->middleware('check_user');
Route::get('/impact_types/show', 'LibImpactTypesController@show')->name('impact_types.show')->middleware('check_user');
Route::post('/impact_types/update', 'LibImpactTypesController@update')->name('impact_types.update')->middleware('check_user');
Route::post('/impact_types/store', 'LibImpactTypesController@store')->name('impact_types.store')->middleware('check_user');
Route::post('/impact_types/delete', 'LibImpactTypesController@delete')->name('impact_types.delete')->middleware('check_user');

//Output Types
Route::get('/output_types/table', 'LibOutputTypesController@table')->name('output_types.table')->middleware('check_user');
Route::get('/output_types/show', 'LibOutputTypesController@show')->name('output_types.show')->middleware('check_user');
Route::post('/output_types/update', 'LibOutputTypesController@update')->name('output_types.update')->middleware('check_user');
Route::post('/output_types/store', 'LibOutputTypesController@store')->name('output_types.store')->middleware('check_user');
Route::post('/output_types/delete', 'LibOutputTypesController@delete')->name('output_types.delete')->middleware('check_user');

//Research Types
Route::get('/research_types/table', 'LibResearchTypesController@table')->name('research_types.table')->middleware('check_user');
Route::get('/research_types/show', 'LibResearchTypesController@show')->name('research_types.show')->middleware('check_user');
Route::post('/research_types/update', 'LibResearchTypesController@update')->name('research_types.update')->middleware('check_user');
Route::post('/research_types/store', 'LibResearchTypesController@store')->name('research_types.store')->middleware('check_user');
Route::post('/research_types/delete', 'LibResearchTypesController@delete')->name('research_types.delete')->middleware('check_user');

//Proposal Types
Route::get('/proposal_types/table', 'LibProposalTypesController@table')->name('proposal_types.table')->middleware('check_user');
Route::get('/proposal_types/show', 'LibProposalTypesController@show')->name('proposal_types.show')->middleware('check_user');
Route::post('/proposal_types/update', 'LibProposalTypesController@update')->name('proposal_types.update')->middleware('check_user');
Route::post('/proposal_types/store', 'LibProposalTypesController@store')->name('proposal_types.store')->middleware('check_user');
Route::post('/proposal_types/delete', 'LibProposalTypesController@delete')->name('proposal_types.delete')->middleware('check_user');

//Proposal Status
Route::get('/proposal_status/table', 'LibProposalStatusController@table')->name('proposal_status.table')->middleware('check_user');
Route::get('/proposal_status/show', 'LibProposalStatusController@show')->name('proposal_status.show')->middleware('check_user');
Route::post('/proposal_status/update', 'LibProposalStatusController@update')->name('proposal_status.update')->middleware('check_user');
Route::post('/proposal_status/store', 'LibProposalStatusController@store')->name('proposal_status.store')->middleware('check_user');
Route::post('/proposal_status/delete', 'LibProposalStatusController@delete')->name('proposal_status.delete')->middleware('check_user');

//R & D Policy
Route::get('/rd_policy/table', 'LibRDPolicyController@table')->name('rd_policy.table')->middleware('check_user');
Route::get('/rd_policy/show', 'LibRDPolicyController@show')->name('rd_policy.show')->middleware('check_user');
Route::post('/rd_policy/update', 'LibRDPolicyController@update')->name('rd_policy.update')->middleware('check_user');
Route::post('/rd_policy/store', 'LibRDPolicyController@store')->name('rd_policy.store')->middleware('check_user');
Route::post('/rd_policy/delete', 'LibRDPolicyController@delete')->name('rd_policy.delete')->middleware('check_user');

//R & D Policy Status
Route::get('/rd_policy_status/table', 'LibRDPolicyStatusController@table')->name('rd_policy_status.table')->middleware('check_user');
Route::get('/rd_policy_status/show', 'LibRDPolicyStatusController@show')->name('rd_policy_status.show')->middleware('check_user');
Route::post('/rd_policy_status/update', 'LibRDPolicyStatusController@update')->name('rd_policy_status.update')->middleware('check_user');
Route::post('/rd_policy_status/store', 'LibRDPolicyStatusController@store')->name('rd_policy_status.store')->middleware('check_user');
Route::post('/rd_policy_status/delete', 'LibRDPolicyStatusController@delete')->name('rd_policy_status.delete')->middleware('check_user');

//R & D Policy Areas
Route::get('/rd_policy_areas/table', 'LibRDPolicyAreasController@table')->name('rd_policy_areas.table')->middleware('check_user');
Route::get('/rd_policy_areas/show', 'LibRDPolicyAreasController@show')->name('rd_policy_areas.show')->middleware('check_user');
Route::post('/rd_policy_areas/update', 'LibRDPolicyAreasController@update')->name('rd_policy_areas.update')->middleware('check_user');
Route::post('/rd_policy_areas/store', 'LibRDPolicyAreasController@store')->name('rd_policy_areas.store')->middleware('check_user');
Route::post('/rd_policy_areas/delete', 'LibRDPolicyAreasController@delete')->name('rd_policy_areas.delete')->middleware('check_user');

//R & D Policy Programs
Route::get('/rd_policy_programs/table', 'LibRDPolicyProgramsController@table')->name('rd_policy_programs.table')->middleware('check_user');
Route::get('/rd_policy_programs/show', 'LibRDPolicyProgramsController@show')->name('rd_policy_programs.show')->middleware('check_user');
Route::post('/rd_policy_programs/update', 'LibRDPolicyProgramsController@update')->name('rd_policy_programs.update')->middleware('check_user');
Route::post('/rd_policy_programs/store', 'LibRDPolicyProgramsController@store')->name('rd_policy_programs.store')->middleware('check_user');
Route::post('/rd_policy_programs/delete', 'LibRDPolicyProgramsController@delete')->name('rd_policy_programs.delete')->middleware('check_user');


//Reports
Route::get('/reports/view_proposal_count_by_type', 'ReportsController@view_proposal_count_by_type')->name('reports.view_proposal_count_by_type')->middleware('check_user');
Route::get('/reports/view_proposal_count_by_agency', 'ReportsController@view_proposal_count_by_agency')->name('reports.view_proposal_count_by_agency')->middleware('check_user');
Route::get('/reports/view_proposal_count_by_region', 'ReportsController@view_proposal_count_by_region')->name('reports.view_proposal_count_by_region')->middleware('check_user');
Route::get('/reports/view_dost_budget', 'ReportsController@view_dost_budget')->name('reports.view_dost_budget')->middleware('check_user');
Route::get('/reports/view_counterpart_budget', 'ReportsController@view_counterpart_budget')->name('reports.view_counterpart_budget')->middleware('check_user');

Route::get('/reports/view_proposal_count_by_month', 'ReportsController@view_proposal_count_by_month')->name('reports.view_proposal_count_by_month')->middleware('check_user');
Route::get('/reports/view_proposal_count_by_quarter', 'ReportsController@view_proposal_count_by_quarter')->name('reports.view_proposal_count_by_quarter')->middleware('check_user');
Route::get('/reports/view_proposal_count_by_year', 'ReportsController@view_proposal_count_by_year')->name('reports.view_proposal_count_by_year')->middleware('check_user');

// Added by Drei
Route::get('/reports/view_proposal_count_by_trd', 'ReportsController@view_proposal_count_by_trd')->name('reports.view_proposal_count_by_trd')->middleware('check_user');
Route::get('/reports/view_proposal_count_by_call', 'ReportsController@view_proposal_count_by_call')->name('reports.view_proposal_count_by_call')->middleware('check_user');
Route::post('/proposals/upload_comment_attachment', 'ProposalsController@upload_comment_attachment')->name('proposals.upload_comment_attachment');
Route::delete('/proposals/delete_comment_attachment', 'ProposalsController@delete_comment_attachment')->name('proposals.delete_comment_attachment');

//dashboard counter
Route::get('/reports/view_proposal_count_all', 'ReportsController@view_proposal_count_all')->name('reports.view_proposal_count_all')->middleware('check_user');
Route::get('/reports/view_proposal_count_from_dpmis', 'ReportsController@view_proposal_count_from_dpmis')->name('reports.view_proposal_count_from_dpmis')->middleware('check_user');
Route::get('/reports/view_proposal_count_received', 'ReportsController@view_proposal_count_received')->name('reports.view_proposal_count_received')->middleware('check_user');
Route::get('/reports/view_proposal_count_under_evaluation', 'ReportsController@view_proposal_count_under_evaluation')->name('reports.view_proposal_count_under_evaluation')->middleware('check_user');
Route::get('/reports/view_proposal_count_approved', 'ReportsController@view_proposal_count_approved')->name('reports.view_proposal_count_approved')->middleware('check_user');
Route::get('/reports/view_proposal_count_disapproved', 'ReportsController@view_proposal_count_disapproved')->name('reports.view_proposal_count_disapproved')->middleware('check_user');

