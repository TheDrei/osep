<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use File;
use Response;
use DataTables;
use Session;
use View;


class ReportsController extends Controller
{

	private $start_month;
	private $start_year;
	private $end_month;
	private $end_year;

	public function set_filters(Request $request){
		$this->start_month = $request->all()['filters']['filter_start_month'];
		$this->start_year = $request->all()['filters']['filter_start_year'];
		$this->end_month = $request->all()['filters']['filter_end_month'];
		$this->end_year = $request->all()['filters']['filter_end_year'];
		$this->date_received_start_month = $request->all()['filters']['filter_date_received_start_month'];
		$this->date_received_start_year = $request->all()['filters']['filter_date_received_start_year'];
		$this->date_received_end_month = $request->all()['filters']['filter_date_received_end_month'];
		$this->date_received_end_year = $request->all()['filters']['filter_date_received_end_year'];
		$this->lead_trd = $request->all()['filters']['filter_lead_trd'];
	}

	public function view_proposal_count_by_type(Request $request){
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;

		$view_proposal_count_by_type = DB::table('view_all_apiproposal')
                        		->leftJoin(
	                    			'proposal_has_lib_proposal_status as pstatus', function($ljoin){
	                    				$ljoin->on('view_all_apiproposal.id', '=', 'pstatus.proposal_idproposal');
	                    				$ljoin->on('idproposal_has_lib_proposal_status', '=', DB::raw('(SELECT idproposal_has_lib_proposal_status FROM proposal_has_lib_proposal_status as lpstatus WHERE `lpstatus`.`lib_proposal_status_idlib_proposal_status` = 6 AND view_all_apiproposal.id = lpstatus.proposal_idproposal ORDER BY lpstatus.created_at ASC LIMIT 1)'));
	                    			}
	                    		)
								->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
								->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
								->leftJoin('proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
								->where('pd.is_active', 1)
								->where('plt.is_active', 1)
								->wherein('plt.division_iddivision', $lead_trd)
								->where(function($q) use($start_month, $start_year, $end_month, $end_year){
									$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
									$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
									$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
									$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
								})
								->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
								})
								->select(
									'view_all_apiproposal.id',
									'view_all_apiproposal.proposal_type',
									'libptype.proposal_type as title',
									DB::raw('COUNT(*) as count')
								)
								->groupBy(
									'view_all_apiproposal.proposal_type'
								)
								->get();
    	return Response::json([
    		'view_proposal_count_by_type' => $view_proposal_count_by_type,
    		'status' => 1
    	]);
	}
    // Added by Drei
	public function view_proposal_count_all(Request $request){
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;

		$view_proposal_count_all = DB::table('view_all_apiproposal')
                        		->leftJoin(
	                    			'proposal_has_lib_proposal_status as pstatus', function($ljoin){
	                    				$ljoin->on('view_all_apiproposal.id', '=', 'pstatus.proposal_idproposal');
	                    				$ljoin->on('idproposal_has_lib_proposal_status', '=', DB::raw('(SELECT idproposal_has_lib_proposal_status FROM proposal_has_lib_proposal_status as lpstatus WHERE `lpstatus`.`lib_proposal_status_idlib_proposal_status` = 6 AND view_all_apiproposal.id = lpstatus.proposal_idproposal ORDER BY lpstatus.created_at ASC LIMIT 1)'));
	                    			}
	                    		)
								->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
								->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
								->leftJoin('proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
								->where('pd.is_active', 1)
								->where('plt.is_active', 1)
								->wherein('plt.division_iddivision', $lead_trd)
								->where(function($q) use($start_month, $start_year, $end_month, $end_year){
									$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
									$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
									$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
									$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
								})
								->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
								})
								->select(
									DB::raw('COUNT(project_id) as count')
								)
								// ->groupBy(
								// 	'view_all_apiproposal.project_id'
								// )
								->count();
    	return Response::json([
    		'view_proposal_count_all' => $view_proposal_count_all,
    		'status' => 1
    	]);
	}

	public function view_proposal_count_from_dpmis(Request $request){
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;

		$view_proposal_count_from_dpmis = DB::table('view_all_apiproposal')
								->where('pstatus.is_active', 1)
								->where('pstatus.lib_proposal_status_idlib_proposal_status', 6)
								->leftJoin('proposal_has_lib_proposal_status as pstatus', 'pstatus.proposal_idproposal', '=', 'view_all_apiproposal.id')
								->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
								->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
								->leftJoin('proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
								->where('pd.is_active', 1)
								->where('plt.is_active', 1)
								->wherein('plt.division_iddivision', $lead_trd)
								->where(function($q) use($start_month, $start_year, $end_month, $end_year){
									$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
									$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
									$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
									$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
								})
								->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
								})
								->select(
									DB::raw('COUNT(project_id) as count')
								)
								// ->groupBy(
								// 	'view_all_apiproposal.project_id'
								// )
								->count();
    	return Response::json([
    		'view_proposal_count_from_dpmis' => $view_proposal_count_from_dpmis,
    		'status' => 1
    	]);
	}

	public function view_proposal_count_received(Request $request){
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;

		$view_proposal_count_received = DB::table('view_all_apiproposal')
								->where('pstatus.is_active', 1)
								->where('pstatus.lib_proposal_status_idlib_proposal_status', 7)
								->leftJoin(
	                    			'proposal_has_lib_proposal_status as pstatus', function($ljoin){
	                    				$ljoin->on('view_all_apiproposal.id', '=', 'pstatus.proposal_idproposal');
	                    				$ljoin->on('idproposal_has_lib_proposal_status', '=', DB::raw('(SELECT idproposal_has_lib_proposal_status FROM proposal_has_lib_proposal_status as lpstatus WHERE `lpstatus`.`lib_proposal_status_idlib_proposal_status` = 6 AND view_all_apiproposal.id = lpstatus.proposal_idproposal ORDER BY lpstatus.created_at ASC LIMIT 1)'));
	                    			}
	                    		)
								->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
								->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
								->leftJoin('proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
								->where('pd.is_active', 1)
								->where('plt.is_active', 1)
								->wherein('plt.division_iddivision', $lead_trd)
								->where(function($q) use($start_month, $start_year, $end_month, $end_year){
									$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
									$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
									$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
									$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
								})
								->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
								})
								->select(
									DB::raw('COUNT(project_id) as count')
								)
								->count();
    	return Response::json([
    		'view_proposal_count_received' => $view_proposal_count_received,
    		'status' => 1
    	]);
	}

	public function view_proposal_count_under_evaluation(Request $request){
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;

		$view_proposal_count_under_evaluation = DB::table('view_all_apiproposal')
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
								->leftJoin('proposal_has_lib_proposal_status as pstatus', 'pstatus.proposal_idproposal', '=', 'view_all_apiproposal.id')
								->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
								->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
								->leftJoin('proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
								->where('pd.is_active', 1)
								->where('plt.is_active', 1)
								->wherein('plt.division_iddivision', $lead_trd)
								->where(function($q) use($start_month, $start_year, $end_month, $end_year){
									$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
									$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
									$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
									$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
								})
								->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
								})
								->select(
									DB::raw('COUNT(project_id) as count')
								)
								->count();
    	return Response::json([
    		'view_proposal_count_under_evaluation' => $view_proposal_count_under_evaluation,
    		'status' => 1
    	]);
	}

	
	public function view_proposal_count_approved(Request $request){
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;

		$view_proposal_count_approved = DB::table('view_all_apiproposal')
								->where('pstatus.is_active', 1)
								->where('pstatus.lib_proposal_status_idlib_proposal_status', 15)
								->leftJoin('proposal_has_lib_proposal_status as pstatus', 'pstatus.proposal_idproposal', '=', 'view_all_apiproposal.id')
								->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
								->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
								->leftJoin('proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
								->where('pd.is_active', 1)
								->where('plt.is_active', 1)
								->wherein('plt.division_iddivision', $lead_trd)
								->where(function($q) use($start_month, $start_year, $end_month, $end_year){
									$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
									$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
									$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
									$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
								})
								->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
								})
								->select(
									DB::raw('COUNT(project_id) as count')
								)
								->count();
    	return Response::json([
    		'view_proposal_count_approved' => $view_proposal_count_approved,
    		'status' => 1
    	]);
	}

	public function view_proposal_count_disapproved(Request $request){
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;

		$view_proposal_count_disapproved = DB::table('view_all_apiproposal')
		->where('pstatus.is_active', 1)
		->where(
			function($query) {
			  return $query
			  ->where('pstatus.lib_proposal_status_idlib_proposal_status', 20)
					 ->orWhere('pstatus.lib_proposal_status_idlib_proposal_status', 21);
			 })
		->leftJoin('proposal_has_lib_proposal_status as pstatus', 'pstatus.proposal_idproposal', '=', 'view_all_apiproposal.id')
								->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
								->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
								->leftJoin('proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
								->where('pd.is_active', 1)
								->where('plt.is_active', 1)
								->wherein('plt.division_iddivision', $lead_trd)
								->where(function($q) use($start_month, $start_year, $end_month, $end_year){
									$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
									$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
									$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
									$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
								})
								->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
								})
								->select(
									DB::raw('COUNT(project_id) as count')
								)
								->count();
    	return Response::json([
    		'view_proposal_count_disapproved' => $view_proposal_count_disapproved,
    		'status' => 1
    	]);
	}


	public function view_proposal_count_by_call(Request $request){
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;

		$view_proposal_count_by_call = DB::table('view_all_apiproposal')
                        		->leftJoin(
	                    			'proposal_has_lib_proposal_status as pstatus', function($ljoin){
	                    				$ljoin->on('view_all_apiproposal.id', '=', 'pstatus.proposal_idproposal');
	                    				$ljoin->on('idproposal_has_lib_proposal_status', '=', DB::raw('(SELECT idproposal_has_lib_proposal_status FROM proposal_has_lib_proposal_status as lpstatus WHERE `lpstatus`.`lib_proposal_status_idlib_proposal_status` = 6 AND view_all_apiproposal.id = lpstatus.proposal_idproposal ORDER BY lpstatus.created_at ASC LIMIT 1)'));
	                    			}
	                    		)
								->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
								->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
								->leftJoin('proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
								->where('pd.is_active', 1)
								->where('plt.is_active', 1)
								->wherein('plt.division_iddivision', $lead_trd)
								->where(function($q) use($start_month, $start_year, $end_month, $end_year){
									$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
									$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
									$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
									$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
								})
								->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
								})
								->select(
									'view_all_apiproposal.id',
									'view_all_apiproposal.proposal_type',
									'view_all_apiproposal.call_name as title',
									DB::raw('COUNT(*) as count')
								)
								->groupBy(
									'view_all_apiproposal.call_name'
								)
								->orderBy('title')
								->get();
    	return Response::json([
    		'view_proposal_count_by_call' => $view_proposal_count_by_call,
    		'status' => 1
    	]);
	}

	public function view_proposal_count_by_trd(Request $request){
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;

		$view_proposal_count_by_trd = DB::table('view_all_apiproposal')
                        		->leftJoin(
	                    			'proposal_has_lib_proposal_status as pstatus', function($ljoin){
	                    				$ljoin->on('view_all_apiproposal.id', '=', 'pstatus.proposal_idproposal');
	                    				$ljoin->on('idproposal_has_lib_proposal_status', '=', DB::raw('(SELECT idproposal_has_lib_proposal_status FROM proposal_has_lib_proposal_status as lpstatus WHERE `lpstatus`.`lib_proposal_status_idlib_proposal_status` = 6 AND view_all_apiproposal.id = lpstatus.proposal_idproposal ORDER BY lpstatus.created_at ASC LIMIT 1)'));
	                    			}
	                    		)
								->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
								->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
								->leftJoin('view_proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
								->where('pd.is_active', 1)
								->where('plt.is_active', 1)
								->wherein('plt.division_iddivision', $lead_trd)
								->where(function($q) use($start_month, $start_year, $end_month, $end_year){
									$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
									$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
									$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
									$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
								})
								->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
									$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
									$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
								})
								->select(
									'view_all_apiproposal.id',
									'view_all_apiproposal.proposal_type',
									'plt.division_acronym as title',
									DB::raw('COUNT(*) as count')
								)
								->groupBy(
									'plt.division_iddivision'
								)
								->orderBy('title')
								->get();
    	return Response::json([
    		'view_proposal_count_by_trd' => $view_proposal_count_by_trd,
    		'status' => 1
    	]);
	}


	// End

	public function view_proposal_count_by_agency(Request $request){
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;


		$view_proposal_count_by_agency = DB::table('view_apiimplementingagency')
						->leftJoin('view_all_apiproposal', 'view_apiimplementingagency.proposal_idproposal', '=', 'view_all_apiproposal.id')
						->leftJoin('commonLibrariesdb.agency as libagency', 'view_apiimplementingagency.comlib_agency_id', '=', 'libagency.id')
                		->leftJoin(
                			'proposal_has_lib_proposal_status as pstatus', function($ljoin){
                				$ljoin->on('view_all_apiproposal.id', '=', 'pstatus.proposal_idproposal');
                				$ljoin->on('idproposal_has_lib_proposal_status', '=', DB::raw('(SELECT idproposal_has_lib_proposal_status FROM proposal_has_lib_proposal_status as lpstatus WHERE `lpstatus`.`lib_proposal_status_idlib_proposal_status` = 6 AND view_all_apiproposal.id = lpstatus.proposal_idproposal ORDER BY lpstatus.created_at ASC LIMIT 1)'));
                			}
                		)
						->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
						->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
						->leftJoin('proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
						->where('pd.is_active', 1)
						->where('plt.is_active', 1)
						->wherein('plt.division_iddivision', $lead_trd)
						->where('libagency.is_active', 1)
						->where(function($q) use($start_month, $start_year, $end_month, $end_year){
							$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
							$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
							$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
							$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
						})
						->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
							$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
							$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
							$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
							$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
						})
						->select(
							'view_apiimplementingagency.comlib_agency_id',
							'libagency.agency as title',
							DB::raw('COUNT(*) as count')
						)
						->groupBy(
							'view_apiimplementingagency.comlib_agency_id',
							'libagency.agency'
						)
						->orderBy('title')
						->get();
		return Response::json([
			'view_proposal_count_by_agency' => $view_proposal_count_by_agency,
    		'status' => 1
		]);
	}
	public function view_proposal_count_by_region(Request $request){
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;

		$view_proposal_count_by_region = DB::table('view_apisites')
										->leftJoin('view_all_apiproposal', 'view_apisites.proposal_idproposal', '=', 'view_all_apiproposal.id')
		                        		->leftJoin(
			                    			'proposal_has_lib_proposal_status as pstatus', function($ljoin){
			                    				$ljoin->on('view_all_apiproposal.id', '=', 'pstatus.proposal_idproposal');
			                    				$ljoin->on('idproposal_has_lib_proposal_status', '=', DB::raw('(SELECT idproposal_has_lib_proposal_status FROM proposal_has_lib_proposal_status as lpstatus WHERE `lpstatus`.`lib_proposal_status_idlib_proposal_status` = 6 AND view_all_apiproposal.id = lpstatus.proposal_idproposal ORDER BY lpstatus.created_at ASC LIMIT 1)'));
			                    			}
			                    		)
										->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
										->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
										->leftJoin('proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
										->where('pd.is_active', 1)
										->where('plt.is_active', 1)
										->wherein('plt.division_iddivision', $lead_trd)
										->where(function($q) use($start_month, $start_year, $end_month, $end_year){
											$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
											$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
											$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
											$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
										})
										->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
											$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
											$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
											$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
											$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
										})
						->select(
							'dpmis_region as title',
							DB::raw('COUNT(*) as count')
						)
						->groupBy(
							'title'
						)
						->get();
		return Response::json([
			'view_proposal_count_by_region' => $view_proposal_count_by_region,
    		'status' => 1
		]);

	}

	public function view_dost_budget(Request $request) {
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;

		$view_dost_budget = DB::table('view_apilibunion')
							->leftJoin('proposal_duration as pd', 'view_apilibunion.proposal_idproposal', '=', 'pd.proposal_idproposal')
							->leftJoin('eo_co_lib as eo_co', 'view_apilibunion.ideo_co_lib', '=', 'eo_co.ideo_co_lib')
							->leftJoin('mooe_lib as mooe', 'view_apilibunion.idmooe_lib', '=', 'mooe.idmooe_lib')
							->leftJoin('ps_lib as ps', 'view_apilibunion.idps_lib', '=', 'ps.idps_lib')
							->leftJoin('lib_dpmis_position as dpmis_position', 'ps.lib_dpmis_position_idlib_dpmis_position', '=', 'dpmis_position.idlib_dpmis_position')
							->leftJoin('proposal_lead_trd as plt', 'view_apilibunion.proposal_idproposal', '=', 'plt.proposal_idproposal')
							->where('pd.is_active', 1)
							->where('plt.is_active', 1)
							->where(function($q) use($start_month, $start_year, $end_month, $end_year){
								$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
								$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
								$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
								$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
							
							})
							->where(function($q){
								$q->orWhereNull('ps.comlib_counterpart_agency_id');
								$q->orWhereNull('eo_co.comlib_counterpart_agency_id');
								$q->orWhereNull('mooe.comlib_counterpart_agency_id');
								$q->whereNotNull('ps.comlib_imp_mon_agency_id');
								$q->whereNotNull('eo_co.comlib_imp_mon_agency_id');
								$q->whereNotNull('mooe.comlib_imp_mon_agency_id');
							})
							->select(
								DB::raw('(SELECT SUM(CASE WHEN ps.`amount` <= 0 THEN (dpmis_position.rate * ps.num_duration * ps.num_position)
                                              ELSE "-"
                                              END)) as "PS LIB Amount"'),
								DB::raw('SUM(eo_co.`amount`) as "EO CO LIB Amount"'),
								DB::raw('SUM(mooe.`amount`) as "MOOE LIB Amount"')
							)
							->get();
		return Response::json([
			'view_dost_budget' => $view_dost_budget,
    		'status' => 1
		]);
	}

	public function view_counterpart_budget(Request $request) {
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;

		$view_counterpart_budget = DB::table('view_apilibunion')
										->leftJoin('proposal_duration as pd', 'view_apilibunion.proposal_idproposal', '=', 'pd.proposal_idproposal')
										->leftJoin('eo_co_lib as eo_co', 'view_apilibunion.ideo_co_lib', '=', 'eo_co.ideo_co_lib')
										->leftJoin('mooe_lib as mooe', 'view_apilibunion.idmooe_lib', '=', 'mooe.idmooe_lib')
										->leftJoin('ps_lib as ps', 'view_apilibunion.idps_lib', '=', 'ps.idps_lib')
										->leftJoin('lib_dpmis_position as dpmis_position', 'ps.lib_dpmis_position_idlib_dpmis_position', '=', 'dpmis_position.idlib_dpmis_position')
										->leftJoin('proposal_lead_trd as plt', 'view_apilibunion.proposal_idproposal', '=', 'plt.proposal_idproposal')
										->where('pd.is_active', 1)
										->where('plt.is_active', 1)
										->where(function($q) use($start_month, $start_year, $end_month, $end_year){
											$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
											$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
											$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
											$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
										})
										->where(function($q){
											$q->whereNotNull('ps.comlib_counterpart_agency_id');
											$q->whereNotNull('eo_co.comlib_counterpart_agency_id');
											$q->whereNotNull('mooe.comlib_counterpart_agency_id');
											$q->orWhereNull('ps.comlib_imp_mon_agency_id');
											$q->orWhereNull('eo_co.comlib_imp_mon_agency_id');
											$q->orWhereNull('mooe.comlib_imp_mon_agency_id');
										})
										->select(
											DB::raw('(SELECT SUM(CASE WHEN ps.`amount` <= 0 THEN (dpmis_position.rate * ps.num_duration * ps.num_position)
                                                          ELSE "-"
                                                          END)) as "PS LIB Amount"'),
											DB::raw('SUM(eo_co.`amount`) as "EO CO LIB Amount"'),
											DB::raw('SUM(mooe.`amount`) as "MOOE LIB Amount"')
										)
										->get();
		return Response::json([
			'view_counterpart_budget' => $view_counterpart_budget,
    		'status' => 1
		]);
	}

	public function view_proposal_count_by_month(Request $request) {
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;



		$view_proposal_count_by_month = DB::table('view_all_apiproposal')
											
			                        		->leftJoin(
				                    			'proposal_has_lib_proposal_status as pstatus', function($ljoin){
				                    				$ljoin->on('view_all_apiproposal.id', '=', 'pstatus.proposal_idproposal');
				                    				$ljoin->on('idproposal_has_lib_proposal_status', '=', DB::raw('(SELECT idproposal_has_lib_proposal_status FROM proposal_has_lib_proposal_status as lpstatus WHERE `lpstatus`.`lib_proposal_status_idlib_proposal_status` = 6 AND view_all_apiproposal.id = lpstatus.proposal_idproposal ORDER BY lpstatus.created_at ASC LIMIT 1)'));
				                    			}
				                    		)
											->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
											->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
											->leftJoin('proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
											->where('pd.is_active', 1)
											->where('plt.is_active', 1)
											->wherein('plt.division_iddivision', $lead_trd)
											->where(function($q) use($start_month, $start_year, $end_month, $end_year){
												$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
												$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
												$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
												$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
											})
											->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
												$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
												$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
												$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
												$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
											})
											->select(
												DB::raw('CONCAT(MONTHNAME(pd.start_date), " ", YEAR(pd.start_date)) as title'),
												DB::raw('COUNT(*) as count')
											)
											->groupBy(
												DB::raw('YEAR(pd.start_date)'),
												DB::raw('MONTH(pd.start_date)')
											)
											->get();
		return Response::json([
			'view_proposal_count_by_month' => $view_proposal_count_by_month,
    		'status' => 1
		]);
	}

	public function view_proposal_count_by_quarter(Request $request) {
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;



		$view_proposal_count_by_quarter = DB::table('view_all_apiproposal')
											
			                        		->leftJoin(
				                    			'proposal_has_lib_proposal_status as pstatus', function($ljoin){
				                    				$ljoin->on('view_all_apiproposal.id', '=', 'pstatus.proposal_idproposal');
				                    				$ljoin->on('idproposal_has_lib_proposal_status', '=', DB::raw('(SELECT idproposal_has_lib_proposal_status FROM proposal_has_lib_proposal_status as lpstatus WHERE `lpstatus`.`lib_proposal_status_idlib_proposal_status` = 6 AND view_all_apiproposal.id = lpstatus.proposal_idproposal ORDER BY lpstatus.created_at ASC LIMIT 1)'));
				                    			}
				                    		)
											->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
											->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
											->leftJoin('proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
											->where('pd.is_active', 1)
											->where('plt.is_active', 1)
											->wherein('plt.division_iddivision', $lead_trd)
											->where(function($q) use($start_month, $start_year, $end_month, $end_year){
												$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
												$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
												$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
												$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
											})
											->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
												$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
												$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
												$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
												$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
											})
											->select(
												DB::raw('CONCAT(YEAR(pd.start_date), " Q", QUARTER(pd.start_date)) as title'),
												DB::raw('COUNT(*) as count')
											)
											->groupBy(
												DB::raw('YEAR(pd.start_date)'),
												DB::raw('QUARTER(pd.start_date)')
											)
											->get();
		return Response::json([
			'view_proposal_count_by_quarter' => $view_proposal_count_by_quarter,
    		'status' => 1
		]);
	}
	public function view_proposal_count_by_year(Request $request) {
		//insert filters here
		$this->set_filters($request);
		$start_month = $this->start_month;
		$start_year = $this->start_year;
		$end_month = $this->end_month;
		$end_year = $this->end_year;
		$date_received_start_month = $this->date_received_start_month;
		$date_received_start_year = $this->date_received_start_year;
		$date_received_end_month = $this->date_received_end_month;
		$date_received_end_year = $this->date_received_end_year;
		$lead_trd = $this->lead_trd;



		$view_proposal_count_by_year = DB::table('view_all_apiproposal')
											
		                        		->leftJoin(
			                    			'proposal_has_lib_proposal_status as pstatus', function($ljoin){
			                    				$ljoin->on('view_all_apiproposal.id', '=', 'pstatus.proposal_idproposal');
			                    				$ljoin->on('idproposal_has_lib_proposal_status', '=', DB::raw('(SELECT idproposal_has_lib_proposal_status FROM proposal_has_lib_proposal_status as lpstatus WHERE `lpstatus`.`lib_proposal_status_idlib_proposal_status` = 6 AND view_all_apiproposal.id = lpstatus.proposal_idproposal ORDER BY lpstatus.created_at ASC LIMIT 1)'));
			                    			}
			                    		)
										->leftJoin('proposal_duration as pd', 'view_all_apiproposal.id', '=', 'pd.proposal_idproposal')
										->leftJoin('lib_proposal_type as libptype', 'view_all_apiproposal.proposal_type', '=', 'libptype.idlib_proposal_type')
										->leftJoin('proposal_lead_trd as plt', 'view_all_apiproposal.id', '=', 'plt.proposal_idproposal')
										->where('pd.is_active', 1)
										->where('plt.is_active', 1)
										->wherein('plt.division_iddivision', $lead_trd)
										->where(function($q) use($start_month, $start_year, $end_month, $end_year){
											$q->where(DB::raw('MONTH(pd.start_date)'), '>=', $start_month);
											$q->where(DB::raw('YEAR(pd.start_date)'), '>=', $start_year);
											$q->where(DB::raw('MONTH(pd.end_date)'), '<=', $end_month);
											$q->where(DB::raw('YEAR(pd.end_date)'), '<=', $end_year);
										})
										->where(function($q) use($date_received_start_month, $date_received_start_year, $date_received_end_month, $date_received_end_year){
											$q->where(DB::raw('MONTH(pstatus.created_at)'), '>=', $date_received_start_month);
											$q->where(DB::raw('YEAR(pstatus.created_at)'), '>=', $date_received_start_year);
											$q->where(DB::raw('MONTH(pstatus.created_at)'), '<=', $date_received_end_month);
											$q->where(DB::raw('YEAR(pstatus.created_at)'), '<=', $date_received_end_year);
										})
											->select(
												DB::raw('YEAR(pd.start_date) as title'),
												DB::raw('COUNT(*) as count')
											)
											->groupBy(
												DB::raw('YEAR(pd.start_date)')
											)
											->get();
		return Response::json([
			'view_proposal_count_by_year' => $view_proposal_count_by_year,
    		'status' => 1
		]);
	}
}
