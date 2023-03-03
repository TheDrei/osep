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

class LibBeneficiaryController extends Controller
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
            $data = DB::table('lib_beneficiary')
                        ->select(
                            'lib_beneficiary.*',
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
                         'data-id' => function($beneficiary) {
                           return $beneficiary->idlib_beneficiary;
                         }
                       ])
                       ->addColumn('action', function($row){
                              $btn =
                              "<div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                  Action
                                </button>
                                <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                                  <a class='dropdown-item view-beneficiary' href='#'><span><i class='fas fa-eye'></i> View Beneficiary</span></a>
                                  <a class='dropdown-item delete-beneficiary' href='#'><span><i class='fas fa-trash-alt'></i> Delete Beneficiary</span></a>
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
                DB::table('lib_beneficiary')
                    ->insert([
                        'beneficiary' => $request->get('beneficiary'),
                        'is_active' => $request->get('beneficiary_is_active'),
                    ]);
                Session::flash('success', 'Creating new beneficiary is successful!');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status' => 1
                ]);
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Creating new beneficiary has failed!');
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
            if(!is_null($request->get('beneficiary_id'))){
                $beneficiary_id = $request->get('beneficiary_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    $beneficiary = DB::table('lib_beneficiary')
                                    ->where('idlib_beneficiary', $beneficiary_id)
                                    ->first();
                    Session::flash('success', 'Viewing beneficiary is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'beneficiary' => $beneficiary,
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Viewing beneficiary has failed!');
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
            if(!is_null($request->get('beneficiary_id'))){
                $beneficiary_id = $request->get('beneficiary_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    DB::table('lib_beneficiary')
                        ->where('idlib_beneficiary', $beneficiary_id)
                        ->update([
                            'beneficiary' => $request->get('beneficiary'),
                            'is_active' => $request->get('beneficiary_is_active'),
                            'updated_at' => Carbon::now()
                        ]);
                    Session::flash('success', 'Updating beneficiary is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Updating beneficiary has failed!');
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
            if(!is_null($request->get('beneficiary_id'))){
                $beneficiary_id = $request->get('beneficiary_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    DB::table('lib_beneficiary')
                        ->where('idlib_beneficiary', $beneficiary_id)
                        ->update([
                            'is_active' => 0
                        ]);
                    Session::flash('success', 'Deleting beneficiary is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Deleting beneficiary has failed!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 0
                    ]);
                }

            }
        }
    }
}
