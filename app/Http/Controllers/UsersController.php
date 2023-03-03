<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request as GRequest;
use GuzzleHttp\Psr7\Response as GResponse;
use App\User;
use Carbon\Carbon;
use DB;
use File;
use Response;
use DataTables;
use Session;
use View;
use Hash;

class UsersController extends Controller
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
          if(Auth::user()->privilege == 1 || Auth::user()->privilege == 2){
            $data = DB::table('users')
                    ->leftJoin('commonlibrariesdb.pcaarrd_divisions as divisions', 'users.division', '=', 'divisions.id')
                    ->select(
                        'users.*',
                        'divisions.division_acronym as division_acronym',
                        DB::raw('(
                            CASE
                                WHEN privilege = 1
                                    THEN "Admin"
                                WHEN privilege = 2
                                    THEN "Cluster"
                                WHEN privilege = 3
                                    THEN "Division"
                            END
                        ) as user_privilege')
                    )
                    ->get();
          }

          if(!is_null($data)){
            return DataTables::of($data)
           ->setRowAttr([
             'data-id' => function($user) {
               return $user->id;
             }
           ])
           ->addColumn('action', function($row){
                  $btn =
                  "<div class='dropdown'>
                    <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                      Action
                    </button>
                    <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                      <a class='dropdown-item view-user' href='#'><span><i class='fas fa-eye'></i> View User</span></a>
                      <a class='dropdown-item delete-user' href='#'><span><i class='fas fa-trash-alt'></i> Delete User</span></a>
                    </div>
                  </div>";
                   return $btn;
           })
           ->rawColumns(['action'])
           ->make(true);
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
        if($request->ajax()){
            try {
                $user_id = DB::table('users')->insertGetId([
                    'username' => $request->get('username'),
                    'employee_code' => $request->get('employee_code'),
                    'first_name' => $request->get('first_name'),
                    'middle_name' => $request->get('middle_name'),
                    'last_name' => $request->get('last_name'),
                    'privilege' => $request->get('privilege'),
                    'division' => $request->get('division'),
                    'password' => Hash::make($request->get('password'))
                ]);

                //save to user_has_expertise
                DB::table('user_has_expertise')->where('users_id', $user_id)->update(['is_active' => 0]);
                $user_expertise = (!is_null($request->get('expertise')) ? $request->get('expertise') : []);
                for ($i=0; $i < count($user_expertise); $i++) { 
                    DB::table('user_has_expertise')->insert([
                        'users_id' => $user_id,
                        'lib_dpmis_expertise_idlib_dpmis_expertise' => $user_expertise[$i]
                    ]);
                }
                DB::table('user_has_area_assignment')->where('users_id', $user_id)->update(['is_active' => 0]);
                $user_area_assignment = (!is_null($request->get('area_assignment')) ? $request->get('area_assignment') : []);
                for ($i=0; $i < count($user_area_assignment); $i++) { 
                    DB::table('user_has_area_assignment')->insert([
                        'users_id' => $user_id,
                        'lib_dpmis_area_assignment_idlib_dpmis_area_assignment' => $user_area_assignment[$i]
                    ]);
                }
                $user = DB::table('users')->orderBy('id', 'desc')->first();
                $pm_info = DB::table('fed_employeedb2.view_dpmis_pmt_pis_data_with_area_assignment')
                        ->groupBy('fed_employeedb2.view_dpmis_pmt_pis_data_with_area_assignment.fldEmpCode')
                        ->where('fed_employeedb2.view_dpmis_pmt_pis_data_with_area_assignment.fldEmpCode', $user->employee_code)
                        ->first();
                try {
                    //internal only
                    //push to DPMIS here
                    try {
                        set_time_limit(0);
                        $now = Carbon::now();
                        $dpmis_auth = new Client(['proxy' => 'tcp://192.168.0.9:3128']);
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

                        //redacted: expertise, designation, employment_status, area_assignment_ids, PM Educations
                        $dpmis_pm_info = [
                            'title' => (!empty($pm_info->title) ? $pm_info->title : 'Not Applicable'),
                            'first_name' => (!empty($pm_info->first_name) ? $pm_info->first_name : 'Not Applicable'),
                            'middle_name' => (!empty($pm_info->middle_name) ? $pm_info->middle_name : 'Not Applicable'),
                            'last_name' => (!empty($pm_info->last_name) ? $pm_info->last_name : 'Not Applicable'),
                            'suffix_name' => (!empty($pm_info->suffix_name) ? $pm_info->suffix_name : 'Not Applicable'),
                            'sex' => (!empty($pm_info->gender) ? $pm_info->gender : '0'),
                            'landline' => '5549670',
                            'mobile' => (!empty($pm_info->mobile) ? $pm_info->mobile : '(+63 49) 554 9670'),
                            'email' => (!empty($pm_info->email) ? $pm_info->email : 'pcaarrd@pcaarrd.dost.gov.ph'),
                            'image' => (!empty($pm_info->image) ? $pm_info->image : 'Not Applicable'),
                            'expertise' => '.',
                            'institution_id' => '4389',
                            'designation' => '.',
                            'employment_status' => '1',
                            'area_assignment_ids' => '16',
                            'pm_educations' => []
                        ];

                        $dpmis_forward_pmt = $dpmis_auth->post('https://api.dpmis.dost.gov.ph/v1/projectmanagers', [
                            'headers' => [
                                'Authorization' => ' Bearer '.$dpmis_access_token,
                                'Content-Type' => 'application/json',
                                'Accept' => 'application/json'
                            ],
                            'json' => $dpmis_pm_info
                        ]);
                        $pm_id = (json_decode($dpmis_forward_pmt->getBody(), true)['pm_id']);
                        //updates pm_id
                        DB::table('users')->where('id', $user_id)->update(['dpmis_pm_id' => $pm_id]);
                        set_time_limit(120);
                    } catch (BadResponseException $ex) {
                        DB::table('users')->where('id', $user_id)->delete();
                        $response = $ex->getResponse();
                        $jsonBody = (string) $response->getBody();
                        dd($jsonBody);
                        Session::flash('error', 'PMT transfer to DPMIS failed');
                        return Response::json([
                            'view' => View::make('partials/flash-messages')->render(),
                            'status'=>'0'
                        ]); 
                    }
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'User creation has failed');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status'=>'0'
                    ]);  
                }
            } catch (Exception $e) {
                dd($e);
                Session::flash('error', 'User creation has failed');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'0'
                ]);  
            }
            Session::flash('success', 'User has been created successfully');
            return Response::json([
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'1'
            ]);
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
        if($request->ajax()){
            if($request->get('user_id')){
                $user_id = $request->get('user_id');
                $request->session()->forget('success');
                $request->session()->forget('error');

                try {
                    $user = DB::table('users')
                                ->where('id', $user_id)
                                ->first();
                    $user_expertise = DB::table('user_has_expertise')
                                ->where('users_id', $user_id)
                                ->pluck('lib_dpmis_expertise_idlib_dpmis_expertise');
                    $user_area_assignment = DB::table('user_has_area_assignment')
                                ->where('users_id', $user_id)
                                ->pluck('lib_dpmis_area_assignment_idlib_dpmis_area_assignment');
                } catch (Exception $e) {
                    dd($e);
                    Session::flash('error', 'User viewing has failed');
                    return Response::json([
                        'view' => View::make('partials/flash-messages')->render(),
                        'status'=>'0'
                    ]);   
                }
                Session::flash('success', 'User view has been loaded successfully');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'user' => $user,
                    'expertise' => $user_expertise,
                    'area_assignment' => $user_area_assignment,
                    'status'=>'1'
                ]);

            }
        }
    }
    public function export_pmt_to_dpmis() {
        //get list of pmt here
        // $pmt = DB::table('fed_employeedb2.view_dpmis_pmt')
        //         ->leftJoin('fed_employeedb2.dpmis_pmt_area_assignment_ids', 'fed_employeedb2.view_dpmis_pmt.fldEmpCode', '=', 'fed_employeedb2.dpmis_pmt_area_assignment_ids.employee_code')
        //         ->select('fed_employeedb2.view_dpmis_pmt.*', 'fed_employeedb2.dpmis_pmt_area_assignment_ids.area_assignment_ids as area_assignment')
        //         ->groupBy('fed_employeedb2.view_dpmis_pmt.fldEmpCode')
        //         ->get();
        // foreach($pmt as $pm => $pm_info){
        //     $user_id = DB::table('users')->insert([
        //         'username' => $pm_info->fldEmpCode,
        //         'employee_code' => $pm_info->fldEmpCode,
        //         'first_name' => $pm_info->first_name,
        //         'middle_name' => $pm_info->middle_name,
        //         'last_name' => $pm_info->last_name,
        //         'privilege' => 3,
        //         'division' => 21,
        //         'password' => Hash::make('pcaarrd_pmt')
        //     ]);
        //     $user_id = DB::table('users')->orderBy('id', 'desc')->pluck('id')->first();

        //     //save to user_has_expertise
        //     // DB::table('user_has_expertise')->where('users_id', $user_id)->delete();
        //     // $user_expertise = (!is_null($pm_info->expertise) ? $pm_info->expertise : '');
        //     // $user_area_assignment = array_unique(explode(",",$user_area_assignment));
        //     // for ($i=0; $i < count($user_expertise); $i++) { 
        //     //     DB::table('user_has_expertise')->insert([
        //     //         'users_id' => $user_id,
        //     //         'lib_dpmis_expertise_idlib_dpmis_expertise' => $user_expertise[$i]
        //     //     ]);
        //     // }
        //     DB::table('user_has_area_assignment')->where('users_id', $user_id)->update(['is_active' => 0]);
        //     $user_area_assignment = (!is_null($pm_info->area_assignment) ? $pm_info->area_assignment : '');
        //     $user_area_assignment = array_unique(explode(",", $user_area_assignment));
        //     for ($i=0; $i < count($user_area_assignment); $i++) { 
        //         DB::table('user_has_area_assignment')->insert([
        //             'users_id' => $user_id,
        //             'lib_dpmis_area_assignment_idlib_dpmis_area_assignment' => $user_area_assignment[$i]
        //         ]);
        //     }
        //     try {
        //         //internal only
        //         //push to DPMIS here
        //         try {
        //             set_time_limit(0);
        //             $now = Carbon::now();
        //             $dpmis_auth = new Client(['proxy' => 'tcp://192.168.0.9:3128']);
        //             $dpmis_auth_result = $dpmis_auth->post('https://api.dpmis.dost.gov.ph/dpmisoauth', [
        //               'form_params' => [
        //                 'headers' => [
        //                   'Content-Type' => 'application/json',
        //                   'Accept' => 'application/json'
        //                 ],  
        //                 'redirect_uri' => '/oauth/receivecode',
        //                 'client_id' => 'pcaarrd',
        //                 'client_secret' => 'pcaarrd2020',
        //                 'grant_type' => 'client_credentials'
        //               ]
        //             ]);
        //             $dpmis_access_token = (json_decode($dpmis_auth_result->getBody(), true)['access_token']);

        //             //redacted: expertise, designation, employment_status, area_assignment_ids, PM Educations
        //             $dpmis_pm_info = [
        //                 'title' => (!empty($pm_info->title) ? $pm_info->title : 'Not Applicable'),
        //                 'first_name' => (!empty($pm_info->first_name) ? $pm_info->first_name : 'Not Applicable'),
        //                 'middle_name' => (!empty($pm_info->middle_name) ? $pm_info->middle_name : 'Not Applicable'),
        //                 'last_name' => (!empty($pm_info->last_name) ? $pm_info->last_name : 'Not Applicable'),
        //                 'suffix_name' => (!empty($pm_info->suffix_name) ? $pm_info->suffix_name : 'Not Applicable'),
        //                 'sex' => (!empty($pm_info->gender) ? $pm_info->gender : '0'),
        //                 'landline' => '5549670',
        //                 'mobile' => (!empty($pm_info->mobile) ? $pm_info->mobile : '(+63 49) 554 9670'),
        //                 'email' => (!empty($pm_info->email) ? $pm_info->email : 'pcaarrd@pcaarrd.dost.gov.ph'),
        //                 'image' => (!empty($pm_info->image) ? $pm_info->image : 'Not Applicable'),
        //                 'expertise' => '.',
        //                 'institution_id' => '4389',
        //                 'designation' => '.',
        //                 'employment_status' => '1',
        //                 'area_assignment_ids' => '16',
        //                 'pm_educations' => []
        //             ];
                    
        //             $dpmis_forward_pmt = $dpmis_auth->post('https://api.dpmis.dost.gov.ph/v1/projectmanagers', [
        //                 'headers' => [
        //                     'Authorization' => ' Bearer '.$dpmis_access_token,
        //                     'Content-Type' => 'application/json',
        //                     'Accept' => 'application/json'
        //                 ],
        //                 'json' => $dpmis_pm_info
        //             ]);
        //             $pm_id = (json_decode($dpmis_forward_pmt->getBody(), true)['pm_id']);
        //             //updates pm_id
        //             DB::table('users')->where('id', $user_id)->update(['dpmis_pm_id' => $pm_id]);
        //             set_time_limit(120);
        //         } catch (BadResponseException $ex) {
        //             DB::table('users')->where('id', $user_id)->delete();
        //             $response = $ex->getResponse();
        //             $jsonBody = (string) $response->getBody();
        //             dd($jsonBody);
        //             Session::flash('error', 'PMT transfer to DPMIS failed');
        //             return Response::json([
        //                 'view' => View::make('partials/flash-messages')->render(),
        //                 'status'=>'0'
        //             ]); 
        //         }

        //         //after push update record with pmt id return from DPMIS
        //     } catch (Exception $e) {
        //         dd($e);
        //         Session::flash('error', 'User creation has failed');
        //         return Response::json([
        //             'view' => View::make('partials/flash-messages')->render(),
        //             'status'=>'0'
        //         ]);  
        //     }
        // }
        // Session::flash('success', 'User creation has been successful');
        // return Response::json([
        //     'view' => View::make('partials/flash-messages')->render(),
        //     'status'=>'1'
        // ]);
    }
    public function export_pmt_assigned_proposal_to_dpmis(Request $request) {
        if($request->ajax()) {
            $user_has_proposal_assigned = DB::table('user_has_proposal_assigned')
                                            ->leftJoin('users', 'user_has_proposal_assigned.users_id', '=', 'users.id')
                                            ->leftJoin('proposal', 'user_has_proposal_assigned.proposal_idproposal', '=', 'proposal.idproposal')
                                            ->where('user_has_proposal_assigned.is_active', 1)
                                            ->select(
                                                DB::raw('
                                                    (
                                                            CASE
                                                                WHEN (proposal.project_id IS NULL OR proposal.project_id = "") AND (proposal.program_id IS NOT NULL AND proposal.program_id != "")
                                                                        THEN proposal.program_id
                                                                WHEN (proposal.program_id IS NULL OR proposal.program_id = "") AND (proposal.project_id IS NOT NULL AND proposal.project_id != "")
                                                                        THEN proposal.project_id
                                                                WHEN (proposal.program_id IS NOT NULL AND proposal.program_id != "" AND proposal.project_id IS NOT NULL AND proposal.project_id != "")
                                                                        THEN proposal.project_id
                                                                ELSE "N/A"
                                                            END
                                                    ) AS proposal_code'),
                                                    'users.dpmis_pm_id as dpmis_pm_id'
                                                )
                                            ->whereNotNull('user_has_proposal_assigned.proposal_idproposal')
                                            ->get();


            foreach($user_has_proposal_assigned as $user_proposal) {
                set_time_limit(0);
                $now = Carbon::now();
                $dpmis_auth = new Client(['proxy' => 'tcp://192.168.0.9:3128']);
                $dpmis_auth_result = $dpmis_auth->post('https://api.dpmis.dost.gov.ph/dpmisoauth', 
                [
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

                $dpmis_user_proposal_assigned = $dpmis_auth->put('https://api.dpmis.dost.gov.ph/v1/projectManagersAssignment/'.$user_proposal->proposal_code,
                [
                    'headers' => [
                        'Authorization' => ' Bearer '.$dpmis_access_token,
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json'
                    ],
                    'json' => [
                        'project_id' => (!is_null($user_proposal->proposal_code) ? $user_proposal->proposal_code : 'Not Applicable'),
                        'pm_id' => (!is_null($user_proposal->dpmis_pm_id) ? $user_proposal->dpmis_pm_id : 'Not Applicable')
                    ]
                ]);
                set_time_limit(120);
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
            if($request->get('user_id')){
                $user_id = $request->get('user_id');
                $request->session()->forget('success');
                $request->session()->forget('error');
                try {
                  
                    if(!is_null($request->get('password')))
                    {
                    DB::table('users')
                        ->where('id', $user_id)
                        ->update([
                            'username' => $request->get('username'),
                            'employee_code' => $request->get('employee_code'),
                            'first_name' => $request->get('first_name'),
                            'middle_name' => $request->get('middle_name'),
                            'last_name' => $request->get('last_name'),
                            'privilege' => $request->get('privilege'),
                            'division' => $request->get('division'),
                            'password' => Hash::make($request->get('password'))
                        ]);
                    }
                    else
                    {
                        DB::table('users')
                        ->where('id', $user_id)
                        ->update([
                            'username' => $request->get('username'),
                            'employee_code' => $request->get('employee_code'),
                            'first_name' => $request->get('first_name'),
                            'middle_name' => $request->get('middle_name'),
                            'last_name' => $request->get('last_name'),
                            'privilege' => $request->get('privilege'),
                            'division' => $request->get('division'),
                        ]);
                    }

                    //save to user_has_expertise
                    DB::table('user_has_expertise')->where('users_id', $user_id)->update(['is_active' => 0]);
                    $user_expertise = (!is_null($request->get('expertise')) ? $request->get('expertise') : []);
                    for ($i=0; $i < count($user_expertise); $i++) { 
                        DB::table('user_has_expertise')->insert([
                            'users_id' => $user_id,
                            'lib_dpmis_expertise_idlib_dpmis_expertise' => $user_expertise[$i]
                        ]);
                    }
                    DB::table('user_has_area_assignment')->where('users_id', $user_id)->update(['is_active' => 0]);
                    $user_area_assignment = (!is_null($request->get('area_assignment')) ? $request->get('area_assignment') : []);
                    for ($i=0; $i < count($user_area_assignment); $i++) { 
                        DB::table('user_has_area_assignment')->insert([
                            'users_id' => $user_id,
                            'lib_dpmis_area_assignment_idlib_dpmis_area_assignment' => $user_area_assignment[$i]
                        ]);
                    }
                } catch (Exception $e) {
                    dd($e);
                     Session::flash('error', 'User update has failed');
                        return Response::json([
                            'view' => View::make('partials/flash-messages')->render(),
                            'status'=>'0'
                        ]);  
                }
                Session::flash('success', 'User has been updated successfully');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'1'
                ]);
            }
        }
    }

    public function update_password(Request $request) {
        if($request->ajax()) {
            $user = Auth::user();
            $current_password = $request->get('current_password');
            $new_password = $request->get('new_password');
            $confirm_password = $request->get('confirm_password');
            $request->session()->forget('success');
            $request->session()->forget('error');
            
            if(!Hash::check($current_password, $user->password)) {
                Session::flash('error', 'Incorrect password');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'0'
                ]);   
            } 
            if($new_password != $confirm_password) {
                Session::flash('error', 'New password and confirm password do not match.');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'0'
                ]);  
            }
            try{
                $user->update(['password' => Hash::make($new_password)]);
            } catch (Exception $e) {
                Session::flash('error', 'Updating password has failed');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'0'
                ]);
            }
            Session::flash('success', 'Updating password has been successful');
            return Response::json([
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'1'
            ]);
        }
    }
    public function delete(Request $request)
    {
        if($request->ajax()){
            if($request->get('user_id')){
                $user_id = $request->get('user_id');
                try {
                    DB::table('users_has_access_during_proposal_has_lib_proposal_status')
                        ->where('users_id', $user_id)
                        ->delete();
                    DB::table('users')
                        ->where('id', $user_id)
                        ->delete();
                    DB::table('user_has_expertise')
                        ->where('users_id', $user_id)
                        ->update(['is_active' => 0]);
                    DB::table('user_has_area_assignment')
                        ->where('users_id', $user_id)
                        ->update(['is_active' => 0]);
                } catch (Exception $e) {
                    dd($e);
                     Session::flash('error', 'User deletion has failed');
                        return Response::json([
                            'view' => View::make('partials/flash-messages')->render(),
                            'status'=>'0'
                        ]);  
                }
                Session::flash('success', 'User has been deleted successfully');
                return Response::json([
                    'view' => View::make('partials/flash-messages')->render(),
                    'status'=>'1'
                ]);
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
}
