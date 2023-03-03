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
class LibUserPrivilegesController extends Controller
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
            $data = DB::table('lib_user_privilege')
                        ->select(
                            'lib_user_privilege.*',
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
                         'data-id' => function($lib_user_privilege) {
                           return $lib_user_privilege->idlib_user_privilege;
                         }
                       ])
                       ->addColumn('action', function($row){
                              $btn =
                              "<div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                  Action
                                </button>
                                <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                                  <a class='dropdown-item view-user-privilege' href='#'><span><i class='fas fa-eye'></i> View User Privilege</span></a>
                                  <a class='dropdown-item delete-user-privilege' href='#'><span><i class='fas fa-trash-alt'></i> Delete User Privilege</span></a>
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
     * Display the resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $request->session()->forget('success');
            $request->session()->forget('error');
            $user_privilege_id = $request->get('user_privilege_id');
            try {
                $user_privilege = DB::table('lib_user_privilege')
                    ->where('idlib_user_privilege', $user_privilege_id)
                    ->first();
                Session::flash('success', 'View of User Privilege is successful!');
                return Response::json([
                    'user_privilege' => $user_privilege,
                    'view' => View::make('partials/flash-messages')->render(),
                    'status' => 1
                ]);
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'View of User Privilege has failed!');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status' => 0
                ]);
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
                DB::table('lib_user_privilege')
                    ->insert([
                        'user_privilege' => $request->get('user_privilege'),
                        'is_active' => $request->get('user_privilege_is_active')
                    ]);
                Session::flash('success', 'Creating new User Privilege is successful!');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status' => 1
                ]);
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Creating new User Privilege has failed!');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status' => 0
                ]);
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
            if(!is_null($request->get('user_privilege_id'))){
                $user_privilege_id = $request->get('user_privilege_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    DB::table('lib_user_privilege')
                        ->where('idlib_user_privilege', $user_privilege_id)
                        ->update([
                            'user_privilege' => $request->get('user_privilege'),
                            'is_active' => $request->get('user_privilege_is_active'),
                            'updated_at' => Carbon::now()
                        ]);
                    Session::flash('success', 'Updating User Privilege is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Updating User Privilege has failed!');
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
            if(!is_null($request->get('user_privilege_id'))){
                $user_privilege_id = $request->get('user_privilege_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    DB::table('lib_user_privilege')
                        ->where('idlib_user_privilege', $user_privilege_id)
                        ->update([
                            'is_active' => 0
                        ]);
                    Session::flash('success', 'Deleting User Privilege is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Deleting User Privilege has failed!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 0
                    ]);
                }

            }
        }
    }
}
