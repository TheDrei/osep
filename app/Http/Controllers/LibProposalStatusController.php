<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use File;
use Response;
use DataTables;
use Session;
use View;
use Hash;

class LibProposalStatusController extends Controller
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
    public function table(Request $request) {
        if($request->ajax()) {
          $data;
          if(Auth::user()->privilege == 1){
            $data = DB::table('lib_proposal_status as libpstatus')
                        ->select(
                            'libpstatus.*',
                            DB::raw('(
                                CASE
                                    WHEN libpstatus.is_active = 1
                                        THEN "YES"
                                    ELSE "NO"
                                END
                            ) as is_active_text'),
                            DB::raw('(SELECT GROUP_CONCAT(`b`.`status` SEPARATOR "; ") FROM lib_proposal_status_allowed_transitions a LEFT JOIN lib_proposal_status b ON a.to_lib_proposal_status_idlib_proposal_status = b.idlib_proposal_status WHERE a.from_lib_proposal_status_idlib_proposal_status = libpstatus.idlib_proposal_status AND a.is_active = 1 ) as allowed_transitions')
                        )
                        ->get();
          
            if(!is_null($data)){
                return DataTables::of($data)
                       ->setRowAttr([
                         'data-id' => function($status) {
                           return $status->idlib_proposal_status;
                         }
                       ])
                       ->addColumn('action', function($row){
                              $btn =
                              "<div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                  Action
                                </button>
                                <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                                  <a class='dropdown-item view-proposal-status' href='#'><span><i class='fas fa-eye'></i> View Status</span></a>
                                  <a class='dropdown-item delete-proposal-status' href='#'><span><i class='fas fa-trash-alt'></i> Delete Status</span></a>
                                </div>
                              </div>";
                               return $btn;
                       })
                       ->rawColumns(['action'])
                       ->make(true);
                }
            }
        }
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->session()->forget('success');
            $request->session()->forget('error');
            try {
                $new_lib_proposal_status_id = DB::table('lib_proposal_status')
                    ->insertGetId([
                        'status' => $request->get('proposal_status'),
                        'description' => $request->get('proposal_status_description'),
                        'is_active' => $request->get('proposal_status_is_active'),
                    ]);

                $proposal_status_allowed_transitions = (!is_null($request->get('proposal_status_allowed_transitions'))) ? $request->get('proposal_status_allowed_transitions') : [];
                
                DB::table('lib_proposal_status_allowed_transitions')
                    ->where('from_lib_proposal_status_idlib_proposal_status', $new_lib_proposal_status_id)
                    ->update([
                        'is_active' => '0'
                    ]);
                
                DB::table('lib_proposal_status_allowed_transitions')
                ->insert([
                    'from_lib_proposal_status_idlib_proposal_status' => $new_lib_proposal_status_id,
                    'to_lib_proposal_status_idlib_proposal_status' => $new_lib_proposal_status_id
                ]);
                for ($i=0; $i < count($proposal_status_allowed_transitions); $i++) { 
                  if($new_lib_proposal_status_id == $proposal_status_allowed_transitions[$i]) continue;
                  DB::table('lib_proposal_status_allowed_transitions')
                      ->insert([
                          'from_lib_proposal_status_idlib_proposal_status' => $new_lib_proposal_status_id,
                          'to_lib_proposal_status_idlib_proposal_status' => $proposal_status_allowed_transitions[$i]
                      ]);
                }

                Session::flash('success', 'Creating new proposal status is successful!');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status' => 1
                ]);
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Creating new proposal status has failed!');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status' => 0
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            if(!is_null($request->get('proposal_status_id'))){
                $proposal_status_id = $request->get('proposal_status_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    $proposal_status = DB::table('lib_proposal_status')
                                    ->where('idlib_proposal_status', $proposal_status_id)
                                    ->first();
                    $proposal_status_allowed_transitions = DB::table('lib_proposal_status_allowed_transitions')
                                                                ->where('from_lib_proposal_status_idlib_proposal_status', $proposal_status_id)
                                                                ->where('is_active', 1)
                                                                ->get();
                    Session::flash('success', 'Viewing proposal status is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'proposal_status' => $proposal_status,
                        'proposal_status_allowed_transitions' => $proposal_status_allowed_transitions,
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Viewing proposal status has failed!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 0
                    ]);
                }
            }
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
        if($request->ajax()){
            if(!is_null($request->get('proposal_status_id'))){
                $proposal_status_id = $request->get('proposal_status_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    DB::table('lib_proposal_status')
                        ->where('idlib_proposal_status', $proposal_status_id)
                        ->update([
                            'status' => $request->get('proposal_status'),
                            'description' => $request->get('proposal_status_description'),
                            'is_active' => $request->get('proposal_status_is_active'),
                            'updated_at' => Carbon::now()
                        ]);
                    $proposal_status_allowed_transitions = (!is_null($request->get('proposal_status_allowed_transitions'))) ? $request->get('proposal_status_allowed_transitions') : [];

                    DB::table('lib_proposal_status_allowed_transitions')
                        ->where('from_lib_proposal_status_idlib_proposal_status', $proposal_status_id)
                        ->update([
                            'is_active' => '0'
                        ]);
                    DB::table('lib_proposal_status_allowed_transitions')
                    ->insert([
                        'from_lib_proposal_status_idlib_proposal_status' => $proposal_status_id,
                        'to_lib_proposal_status_idlib_proposal_status' => $proposal_status_id
                    ]);
                    for ($i=0; $i < count($proposal_status_allowed_transitions); $i++) { 
                      if($proposal_status_id == $proposal_status_allowed_transitions[$i]) continue;
                      DB::table('lib_proposal_status_allowed_transitions')
                          ->insert([
                              'from_lib_proposal_status_idlib_proposal_status' => $proposal_status_id,
                              'to_lib_proposal_status_idlib_proposal_status' => $proposal_status_allowed_transitions[$i]
                          ]);
                    }
                    Session::flash('success', 'Updating proposal status is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Updating proposal status has failed!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 0
                    ]);
                }

            }
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

    public function delete(Request $request){
        if($request->ajax()){
            if(!is_null($request->get('proposal_status_id'))){
                $proposal_status_id = $request->get('proposal_status_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    DB::table('lib_proposal_status')
                        ->where('idlib_proposal_status', $proposal_status_id)
                        ->update([
                            'is_active' => 0
                        ]);
                    Session::flash('success', 'Deleting proposal status is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Deleting proposal status has failed!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 0
                    ]);
                }

            }
        }
    }
}
