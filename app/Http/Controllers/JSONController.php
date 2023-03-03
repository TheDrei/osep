<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request as GRequest;
use GuzzleHttp\Psr7\Response as GResponse;
use App\Proposal;
use App\Mail\NotificationMail;
use Carbon\Carbon;
use Artisan;
use App;
use App\Models\ViewProjectModel;
use PDF;
use DB;
use File;
use Response;
use DataTables;
use Session;
use View;


class JSONController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
   public function allcompletedprojects(Request $request){       
      $data = DB::table('palihan_fed.projects')
      ->where('delete_flag', '1')->whereNotNull('dpmis_code')->where('id', '!=' , 3135)->get();   
      return DataTables::of($data)
         ->addIndexColumn()
         ->setRowAttr([
            'data-id' => function($project) {
            return $project->dpmis_code;
            }
         ])
         ->addColumn('action', function($row){      
            $btn =
            "<div>
               <button class='actionbtn btn btn-primary forward-project-status-to-dpmis' type='button'> 
                  Forward Status                   
               </button>                 
            </div>
            ";
            return $btn;
         })
         ->rawColumns(['action'])
         ->make(true);      
   } 

   public function forwardstatus(Request $request) {      
      $dpmis_code = $request->get('dpmis_code');
      try {
         $project_status = DB::table('palihan_fed.projects')
            ->where('delete_flag', '1')->where('dpmis_code', $dpmis_code)->get();
        
         $now = Carbon::now();
         $dpmis_auth = new Client(['proxy' => 'tcp://192.168.0.9:3128']);
         $dpmis_auth_result = $dpmis_auth->post('http://192.168.0.56/apigility/oauth/token', [
            'form_params' => [
            'headers' => [
               'Content-Type' => 'application/json',
               'Accept' => 'application/json'
            ],  
            'redirect_uri' => '/oauth/receivecode',
            'client_id' => 'dost-pcaarrd',
            'client_secret' => 'secret',
            'grant_type' => 'client_credentials'
            ]
         ]);
         $dpmis_access_token = (json_decode($dpmis_auth_result->getBody(), true)['access_token']);

         $forward_project_status = $dpmis_auth->post('http://192.168.0.56/apigility/v1/dpmisstatustest', [
            'headers' => [
            'Authorization' => ' Bearer '.$dpmis_access_token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
            ],
            'json' => [
            'project_id' => '2020-06-A2-1936',
            'status_id' => '5',
            'status_name' => 'Completed',
            'status_type' =>  '15',
            'remarks' => 'Completed',
            'date_created' => '2022-05-26 08:05:39',
            'evaluation_level' => '1',
            'is_closed' => '0',
            'created_by' => 'Pamela Anne Tandang'
            ]
         ]); 
      } catch (\GuzzleHttp\Exception\BadResponseException $e) {
          dd($e->getResponse()->getBody()->getContents());
      }
   }

   public function forward_project_status_to_dpmis2(Request $request){   
      dd($request->get('dpmis_code'));    
    
   } 

}

