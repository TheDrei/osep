<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Response;
use Session;
use View;

class ProposalImplementationDateController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $proposal_id = $request->get('proposal_id');
        $proposal_implementation_dates = DB::table('proposal_implementation_dates')->where('proposal_idproposal', $proposal_id)->first();
        $request->session()->forget('success');
        $request->session()->forget('error');

        if(!$proposal_implementation_dates) {
            Session::flash('error', 'The proposal does not have an approve implementation date. Please contact the Lead TRD.');
            return Response::json([
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'0'
            ]);
        } else {
            Session::flash('success', 'The proposal has an approve implementation date');
            return Response::json([
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
    public function update(Request $request, $id)
    {
        //
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
}
