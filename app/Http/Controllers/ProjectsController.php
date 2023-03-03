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


class ProjectsController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
   public function select_project(){
      $data = DB::table('palihan_fed.view_projects_status')
      ->whereNotNull('dpmis_code')->where('project_id', '!=' , 3135)
      ->orderBY('forwarded_to_dpmis', 'ASC')->get();   
      return $data;
   }   

   public function all_projects(Request $request){   
      $data = $this->select_project();      
      // dd($data);
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

   public function forward_project_status_to_dpmis(Request $request) {      
      $dpmis_code = $request->get('dpmis_code');  
      $select_project = $this->select_project();
      $project = clone $select_project;
      $project = $project->where('dpmis_code', $dpmis_code)->first();  
      $now = Carbon::now();    
      $date_now = $now->format("Y-m-d");  
      try {           
         // $project = [             
         //    'project_id' => (!is_null($project->dpmis_code) ? $project->dpmis_code : 'Not Applicable'),
         //    'status_id' => (!is_null($project->project_status_id) ? $project->project_status_id : '7'),
         //    'status_name' => (!is_null($project->project_status) ? $project->project_status : 'N/A'),
         //    'status_type' =>  (!is_null($project->dpmis_counterpart_status_id) ? $project->dpmis_counterpart_status_id : '1'),
         //    'remarks' => ($project->project_status),
         //    'date_created' => ($date_now),
         //    'created_by' => ('Pamela Anne Tandang'),
         //    'evaluation_level' => ('1'),
         //    'is_closed' => ('0')    
         // ];   
         $dpmis_auth = new Client(['proxy' => 'tcp://192.168.0.9:3128']);   
         // dd($dpmis_auth);  
         $dpmis_auth_result = $dpmis_auth->post('https://api.dpmis.dost.gov.ph/dpmisoauth', [            
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
         $forward_project_status = $dpmis_auth->post('https://api.dpmis.dost.gov.ph/statuses', [
            'headers' => [
               'Authorization' => ' Bearer '.$dpmis_access_token,
               'Content-Type' => 'application/json',
               'Accept' => 'application/json'
            ],
            'json' => [      
               'project_id' => (!is_null($project->dpmis_code) ? $project->dpmis_code : 'Not Applicable'),
               'status_id' => (!is_null($project->id) ? $project->id : '7'),
               'status_name' => (!is_null($project->status) ? $project->status : 'N/A'),
               'status_type' =>  (!is_null($project->dpmis_counterpart_status_id) ? $project->dpmis_counterpart_status_id : '1'),
               'remarks' => (!is_null($project->remarks) ? $project->remarks : $project->status),
               'date_created' => (!is_null($project->created_at) ? $project->created_at : $date_now),
               'evaluation_level' => (!is_null($project->evaluation_level) ? $project->evaluation_level : '1'),
               'is_closed' => (!is_null($project->is_evaluation_closed) ? $project->is_evaluation_closed : '0'),
               'created_by' => ((!is_null(Auth::user()->first_name) && !is_null(Auth::user()->last_name)) ? Auth::user()->first_name.' '.Auth::user()->last_name : 'Pamela Anne Tandang')                
            ]      
         ]);
         
         Session::flash('success', 'Forward project status to DPMIS was successful');
         DB::table('palihan_fed.projects_status')->where('id', $project->id)
               ->update([
                     'forwarded_to_dpmis' => '1'
               ]);
         return Response::json([
          'view' => View::make('partials/flash-messages')->render(),
          'status'=>'1'
         ]);
      } catch (\GuzzleHttp\Exception\BadResponseException $e) {
         //  dd($e->getResponse()->getBody()->getContents());
         //  dd($e);
            Session::flash('error', 'Forward project status to DPMIS has failed');
            return Response::json([
             'view' => View::make('partials/flash-messages')->render(),
             'status'=>'0'
            ]);
      }      
   }

}

