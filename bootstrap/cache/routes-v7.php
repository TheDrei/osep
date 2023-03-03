<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EvldSSLkx14PX5bp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EEbbqKAzyMOC67cZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'user.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2TPHma5DcLoysvJ6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eF9D1leWJQ1nYyYd',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4qM6bNB8PBCYndPM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lUXbOyN6ITg7iL6G',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/home' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/administration' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'administration',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/completed_projects' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'completed_projects',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/received_proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'received_proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/from_dpmis_proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'from_dpmis_proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/for_evaluation_proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'for_evaluation_proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/approved_proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'approved_proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/forward_comments_to_dpmis_proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'forward_comments_to_dpmis_proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/consolidated_comments_forwarded_to_dpmis_proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'consolidated_comments_forwarded_to_dpmis_proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/update_password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update_password',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/projects' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'projects',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/table/all_projects' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'projects.all_projects',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/projects/forward_project_status_to_dpmis' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'projects.forward_project_status_to_dpmis',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/table/all_proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.table_all_proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/table/received_proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.table_received_proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/table/from_dpmis_proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.table_from_dpmis_proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/table/for_evaluation_proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.table_for_evaluation_proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/table/forward_comments_to_dpmis_proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.table_forward_comments_to_dpmis_proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/table/consolidated_comments_forwarded_to_dpmis_proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.table_consolidated_comments_forwarded_to_dpmis_proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/table/approved_proposals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.table_approved_proposals',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/table/completed_projects' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'allcompletedprojects',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/view_forward_proposal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.view_forward_proposal',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/update_status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.update_status',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/export_statuses_to_dpmis' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.export_statuses_to_dpmis',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/forward_proposal_to_trd' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.forward_proposal_to_trd',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/upload_files' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.upload_files',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/show_lib_by_proposal_and_year' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.show_lib_by_proposal_and_year',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/show_lib_by_proposal_per_year' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.show_lib_by_proposal_per_year',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/show_proposal_version' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.show_proposal_version',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/forward_proposal_to_palihan' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.forward_proposal_to_palihan',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/download_proposal_files' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.download_proposal_files',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/forward_proposal_to_palihan_direct' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.forward_proposal_to_palihan_direct',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposal_implementation_date/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposal_implementation_date.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposal_researchers/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposal_researchers.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals_comment/show_all_comments_by_proposal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals_comment.show_all_comments_by_proposal',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals_comment/show_inline_comments_by_proposal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals_comment.show_inline_comments_by_proposal',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals_comment/show_outline_comments_by_proposal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals_comment.show_outline_comments_by_proposal',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals_comment/show_user_outline_comments_by_proposal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals_comment.show_user_outline_comments_by_proposal',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals_comment/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals_comment.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals_comment/store_outline_comments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals_comment.store_outline_comments',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals_comment/store_inline_comments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals_comment.store_inline_comments',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals_comment/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals_comment.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals_comment/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals_comment.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals_comment/forward_comments_to_dpmis' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals_comment.forward_comments_to_dpmis',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals_comment/delete_comments_by_proposal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals_comment.delete_comments_by_proposal',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/users/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'users.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/users/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'users.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/users/export_pmt_to_dpmis' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'users.export_pmt_to_dpmis',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/users/update_password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'users.update_password',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/users/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'users.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/users/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'users.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/users/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'users.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/users_proposals/export_pmt_assigned_proposal_to_dpmis' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'users.export_pmt_assigned_proposal_to_dpmis',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user_privileges/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user_privileges.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user_privileges/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user_privileges.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user_privileges/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user_privileges.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user_privileges/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user_privileges.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user_privileges/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user_privileges.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/beneficiary/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'beneficiary.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/beneficiary/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'beneficiary.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/beneficiary/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'beneficiary.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/beneficiary/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'beneficiary.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/beneficiary/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'beneficiary.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/call_for_proposals/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'call_for_proposals.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/call_for_proposals/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'call_for_proposals.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/call_for_proposals/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'call_for_proposals.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/call_for_proposals/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'call_for_proposals.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/call_for_proposals/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'call_for_proposals.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/document_types/show_all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_types.show_all',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/document_types/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_types.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/document_types/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_types.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/document_types/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_types.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/document_types/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_types.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/document_types/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'document_types.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/impact_types/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'impact_types.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/impact_types/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'impact_types.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/impact_types/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'impact_types.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/impact_types/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'impact_types.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/impact_types/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'impact_types.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/output_types/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'output_types.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/output_types/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'output_types.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/output_types/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'output_types.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/output_types/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'output_types.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/output_types/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'output_types.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/research_types/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'research_types.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/research_types/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'research_types.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/research_types/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'research_types.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/research_types/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'research_types.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/research_types/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'research_types.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposal_types/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposal_types.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposal_types/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposal_types.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposal_types/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposal_types.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposal_types/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposal_types.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposal_types/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposal_types.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposal_status/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposal_status.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposal_status/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposal_status.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposal_status/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposal_status.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposal_status/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposal_status.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposal_status/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposal_status.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_status/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_status.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_status/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_status.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_status/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_status.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_status/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_status.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_status/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_status.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_areas/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_areas.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_areas/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_areas.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_areas/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_areas.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_areas/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_areas.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_areas/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_areas.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_programs/table' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_programs.table',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_programs/show' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_programs.show',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_programs/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_programs.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_programs/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_programs.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rd_policy_programs/delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rd_policy_programs.delete',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_by_type' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_by_type',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_by_agency' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_by_agency',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_by_region' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_by_region',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_dost_budget' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_dost_budget',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_counterpart_budget' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_counterpart_budget',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_by_month' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_by_month',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_by_quarter' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_by_quarter',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_by_year' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_by_year',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_by_trd' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_by_trd',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_by_call' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_by_call',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/upload_comment_attachment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.upload_comment_attachment',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proposals/delete_comment_attachment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proposals.delete_comment_attachment',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_all',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_from_dpmis' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_from_dpmis',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_received' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_received',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_under_evaluation' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_under_evaluation',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_approved' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_approved',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/view_proposal_count_disapproved' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.view_proposal_count_disapproved',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/password/reset/([^/]++)(*:31))/?$}sDu',
    ),
    3 => 
    array (
      31 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::EvldSSLkx14PX5bp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\LoginController@routeApiUser',
        'controller' => 'App\\Http\\Controllers\\LoginController@routeApiUser',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::EvldSSLkx14PX5bp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::EEbbqKAzyMOC67cZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::EEbbqKAzyMOC67cZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::2TPHma5DcLoysvJ6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@login',
        'controller' => 'App\\Http\\Controllers\\PagesController@login',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::2TPHma5DcLoysvJ6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::eF9D1leWJQ1nYyYd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::eF9D1leWJQ1nYyYd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::4qM6bNB8PBCYndPM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::4qM6bNB8PBCYndPM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::lUXbOyN6ITg7iL6G' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@login',
        'controller' => 'App\\Http\\Controllers\\PagesController@login',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::lUXbOyN6ITg7iL6G',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'home',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@home',
        'controller' => 'App\\Http\\Controllers\\PagesController@home',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'administration' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'administration',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@administration',
        'controller' => 'App\\Http\\Controllers\\PagesController@administration',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'administration',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'user.logout' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'user.logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@proposals',
        'controller' => 'App\\Http\\Controllers\\PagesController@proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'completed_projects' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'completed_projects',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@completed_projects',
        'controller' => 'App\\Http\\Controllers\\PagesController@completed_projects',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'completed_projects',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'received_proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'received_proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@received_proposals',
        'controller' => 'App\\Http\\Controllers\\PagesController@received_proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'received_proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'from_dpmis_proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'from_dpmis_proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@from_dpmis_proposals',
        'controller' => 'App\\Http\\Controllers\\PagesController@from_dpmis_proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'from_dpmis_proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'for_evaluation_proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'for_evaluation_proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@for_evaluation_proposals',
        'controller' => 'App\\Http\\Controllers\\PagesController@for_evaluation_proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'for_evaluation_proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'approved_proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'approved_proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@approved_proposals',
        'controller' => 'App\\Http\\Controllers\\PagesController@approved_proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'approved_proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'forward_comments_to_dpmis_proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'forward_comments_to_dpmis_proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@forward_comments_to_dpmis_proposals',
        'controller' => 'App\\Http\\Controllers\\PagesController@forward_comments_to_dpmis_proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'forward_comments_to_dpmis_proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'consolidated_comments_forwarded_to_dpmis_proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'consolidated_comments_forwarded_to_dpmis_proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@consolidated_comments_forwarded_to_dpmis_proposals',
        'controller' => 'App\\Http\\Controllers\\PagesController@consolidated_comments_forwarded_to_dpmis_proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'consolidated_comments_forwarded_to_dpmis_proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update_password' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'update_password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@update_password',
        'controller' => 'App\\Http\\Controllers\\PagesController@update_password',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update_password',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'projects' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'projects',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\PagesController@projects',
        'controller' => 'App\\Http\\Controllers\\PagesController@projects',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'projects',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'projects.all_projects' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'table/all_projects',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProjectsController@all_projects',
        'controller' => 'App\\Http\\Controllers\\ProjectsController@all_projects',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'projects.all_projects',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'projects.forward_project_status_to_dpmis' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'projects/forward_project_status_to_dpmis',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProjectsController@forward_project_status_to_dpmis',
        'controller' => 'App\\Http\\Controllers\\ProjectsController@forward_project_status_to_dpmis',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'projects.forward_project_status_to_dpmis',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.table_all_proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals/table/all_proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@table_all_proposals',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@table_all_proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.table_all_proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.table_received_proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals/table/received_proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@table_received_proposals',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@table_received_proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.table_received_proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.table_from_dpmis_proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals/table/from_dpmis_proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@table_from_dpmis_proposals',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@table_from_dpmis_proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.table_from_dpmis_proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.table_for_evaluation_proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals/table/for_evaluation_proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@table_for_evaluation_proposals',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@table_for_evaluation_proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.table_for_evaluation_proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.table_forward_comments_to_dpmis_proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals/table/forward_comments_to_dpmis_proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@table_forward_comments_to_dpmis_proposals',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@table_forward_comments_to_dpmis_proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.table_forward_comments_to_dpmis_proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.table_consolidated_comments_forwarded_to_dpmis_proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals/table/consolidated_comments_forwarded_to_dpmis_proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@table_consolidated_comments_forwarded_to_dpmis_proposals',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@table_consolidated_comments_forwarded_to_dpmis_proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.table_consolidated_comments_forwarded_to_dpmis_proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.table_approved_proposals' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals/table/approved_proposals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@table_approved_proposals',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@table_approved_proposals',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.table_approved_proposals',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'allcompletedprojects' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'table/completed_projects',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\JSONController@allcompletedprojects',
        'controller' => 'App\\Http\\Controllers\\JSONController@allcompletedprojects',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'allcompletedprojects',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@show',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.view_forward_proposal' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals/view_forward_proposal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@view_forward_proposal',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@view_forward_proposal',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.view_forward_proposal',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.update_status' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposals/update_status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@update_status',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@update_status',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.update_status',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.export_statuses_to_dpmis' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposals/export_statuses_to_dpmis',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@export_statuses_to_dpmis',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@export_statuses_to_dpmis',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.export_statuses_to_dpmis',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.forward_proposal_to_trd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposals/forward_proposal_to_trd',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@forward_proposal_to_trd',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@forward_proposal_to_trd',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.forward_proposal_to_trd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.upload_files' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposals/upload_files',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@upload_files',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@upload_files',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.upload_files',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.show_lib_by_proposal_and_year' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals/show_lib_by_proposal_and_year',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@show_lib_by_proposal_and_year',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@show_lib_by_proposal_and_year',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.show_lib_by_proposal_and_year',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.show_lib_by_proposal_per_year' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals/show_lib_by_proposal_per_year',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@show_lib_by_proposal_per_year',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@show_lib_by_proposal_per_year',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.show_lib_by_proposal_per_year',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.show_proposal_version' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals/show_proposal_version',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@show_proposal_version',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@show_proposal_version',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.show_proposal_version',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.forward_proposal_to_palihan' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposals/forward_proposal_to_palihan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@forward_proposal_to_palihan',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@forward_proposal_to_palihan',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.forward_proposal_to_palihan',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.download_proposal_files' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals/download_proposal_files',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@download_proposal_files',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@download_proposal_files',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.download_proposal_files',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.forward_proposal_to_palihan_direct' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposals/forward_proposal_to_palihan_direct',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@forward_proposal_to_palihan_direct',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@forward_proposal_to_palihan_direct',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.forward_proposal_to_palihan_direct',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposal_implementation_date.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposal_implementation_date/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalImplementationDateController@show',
        'controller' => 'App\\Http\\Controllers\\ProposalImplementationDateController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposal_implementation_date.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposal_researchers.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposal_researchers/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalResearchersController@show',
        'controller' => 'App\\Http\\Controllers\\ProposalResearchersController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposal_researchers.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals_comment.show_all_comments_by_proposal' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals_comment/show_all_comments_by_proposal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsCommentController@show_all_comments_by_proposal',
        'controller' => 'App\\Http\\Controllers\\ProposalsCommentController@show_all_comments_by_proposal',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals_comment.show_all_comments_by_proposal',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals_comment.show_inline_comments_by_proposal' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals_comment/show_inline_comments_by_proposal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsCommentController@show_inline_comments_by_proposal',
        'controller' => 'App\\Http\\Controllers\\ProposalsCommentController@show_inline_comments_by_proposal',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals_comment.show_inline_comments_by_proposal',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals_comment.show_outline_comments_by_proposal' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals_comment/show_outline_comments_by_proposal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsCommentController@show_outline_comments_by_proposal',
        'controller' => 'App\\Http\\Controllers\\ProposalsCommentController@show_outline_comments_by_proposal',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals_comment.show_outline_comments_by_proposal',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals_comment.show_user_outline_comments_by_proposal' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals_comment/show_user_outline_comments_by_proposal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsCommentController@show_user_outline_comments_by_proposal',
        'controller' => 'App\\Http\\Controllers\\ProposalsCommentController@show_user_outline_comments_by_proposal',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals_comment.show_user_outline_comments_by_proposal',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals_comment.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposals_comment/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsCommentController@show',
        'controller' => 'App\\Http\\Controllers\\ProposalsCommentController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals_comment.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals_comment.store_outline_comments' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposals_comment/store_outline_comments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsCommentController@store_outline_comments',
        'controller' => 'App\\Http\\Controllers\\ProposalsCommentController@store_outline_comments',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals_comment.store_outline_comments',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals_comment.store_inline_comments' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposals_comment/store_inline_comments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsCommentController@store_inline_comments',
        'controller' => 'App\\Http\\Controllers\\ProposalsCommentController@store_inline_comments',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals_comment.store_inline_comments',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals_comment.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposals_comment/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsCommentController@update',
        'controller' => 'App\\Http\\Controllers\\ProposalsCommentController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals_comment.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals_comment.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposals_comment/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsCommentController@delete',
        'controller' => 'App\\Http\\Controllers\\ProposalsCommentController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals_comment.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals_comment.forward_comments_to_dpmis' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposals_comment/forward_comments_to_dpmis',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsCommentController@forward_comments_to_dpmis',
        'controller' => 'App\\Http\\Controllers\\ProposalsCommentController@forward_comments_to_dpmis',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals_comment.forward_comments_to_dpmis',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals_comment.delete_comments_by_proposal' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'proposals_comment/delete_comments_by_proposal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsCommentController@delete_comments_by_proposal',
        'controller' => 'App\\Http\\Controllers\\ProposalsCommentController@delete_comments_by_proposal',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals_comment.delete_comments_by_proposal',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'users/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\UsersController@table',
        'controller' => 'App\\Http\\Controllers\\UsersController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'users.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'users/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\UsersController@show',
        'controller' => 'App\\Http\\Controllers\\UsersController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'users.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.export_pmt_to_dpmis' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/export_pmt_to_dpmis',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\UsersController@export_pmt_to_dpmis',
        'controller' => 'App\\Http\\Controllers\\UsersController@export_pmt_to_dpmis',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'users.export_pmt_to_dpmis',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.update_password' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/update_password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\UsersController@update_password',
        'controller' => 'App\\Http\\Controllers\\UsersController@update_password',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'users.update_password',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\UsersController@update',
        'controller' => 'App\\Http\\Controllers\\UsersController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'users.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\UsersController@store',
        'controller' => 'App\\Http\\Controllers\\UsersController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'users.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\UsersController@delete',
        'controller' => 'App\\Http\\Controllers\\UsersController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'users.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'users.export_pmt_assigned_proposal_to_dpmis' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'users_proposals/export_pmt_assigned_proposal_to_dpmis',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\UsersController@export_pmt_assigned_proposal_to_dpmis',
        'controller' => 'App\\Http\\Controllers\\UsersController@export_pmt_assigned_proposal_to_dpmis',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'users.export_pmt_assigned_proposal_to_dpmis',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'user_privileges.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user_privileges/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibUserPrivilegesController@table',
        'controller' => 'App\\Http\\Controllers\\LibUserPrivilegesController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'user_privileges.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'user_privileges.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'user_privileges/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibUserPrivilegesController@show',
        'controller' => 'App\\Http\\Controllers\\LibUserPrivilegesController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'user_privileges.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'user_privileges.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user_privileges/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibUserPrivilegesController@update',
        'controller' => 'App\\Http\\Controllers\\LibUserPrivilegesController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'user_privileges.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'user_privileges.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user_privileges/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibUserPrivilegesController@store',
        'controller' => 'App\\Http\\Controllers\\LibUserPrivilegesController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'user_privileges.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'user_privileges.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user_privileges/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibUserPrivilegesController@delete',
        'controller' => 'App\\Http\\Controllers\\LibUserPrivilegesController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'user_privileges.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'beneficiary.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'beneficiary/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibBeneficiaryController@table',
        'controller' => 'App\\Http\\Controllers\\LibBeneficiaryController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'beneficiary.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'beneficiary.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'beneficiary/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibBeneficiaryController@show',
        'controller' => 'App\\Http\\Controllers\\LibBeneficiaryController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'beneficiary.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'beneficiary.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'beneficiary/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibBeneficiaryController@update',
        'controller' => 'App\\Http\\Controllers\\LibBeneficiaryController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'beneficiary.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'beneficiary.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'beneficiary/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibBeneficiaryController@store',
        'controller' => 'App\\Http\\Controllers\\LibBeneficiaryController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'beneficiary.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'beneficiary.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'beneficiary/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibBeneficiaryController@delete',
        'controller' => 'App\\Http\\Controllers\\LibBeneficiaryController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'beneficiary.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'call_for_proposals.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'call_for_proposals/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibCallForProposalsController@table',
        'controller' => 'App\\Http\\Controllers\\LibCallForProposalsController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'call_for_proposals.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'call_for_proposals.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'call_for_proposals/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibCallForProposalsController@show',
        'controller' => 'App\\Http\\Controllers\\LibCallForProposalsController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'call_for_proposals.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'call_for_proposals.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'call_for_proposals/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibCallForProposalsController@update',
        'controller' => 'App\\Http\\Controllers\\LibCallForProposalsController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'call_for_proposals.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'call_for_proposals.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'call_for_proposals/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibCallForProposalsController@store',
        'controller' => 'App\\Http\\Controllers\\LibCallForProposalsController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'call_for_proposals.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'call_for_proposals.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'call_for_proposals/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibCallForProposalsController@delete',
        'controller' => 'App\\Http\\Controllers\\LibCallForProposalsController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'call_for_proposals.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'document_types.show_all' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'document_types/show_all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibDocumentTypesController@show_all',
        'controller' => 'App\\Http\\Controllers\\LibDocumentTypesController@show_all',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'document_types.show_all',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'document_types.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'document_types/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibDocumentTypesController@table',
        'controller' => 'App\\Http\\Controllers\\LibDocumentTypesController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'document_types.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'document_types.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'document_types/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibDocumentTypesController@show',
        'controller' => 'App\\Http\\Controllers\\LibDocumentTypesController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'document_types.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'document_types.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'document_types/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibDocumentTypesController@update',
        'controller' => 'App\\Http\\Controllers\\LibDocumentTypesController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'document_types.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'document_types.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'document_types/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibDocumentTypesController@store',
        'controller' => 'App\\Http\\Controllers\\LibDocumentTypesController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'document_types.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'document_types.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'document_types/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibDocumentTypesController@delete',
        'controller' => 'App\\Http\\Controllers\\LibDocumentTypesController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'document_types.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'impact_types.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'impact_types/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibImpactTypesController@table',
        'controller' => 'App\\Http\\Controllers\\LibImpactTypesController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'impact_types.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'impact_types.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'impact_types/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibImpactTypesController@show',
        'controller' => 'App\\Http\\Controllers\\LibImpactTypesController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'impact_types.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'impact_types.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'impact_types/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibImpactTypesController@update',
        'controller' => 'App\\Http\\Controllers\\LibImpactTypesController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'impact_types.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'impact_types.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'impact_types/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibImpactTypesController@store',
        'controller' => 'App\\Http\\Controllers\\LibImpactTypesController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'impact_types.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'impact_types.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'impact_types/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibImpactTypesController@delete',
        'controller' => 'App\\Http\\Controllers\\LibImpactTypesController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'impact_types.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'output_types.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'output_types/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibOutputTypesController@table',
        'controller' => 'App\\Http\\Controllers\\LibOutputTypesController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'output_types.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'output_types.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'output_types/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibOutputTypesController@show',
        'controller' => 'App\\Http\\Controllers\\LibOutputTypesController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'output_types.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'output_types.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'output_types/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibOutputTypesController@update',
        'controller' => 'App\\Http\\Controllers\\LibOutputTypesController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'output_types.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'output_types.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'output_types/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibOutputTypesController@store',
        'controller' => 'App\\Http\\Controllers\\LibOutputTypesController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'output_types.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'output_types.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'output_types/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibOutputTypesController@delete',
        'controller' => 'App\\Http\\Controllers\\LibOutputTypesController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'output_types.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'research_types.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'research_types/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibResearchTypesController@table',
        'controller' => 'App\\Http\\Controllers\\LibResearchTypesController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'research_types.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'research_types.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'research_types/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibResearchTypesController@show',
        'controller' => 'App\\Http\\Controllers\\LibResearchTypesController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'research_types.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'research_types.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'research_types/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibResearchTypesController@update',
        'controller' => 'App\\Http\\Controllers\\LibResearchTypesController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'research_types.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'research_types.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'research_types/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibResearchTypesController@store',
        'controller' => 'App\\Http\\Controllers\\LibResearchTypesController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'research_types.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'research_types.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'research_types/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibResearchTypesController@delete',
        'controller' => 'App\\Http\\Controllers\\LibResearchTypesController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'research_types.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposal_types.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposal_types/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibProposalTypesController@table',
        'controller' => 'App\\Http\\Controllers\\LibProposalTypesController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposal_types.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposal_types.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposal_types/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibProposalTypesController@show',
        'controller' => 'App\\Http\\Controllers\\LibProposalTypesController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposal_types.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposal_types.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposal_types/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibProposalTypesController@update',
        'controller' => 'App\\Http\\Controllers\\LibProposalTypesController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposal_types.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposal_types.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposal_types/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibProposalTypesController@store',
        'controller' => 'App\\Http\\Controllers\\LibProposalTypesController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposal_types.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposal_types.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposal_types/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibProposalTypesController@delete',
        'controller' => 'App\\Http\\Controllers\\LibProposalTypesController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposal_types.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposal_status.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposal_status/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibProposalStatusController@table',
        'controller' => 'App\\Http\\Controllers\\LibProposalStatusController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposal_status.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposal_status.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proposal_status/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibProposalStatusController@show',
        'controller' => 'App\\Http\\Controllers\\LibProposalStatusController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposal_status.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposal_status.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposal_status/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibProposalStatusController@update',
        'controller' => 'App\\Http\\Controllers\\LibProposalStatusController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposal_status.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposal_status.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposal_status/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibProposalStatusController@store',
        'controller' => 'App\\Http\\Controllers\\LibProposalStatusController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposal_status.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposal_status.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposal_status/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibProposalStatusController@delete',
        'controller' => 'App\\Http\\Controllers\\LibProposalStatusController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposal_status.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rd_policy/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyController@table',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rd_policy/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyController@show',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rd_policy/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyController@update',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rd_policy/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyController@store',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rd_policy/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyController@delete',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_status.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rd_policy_status/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyStatusController@table',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyStatusController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_status.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_status.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rd_policy_status/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyStatusController@show',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyStatusController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_status.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_status.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rd_policy_status/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyStatusController@update',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyStatusController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_status.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_status.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rd_policy_status/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyStatusController@store',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyStatusController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_status.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_status.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rd_policy_status/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyStatusController@delete',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyStatusController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_status.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_areas.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rd_policy_areas/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyAreasController@table',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyAreasController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_areas.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_areas.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rd_policy_areas/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyAreasController@show',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyAreasController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_areas.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_areas.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rd_policy_areas/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyAreasController@update',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyAreasController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_areas.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_areas.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rd_policy_areas/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyAreasController@store',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyAreasController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_areas.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_areas.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rd_policy_areas/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyAreasController@delete',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyAreasController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_areas.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_programs.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rd_policy_programs/table',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyProgramsController@table',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyProgramsController@table',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_programs.table',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_programs.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rd_policy_programs/show',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyProgramsController@show',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyProgramsController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_programs.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_programs.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rd_policy_programs/update',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyProgramsController@update',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyProgramsController@update',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_programs.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_programs.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rd_policy_programs/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyProgramsController@store',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyProgramsController@store',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_programs.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'rd_policy_programs.delete' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rd_policy_programs/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\LibRDPolicyProgramsController@delete',
        'controller' => 'App\\Http\\Controllers\\LibRDPolicyProgramsController@delete',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'rd_policy_programs.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_by_type' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_by_type',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_type',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_type',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_by_type',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_by_agency' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_by_agency',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_agency',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_agency',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_by_agency',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_by_region' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_by_region',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_region',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_region',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_by_region',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_dost_budget' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_dost_budget',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_dost_budget',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_dost_budget',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_dost_budget',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_counterpart_budget' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_counterpart_budget',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_counterpart_budget',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_counterpart_budget',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_counterpart_budget',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_by_month' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_by_month',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_month',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_month',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_by_month',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_by_quarter' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_by_quarter',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_quarter',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_quarter',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_by_quarter',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_by_year' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_by_year',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_year',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_year',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_by_year',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_by_trd' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_by_trd',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_trd',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_trd',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_by_trd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_by_call' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_by_call',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_call',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_by_call',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_by_call',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.upload_comment_attachment' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proposals/upload_comment_attachment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@upload_comment_attachment',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@upload_comment_attachment',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.upload_comment_attachment',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'proposals.delete_comment_attachment' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'proposals/delete_comment_attachment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ProposalsController@delete_comment_attachment',
        'controller' => 'App\\Http\\Controllers\\ProposalsController@delete_comment_attachment',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'proposals.delete_comment_attachment',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_all' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_all',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_all',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_all',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_from_dpmis' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_from_dpmis',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_from_dpmis',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_from_dpmis',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_from_dpmis',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_received' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_received',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_received',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_received',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_received',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_under_evaluation' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_under_evaluation',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_under_evaluation',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_under_evaluation',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_under_evaluation',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_approved' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_approved',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_approved',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_approved',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_approved',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'reports.view_proposal_count_disapproved' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/view_proposal_count_disapproved',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check_user',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_disapproved',
        'controller' => 'App\\Http\\Controllers\\ReportsController@view_proposal_count_disapproved',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'reports.view_proposal_count_disapproved',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
  ),
)
);
