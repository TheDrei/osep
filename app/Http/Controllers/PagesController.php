<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Proposals;
use Carbon\Carbon;
use DB;
use App;

class PagesController extends Controller
{

    public function home() {


    	$start_month = 1;
        $start_year = Carbon::now()->year;
        $end_month = 12;
        $end_year = Carbon::now()->year + 10;
        $total_count = DB::table('view_all_apiproposal')->count();
        $fromdpmis = DB::table('view_all_apiproposal')
                        ->where('pstatus.is_active', 1)
                        ->where('pstatus.lib_proposal_status_idlib_proposal_status', 6)
                        ->leftJoin('proposal_has_lib_proposal_status as pstatus', 'pstatus.proposal_idproposal', '=', 'view_all_apiproposal.id')
                        ->count();
        $received = DB::table('view_all_apiproposal')
                        ->where('pstatus.is_active', 1)
                        ->where('pstatus.lib_proposal_status_idlib_proposal_status', 7)
                        ->leftJoin('proposal_has_lib_proposal_status as pstatus', 'pstatus.proposal_idproposal', '=', 'view_all_apiproposal.id')
                        ->count();

        $under_evaluation = DB::table('view_all_apiproposal')
                        ->leftJoin('proposal_has_lib_proposal_status as pstatus', 'pstatus.proposal_idproposal', '=', 'view_all_apiproposal.id')
                        ->where('pstatus.is_active', 1)
                        ->where(
                            function($query) {
                              return $query
                              ->where('pstatus.lib_proposal_status_idlib_proposal_status', 8)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 9)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 10)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 11)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 12)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 13)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 14)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 16)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 17)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 19)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 23)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 28)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 29)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 31)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 34)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 35)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 37);
                             })
                        ->count();   

        $approved = DB::table('view_all_apiproposal')
                        ->where('pstatus.is_active', 1)
                        ->where('pstatus.lib_proposal_status_idlib_proposal_status', 15)
                        ->leftJoin('proposal_has_lib_proposal_status as pstatus', 'pstatus.proposal_idproposal', '=', 'view_all_apiproposal.id')
                        ->count();   

        $disapproved = DB::table('view_all_apiproposal')
                        ->where('pstatus.is_active', 1)
                        ->where(
                            function($query) {
                              return $query
                              ->where('pstatus.lib_proposal_status_idlib_proposal_status', 20)
                                     ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 21);
                             })
                        ->leftJoin('proposal_has_lib_proposal_status as pstatus', 'pstatus.proposal_idproposal', '=', 'view_all_apiproposal.id')
                        ->count();   

        $divisions = DB::table('commonlibrariesdb.pcaarrd_divisions')
                        ->get();

    	return view('home')
    			->with(compact('start_month', $start_month))
    			->with(compact('start_year', $start_year))
    			->with(compact('end_month', $end_month))
    			->with(compact('end_year', $end_year))
                ->with(compact('total_count', $total_count))
                ->with(compact('fromdpmis', $fromdpmis))
                ->with(compact('received', $received))
                ->with(compact('under_evaluation', $under_evaluation))
                ->with(compact('approved', $approved))
                ->with(compact('disapproved', $disapproved))
                ->with(compact('divisions', $divisions));
    }

    public function login() {
    	return redirect('/login');
    }

    public function proposals() {
        $users = $this->getUserByCurrentUserPrivilege();
        $divisions = DB::table('commonlibrariesdb.pcaarrd_divisions')
                        ->get();
        return view('proposals.all-proposals')
                ->with(compact('users', $users))
                ->with(compact('divisions', $divisions));
    }

    //maine
    public function projects(){   
        $title = "Projects From Palihan";
        $users = $this->getUserByCurrentUserPrivilege();
        $divisions = DB::table('commonlibrariesdb.pcaarrd_divisions')
                        ->get();
        return view('projects.all-projects')
                ->with(compact('users', $users))
                ->with(compact('divisions', $divisions));
    }

     public function completed_projects() {
       $users = $this->getUserByCurrentUserPrivilege();
        $divisions = DB::table('commonlibrariesdb.pcaarrd_divisions')
                        ->get();
        return view('proposals.completed-projects')
                ->with(compact('users', $users))
                ->with(compact('divisions', $divisions));
    }

    public function received_proposals() {
        $users = $this->getUserByCurrentUserPrivilege();
        $divisions = DB::table('commonlibrariesdb.pcaarrd_divisions')
                        ->get();
        return view('proposals.received-proposals')
                ->with(compact('users', $users))
                ->with(compact('divisions', $divisions));
    }

    public function from_dpmis_proposals() {
        $users = $this->getUserByCurrentUserPrivilege();
        $divisions = DB::table('commonlibrariesdb.pcaarrd_divisions')
                        ->get();
        return view('proposals.from-dpmis-proposals')
                ->with(compact('users', $users))
                ->with(compact('divisions', $divisions));
    }

    public function for_evaluation_proposals() {
        $users = $this->getUserByCurrentUserPrivilege();
        $divisions = DB::table('commonlibrariesdb.pcaarrd_divisions')
                        ->get();
        return view('proposals.for-evaluation-proposals')
                ->with(compact('users', $users))
                ->with(compact('divisions', $divisions));
    }

    public function forward_comments_to_dpmis_proposals() {
        $users = $this->getUserByCurrentUserPrivilege();
        $divisions = DB::table('commonlibrariesdb.pcaarrd_divisions')
                        ->get();
        return view('proposals.forward-comments-to-dpmis-proposals')
                ->with(compact('users', $users))
                ->with(compact('divisions', $divisions));
    }

    public function consolidated_comments_forwarded_to_dpmis_proposals() {
        $users = $this->getUserByCurrentUserPrivilege();
        $divisions = DB::table('commonlibrariesdb.pcaarrd_divisions')
                        ->get();
        return view('proposals.consolidated-comments-forwarded-to-dpmis-proposals')
                ->with(compact('users', $users))
                ->with(compact('divisions', $divisions));
    }

    public function approved_proposals() {
        $users = $this->getUserByCurrentUserPrivilege();
        $divisions = DB::table('commonlibrariesdb.pcaarrd_divisions')
                        ->get();
        return view('proposals.approved-proposals')
                ->with(compact('users', $users))
                ->with(compact('divisions', $divisions));
    }


    public function administration() {
        $divisions = DB::table('commonlibrariesdb.pcaarrd_divisions')->get();
        $proposal_statuses = DB::table('lib_proposal_status')->get();
        $area_assignments = DB::table('lib_dpmis_area_assignment')->get();
        $expertises = DB::table('commonlibrariesdb.field_of_specialization')->get();
        $user_privileges = DB::table('lib_user_privilege')->where('is_active', 1)->get();
        // $pcaarrd_employees = DB::table('fed_tblEmployees')->get();
        $pcaarrd_employees = DB::table('fed_employeedb2.tblEmployees')->get();
        return view('administration')
                ->with(compact('divisions', $divisions))
                ->with(compact('proposal_statuses', $proposal_statuses))
                ->with(compact('area_assignments', $area_assignments))
                ->with(compact('expertises', $expertises))
                ->with(compact('user_privileges', $user_privileges))
                ->with(compact('pcaarrd_employees', $pcaarrd_employees));
    }

    public function update_password() {
        return view('user_account.update_password');
    }
   
    protected function getUserByCurrentUserPrivilege(){
        $users;
        if(Auth::user()->privilege == 1 || Auth::user()->privilege == 2){
            $users = DB::table('users')
                        ->where('privilege', 4)
                        ->get();
        } else {
            $users = DB::table('users')
                        ->orWhere(function($q) {
                            $q->orWhere('privilege', 4)
                              ->orWhere('privilege', 5);
                        })
                        ->where('users.division', Auth::user()->division)
                        ->get();
        }
        return $users;
    }

    public function palihan()
    {
        $proj = new App\Models\Palihan\Project;
        $proj->title = "test";
        $proj->save();
    }
}
