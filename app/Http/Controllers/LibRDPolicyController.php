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

class LibRDPolicyController extends Controller
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
            $data = DB::table('lib_rd_policy')
                        ->select(
                            'lib_rd_policy.*',
                            DB::raw('(
                                CASE
                                    WHEN is_active = 1
                                        THEN "YES"
                                    ELSE "NO"
                                END
                            ) as is_active_text')

                        )
                        ->get();
          
            if(!is_null($data)){
                return DataTables::of($data)
                       ->setRowAttr([
                         'data-id' => function($rd_policy) {
                           return $rd_policy->idlib_rd_policy;
                         }
                       ])
                       ->addColumn('action', function($row){
                              $btn =
                              "<div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                  Action
                                </button>
                                <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                                  <a class='dropdown-item view-rd-policy' href='#'><span><i class='fas fa-eye'></i> View Policy</span></a>
                                  <a class='dropdown-item delete-rd-policy' href='#'><span><i class='fas fa-trash-alt'></i> Delete Policy</span></a>
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
                DB::table('lib_rd_policy')
                    ->insert([
                        'policy_name' => $request->get('rd_policy_name'),
                        'label' => $request->get('rd_policy_label'),
                        'description' => $request->get('rd_policy_description'),
                        'is_active' => $request->get('rd_policy_is_active'),
                    ]);
                Session::flash('success', 'Creating new R & D Policy is successful!');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status' => 1
                ]);
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Creating new R & D Policy has failed!');
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
            if(!is_null($request->get('rd_policy_id'))){
                $rd_policy_id = $request->get('rd_policy_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    $rd_policy = DB::table('lib_rd_policy')
                                    ->where('idlib_rd_policy', $rd_policy_id)
                                    ->first();
                    Session::flash('success', 'Viewing R & D Policy is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'rd_policy' => $rd_policy,
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Viewing R & D Policy has failed!');
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
            if(!is_null($request->get('rd_policy_id'))){
                $rd_policy_id = $request->get('rd_policy_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    DB::table('lib_rd_policy')
                        ->where('idlib_rd_policy', $rd_policy_id)
                        ->update([
                            'policy_name' => $request->get('rd_policy_name'),
                            'label' => $request->get('rd_policy_label'),
                            'description' => $request->get('rd_policy_description'),
                            'is_active' => $request->get('rd_policy_is_active'),
                            'updated_at' => Carbon::now()
                        ]);
                    Session::flash('success', 'Updating R & D Policy is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Updating R & D Policy has failed!');
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
            if(!is_null($request->get('rd_policy_id'))){
                $rd_policy_id = $request->get('rd_policy_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    DB::table('lib_rd_policy')
                        ->where('idlib_rd_policy', $rd_policy_id)
                        ->update([
                            'is_active' => 0
                        ]);
                    Session::flash('success', 'Deleting R & D Policy is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Deleting R & D Policy has failed!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 0
                    ]);
                }

            }
        }
    }
}
