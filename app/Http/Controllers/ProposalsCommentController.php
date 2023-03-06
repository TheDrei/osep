<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request as GRequest;
use GuzzleHttp\Psr7\Response as GResponse;
use App\ProposalsComment;
use Carbon\Carbon;
use DB;
use File;
use Response;
use DataTables;
use Session;
use View;

class ProposalsCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */

    public function store_outline_comments(Request $request)
    {
        if($request->ajax()){
            $request->session()->forget('success');
            $request->session()->forget('error');
            $proposal_id = $request->get('proposal_id');
            $proposal_latest_status = DB::table('proposal_has_lib_proposal_status')->where('proposal_idproposal', $proposal_id)->where('is_active', 1)->pluck('lib_proposal_status_idlib_proposal_status')->first();
            if($proposal_latest_status == 16 || $proposal_latest_status == 47) {
                Session::flash('error', 'The proposal status does not allow commenting. Please contact OED-RD or lead TRD to adjust the proposal status.');
                return Response::json([
                 'view' => View::make('partials/flash-messages')->render(),
                 'status'=>'0'
                ]);
            }
            $idcomment_type = Auth::user()->privilege;
            $users_id = Auth::user()->id;
            $version_id = (isset($request->get('outline_comments')['version_id'])) ? $request->get('outline_comments')['version_id'] : '';
            $comment_section_id = (isset($request->get('outline_comments')['comment_section_id'])) ? $request->get('outline_comments')['comment_section_id'] : '';
            $proposal_field_id = (isset($request->get('outline_comments')['proposal_field_id'])) ? $request->get('outline_comments')['proposal_field_id'] : '';
            $uniqueName = (isset($request->get('outline_comments')['uniqueName'])) ? $request->get('outline_comments')['uniqueName'] : '';
            $proposal_field = (isset($request->get('outline_comments')['proposal_field'])) ? $request->get('outline_comments')['proposal_field'] : '';
            $proposal_field_class = (isset($request->get('outline_comments')['proposal_field_class'])) ? $request->get('outline_comments')['proposal_field_class'] : '';
            $comment_section = (isset($request->get('outline_comments')['comment_section'])) ? $request->get('outline_comments')['comment_section'] : '';
            $comment_order = (isset($request->get('outline_comments')['comment_order'])) ? $request->get('outline_comments')['comment_order'] : '';
            $comment_text = (isset($request->get('outline_comments')['comment_text'])) ? $request->get('outline_comments')['comment_text'] : '';
            $comments = (isset($request->get('outline_comments')['comments'])) ? $request->get('outline_comments')['comments'] : '';
            $style = (isset($request->get('outline_comments')['style'])) ? $request->get('outline_comments')['style'] : '';
            $is_inline = (isset($request->get('outline_comments')['is_inline'])) ? $request->get('outline_comments')['is_inline'] : '';

            $proposals_comment = new ProposalsComment([
                'proposal_idproposal' => $proposal_id,
                'idcomment_type' => $idcomment_type,
                'users_id' => $users_id,
                'version_id' => $version_id,
                'comment_section_id' => $comment_section_id,
                'proposal_field_id' => $proposal_field_id,
                'uniqueName' => $uniqueName,
                'proposal_field' => $proposal_field,
                'proposal_field_class' => $proposal_field_class,
                'comment_section' => $comment_section,
                'comment_order' => $comment_order,
                'comment_text' => $comment_text,
                'comments' => $comments,
                'style' => $style,
                'is_inline' => $is_inline
            ]);
            try {
                $proposals_comment->save();
                $proposals_comment_id = $proposals_comment->id;
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Comment has not been added');
                return Response::json([
                 'view' => View::make('partials/flash-messages')->render(),
                 'status'=>'0'
                ]);
            }
            Session::flash('success', 'Comment has been added');
            return Response::json([
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'1',
                'proposals_comment_id' => $proposals_comment_id
            ]);
        
        }
    }


    public function store_inline_comments(Request $request){
        if($request->ajax()) {
            $proposal_id = $request->get('proposal_id');
            $idcomment_type = Auth::user()->privilege;
            $users_id = Auth::user()->id;
            $inline_comments = $request->get('inline_comments');
            for ($i=0; $i < count($inline_comments); $i++) { 
                $version_id = (isset($inline_comments[$i]['version_id'])) ? $inline_comments[$i]['version_id'] : '';
                $comment_section_id = (isset($inline_comments[$i]['comment_section_id'])) ? $inline_comments[$i]['comment_section_id'] : '';
                $proposal_field_id = (isset($inline_comments[$i]['proposal_field_id'])) ? $inline_comments[$i]['proposal_field_id'] : '';
                $uniqueName = (isset($inline_comments[$i]['uniqueName'])) ? $inline_comments[$i]['uniqueName'] : '';
                $proposal_field = (isset($inline_comments[$i]['proposal_field'])) ? $inline_comments[$i]['proposal_field'] : '';
                $proposal_field_class = (isset($inline_comments[$i]['proposal_field_class'])) ? $inline_comments[$i]['proposal_field_class'] : '';
                $comment_section = (isset($inline_comments[$i]['comment_section'])) ? $inline_comments[$i]['comment_section'] : '';
                $comment_order = (isset($inline_comments[$i]['order'])) ? $inline_comments[$i]['order'] : '';
                $comment_text = (isset($inline_comments[$i]['text'])) ? $inline_comments[$i]['text'] : '';
                $comments = (isset($inline_comments[$i]['comments'])) ? $inline_comments[$i]['comments'] : '';
                $style = (isset($inline_comments[$i]['style'])) ? $inline_comments[$i]['style'] : '';
                $is_inline = (isset($inline_comments[$i]['is_inline'])) ? $inline_comments[$i]['is_inline'] : '';

                $check_if_exists = DB::table('proposal_comments')
                                    ->where('proposal_idproposal', $proposal_id)
                                    ->where('users_id', $users_id)
                                    ->where('idcomment_type', $idcomment_type)
                                    ->where('comment_section_id', $comment_section_id)
                                    ->where('proposal_field_id', $proposal_field_id)
                                    ->where('proposal_field_class', $proposal_field_class)
                                    ->where('comment_order', $comment_order)
                                    ->where('comment_text', $comment_text)
                                    ->where('comment_section', $comment_section)
                                    ->where('is_inline', '1')
                                    ->get()
                                    ->count();

                if($check_if_exists <= 0){
                    $proposals_comment = new ProposalsComment([
                        'proposal_idproposal' => $proposal_id,
                        'idcomment_type' => $idcomment_type,
                        'users_id' => $users_id,
                        'version_id' => $version_id,
                        'comment_section_id' => $comment_section_id,
                        'proposal_field_id' => $proposal_field_id,
                        'uniqueName' => $uniqueName,
                        'proposal_field' => $proposal_field,
                        'proposal_field_class' => $proposal_field_class,
                        'comment_section' => $comment_section,
                        'comment_order' => $comment_order,
                        'comment_text' => $comment_text,
                        'comments' => $comments,
                        'style' => $style,
                        'is_inline' => $is_inline
                    ]);
                    try {
                        $proposals_comment->save();
                        $proposals_comment_id = $proposals_comment->id;
                    } catch (Exception $e) {
                        dd($e);
                        Session::flash('error', 'Comment has not been added');
                        return Response::json([
                         'view' => View::make('partials/flash-messages')->render(),
                         'status'=>'0'
                        ]);
                    }
                }
            }
            Session::flash('success', 'Comment has been added');
            return Response::json([
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'1',
                'proposals_comment_id' => $proposals_comment_id
            ]);

        }
    }

    public function show_all_comments_by_proposal(Request $request){
        if($request->ajax()){
            $proposal_id = $request->get('proposal_id');
            try {
                $proposal_comments = DB::table('proposal_comments')
                                        ->leftJoin('users', 'proposal_comments.users_id', '=', 'users.id')
                                        ->where('proposal_idproposal', $proposal_id)
                                        ->where('proposal_comments.is_active', 1)
                                        ->select(
                                            'proposal_comments.*',
                                            'users.username'
                                        )
                                        ->orderBy('username')
                                        ->get();
                $proposal_select = app('App\Http\Controllers\ProposalsController')->show($request);

                // dd($proposal_select);
                if(!is_null($proposal_comments)) Session::flash('proposal_comments', $proposal_comments);
                
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Comments have failed to load');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'0'
                ]);
            }
            Session::flash('success', 'Comments have successfully loaded');
            return Response::json([
                'comment_form' => View::make('forms/comment_form')->render(),
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'1',
                'user_privilege' => Auth::user()->privilege
            ]);

        }
    }
    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request  $request
     */
    public function show_inline_comments_by_proposal(Request $request)
    {
        if($request->ajax()){
            $proposal_id = $request->get('proposal_id');
            $comment_type = $request->get('comment_type');
            try {
                $proposal_comments = DB::table('proposal_comments')
                                        ->where('proposal_idproposal', $proposal_id)
                                        ->where('is_active', 1)
                                        ->where('is_inline', 1)
                                        ->where(function($q) use ($comment_type) {
                                          if($comment_type) {
                                            $q->where('proposal_comments.idcomment_type', $comment_type);
                                          }
                                        })
                                        ->orderBy('comment_section')
                                        ->orderBy('proposal_field_id')
                                        ->orderBy('comment_order', 'DESC')
                                        ->get();
                
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Inline comments have failed to load');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'0'
                ]);
            }
            Session::flash('success', 'Inline comments have successfully loaded');
            return Response::json([
                'inline_comments' => $proposal_comments,
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'1'
            ]);

        }
    }

    public function show_outline_comments_by_proposal(Request $request){
        if($request->ajax()){
            $proposal_id = $request->get('proposal_id');
            $comment_type = $request->get('comment_type');
            $has_access = false;
            try {
                $proposal_lead_trd = DB::table('proposal_lead_trd')
                                        ->where('proposal_idproposal', $proposal_id)
                                        ->where('is_active', 1)
                                        ->pluck('division_iddivision')
                                        ->first();
                $proposal_comments = DB::table('proposal_comments')
                                        ->leftJoin('users', 'proposal_comments.users_id', '=', 'users.id')
                                        ->where('proposal_idproposal', $proposal_id)
                                        ->where('proposal_comments.is_active', 1)
                                        ->where('is_inline', 0)
                                        ->where(function($q) use ($comment_type, $proposal_lead_trd) {
                                            if($comment_type) {
                                                $q->where('proposal_comments.idcomment_type', $comment_type);
                                            }
                                            if(Auth::user()->privilege == 3 && Auth::user()->division != $proposal_lead_trd) {
                                                $q->where('users.division', Auth::user()->division);
                                            }
                                        })
                                        ->select(
                                            'proposal_comments.*',
                                            'users.username',
                                            DB::raw('DATE_FORMAT(`proposal_comments`.`created_at`, "%M %d, %Y %H:%i:%s") as date_commented')
                                        )
                                        ->get();
                
                $has_access = (Auth::user()->privilege < 4);
                $comments_classification = "All comments";
                if(Auth::user()->privilege == 3 && Auth::user()->division != $proposal_lead_trd) {
                	$comments_classification = "from your division";
                }

            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Outline comments have failed to load');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'0'
                ]);
            }
            Session::flash('success', 'Outline comments have successfully loaded');
            return Response::json([
                'outline_comments' => $proposal_comments,
                'has_access' => $has_access,
                'comments_classification' => $comments_classification,
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'1'
            ]);

        }
    }

    public function show_user_outline_comments_by_proposal(Request $request){
        if($request->ajax()){
            $proposal_id = $request->get('proposal_id');
            $comment_type = $request->get('comment_type');
            try {
                $proposal_comments = DB::table('proposal_comments')
                                        ->leftJoin('users', 'proposal_comments.users_id', '=', 'users.id')
                                        ->where('proposal_idproposal', $proposal_id)
                                        ->where('users_id', Auth::user()->id)
                                        ->where('proposal_comments.is_active', 1)
                                        ->where('is_inline', 0)
                                        ->where(function($q) use ($comment_type) {
                                          if($comment_type) {
                                            $q->where('proposal_comments.idcomment_type', $comment_type);
                                          }
                                        })
                                        ->select(
                                            'proposal_comments.*',
                                            'users.username',
                                            DB::raw('DATE_FORMAT(`proposal_comments`.`created_at`, "%M %d, %Y %H:%i:%s") as date_commented')
                                        )
                                        ->get();
                
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Outline comments have failed to load');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'0'
                ]);
            }
            Session::flash('success', 'Outline comments have successfully loaded');
            return Response::json([
                'user_outline_comments' => $proposal_comments,
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'1'
            ]);

        }
    }
    public function show(Request $request)
    {
        if($request->ajax()){
            try {
                $proposal_comment = DB::table('proposal_comments')
                                        ->where('is_active', 1);
                if($request->get('is_inline') == 0){
                    $comment_id = $request->get('comment_id');
                    $proposal_comment = $proposal_comment
                                        ->where('idproposal_comments', $comment_id)
                                        ->select(
                                            'proposal_comments.*',
                                            DB::raw('GROUP_CONCAT(comment_text SEPARATOR "<br/>") as comment_text')
                                        )
                                        ->groupBy('idproposal_comments')
                                        ->first();
                } else if($request->get('is_inline') == 1){
                    $uniqueName = $request->get('uniqueName');
                    $proposal_comment = $proposal_comment
                                        ->where('uniqueName', $uniqueName)
                                        ->select(
                                            'proposal_comments.*',
                                            DB::raw('GROUP_CONCAT(comment_text SEPARATOR "<br/>") as comment_text')
                                        )
                                        ->groupBy('uniqueName')
                                        ->first();
                }
                
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Comment has failed to load');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'0'
                ]);
            }
            Session::flash('error', 'Comment has successfully been loaded');
            return Response::json([
                'comment' => $proposal_comment,
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'1'
            ]);                

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->ajax()) {
            try {
                $request->session()->forget('success');
                $request->session()->forget('error');
                $proposal_comment = DB::table('proposal_comments')
                                        ->where('is_active', 1);
                $comments = $request->get('comment')['comments'];
                if($request->get('is_inline') == 0){
                    $comment_id = $request->get('comment')['comment_id'];
                    $proposal_comment = $proposal_comment
                                        ->where('idproposal_comments', $comment_id);
                } else if($request->get('is_inline') == 1){
                    $uniqueName = $request->get('comment')['uniqueName'];
                    $proposal_comment = $proposal_comment
                                        ->where('uniqueName', $uniqueName);
                }
                $proposal_comment = $proposal_comment
                                    ->update([
                                        'comments' => $comments
                                    ]);
                
            }catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Comment has failed to load');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'0'
                ]);
            }
            Session::flash('success', 'Comment has successfully been loaded');
            return Response::json([
                'comment' => $proposal_comment,
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'1'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete_comments_by_proposal(Request $request){
        if($request->ajax()){
            $proposal_id = $request->get('proposal_id');
            $comment_section = $request->get('comment_section');
            try {
                DB::table('proposal_comments')
                    ->where('proposal_idproposal', $proposal_id)
                    ->where('comment_section', $comment_section)
                    ->delete();
            } catch (Exception $e) {
                dd($e);
            }
        }
    }
    public function forward_comments_to_dpmis(Request $request) {
        if($request->ajax()) {
            $request->session()->forget('success');
            $request->session()->forget('error');
            $proposal_id = $request->get('proposal_id');
            $comments = $request->get('comments');
            try {
                $proposal_status = DB::table('proposal_has_lib_proposal_status')
                                        ->where('proposal_idproposal', $proposal_id)
                                        ->update([
                                          'is_active' => 0
                                        ]);
                DB::table('proposal_has_lib_proposal_status')
                    ->insert([
                      'proposal_idproposal' => $proposal_id,
                      'lib_proposal_status_idlib_proposal_status' => 47,
                      'remarks' => $comments,
                      'is_active' => '1'
                ]);

                $new_status = DB::table('proposal_has_lib_proposal_status')
                            ->where('proposal_idproposal', $proposal_id)
                            ->where('lib_proposal_status_idlib_proposal_status', 47)
                            ->where('proposal_has_lib_proposal_status.is_active', 1)
                            ->leftJoin('lib_proposal_status', 'proposal_has_lib_proposal_status.lib_proposal_status_idlib_proposal_status', '=', 'lib_proposal_status.idlib_proposal_status')
                            ->select(
                                'proposal_has_lib_proposal_status.remarks as remarks',
                                'proposal_has_lib_proposal_status.idproposal_has_lib_proposal_status',
                                'proposal_has_lib_proposal_status.created_at as pcreated_at',
                                'lib_proposal_status.*'
                            )
                            ->first();
            try {
                $now = Carbon::now();
                $dpmis_auth = new Client(['proxy' => 'tcp://192.168.0.9:3128']);
                $dpmis_auth_result = $dpmis_auth->post('http://202.90.141.23/dpmisoauth', [
                  'form_params' => [
                    'headers' => [
                      'Content-Type' => 'application/json',
                      'Accept' => 'application/json'
                    ],  
                    'redirect_uri' => '/oauth/receivecode',
                    'client_id' => 'pcaarrd',
                    'client_secret' => 'pcaarrd2020',
                    'grant_type' => 'client_credentials'
                  ]
                ]);
                $dpmis_access_token = (json_decode($dpmis_auth_result->getBody(), true)['access_token']);

                $dpmis_update_status = $dpmis_auth->post('http://202.90.141.23/statuses', [

                  'headers' => [
                    'Authorization' => ' Bearer '.$dpmis_access_token,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                  ],
                  'json' => [
                    'project_id' => (!is_null($proposal_update_status->project_id) ? $proposal_update_status->project_id : 'Not Applicable'),
                    'status_id' => (!is_null($new_status->idproposal_has_lib_proposal_status) ? $new_status->idproposal_has_lib_proposal_status : '7'),
                    'status_name' => (!is_null($new_status->status) ? $new_status->status : 'N/A'),
                    'status_type' =>  (!is_null($new_status->dpmis_counterpart_status_id) ? $new_status->dpmis_counterpart_status_id : '1'),
                    'remarks' => (!is_null($new_status->remarks) ? $new_status->remarks : $new_status->status),
                    'date_created' => (!is_null($new_status->pcreated_at) ? $new_status->pcreated_at : $now),
                    'evaluation_level' => (!is_null($new_status->evaluation_level) ? $new_status->evaluation_level : '1'),
                    'is_closed' => (!is_null($new_status->is_evaluation_closed) ? $new_status->is_evaluation_closed : 'N/A'),
                    'created_by' => ((!is_null(Auth::user()->first_name) && !is_null(Auth::user()->last_name)) ? Auth::user()->first_name.' '.Auth::user()->last_name : 'Pamela Anne Tandang')
                  ]
                ]);

                // {
                //     "project_id" : "2023-02-B2-SPAANR-12438",
                //     "status_id" : "pcaarrd",
                //     "status_name" : "pcaarrd2020",
                //     "status_type" : "client_credentials",
                //     "remarks" : "client_credentials",
                //     "date_created" : "client_credentials",
                //     "evaluation_level" : "client_credentials",
                //     "is_closed" : "client_credentials",
                //     "created_by" : "client_credentials"
                // }  
   

              } catch (GuzzleHttp\Exception\ClientException $e) {
                
              }
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Sending comments to DPMIS failed');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'0'
                ]);
            }
            Session::flash('success', 'Sending comments to DPMIS is successful');
            return Response::json([
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'1'
            ]);


        }
    }
    public function delete(Request $request){
        if($request->ajax()){
            $comment_id = $request->get('comment')['comment_id'];
            try {
                DB::table('proposal_comments')
                    ->where('idproposal_comments', $comment_id)
                    ->update([
                        'is_active' => 0
                    ]);
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Comment has failed to be deleted');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'0'
                ]);
            }

            Session::flash('success', 'Comment has successfully been deleted');
            return Response::json([
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'1'
            ]);
        }
    }
}
