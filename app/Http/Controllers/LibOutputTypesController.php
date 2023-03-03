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

class LibOutputTypesController extends Controller
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
            $data = DB::table('lib_output_type')
                        ->select(
                            'lib_output_type.*',
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
                         'data-id' => function($output_type) {
                           return $output_type->idlib_output_type;
                         }
                       ])
                       ->addColumn('action', function($row){
                              $btn =
                              "<div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                  Action
                                </button>
                                <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                                  <a class='dropdown-item view-output-type' href='#'><span><i class='fas fa-eye'></i> View Type</span></a>
                                  <a class='dropdown-item delete-output-type' href='#'><span><i class='fas fa-trash-alt'></i> Delete Type</span></a>
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
                DB::table('lib_output_type')
                    ->insert([
                        'output_type_group' => $request->get('output_type_group'),
                        'output_type' => $request->get('output_type'),
                        'description' => $request->get('output_type_description'),
                        'is_active' => $request->get('output_type_is_active'),
                        'is_active' => $request->get('output_type_is_active'),
                    ]);
                Session::flash('success', 'Creating new output type is successful!');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status' => 1
                ]);
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'Creating new output type has failed!');
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
            if(!is_null($request->get('output_type_id'))){
                $output_type_id = $request->get('output_type_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    $output_type = DB::table('lib_output_type')
                                    ->where('idlib_output_type', $output_type_id)
                                    ->first();
                    Session::flash('success', 'Viewing output type is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'output_type' => $output_type,
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Viewing output type has failed!');
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
            if(!is_null($request->get('output_type_id'))){
                $output_type_id = $request->get('output_type_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    DB::table('lib_output_type')
                        ->where('idlib_output_type', $output_type_id)
                        ->update([
                            'output_type_group' => $request->get('output_type_group'),
                            'output_type' => $request->get('output_type'),
                            'description' => $request->get('output_type_description'),
                            'is_active' => $request->get('output_type_is_active'),
                            'updated_at' => Carbon::now()
                        ]);
                    Session::flash('success', 'Updating output type is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Updating output type has failed!');
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
            if(!is_null($request->get('output_type_id'))){
                $output_type_id = $request->get('output_type_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                    DB::table('lib_output_type')
                        ->where('idlib_output_type', $output_type_id)
                        ->update([
                            'is_active' => 0
                        ]);
                    Session::flash('success', 'Deleting output type is successful!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 1
                    ]);
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'Deleting output type has failed!');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status' => 0
                    ]);
                }

            }
        }
    }
}
