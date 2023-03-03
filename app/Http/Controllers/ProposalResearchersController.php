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
use Carbon\Carbon;
use DB;
use File;
use Response;
use DataTables;
use Session;
use View;

class ProposalResearchersController extends Controller
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
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($request->ajax()) {

            set_time_limit(0);
            $researcher_id = $request->get('researcher_id');
            $dpmis_client = new Client(['proxy' => 'tcp://192.168.0.9:3128']);
            $dpmis_auth_result = $dpmis_client->post('https://api.dpmis.dost.gov.ph/dpmisoauth', [
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
            ], ['timeout' => 30]);
            $dpmis_access_token = (json_decode($dpmis_auth_result->getBody(), true)['access_token']);
            $dpmis_researcher_info = $dpmis_client->get('https://api.dpmis.dost.gov.ph/researchers/'.$researcher_id, [
                'headers' => [
                    'Authorization' => ' Bearer '.$dpmis_access_token,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ], ['timeout' => 30]);
            $dpmis_researcher_info = (json_decode($dpmis_researcher_info->getBody(), true));
            set_time_limit(120);
            Session::flash('success', 'Researcher info has been loaded successfully');
            Session::flash('researcher', $dpmis_researcher_info);
            return Response::json([
                'view' => View::make('partials/flash-messages')->render(),
                'cv' => View::make('researchers/cv')->render(),
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
