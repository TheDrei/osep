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


class ProposalsController extends Controller
{

    private $proposal_select;
    public function proposal_select() {
      $proposal_select = DB::table('proposal')
                                  ->leftJoin('proposal_has_lib_proposal_status as pstatus', 'pstatus.proposal_idproposal', '=', 'proposal.idproposal')
                                  ->leftJoin('lib_proposal_status as libstatus', 'libstatus.idlib_proposal_status', '=', 'pstatus.lib_proposal_status_idlib_proposal_status')
                                  ->select(
                                    'proposal.idproposal as proposal_id',
                                    'proposal.program_id as program_id',
                                    'proposal.title as title',
                                    'libstatus.status as proposal_status',
                                    'proposal.proposal_type as proposal_type_id',
                                    'proposal.research_type as proposal_research_type_id',
                                    'proposal.dpmis_date_submitted as dpmis_date_submitted',
                                    DB::raw('(
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
                                    'proposal.dpmis_hnrda_id AS dpmis_hnrda_id',
                                    'proposal.dpmis_hnrda_classification AS dpmis_hnrda_classification',
                                    'proposal.dpmis_hnrda_item_id AS dpmis_hnrda_item_id',
                                    'proposal.dpmis_hnrda_item AS dpmis_hnrda_item',
                                    'proposal.gad_score AS gad_score',
                                    DB::raw('
                                      (
                                        SELECT
                                            `researcher`.`dpmis_researcher_id`
                                        FROM
                                            `proposal_researcher` `researcher`
                                        WHERE
                                            `researcher`.`proposal_idproposal` = `proposal`.`idproposal` AND `researcher`.`is_lead` IS TRUE AND `researcher`.`is_active` IS TRUE
                                      ) AS `researcher_id`
                                    '),
                                    DB::raw('
                                      (
                                        SELECT
                                            DATE_FORMAT(durs.start_date, "%b. %e, %Y")
                                        FROM
                                            `proposal_duration` `durs`
                                        WHERE
                                            `durs`.`proposal_idproposal` = `proposal`.`idproposal` AND `durs`.`is_active` IS TRUE
                                      ) AS `start_date`
                                    '),
                                    DB::raw('
                                      (
                                        SELECT
                                            DATE_FORMAT(durs.end_date, "%b. %e, %Y")
                                        FROM
                                            `proposal_duration` `durs`
                                        WHERE
                                            `durs`.`proposal_idproposal` = `proposal`.`idproposal` AND `durs`.`is_active` IS TRUE
                                      ) AS `end_date`
                                    '),
                                    DB::raw('
                                      (
                                        SELECT
                                            CONCAT(
                                              DATE_FORMAT(dur.start_date, "%b. %e, %Y"),
                                              "-",
                                              DATE_FORMAT(dur.end_date, "%b. %e, %Y")
                                            )
                                        FROM
                                            `proposal_duration` `dur`
                                        WHERE
                                            `dur`.`proposal_idproposal` = `proposal`.`idproposal` AND `dur`.`is_active` IS TRUE
                                    ) AS `duration`
                                    '),
                                    DB::raw('
                                      ( 
                                        SELECT
                                            (
                                                CASE WHEN (SELECT COALESCE(MAX(year), 0) FROM `view_apilibunion` `apilib` WHERE `apilib`.`proposal_idproposal` = `proposal`.`idproposal` AND `apilib`.`is_active` IS TRUE) != 0 
                                                THEN (SELECT COALESCE(MAX(year), 0) FROM `view_apilibunion` `apilib` WHERE `apilib`.`proposal_idproposal` = `proposal`.`idproposal` AND `apilib`.`is_active` IS TRUE) 
                                                ELSE (SELECT TIMESTAMPDIFF(year, start_date, end_date) + 1 FROM `proposal_duration` `dur` WHERE `dur`.`proposal_idproposal` = `proposal`.`idproposal` AND `dur`.`is_active` IS TRUE) 
                                                END
                                            )
                                    ) AS `proposal_years`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `b`.`label` SEPARATOR "; ") AS `policy_area`
                                        FROM
                                            (
                                                `proposal_has_lib_rd_policy_area` `a`
                                            JOIN `lib_rd_policy_area` `b` ON
                                                (
                                                    `a`.`lib_rd_policy_area_idlib_rd_policy_area` = `b`.`idlib_rd_policy_area`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `b`.`is_active` IS TRUE
                                    ) AS `hnrda_classification`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(
                                                DISTINCT `b`.`label`,
                                                "-",
                                                `a`.`value` SEPARATOR "; "
                                            ) AS `policy_program`
                                        FROM
                                            (
                                                `proposal_has_lib_rd_policy_program` `a`
                                            JOIN `lib_rd_policy_program` `b` ON
                                                (
                                                    `a`.`lib_rd_policy_program_idlib_rd_policy_program` = `b`.`idlib_rd_policy_program`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `b`.`is_active` IS TRUE
                                    ) AS `hnrda_item`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`description` SEPARATOR "; ")
                                        FROM
                                            `description` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `description`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`significance` SEPARATOR "; ")
                                        FROM
                                            `significance` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `significance`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`discussion` SEPARATOR "; ")
                                        FROM
                                            `discussion` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `discussion`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`rationale` SEPARATOR "; ")
                                        FROM
                                            `rationale` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `rationale`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`marketing_commercial_viability` SEPARATOR "; ")
                                        FROM
                                            `marketing_commercial_viability` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `marketing_commercial_viability`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`review_of_literature` SEPARATOR "; ")
                                        FROM
                                            `review_of_literature` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `literature`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(`a`.`objective` SEPARATOR "; ")
                                        FROM
                                            `objective` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_general` IS TRUE AND `a`.`is_active` IS TRUE
                                    ) AS `general_objective`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(`a`.`objective` SEPARATOR "; ")
                                        FROM
                                            `objective` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_general` IS FALSE AND `a`.`is_active` IS TRUE
                                    ) AS `specific_objective`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`methodology` SEPARATOR "; ")
                                        FROM
                                            `methodology` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `methodology`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`output` SEPARATOR "; ") AS `output`
                                        FROM
                                            (
                                                `output` `a`
                                            JOIN `lib_output_type` `b` ON
                                                (
                                                    `a`.`lib_output_type_idlib_output_type` = `b`.`idlib_output_type`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `b`.`idlib_output_type` = 1 AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `sixp_publication`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`output` SEPARATOR "; ") AS `output`
                                        FROM
                                            (
                                                `output` `a`
                                            JOIN `lib_output_type` `b` ON
                                                (
                                                    `a`.`lib_output_type_idlib_output_type` = `b`.`idlib_output_type`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `b`.`idlib_output_type` = 2 AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `sixp_patent`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`output` SEPARATOR "; ") AS `output`
                                        FROM
                                            (
                                                `output` `a`
                                            JOIN `lib_output_type` `b` ON
                                                (
                                                    `a`.`lib_output_type_idlib_output_type` = `b`.`idlib_output_type`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `b`.`idlib_output_type` = 3 AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `sixp_product`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`output` SEPARATOR "; ") AS `output`
                                        FROM
                                            (
                                                `output` `a`
                                            JOIN `lib_output_type` `b` ON
                                                (
                                                    `a`.`lib_output_type_idlib_output_type` = `b`.`idlib_output_type`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `b`.`idlib_output_type` = 4 AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `sixp_people`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`output` SEPARATOR "; ") AS `output`
                                        FROM
                                            (
                                                `output` `a`
                                            JOIN `lib_output_type` `b` ON
                                                (
                                                    `a`.`lib_output_type_idlib_output_type` = `b`.`idlib_output_type`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `b`.`idlib_output_type` = 5 AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `sixp_place`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`output` SEPARATOR "; ") AS `output`
                                        FROM
                                            (
                                                `output` `a`
                                            JOIN `lib_output_type` `b` ON
                                                (
                                                    `a`.`lib_output_type_idlib_output_type` = `b`.`idlib_output_type`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `b`.`idlib_output_type` = 6 AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `sixp_policy`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`outcome` SEPARATOR "; ")
                                        FROM
                                            `outcome` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `outcomes`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`impact` SEPARATOR "; ") AS `impact`
                                        FROM
                                            (
                                                `impact` `a`
                                            JOIN `lib_impact_type` `b` ON
                                                (
                                                    `a`.`lib_impact_type_idlib_impact_type` = `b`.`idlib_impact_type`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `b`.`idlib_impact_type` = 1 AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `social_impact`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`impact` SEPARATOR "; ") AS `impact`
                                        FROM
                                            (
                                                `impact` `a`
                                            JOIN `lib_impact_type` `b` ON
                                                (
                                                    `a`.`lib_impact_type_idlib_impact_type` = `b`.`idlib_impact_type`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `b`.`idlib_impact_type` = 2 AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `economic_impact`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`beneficiaries` SEPARATOR "; ")
                                        FROM
                                            `beneficiary` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `target_beneficiaries`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`sustainability` SEPARATOR "; ")
                                        FROM
                                            `sustainability` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `sustainability`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`limitation` SEPARATOR "; ")
                                        FROM
                                            `limitation` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `limitations`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`literature_cited` SEPARATOR "; ")
                                        FROM
                                            `literature_cited` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `literature_cited`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`risk_assumption` SEPARATOR "; ")
                                        FROM
                                            `risk_assumption` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `risks_assumptions`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`executive_summary` SEPARATOR "; ")
                                        FROM
                                            `executive_summary` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `executive_summary`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`scientific_framework` SEPARATOR "; ")
                                        FROM
                                            `scientific_framework` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `scientific_framework`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`url` SEPARATOR "; ")
                                        FROM
                                            `technology_roadmap` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `technology_roadmap`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`proposed_measure` SEPARATOR "; ")
                                        FROM
                                            `proposed_measure` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `proposed_measure`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`nonrd_id` SEPARATOR "; ")
                                        FROM
                                            `nonrd_type` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `nonrd_id`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`nonrd_type` SEPARATOR "; ")
                                        FROM
                                            `nonrd_type` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `nonrd_type`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            `b`.`dpmis_call_id`
                                        FROM
                                            (
                                                `proposal_has_lib_call_for_proposal` `a`
                                            JOIN `lib_call_for_proposal` `b` ON
                                                (
                                                    `a`.`lib_call_for_proposal_idlib_call_for_proposal` = `b`.`idlib_call_for_proposal`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `call_id`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            `b`.`call_name`
                                        FROM
                                            (
                                                `proposal_has_lib_call_for_proposal` `a`
                                            JOIN `lib_call_for_proposal` `b` ON
                                                (
                                                    `a`.`lib_call_for_proposal_idlib_call_for_proposal` = `b`.`idlib_call_for_proposal`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `call_name`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            `b`.`call_code`
                                        FROM
                                            (
                                                `proposal_has_lib_call_for_proposal` `a`
                                            JOIN `lib_call_for_proposal` `b` ON
                                                (
                                                    `a`.`lib_call_for_proposal_idlib_call_for_proposal` = `b`.`idlib_call_for_proposal`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `call_code`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            `b`.`call_start_date`
                                        FROM
                                            (
                                                `proposal_has_lib_call_for_proposal` `a`
                                            JOIN `lib_call_for_proposal` `b` ON
                                                (
                                                    `a`.`lib_call_for_proposal_idlib_call_for_proposal` = `b`.`idlib_call_for_proposal`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `call_start_date`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            `b`.`call_end_date`
                                        FROM
                                            (
                                                `proposal_has_lib_call_for_proposal` `a`
                                            JOIN `lib_call_for_proposal` `b` ON
                                                (
                                                    `a`.`lib_call_for_proposal_idlib_call_for_proposal` = `b`.`idlib_call_for_proposal`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `call_end_date`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            `b`.`is_dostco_call`
                                        FROM
                                            (
                                                `proposal_has_lib_call_for_proposal` `a`
                                            JOIN `lib_call_for_proposal` `b` ON
                                                (
                                                    `a`.`lib_call_for_proposal_idlib_call_for_proposal` = `b`.`idlib_call_for_proposal`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `is_dostco_call`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`remarks` SEPARATOR "; ")
                                        FROM
                                            (
                                                `proposal_has_lib_call_for_proposal` `a`
                                            JOIN `lib_call_for_proposal` `b` ON
                                                (
                                                    `a`.`lib_call_for_proposal_idlib_call_for_proposal` = `b`.`idlib_call_for_proposal`
                                                )
                                            )
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                    ) AS `remarks`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`project_management` SEPARATOR "; ")
                                        FROM
                                            `project_management` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `project_management`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`sdg_title` SEPARATOR "; ")
                                        FROM
                                            `proposal_sdg` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `sdg_addressed`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(DISTINCT `a`.`startup_background` SEPARATOR "; ")
                                        FROM
                                            `startup_background` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE
                                    ) AS `startup_background`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(
                                                DISTINCT CONCAT(
                                                    `a`.`dpmis_implementation_site`,
                                                    "  (",
                                                    `a`.`dpmis_municipality`,
                                                    " ",
                                                    `a`.`dpmis_district`,
                                                    " ",
                                                    `a`.`dpmis_province`,
                                                    " ",
                                                    `a`.`dpmis_region`,
                                                    ")"
                                                ) SEPARATOR "<br> "
                                            )
                                        FROM
                                            `implementation_site` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = 1 AND `a`.`is_active` IS TRUE AND `a`.`is_lead` IS TRUE
                                    ) AS `base_implementation_site_station`
                                    '),
                                    DB::raw('
                                    (
                                        SELECT
                                            GROUP_CONCAT(
                                                DISTINCT CONCAT(
                                                    `a`.`dpmis_implementation_site`,
                                                    "  (",
                                                    `a`.`dpmis_municipality`,
                                                    " ",
                                                    `a`.`dpmis_district`,
                                                    " ",
                                                    `a`.`dpmis_province`,
                                                    " ",
                                                    `a`.`dpmis_region`,
                                                    ")"
                                                ) SEPARATOR "<br> "
                                            )
                                        FROM
                                            `implementation_site` `a`
                                        WHERE
                                            `a`.`proposal_idproposal` = 1 AND `a`.`is_active` IS TRUE AND `a`.`is_lead` IS FALSE
                                    ) AS `other_implementation_site_station`
                                    '),
                                    DB::raw('
                                    (SELECT 
                                          (
                                            CASE
                                              WHEN pstatus.created_at IS NULL OR pstatus.created_at = ""
                                                THEN "Not yet forwarded"
                                              ELSE DATE_FORMAT(pstatus.created_at, "%b %e, %Y (%T)")
                                            END
                                          ) FROM `proposal_has_lib_proposal_status` pstatus WHERE pstatus.proposal_idproposal = proposal.idproposal AND pstatus.lib_proposal_status_idlib_proposal_status = 6 ORDER BY pstatus.created_at ASC LIMIT 1) as date_forwarded_through_api'),
                                   // Added by Drei - 7/20/2022
                                   DB::raw('
                                   (SELECT 
                                         (
                                           CASE
                                             WHEN pstatus.created_at IS NULL OR pstatus.created_at = ""
                                               THEN "Not yet forwarded"
                                             ELSE DATE_FORMAT(pstatus.created_at, "%b %e, %Y (%T)")
                                           END
                                         ) FROM `proposal_has_lib_proposal_status` pstatus WHERE pstatus.proposal_idproposal = proposal.idproposal AND pstatus.lib_proposal_status_idlib_proposal_status = 8 ORDER BY pstatus.created_at ASC LIMIT 1) as date_forwarded_by_trd'),
                                    //End      
                                    DB::raw('(SELECT ptype.proposal_type FROM `lib_proposal_type` ptype WHERE ptype.idlib_proposal_type = proposal.proposal_type) as proposal_type'),
                                    DB::raw('(SELECT rtype.research_type FROM `lib_research_type` rtype WHERE rtype.idlib_research_type = proposal.research_type) as research_type'),
                                    DB::raw('(SELECT libcall.call_name FROM `proposal_has_lib_call_for_proposal` pcall LEFT JOIN `lib_call_for_proposal` libcall ON pcall.lib_call_for_proposal_idlib_call_for_proposal = libcall.idlib_call_for_proposal WHERE pcall.proposal_idproposal = proposal.idproposal) as call_for_proposal'),
                                    DB::raw('(SELECT pr.title FROM proposal pr WHERE proposal.program_id = pr.program_id AND (pr.proposal_type = 1 OR pr.proposal_type = 3 OR pr.proposal_type = 5) LIMIT 1) as proposal_program_title'),
                                    DB::raw('(SELECT pr.title FROM proposal pr WHERE proposal.project_id = pr.project_id AND (pr.proposal_type = 2 OR pr.proposal_type = 4 OR pr.proposal_type = 6) LIMIT 1) as proposal_project_title'),
                                    DB::raw('(SELECT GROUP_CONCAT(commlibagency.acronym, "; ") FROM view_apicooperatingagency coopagency LEFT JOIN commonlibrariesdb.agency as commlibagency ON coopagency.comlib_agency_id = commlibagency.id WHERE coopagency.proposal_idproposal = proposal.idproposal) as proposal_cooperating_agencys'),
                                    DB::raw('(SELECT GROUP_CONCAT(commlibagency.acronym, "; ") FROM view_apiimplementingagency impagency LEFT JOIN commonlibrariesdb.agency as commlibagency ON impagency.comlib_agency_id = commlibagency.id WHERE impagency.proposal_idproposal = proposal.idproposal) as proposal_implementing_agencys'),
                                    DB::raw('(SELECT CONCAT(DATE_FORMAT(pd.`start_date`, "%M %d, %Y"), " - ", DATE_FORMAT(pd.`end_date`, "%M %d, %Y"), " (", pd.project_month_length ,") months") FROM `proposal_duration` pd WHERE proposal.idproposal = pd.proposal_idproposal AND pd.is_active = 1) as proposal_total_duration'),
                                    DB::raw('(SELECT CONCAT(hr.hr_first_name, " ", hr.hr_last_name) FROM proposal pr LEFT JOIN proposal_researcher prhr ON pr.idproposal = prhr.proposal_idproposal LEFT JOIN hrisv2db.records as hr ON prhr.hris_researcher_id = hr.id WHERE proposal.program_id = pr.program_id AND (pr.proposal_type = 1 OR pr.proposal_type = 3 OR pr.proposal_type = 5) LIMIT 1) as proposal_program_leader'),
                                    DB::raw('(SELECT CONCAT(hr.hr_first_name, " ", hr.hr_last_name) FROM proposal pr LEFT JOIN proposal_researcher prhr ON pr.idproposal = prhr.proposal_idproposal LEFT JOIN hrisv2db.records as hr ON prhr.hris_researcher_id = hr.id WHERE proposal.project_id = pr.project_id AND (pr.proposal_type = 2 OR pr.proposal_type = 4 OR pr.proposal_type = 6) LIMIT 1) as proposal_project_leader'),
                                    DB::raw('(SELECT 
                                      (
                                        CASE
                                          WHEN pstatus.created_at IS NULL OR pstatus.created_at = ""
                                            THEN "Not yet forwarded"
                                          ELSE DATE_FORMAT(pstatus.created_at, "%b %e, %Y (%T)")
                                        END
                                      ) FROM `proposal_has_lib_proposal_status` pstatus WHERE pstatus.proposal_idproposal = proposal.idproposal AND pstatus.lib_proposal_status_idlib_proposal_status = 6 ORDER BY pstatus.created_at ASC LIMIT 1) as date_forwarded_through_api'),
                                       // Added by Drei
                                      DB::raw('
                                      (SELECT 
                                            (
                                              CASE
                                                WHEN pstatus.created_at IS NULL OR pstatus.created_at = ""
                                                  THEN "Not yet forwarded"
                                                ELSE DATE_FORMAT(pstatus.created_at, "%b %e, %Y (%T)")
                                              END
                                            ) FROM `proposal_has_lib_proposal_status` pstatus WHERE pstatus.proposal_idproposal = proposal.idproposal AND pstatus.lib_proposal_status_idlib_proposal_status = 8 ORDER BY pstatus.created_at ASC LIMIT 1) as date_forwarded_by_trd'),
                                    //End
                                    DB::raw('
                                      (SELECT (
                                        CASE
                                          WHEN DATE_FORMAT(pd.`start_date`, "%Y") = DATE_FORMAT(pd.`end_date`, "%Y")
                                            THEN DATE_FORMAT(pd.`start_date`, "%Y")
                                          ELSE CONCAT(DATE_FORMAT(pd.`start_date`, "%Y"), " - ", DATE_FORMAT(pd.`end_date`, "%Y"))
                                          END
                                        )
                                        FROM `proposal_duration` pd WHERE proposal.idproposal = pd.proposal_idproposal AND pd.is_active = 1) as proposal_duration_year'),
                                    DB::raw('(
                                      CASE
                                        WHEN (proposal.project_id IS NULL OR proposal.project_id = "") AND (proposal.program_id IS NOT NULL AND proposal.program_id != "")
                                          THEN proposal.program_id
                                        WHEN (proposal.program_id IS NULL OR proposal.program_id = "") AND (proposal.project_id IS NOT NULL AND proposal.project_id != "")
                                          THEN proposal.project_id
                                        WHEN (proposal.program_id IS NOT NULL AND proposal.program_id != "" AND proposal.project_id IS NOT NULL AND proposal.project_id != "")
                                          THEN proposal.project_id
                                        ELSE "N/A"
                                      END
                                    ) AS proposal_code')
                                  );
      return $proposal_select;
    }
    
    protected function replace_funding_agency_keys($lib_array) {
        for($i = 0; $i < count($lib_array); $i++) {
            $bs_funding_agency_id = $lib_array[$i]->funding_agency_id;
            $lib_array[$bs_funding_agency_id] = $lib_array[$i];
            unset($lib_array[$i]);
        }
        return $lib_array;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    //Drei
    public function exclude_from_program(Request $request)
    {
      if($request->ajax()){
        if($request->get('proposal_id')){
          $request->session()->forget('success');
          $request->session()->forget('error');
          $proposal_id = $request->get('proposal_id');
          $remarks = "Approved as separate project";
          $status = 43;
          $approved_implementation_start_date = $request->get('approved_implementation_start_date');
          $approved_implementation_end_date = $request->get('approved_implementation_end_date');
          try {
            $current_status = DB::table('proposal_has_lib_proposal_status')
                                  ->where('proposal_idproposal', $proposal_id)
                                  ->where('is_active', 1)
                                  ->pluck('lib_proposal_status_idlib_proposal_status')
                                  ->first();
            $proposal_update_status = DB::table('proposal')
                                        ->where('proposal.idproposal', $proposal_id)
                                        ->select(
                                          DB::raw('
                                            (
                                              SELECT
                                                  `a`.`remarks`
                                              FROM
                                                  (
                                                      `proposal_has_lib_call_for_proposal` `a`
                                                  JOIN `lib_call_for_proposal` `b` ON
                                                      (
                                                          `a`.`lib_call_for_proposal_idlib_call_for_proposal` = `b`.`idlib_call_for_proposal`
                                                      )
                                                  )
                                              WHERE
                                                  `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                          ) AS `remarks`
                                          '),
                                          DB::raw('(
                                            CASE WHEN project_id IS NULL THEN program_id
                                            ELSE project_id
                                            END
                                          ) as project_id')
                                        )
                                        ->first();
            $allowed_transitions = DB::table('lib_proposal_status_allowed_transitions')
                                    ->where('from_lib_proposal_status_idlib_proposal_status', $current_status)
                                    ->where('is_active', 1)
                                    ->pluck('to_lib_proposal_status_idlib_proposal_status');
            $allowed_transitions_text = DB::table('lib_proposal_status_allowed_transitions')
                                        ->leftJoin('lib_proposal_status', 'lib_proposal_status_allowed_transitions.to_lib_proposal_status_idlib_proposal_status', '=', 'lib_proposal_status.idlib_proposal_status')
                                        ->where('from_lib_proposal_status_idlib_proposal_status', $current_status)
                                        ->where('lib_proposal_status_allowed_transitions.is_active', 1)
                                        ->select(DB::raw('(SELECT (COALESCE(GROUP_CONCAT(DISTINCT `lib_proposal_status`.`status` SEPARATOR ", <br/>") , "N/A"))) as allowed_transitions'))
                                        ->pluck('allowed_transitions')
                                        ->first();
            $lead_division = DB::table('proposal_lead_trd')
                                    ->where('proposal_lead_trd.proposal_idproposal', $proposal_id)
                                    ->where('proposal_lead_trd.is_active', 1)
                                    ->groupBy('proposal_lead_trd.division_iddivision')
                                    ->pluck('proposal_lead_trd.division_iddivision')
                                    ->first();
            $lead_division_text = DB::table('commonlibrariesdb.pcaarrd_divisions')
                                    ->where('id', $lead_division)
                                    ->pluck('division_acronym')
                                    ->first();
            if((Auth::user()->privilege == 1 || Auth::user()->privilege == 2 || Auth::user()->division == $lead_division) || in_array($status, $allowed_transitions->toArray()) || $status == 15) {
                if($status == 16 && Auth::user()->privilege == 3 && Auth::user()->division != $lead_division){
                    if(!is_null($lead_division_text)) {
                        Session::flash('error', 'Only the lead division can consolidate comments. Please contact '.$lead_division_text. ' (lead)');
                        return Response::json([
                            'view' => View::make('partials/flash-messages')->render(),
                            'status'=>'0'
                        ]);
                    }                     
                }
             
                if($status == 16) {
                    $proposal_implementation_dates = DB::table('proposal_implementation_dates')->where('proposal_idproposal', $proposal_id)->first();

                          if(!$proposal_implementation_dates) {
                              DB::table('proposal_implementation_dates')->insert([
                                  'approved_implementation_start_date' => $approved_implementation_start_date,
                                  'proposal_idproposal' => $proposal_id,
                                  'approved_implementation_end_date' => $approved_implementation_end_date,
                                  'is_active' => 1
                              ]);
                          } else {
                              DB::table('proposal_implementation_dates')->where('proposal_idproposal', $proposal_id)
                              ->update([
                                  'approved_implementation_start_date' => $approved_implementation_start_date,
                                  'approved_implementation_end_date' => $approved_implementation_end_date,
                                  'is_active' => 1
                              ]);
                          }
                    }
                $proposal_status = DB::table('proposal_has_lib_proposal_status')
                                ->where('proposal_idproposal', $proposal_id)
                                ->update([
                                  'is_active' => 0
                                ]);

                DB::table('proposal_has_lib_proposal_status')
                    ->insert([
                    'proposal_idproposal' => $proposal_id,
                    'lib_proposal_status_idlib_proposal_status' => $status,
                    'remarks' => $remarks,
                    'is_active' => '1'
                ]);

                $new_status = DB::table('proposal_has_lib_proposal_status')
                          ->where('proposal_idproposal', $proposal_id)
                          ->where('lib_proposal_status_idlib_proposal_status', $status)
                          ->where('proposal_has_lib_proposal_status.is_active', 1)
                          ->leftJoin('lib_proposal_status', 'proposal_has_lib_proposal_status.lib_proposal_status_idlib_proposal_status', '=', 'lib_proposal_status.idlib_proposal_status')
                          ->select(
                            'proposal_has_lib_proposal_status.remarks as remarks',
                            'proposal_has_lib_proposal_status.idproposal_has_lib_proposal_status',
                            'proposal_has_lib_proposal_status.created_at as pcreated_at',
                            'lib_proposal_status.*'
                          )
                          ->first();
                try {
                    $now = Carbon::now();
                    $dpmis_auth = new Client(['proxy' => 'tcp://192.168.0.9:3128']);
                    $dpmis_auth_result = $dpmis_auth->post('http://202.90.141.23/dpmisoauth', [
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

                    $dpmis_update_status = $dpmis_auth->post('http://202.90.141.23/statuses', [

                      'headers' => [
                        'Authorization' => ' Bearer '.$dpmis_access_token,
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json'
                      ],
                      'json' => [
                        'project_id' => (!is_null($proposal_update_status->project_id) ? $proposal_update_status->project_id : 'Not Applicable'),
                        'status_id' => (!is_null($new_status->idproposal_has_lib_proposal_status) ? $new_status->idproposal_has_lib_proposal_status : '7'),
                        'status_name' => (!is_null($new_status->status) ? $new_status->status : 'N/A'),
                        'status_type' =>  (!is_null($new_status->dpmis_counterpart_status_id) ? $new_status->dpmis_counterpart_status_id : '1'),
                        'remarks' => (!is_null($new_status->remarks) ? $new_status->remarks : $new_status->status),
                        'date_created' => (!is_null($new_status->pcreated_at) ? $new_status->pcreated_at : $now),
                        'evaluation_level' => (!is_null($new_status->evaluation_level) ? $new_status->evaluation_level : '1'),
                        'is_closed' => (!is_null($new_status->is_evaluation_closed) ? $new_status->is_evaluation_closed : 'N/A'),
                        'created_by' => ((!is_null(Auth::user()->first_name) && !is_null(Auth::user()->last_name)) ? Auth::user()->first_name.' '.Auth::user()->last_name : 'Pamela Anne Tandang')

                      ]
                    ]); 
               
                } catch (GuzzleHttp\Exception\ClientException $e) {

                }
            } else if(!in_array($status, $allowed_transitions->toArray())){
              Session::flash('error', 'Status transition is not allowed. <br> Only allowed transitions are:<br/> <b>'.$allowed_transitions_text.'</b>');
              return Response::json([
               'view' => View::make('partials/flash-messages')->render(),
               'status'=>'0'
              ]);
            }
          } catch (Exception $e) {
            dd($e);
            Session::flash('error', 'Proposal status update has failed');
            return Response::json([
             'view' => View::make('partials/flash-messages')->render(),
             'status'=>'0'
            ]);
          }
          Session::flash('success', 'Proposal status has been updated successfully');
          return Response::json([
           'view' => View::make('partials/flash-messages')->render(),
           'status'=>'1'
          ]);

        }
      }
    }
    //END 


    public function table(Request $request, $filter) {
        if($request->ajax()) {
          $data;
          //for get proposal status per table
          $proposal_status = $filter[0]['proposal_status'];
          $proposal_select = $this->proposal_select();
          try {
            if(Auth::user()->privilege == 1){
              $data = 
                DB::table('proposal')
                    ->leftJoin('proposal_has_lib_proposal_status as pstatus', 'pstatus.proposal_idproposal', '=', 'proposal.idproposal')
                    ->leftJoin('lib_proposal_status as libstatus', 'libstatus.idlib_proposal_status', '=', 'pstatus.lib_proposal_status_idlib_proposal_status')
           //Added: leftJoin for view_proposal_agency_division_type
 					->leftJoin('view_proposal_agency_division_type as agency_division_type', 'agency_division_type.idproposal',  '=', 'proposal.idproposal')                    
 					->select(
                      DB::raw('(SELECT ptype.proposal_type FROM `lib_proposal_type` ptype WHERE ptype.idlib_proposal_type = proposal.proposal_type) as proposal_type'),
                      'proposal.program_id as program_id',
                      'proposal.dpmis_date_submitted as dpmis_date_submitted',
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
                        ) AS proposal_code'
                      ),
                      'proposal.title as title',
                      DB::raw('
                        (
                          SELECT
                              CONCAT(
                                DATE_FORMAT(dur.start_date, "%b. %e, %Y"),
                                "-",
                                DATE_FORMAT(dur.end_date, "%b. %e, %Y")
                              )
                          FROM
                              `proposal_duration` `dur`
                          WHERE
                              `dur`.`proposal_idproposal` = `proposal`.`idproposal` AND `dur`.`is_active` IS TRUE
                        ) AS `duration`
                      '),
                      DB::raw('
                        (
                          SELECT 
                            (
                              CASE
                                WHEN pstatus.created_at IS NULL OR pstatus.created_at = ""
                                  THEN "Not yet forwarded"
                                ELSE DATE_FORMAT(pstatus.created_at, "%b %e, %Y (%T)")
                              END
                            ) FROM `proposal_has_lib_proposal_status` pstatus WHERE pstatus.proposal_idproposal = proposal.idproposal AND pstatus.lib_proposal_status_idlib_proposal_status = 6 ORDER BY pstatus.created_at ASC LIMIT 1
                        ) as date_forwarded_through_api'
                      ),
                       // Added by Drei
                       DB::raw('
                       (SELECT 
                             (
                               CASE
                                 WHEN pstatus.created_at IS NULL OR pstatus.created_at = ""
                                   THEN "Not yet forwarded"
                                 ELSE DATE_FORMAT(pstatus.created_at, "%b %e, %Y (%T)")
                               END
                             ) FROM `proposal_has_lib_proposal_status` pstatus WHERE pstatus.proposal_idproposal = proposal.idproposal AND pstatus.lib_proposal_status_idlib_proposal_status = 8 ORDER BY pstatus.created_at ASC LIMIT 1) as date_forwarded_by_trd'),
                      //End
                      DB::raw('
                        (
                            SELECT
                                `b`.`call_name`
                            FROM
                                (
                                    `proposal_has_lib_call_for_proposal` `a`
                                JOIN `lib_call_for_proposal` `b` ON
                                    (
                                        `a`.`lib_call_for_proposal_idlib_call_for_proposal` = `b`.`idlib_call_for_proposal`
                                    )
                                )
                            WHERE
                                `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                        ) AS `call_for_proposal`'
                      ),
                      //Added: agency_division_type
                      'agency_division_type.type AS agency_division_type',
                      'agency_division_type.division_acronym AS monitoring_agency_division',
                      'proposal.gad_score AS gad_score',
                      'libstatus.status as proposal_status',
                      'proposal.idproposal as proposal_id'
                    )
                    ->where('pstatus.is_active', 1)
                    ->where(function($q) use ($proposal_status) {
                      if($proposal_status) {
                        $q->where('pstatus.lib_proposal_status_idlib_proposal_status', $proposal_status);
                        $q->where('pstatus.is_active', 1);
                      }
                    })
                    ->groupBy('proposal.idproposal')
                    ->get();
            } else if(Auth::user()->privilege == 2){
              $data = 
              DB::table('proposal')
                  ->leftJoin('proposal_has_lib_proposal_status as pstatus', 'pstatus.proposal_idproposal', '=', 'proposal.idproposal')
                  ->leftJoin('lib_proposal_status as libstatus', 'libstatus.idlib_proposal_status', '=', 'pstatus.lib_proposal_status_idlib_proposal_status')
         //Added: leftJoin for view_proposal_agency_division_type
         ->leftJoin('view_proposal_agency_division_type as agency_division_type', 'agency_division_type.idproposal',  '=', 'proposal.idproposal')                    
         ->select(
                    DB::raw('(SELECT ptype.proposal_type FROM `lib_proposal_type` ptype WHERE ptype.idlib_proposal_type = proposal.proposal_type) as proposal_type'),
                    'proposal.program_id as program_id',
                    'proposal.dpmis_date_submitted as dpmis_date_submitted',
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
                      ) AS proposal_code'
                    ),
                    'proposal.title as title',
                    DB::raw('
                      (
                        SELECT
                            CONCAT(
                              DATE_FORMAT(dur.start_date, "%b. %e, %Y"),
                              "-",
                              DATE_FORMAT(dur.end_date, "%b. %e, %Y")
                            )
                        FROM
                            `proposal_duration` `dur`
                        WHERE
                            `dur`.`proposal_idproposal` = `proposal`.`idproposal` AND `dur`.`is_active` IS TRUE
                      ) AS `duration`
                    '),
                    DB::raw('
                      (
                        SELECT 
                          (
                            CASE
                              WHEN pstatus.created_at IS NULL OR pstatus.created_at = ""
                                THEN "Not yet forwarded"
                              ELSE DATE_FORMAT(pstatus.created_at, "%b %e, %Y (%T)")
                            END
                          ) FROM `proposal_has_lib_proposal_status` pstatus WHERE pstatus.proposal_idproposal = proposal.idproposal AND pstatus.lib_proposal_status_idlib_proposal_status = 6 ORDER BY pstatus.created_at ASC LIMIT 1
                      ) as date_forwarded_through_api'
                    ),
                     // Added by Drei
                     DB::raw('
                     (SELECT 
                           (
                             CASE
                               WHEN pstatus.created_at IS NULL OR pstatus.created_at = ""
                                 THEN "Not yet forwarded"
                               ELSE DATE_FORMAT(pstatus.created_at, "%b %e, %Y (%T)")
                             END
                           ) FROM `proposal_has_lib_proposal_status` pstatus WHERE pstatus.proposal_idproposal = proposal.idproposal AND pstatus.lib_proposal_status_idlib_proposal_status = 8 ORDER BY pstatus.created_at ASC LIMIT 1) as date_forwarded_by_trd'),
                    //End
                    DB::raw('
                      (
                          SELECT
                              `b`.`call_name`
                          FROM
                              (
                                  `proposal_has_lib_call_for_proposal` `a`
                              JOIN `lib_call_for_proposal` `b` ON
                                  (
                                      `a`.`lib_call_for_proposal_idlib_call_for_proposal` = `b`.`idlib_call_for_proposal`
                                  )
                              )
                          WHERE
                              `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                      ) AS `call_for_proposal`'
                    ),
                    //Added: agency_division_type
                    'agency_division_type.type AS agency_division_type',
                    'agency_division_type.division_acronym AS monitoring_agency_division',
                    'proposal.gad_score AS gad_score',
                    'libstatus.status as proposal_status',
                    'proposal.idproposal as proposal_id'
                  )
                  ->where('pstatus.is_active', 1)
                  ->where(function($q) use ($proposal_status) {
                    if($proposal_status) {
                      $q->where('pstatus.lib_proposal_status_idlib_proposal_status', $proposal_status);
                      $q->where('pstatus.is_active', 1);
                    }
                  })
                  ->groupBy('proposal.idproposal')
                  ->get();
              if(Auth::user()->division == "20"){
                $data = $proposal_select
                        ->where('proposal.proposal_type', 1)
                        ->orWhere('proposal.proposal_type', 2)
                        ->orWhere('proposal.proposal_type', 5)
                        ->orWhere('proposal.proposal_type', 6)
                        ->where('pstatus.is_active', 1)
                        ->where(function($q) use ($proposal_status) {
                          if($proposal_status) {
                            $q->where('pstatus.lib_proposal_status_idlib_proposal_status', $proposal_status);
                            $q->where('pstatus.is_active', 1);
                          }
                        })
                        ->groupBy('proposal.idproposal')
                        ->get();
              } else if(Auth::user()->division == "21"){
                $data = $proposal_select
                    ->where('pstatus.is_active', 1)
                    ->where(function($q){
                        $q->orwhere('proposal.proposal_type', 3);
                        $q->orWhere('proposal.proposal_type', 4);
                    })
                    ->where(function($q) use ($proposal_status) {
                        if($proposal_status) {
                            $q->where('pstatus.lib_proposal_status_idlib_proposal_status', $proposal_status);
                            $q->where('pstatus.is_active', 1);
                        }
                    })
                    ->groupBy('proposal.idproposal')
                    ->get();
              }
            } else if(Auth::user()->privilege == 3){    
              $data = $proposal_select
                      ->leftJoin('view_proposal_agency_division_type as agency_division_type', 'agency_division_type.idproposal',  '=', 'proposal.idproposal')      
                      ->leftJoin('users_has_access_during_proposal_has_lib_proposal_status as user_access_proposal', 'user_access_proposal.proposal_has_lib_proposal_status_proposal_idproposal', '=', 'proposal.idproposal')
                      ->leftJoin('users', 'user_access_proposal.users_id', '=', 'users.id')
                      ->select(
                        DB::raw('(SELECT ptype.proposal_type FROM `lib_proposal_type` ptype WHERE ptype.idlib_proposal_type = proposal.proposal_type) as proposal_type'),
                        'proposal.program_id as program_id',
                        'proposal.dpmis_date_submitted as dpmis_date_submitted',
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
                          ) AS proposal_code'
                        ),
                        'proposal.title as title',
                        DB::raw('
                          (
                            SELECT
                                CONCAT(
                                  DATE_FORMAT(dur.start_date, "%b. %e, %Y"),
                                  "-",
                                  DATE_FORMAT(dur.end_date, "%b. %e, %Y")
                                )
                            FROM
                                `proposal_duration` `dur`
                            WHERE
                                `dur`.`proposal_idproposal` = `proposal`.`idproposal` AND `dur`.`is_active` IS TRUE
                          ) AS `duration`
                        '),
                        DB::raw('
                          (
                            SELECT 
                              (
                                CASE
                                  WHEN pstatus.created_at IS NULL OR pstatus.created_at = ""
                                    THEN "Not yet forwarded"
                                  ELSE DATE_FORMAT(pstatus.created_at, "%b %e, %Y (%T)")
                                END
                              ) FROM `proposal_has_lib_proposal_status` pstatus WHERE pstatus.proposal_idproposal = proposal.idproposal AND pstatus.lib_proposal_status_idlib_proposal_status = 6 ORDER BY pstatus.created_at ASC LIMIT 1
                          ) as date_forwarded_through_api'
                        ),
                       // Added by Drei
                          DB::raw('
                          (SELECT 
                                (
                                  CASE
                                    WHEN pstatus.created_at IS NULL OR pstatus.created_at = ""
                                      THEN "Not yet forwarded"
                                    ELSE DATE_FORMAT(pstatus.created_at, "%b %e, %Y (%T)")
                                  END
                                ) FROM `proposal_has_lib_proposal_status` pstatus WHERE pstatus.proposal_idproposal = proposal.idproposal AND pstatus.lib_proposal_status_idlib_proposal_status = 8 ORDER BY pstatus.created_at ASC LIMIT 1) as date_forwarded_by_trd'),
                         //End
                        DB::raw('
                          (
                              SELECT
                                  `b`.`call_name`
                              FROM
                                  (
                                      `proposal_has_lib_call_for_proposal` `a`
                                  JOIN `lib_call_for_proposal` `b` ON
                                      (
                                          `a`.`lib_call_for_proposal_idlib_call_for_proposal` = `b`.`idlib_call_for_proposal`
                                      )
                                  )
                              WHERE
                                  `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                          ) AS `call_for_proposal`'
                        ),
                        //Added: agency_division_type
                        'agency_division_type.type AS agency_division_type',
                        'agency_division_type.division_acronym AS monitoring_agency_division',
                        'proposal.gad_score AS gad_score',
                        'libstatus.status as proposal_status',
                        'proposal.idproposal as proposal_id'
                      )
                      ->where('pstatus.is_active', 1)
                      ->where(function($q) use ($proposal_status) {
                        if($proposal_status) {
                            $q->where('pstatus.lib_proposal_status_idlib_proposal_status', $proposal_status);
                            $q->where('pstatus.is_active', 1);
                        }
                      })
                      ->where('users.division', Auth::user()->division)
                      ->where('user_access_proposal.is_active', 1)
                      ->groupBy('proposal.idproposal')
                      ->get();
            } else if(Auth::user()->privilege == 4){
              $data = $proposal_select
                      ->leftJoin('view_proposal_agency_division_type as agency_division_type', 'agency_division_type.idproposal',  '=', 'proposal.idproposal')      
                      ->leftJoin('users_has_access_during_proposal_has_lib_proposal_status as user_access_proposal', 'user_access_proposal.proposal_has_lib_proposal_status_proposal_idproposal', '=', 'proposal.idproposal')
                      ->leftJoin('users', 'user_access_proposal.users_id', '=', 'users.id')
                      ->select(
                        DB::raw('(SELECT ptype.proposal_type FROM `lib_proposal_type` ptype WHERE ptype.idlib_proposal_type = proposal.proposal_type) as proposal_type'),
                        'proposal.program_id as program_id',
                        'proposal.dpmis_date_submitted as dpmis_date_submitted',
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
                          ) AS proposal_code'
                        ),
                        'proposal.title as title',
                        DB::raw('
                          (
                            SELECT
                                CONCAT(
                                  DATE_FORMAT(dur.start_date, "%b. %e, %Y"),
                                  "-",
                                  DATE_FORMAT(dur.end_date, "%b. %e, %Y")
                                )
                            FROM
                                `proposal_duration` `dur`
                            WHERE
                                `dur`.`proposal_idproposal` = `proposal`.`idproposal` AND `dur`.`is_active` IS TRUE
                          ) AS `duration`
                        '),
                        DB::raw('
                          (
                            SELECT 
                              (
                                CASE
                                  WHEN pstatus.created_at IS NULL OR pstatus.created_at = ""
                                    THEN "Not yet forwarded"
                                  ELSE DATE_FORMAT(pstatus.created_at, "%b %e, %Y (%T)")
                                END
                              ) FROM `proposal_has_lib_proposal_status` pstatus WHERE pstatus.proposal_idproposal = proposal.idproposal AND pstatus.lib_proposal_status_idlib_proposal_status = 6 ORDER BY pstatus.created_at ASC LIMIT 1
                          ) as date_forwarded_through_api'
                        ),
                         // Added by Drei
                         DB::raw('
                         (SELECT 
                               (
                                 CASE
                                   WHEN pstatus.created_at IS NULL OR pstatus.created_at = ""
                                     THEN "Not yet forwarded"
                                   ELSE DATE_FORMAT(pstatus.created_at, "%b %e, %Y (%T)")
                                 END
                               ) FROM `proposal_has_lib_proposal_status` pstatus WHERE pstatus.proposal_idproposal = proposal.idproposal AND pstatus.lib_proposal_status_idlib_proposal_status = 8 ORDER BY pstatus.created_at ASC LIMIT 1) as date_forwarded_by_trd'),
                        //End
                        DB::raw('
                          (
                              SELECT
                                  `b`.`call_name`
                              FROM
                                  (
                                      `proposal_has_lib_call_for_proposal` `a`
                                  JOIN `lib_call_for_proposal` `b` ON
                                      (
                                          `a`.`lib_call_for_proposal_idlib_call_for_proposal` = `b`.`idlib_call_for_proposal`
                                      )
                                  )
                              WHERE
                                  `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                          ) AS `call_for_proposal`'
                        ),
                        //Added: agency_division_type
                        'agency_division_type.type AS agency_division_type',
                        'agency_division_type.division_acronym AS monitoring_agency_division',
                        'proposal.gad_score AS gad_score',
                        'libstatus.status as proposal_status',
                        'proposal.idproposal as proposal_id'
                      )
                      ->where('pstatus.is_active', 1)
                      ->where(function($q) use ($proposal_status) {
                        if($proposal_status) {
                            $q->where('pstatus.lib_proposal_status_idlib_proposal_status', $proposal_status);
                            $q->where('pstatus.is_active', 1);
                        }
                      })
                      ->where('user_access_proposal.users_id', Auth::user()->id)
                      ->where('users.division', Auth::user()->division)
                      ->where('user_access_proposal.is_active', 1)
                      ->groupBy('proposal.idproposal')
                      ->get();
            }
            
          } catch (Exception $e) {
            dd($e);
          }
          if(!is_null($data)){
            $btn;
            if(Auth::user()->id == 98) {
                $btn =
                "<div class='dropdown'>
                  <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Action
                  </button>
                  <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                    <a class='dropdown-item view-proposal' href='#'><span><i class='fas fa-eye'></i> View Proposal</span></a>
                    <a class='dropdown-item forward-proposal-to-trd' href='#'><span><i class='fas fa-paper-plane'></i> Forward Proposal</span></a>
                    <a class='dropdown-item forward-proposal-to-palihan' href='#'><span><i class='fas fa-paper-plane'></i> Forward to Palihan (Test)</span></a>
                    <a class='dropdown-item forapi-proposal' href='#'><span><i class='fas fa-eye'></i> API Proposal</span></a>
                    <a class='dropdown-item receive-proposal' href='#'><span><i class='fab fa-get-pocket'></i> Receive Proposal</span></a>
                    <a class='dropdown-item approve-proposal' href='#'><span><i class='fas fa-check'></i> Approve Proposal</span></a>
                    <a class='dropdown-item endorse-to-dc-proposal' href='#'><span><i class='fas fa-users'></i> Endorse to DC</span></a>


                    <a class='dropdown-item dc-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> DC Endorsed</span></a>
                    <a class='dropdown-item dc-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> DC Approved</span></a>
                    <a class='dropdown-item dc-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> DC Disapproved</span></a>

                    <a class='dropdown-item endorsed-to-usec-rd-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> Endorsed to Usec. for R&D</span></a>
                    <a class='dropdown-item approved-by-usec-rd-proposal' href='#'><span><i class='fas fa-check-square'></i> Approved by Usec. for R&D</span></a>
                    <a class='dropdown-item disapproved-by-usec-rd-proposal' href='#'><span><i class='fas fa-times-circle'></i> Disapproved by Usec. for R&D</span></a>

                    <a class='dropdown-item gc-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> GC Endorsed</span></a>
                    <a class='dropdown-item gc-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> GC Approved</span></a>
                    <a class='dropdown-item gc-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> GC Disapproved</span></a>

                    <a class='dropdown-item execom-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> Execom Endorsed</span></a>
                    <a class='dropdown-item execom-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> Execom Approved</span></a>
                    <a class='dropdown-item execom-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> Execom Disapproved</span></a>

                    <a class='dropdown-item consolidate-comments-proposal' href='#'><span><i class='fas fa-project-diagram'></i> Consolidate Comments</span></a>

                    <a class='dropdown-item forward-comments-to-dpmis' href='#'><span><i class='fas fa-paper-plane'></i> Forward comments to DPMIS</span></a>
                    
                    <a class='dropdown-item revise-proposal' href='#'><span><i class='fas fa-edit'></i> Request for revision</span></a>
                    <a class='dropdown-item return-s4c-proposal' href='#'><span><i class='fas fa-undo'></i> Return proposal (S4C)</span></a>
                    <a class='dropdown-item disapprove-proposal' href='#'><span><i class='fas fa-times'></i> Disapprove Proposal (Not fit for funding)</span></a>
                    <a class='dropdown-item refer-proposal' href='#'><span><i class='fas fa-users'></i> Refer Proposal to other institution</span></a>
                    <a class='dropdown-item withdraw-proposal' href='#'><span><i class='fas fa-ban'></i> Withdraw Proposal</span></a>
                    <a class='dropdown-item review-proposal' href='#'><span><i class='fas fa-search'></i> Review Proposal</span></a>
                    <a class='dropdown-item exclude-from-program' href='#'><span><i class='fas fa-thumbs-up'></i> Approve as Separate Project</span></a>
                    <a class='dropdown-item endorse-for-dost-gia' href='#'><span><i class='fas fa-thumbs-up'></i> Endorse for DOST-GIA Funding</span></a>
                  </div>
                </div>";

            } else if(Auth::user()->privilege == 3){
                $btn =
                    "<div class='dropdown'>
                      <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        Action
                      </button>
                      <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                        <a class='dropdown-item view-proposal' href='#'><span><i class='fas fa-eye'></i> View Proposal</span></a>
                        <a class='dropdown-item forward-proposal-to-trd' href='#'><span><i class='fas fa-paper-plane'></i> Forward Proposal to TRDs</span></a>
                        <a class='dropdown-item approve-proposal' href='#'><span><i class='fas fa-check'></i> Approve Proposal</span></a>
                        <a class='dropdown-item endorse-to-dc-proposal' href='#'><span><i class='fas fa-users'></i> Endorse to DC</span></a>

                        <a class='dropdown-item dc-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> DC Endorsed</span></a>
                        <a class='dropdown-item dc-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> DC Approved</span></a>
                        <a class='dropdown-item dc-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> DC Disapproved</span></a>

                        <a class='dropdown-item endorsed-to-usec-rd-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> Endorsed to Usec. for R&D</span></a>
                        <a class='dropdown-item approved-by-usec-rd-proposal' href='#'><span><i class='fas fa-check-square'></i> Approved by Usec. for R&D</span></a>
                        <a class='dropdown-item disapproved-by-usec-rd-proposal' href='#'><span><i class='fas fa-times-circle'></i> Disapproved by Usec. for R&D</span></a>

                        <a class='dropdown-item gc-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> GC Endorsed</span></a>
                        <a class='dropdown-item gc-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> GC Approved</span></a>
                        <a class='dropdown-item gc-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> GC Disapproved</span></a>

                        <a class='dropdown-item execom-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> Execom Endorsed</span></a>
                        <a class='dropdown-item execom-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> Execom Approved</span></a>
                        <a class='dropdown-item execom-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> Execom Disapproved</span></a>

                        <a class='dropdown-item consolidate-comments-proposal' href='#'><span><i class='fas fa-project-diagram'></i> Consolidate Comments</span></a>
                        
                        <a class='dropdown-item revise-proposal' href='#'><span><i class='fas fa-edit'></i> Request for revision</span></a>
                        <a class='dropdown-item disapprove-proposal' href='#'><span><i class='fas fa-times'></i> Disapprove Proposal (Not fit for funding)</span></a>
                        <a class='dropdown-item refer-proposal' href='#'><span><i class='fas fa-users'></i> Refer Proposal to other institution</span></a>
                        <a class='dropdown-item withdraw-proposal' href='#'><span><i class='fas fa-ban'></i> Withdraw Proposal</span></a>
                        <a class='dropdown-item review-proposal' href='#'><span><i class='fas fa-search'></i> Review Proposal</span></a>
                        <a class='dropdown-item exclude-from-program' href='#'><span><i class='fas fa-thumbs-up'></i> Approve as Separate Project</span></a>
                        <a class='dropdown-item endorse-for-dost-gia' href='#'><span><i class='fas fa-thumbs-up'></i> Endorse for DOST-GIA Funding</span></a>
                      </div>
                    </div>";
            } else if (Auth::user()->privilege == 4 || Auth::user()->privilege == 5 || $proposal_status == 15){
                $btn =
                    "<div class='dropdown'>
                      <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        Action
                      </button>
                      <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                        <a class='dropdown-item view-proposal' href='#'><span><i class='fas fa-eye'></i> View Proposal</span></a>
                      </div>
                    </div>";
            } else {
                $btn =
                "<div class='dropdown'>
                  <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    Action
                  </button>
                  <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                    <a class='dropdown-item view-proposal' href='#'><span><i class='fas fa-eye'></i> View Proposal</span></a>
                    <a class='dropdown-item forward-proposal-to-trd' href='#'><span><i class='fas fa-paper-plane'></i> Forward Proposal to TRDs</span></a>
                    <a class='dropdown-item forward-proposal-to-palihan' href='#'><span><i class='fas fa-paper-plane'></i> Forward to Palihan (Test)</span></a>
                    <a class='dropdown-item forapi-proposal' href='#'><span><i class='fas fa-eye'></i> API Proposal</span></a>
                    <a class='dropdown-item receive-proposal' href='#'><span><i class='fab fa-get-pocket'></i> Receive Proposal</span></a>
                    <a class='dropdown-item approve-proposal' href='#'><span><i class='fas fa-check'></i> Approve Proposal</span></a>
                    <a class='dropdown-item endorse-to-dc-proposal' href='#'><span><i class='fas fa-users'></i> Endorse to DC</span></a>


                    <a class='dropdown-item dc-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> DC Endorsed</span></a>
                    <a class='dropdown-item dc-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> DC Approved</span></a>
                    <a class='dropdown-item dc-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> DC Disapproved</span></a>

                    <a class='dropdown-item endorsed-to-usec-rd-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> Endorsed to Usec. for R&D</span></a>
                    <a class='dropdown-item approved-by-usec-rd-proposal' href='#'><span><i class='fas fa-check-square'></i> Approved by Usec. for R&D</span></a>
                    <a class='dropdown-item disapproved-by-usec-rd-proposal' href='#'><span><i class='fas fa-times-circle'></i> Disapproved by Usec. for R&D</span></a>

                    <a class='dropdown-item gc-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> GC Endorsed</span></a>
                    <a class='dropdown-item gc-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> GC Approved</span></a>
                    <a class='dropdown-item gc-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> GC Disapproved</span></a>

                    <a class='dropdown-item execom-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> Execom Endorsed</span></a>
                    <a class='dropdown-item execom-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> Execom Approved</span></a>
                    <a class='dropdown-item execom-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> Execom Disapproved</span></a>

                    <a class='dropdown-item consolidate-comments-proposal' href='#'><span><i class='fas fa-project-diagram'></i> Consolidate Comments</span></a>

                    <a class='dropdown-item forward-comments-to-dpmis' href='#'><span><i class='fas fa-paper-plane'></i> Forward comments to DPMIS</span></a>
                    
                    <a class='dropdown-item revise-proposal' href='#'><span><i class='fas fa-edit'></i> Request for revision</span></a>
                    <a class='dropdown-item return-s4c-proposal' href='#'><span><i class='fas fa-undo'></i> Return proposal (S4C)</span></a>
                    <a class='dropdown-item disapprove-proposal' href='#'><span><i class='fas fa-times'></i> Disapprove Proposal (Not fit for funding)</span></a>
                    <a class='dropdown-item refer-proposal' href='#'><span><i class='fas fa-users'></i> Refer Proposal to other institution</span></a>
                    <a class='dropdown-item withdraw-proposal' href='#'><span><i class='fas fa-ban'></i> Withdraw Proposal</span></a>
                    <a class='dropdown-item review-proposal' href='#'><span><i class='fas fa-search'></i> Review Proposal</span></a>
                    <a class='dropdown-item exclude-from-program' href='#'><span><i class='fas fa-thumbs-up'></i> Approve as Separate Project</span></a>
                    <a class='dropdown-item endorse-for-dost-gia' href='#'><span><i class='fas fa-thumbs-up'></i> Endorse for DOST-GIA Funding</span></a>
                  </div>
                </div>";
            }
            return DataTables::of($data)
                ->setRowAttr([
                    'data-id' => function($proposal) {
                    return $proposal->proposal_id;
                    }
                ])
                ->editColumn('proposal_type', function($row) {
                    $proposal_id = $row->proposal_id;
                    $division_id = Auth::user()->division;
                    $proposal_type = $row->proposal_type;
                    if(DB::table('proposal_lead_trd')->where('proposal_idproposal', $proposal_id)->where('division_iddivision', $division_id)->where('is_active', 1)->exists()) {
                        $lead = '<span class="badge rounded-pill bg-warning text-dark">Lead TRD</span>';
                        return $proposal_type.$lead;
                    } else return $proposal_type;
                })
                ->addColumn('action', function($row) use($btn, $proposal_status){
                    $proposal_id = $row->proposal_id;

                    if(Auth::user()->id == 98) {
		                $btn =
		                "<div class='dropdown'>
		                  <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
		                    Action
		                  </button>
		                  <div class='dropdown-menu' aria-labelledby='action_dropdown'>
		                    <a class='dropdown-item view-proposal' href='#'><span><i class='fas fa-eye'></i> View Proposal</span></a>
		                    <a class='dropdown-item forward-proposal-to-trd' href='#'><span><i class='fas fa-paper-plane'></i> Forward Proposal to TRDs</span></a>
		                    <a class='dropdown-item forward-proposal-to-palihan' href='#'><span><i class='fas fa-paper-plane'></i> Forward to Palihan (Test)</span></a>
		                    <a class='dropdown-item forapi-proposal' href='#'><span><i class='fas fa-eye'></i> API Proposal</span></a>
		                    <a class='dropdown-item receive-proposal' href='#'><span><i class='fab fa-get-pocket'></i> Receive Proposal</span></a>
		                    <a class='dropdown-item approve-proposal' href='#'><span><i class='fas fa-check'></i> Approve Proposal</span></a>
		                    <a class='dropdown-item endorse-to-dc-proposal' href='#'><span><i class='fas fa-users'></i> Endorse to DC</span></a>


		                    <a class='dropdown-item dc-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> DC Endorsed</span></a>
		                    <a class='dropdown-item dc-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> DC Approved</span></a>
		                    <a class='dropdown-item dc-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> DC Disapproved</span></a>

		                    <a class='dropdown-item endorsed-to-usec-rd-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> Endorsed to Usec. for R&D</span></a>
		                    <a class='dropdown-item approved-by-usec-rd-proposal' href='#'><span><i class='fas fa-check-square'></i> Approved by Usec. for R&D</span></a>
		                    <a class='dropdown-item disapproved-by-usec-rd-proposal' href='#'><span><i class='fas fa-times-circle'></i> Disapproved by Usec. for R&D</span></a>

		                    <a class='dropdown-item gc-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> GC Endorsed</span></a>
		                    <a class='dropdown-item gc-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> GC Approved</span></a>
		                    <a class='dropdown-item gc-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> GC Disapproved</span></a>

		                    <a class='dropdown-item execom-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> Execom Endorsed</span></a>
		                    <a class='dropdown-item execom-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> Execom Approved</span></a>
		                    <a class='dropdown-item execom-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> Execom Disapproved</span></a>

		                    <a class='dropdown-item consolidate-comments-proposal' href='#'><span><i class='fas fa-project-diagram'></i> Consolidate Comments</span></a>

		                    <a class='dropdown-item forward-comments-to-dpmis' href='#'><span><i class='fas fa-paper-plane'></i> Forward comments to DPMIS</span></a>
		                    
		                    <a class='dropdown-item revise-proposal' href='#'><span><i class='fas fa-edit'></i> Request for revision</span></a>
		                    <a class='dropdown-item return-s4c-proposal' href='#'><span><i class='fas fa-undo'></i> Return proposal (S4C)</span></a>
		                    <a class='dropdown-item disapprove-proposal' href='#'><span><i class='fas fa-times'></i> Disapprove Proposal (Not fit for funding)</span></a>
		                    <a class='dropdown-item refer-proposal' href='#'><span><i class='fas fa-users'></i> Refer Proposal to other institution</span></a>
		                    <a class='dropdown-item withdraw-proposal' href='#'><span><i class='fas fa-ban'></i> Withdraw Proposal</span></a>
		                    <a class='dropdown-item review-proposal' href='#'><span><i class='fas fa-search'></i> Review Proposal</span></a>
                        <a class='dropdown-item exclude-from-program' href='#'><span><i class='fas fa-thumbs-up'></i> Approve as Separate Project</span></a>
                        <a class='dropdown-item endorse-for-dost-gia' href='#'><span><i class='fas fa-thumbs-up'></i> Endorse for DOST-GIA Funding</span></a>
		                  </div>
		                </div>";

                    } else if(DB::table('proposal_has_lib_proposal_status')->where('proposal_idproposal', $proposal_id)->where('lib_proposal_status_idlib_proposal_status', 6)->where('is_active', 1)->exists()) {

                        $btn =
                            "<div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Action
                                </button>
                                <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                                    <a class='dropdown-item receive-proposal' href='#'><span><i class='fab fa-get-pocket'></i> Receive Proposal</span></a>
                                </div>
                            </div>"; 
                    } else if(DB::table('proposal_has_lib_proposal_status')->where('proposal_idproposal', $proposal_id)->where('lib_proposal_status_idlib_proposal_status', 15)->where('is_active', 1)->exists()) {

                        $btn =
                            "<div class='dropdown'>
                                <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Action
                                </button>
                                <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                                    <a class='dropdown-item view-proposal' href='#'><span><i class='fas fa-eye'></i> View Proposal</span></a>
                                </div>
                            </div>"; 
                    } else if(Auth::user()->privilege == 3) {
                        $proposal_id = $row->proposal_id;
                        $division_id = Auth::user()->division;
                        if($proposal_status == 16 || $proposal_status == 15){
                            $btn =
                                "<div class='dropdown'>
                                  <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Action
                                  </button>
                                  <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                                    <a class='dropdown-item view-proposal' href='#'><span><i class='fas fa-eye'></i> View Proposal</span></a>
                                  </div>
                                </div>";
                        } else if(DB::table('proposal_lead_trd')->where('proposal_idproposal', $proposal_id)->where('division_iddivision', $division_id)->where('is_active', 1)->exists()) {
                            $btn =
                                "<div class='dropdown'>
                                  <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Action
                                  </button>
                                  <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                                    <a class='dropdown-item view-proposal' href='#'><span><i class='fas fa-eye'></i> View Proposal</span></a>
                                    <a class='dropdown-item forward-proposal-to-trd' href='#'><span><i class='fas fa-paper-plane'></i> Forward Proposal to TRDs</span></a>
                                    <a class='dropdown-item approve-proposal' href='#'><span><i class='fas fa-check'></i> Approve Proposal</span></a>
                                    <a class='dropdown-item endorse-to-dc-proposal' href='#'><span><i class='fas fa-users'></i> Endorse to DC</span></a>

                                    <a class='dropdown-item dc-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> DC Endorsed</span></a>
                                    <a class='dropdown-item dc-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> DC Approved</span></a>
                                    <a class='dropdown-item dc-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> DC Disapproved</span></a>

                                    <a class='dropdown-item endorsed-to-usec-rd-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> Endorsed to Usec. for R&D</span></a>
                                    <a class='dropdown-item approved-by-usec-rd-proposal' href='#'><span><i class='fas fa-check-square'></i> Approved by Usec. for R&D</span></a>
                                    <a class='dropdown-item disapproved-by-usec-rd-proposal' href='#'><span><i class='fas fa-times-circle'></i> Disapproved by Usec. for R&D</span></a>

                                    <a class='dropdown-item gc-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> GC Endorsed</span></a>
                                    <a class='dropdown-item gc-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> GC Approved</span></a>
                                    <a class='dropdown-item gc-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> GC Disapproved</span></a>

                                    <a class='dropdown-item execom-endorsed-proposal' href='#'><span><i class='fas fa-thumbs-up'></i> Execom Endorsed</span></a>
                                    <a class='dropdown-item execom-approved-proposal' href='#'><span><i class='fas fa-check-square'></i> Execom Approved</span></a>
                                    <a class='dropdown-item execom-disapproved-proposal' href='#'><span><i class='fas fa-times-circle'></i> Execom Disapproved</span></a>

                                    <a class='dropdown-item consolidate-comments-proposal' href='#'><span><i class='fas fa-project-diagram'></i> Consolidate Comments</span></a>
                                    
                                    <a class='dropdown-item revise-proposal' href='#'><span><i class='fas fa-edit'></i> Request for revision</span></a>
                                    <a class='dropdown-item disapprove-proposal' href='#'><span><i class='fas fa-times'></i> Disapprove Proposal (Not fit for funding)</span></a>
                                    <a class='dropdown-item refer-proposal' href='#'><span><i class='fas fa-users'></i> Refer Proposal to other institution</span></a>
                                    <a class='dropdown-item withdraw-proposal' href='#'><span><i class='fas fa-ban'></i> Withdraw Proposal</span></a>
                                    <a class='dropdown-item review-proposal' href='#'><span><i class='fas fa-search'></i> Review Proposal</span></a>
                                    <a class='dropdown-item exclude-from-program' href='#'><span><i class='fas fa-thumbs-up'></i> Approve as Separate Project</span></a>
                                    <a class='dropdown-item endorse-for-dost-gia' href='#'><span><i class='fas fa-thumbs-up'></i> Endorse for DOST-GIA Funding</span></a>
                                  </div>
                                </div>";
                        } else {
                            $btn =
                                "<div class='dropdown'>
                                  <button class='btn btn-primary dropdown-toggle' type='button' id='action_dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Action
                                  </button>
                                  <div class='dropdown-menu' aria-labelledby='action_dropdown'>
                                    <a class='dropdown-item view-proposal' href='#'><span><i class='fas fa-eye'></i> View Proposal</span></a>
                                    <a class='dropdown-item forward-proposal-to-trd' href='#'><span><i class='fas fa-paper-plane'></i> Forward Proposal to TRDs</span></a>
                                  </div>
                                </div>";
                        }

                    }
                    $rtbtn = $btn;
                    return $rtbtn;
                })
                ->rawColumns(['action', 'proposal_type'])
                ->make(true);
            }
        }
    }

    public function table_all_proposals(Request $request){
      if ($request->ajax()) {
        $filter = array(['proposal_status' => '']);
        return $this->table($request, $filter);
      }

    }

    public function table_received_proposals(Request $request){
      if ($request->ajax()) {
        $filter = array(['proposal_status' => '7']);
        return $this->table($request, $filter);
      }

    }

    public function table_from_dpmis_proposals(Request $request){
      if ($request->ajax()) {
        $filter = array(['proposal_status' => '6']);
        return $this->table($request, $filter);
      }

    }

    public function table_for_evaluation_proposals(Request $request){
      if ($request->ajax()) {
        $filter = array(['proposal_status' => '8']);
        return $this->table($request, $filter);
      }

    }

    public function table_forward_comments_to_dpmis_proposals(Request $request){
      if ($request->ajax()) {
        $filter = array(['proposal_status' => '16']);
        return $this->table($request, $filter);
      }

    }

    public function table_consolidated_comments_forwarded_to_dpmis_proposals(Request $request){
      if ($request->ajax()) {
        $filter = array(['proposal_status' => '47']);
        return $this->table($request, $filter);
      }

    }

    public function table_approved_proposals(Request $request){
      if ($request->ajax()) {
        $filter = array(['proposal_status' => '15']);
        return $this->table($request, $filter);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($request->ajax()) {
            $proposal_select = $this->proposal_select();
            $proposal_id = $request->get('proposal_id');
            $user = Auth::user();
            // $request->session()->flush();
            // Auth::login($user);
            $proposal = $proposal_select
                      ->where('idproposal', $proposal_id)
                      ->first();
            $researcher = DB::table('proposal_researcher')
                          ->where('proposal_idproposal', $proposal_id)
                          ->where('is_lead', 1)
                          ->leftJoin('hrisv2db.records as proposal_hris_researcher', 'proposal_researcher.hris_researcher_id', '=', 'proposal_hris_researcher.id')
                          ->leftJoin('commonlibrariesdb.agency as commlibagency', 'proposal_hris_researcher.hr_agency_id', '=', 'commlibagency.id')
                          ->select(
                            'proposal_researcher.*',
                            DB::raw('
                              (CASE
                                WHEN proposal_hris_researcher.hr_sex = 1
                                  THEN "Male"
                                WHEN proposal_hris_researcher.hr_sex = 2
                                  THEN "Female"
                              END) as proposal_researcher_sex'),
                            'proposal_hris_researcher.*',
                            'commlibagency.acronym as agency_acronym'
                          )
                          ->first();
            $proposal_researchers = DB::table('proposal_researcher')
                              ->where('proposal_idproposal', $proposal_id)
                              ->leftJoin('hrisv2db.records as proposal_hris_researcher', 'proposal_researcher.hris_researcher_id', '=', 'proposal_hris_researcher.id')
                              ->leftJoin('commonlibrariesdb.agency as commlibagency', 'proposal_hris_researcher.hr_agency_id', '=', 'commlibagency.id')
                              ->select(
                                'proposal_researcher.*',
                                DB::raw('
                                  (CASE
                                    WHEN proposal_hris_researcher.hr_sex = 1
                                      THEN "Male"
                                    WHEN proposal_hris_researcher.hr_sex = 2
                                      THEN "Female"
                                  END) as proposal_researcher_sex'),
                                'proposal_hris_researcher.*',
                                'commlibagency.acronym as agency_acronym'
                              )
                              ->groupBy('proposal_researcher.dpmis_researcher_id')
                              ->orderBy('is_lead', 'desc')
                              ->get();
            $proposal_files = DB::table('proposal_file')
                              ->leftJoin('proposal', 'proposal_file.proposal_idproposal', '=', 'proposal.idproposal')
                              ->leftJoin('lib_document_type', 'proposal_file.lib_document_type_idlib_document_type', '=', 'lib_document_type.idlib_document_type')
                              ->where('proposal_idproposal', $proposal_id)
                              ->where(function($q) use ($proposal) {
                                if($proposal->program_id && ($proposal->proposal_type_id == 1 || $proposal->proposal_type_id == 3 || $proposal->proposal_type_id == 5)) {
                                        $q->where('proposal.program_id', $proposal->program_id);
                                    }
                                })
                              ->select(
                                'proposal_file.*',
                                'lib_document_type.document_type as document_type',
                                DB::raw('COALESCE(proposal_file.dpmis_date_uploaded, "N/A") as dpmis_date_uploaded'),
                                DB::raw('(
                                  CASE
                                    WHEN (proposal.project_id IS NULL OR proposal.project_id = "") AND (proposal.program_id IS NOT NULL AND proposal.program_id != "")
                                      THEN proposal.program_id
                                    WHEN (proposal.program_id IS NULL OR proposal.program_id = "") AND (proposal.project_id IS NOT NULL AND proposal.project_id != "")
                                      THEN proposal.project_id
                                    WHEN (proposal.program_id IS NOT NULL AND proposal.program_id != "" AND proposal.project_id IS NOT NULL AND proposal.project_id != "")
                                      THEN proposal.project_id
                                    ELSE "N/A"
                                  END
                                ) AS proposal_code')
                              )
                              ->groupBy('proposal_file.file_src')
                              ->get();
            $proposal_timeline = DB::table('proposal_has_lib_proposal_status')
                              ->where('proposal_idproposal', $proposal_id)
                              ->leftJoin('lib_proposal_status', 'proposal_has_lib_proposal_status.lib_proposal_status_idlib_proposal_status', '=', 'lib_proposal_status.idlib_proposal_status')
                              ->select(
                                'lib_proposal_status.status as status',
                                'proposal_has_lib_proposal_status.remarks as remarks',
                                DB::raw('DATE_FORMAT(proposal_has_lib_proposal_status.created_at, "%M %d, %Y (%H:%i:%s)") as status_date')
                              )
                              ->orderBy('proposal_has_lib_proposal_status.created_at')
                              ->get();
            $lead_implementing_agency = DB::table('implementing_agency')
                                    ->where('proposal_idproposal', $proposal_id)
                                    ->where('is_lead', 1)
                                    ->leftJoin('commonlibrariesdb.agency as commlibagency', 'implementing_agency.comlib_agency_id', '=', 'commlibagency.id')
                                    ->first();

            if(!is_null($proposal)) {
                Session::flash('proposal', $proposal);
            }
            if(!is_null($researcher)) {
                Session::flash('proposal_leader_hris', $researcher);
            }
            if(!is_null($lead_implementing_agency)) Session::flash('lead_implementing_agency', $lead_implementing_agency);

            //version

            $executive_summary_version = DB::table('executive_summary')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $description_version = DB::table('description')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $startup_background_version = DB::table('startup_background')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();                                          
            $marketing_commercial_viability_version = DB::table('marketing_commercial_viability')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();                                          
            $rationale_version = DB::table('rationale')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $significance_version = DB::table('significance')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $general_objective_version = DB::table('objective')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->where('is_general', 1)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $specific_objective_version = DB::table('objective')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->where('is_general', 0)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $discussion_version = DB::table('discussion')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $scientific_framework_version = DB::table('scientific_framework')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $review_of_literature_version = DB::table('review_of_literature')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $methodology_version = DB::table('methodology')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $technology_roadmap_version = DB::table('technology_roadmap')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $sixp_publication_version = DB::table('output')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->where('lib_output_type_idlib_output_type', 1)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $sixp_patent_version = DB::table('output')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->where('lib_output_type_idlib_output_type', 2)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $sixp_product_version = DB::table('output')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->where('lib_output_type_idlib_output_type', 3)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $sixp_people_service_version = DB::table('output')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->where('lib_output_type_idlib_output_type', 4)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $sixp_place_version = DB::table('output')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->where('lib_output_type_idlib_output_type', 5)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $sixp_place_version = DB::table('output')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->where('lib_output_type_idlib_output_type', 6)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $outcome_version = DB::table('outcome')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $potential_social_impact_version = DB::table('impact')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->where('lib_impact_type_idlib_impact_type', 1)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $potential_economic_impact_version = DB::table('impact')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->where('lib_impact_type_idlib_impact_type', 2)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $target_beneficiaries_version = DB::table('beneficiary')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $sustainability_version = DB::table('sustainability')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $limitation_version = DB::table('limitation')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $risk_assumption_version = DB::table('risk_assumption')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $literature_cited_version = DB::table('literature_cited')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            $project_management_version = DB::table('project_management')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->orderBy('created_at', 'ASC')
                                          ->get();
            if(!is_null($executive_summary_version)) Session::flash('executive_summary_version', $executive_summary_version);
            if(!is_null($description_version)) Session::flash('description_version', $description_version);
            if(!is_null($startup_background_version)) Session::flash('startup_background_version', $startup_background_version);
            if(!is_null($marketing_commercial_viability_version)) Session::flash('marketing_commercial_viability_version', $marketing_commercial_viability_version);
            if(!is_null($rationale_version)) Session::flash('rationale_version', $rationale_version);
            if(!is_null($significance_version)) Session::flash('significance_version', $significance_version);
            if(!is_null($general_objective_version)) Session::flash('general_objective_version', $general_objective_version);
            if(!is_null($specific_objective_version)) Session::flash('specific_objective_version', $specific_objective_version);
            if(!is_null($discussion_version)) Session::flash('discussion_version', $discussion_version);
            if(!is_null($scientific_framework_version)) Session::flash('scientific_framework_version', $scientific_framework_version);
            if(!is_null($review_of_literature_version)) Session::flash('review_of_literature_version', $review_of_literature_version);
            if(!is_null($methodology_version)) Session::flash('methodology_version', $methodology_version);
            if(!is_null($technology_roadmap_version)) Session::flash('technology_roadmap_version', $technology_roadmap_version);
            if(!is_null($sixp_publication_version)) Session::flash('sixp_publication_version', $sixp_publication_version);
            if(!is_null($sixp_patent_version)) Session::flash('sixp_patent_version', $sixp_patent_version);
            if(!is_null($sixp_product_version)) Session::flash('sixp_product_version', $sixp_product_version);
            if(!is_null($sixp_people_service_version)) Session::flash('sixp_people_service_version', $sixp_people_service_version);
            if(!is_null($sixp_place_version)) Session::flash('sixp_place_version', $sixp_place_version);
            if(!is_null($outcome_version)) Session::flash('outcome_version', $outcome_version);
            if(!is_null($potential_social_impact_version)) Session::flash('potential_social_impact_version', $potential_social_impact_version);
            if(!is_null($potential_economic_impact_version)) Session::flash('potential_economic_impact_version', $potential_economic_impact_version);
            if(!is_null($target_beneficiaries_version)) Session::flash('target_beneficiaries_version', $target_beneficiaries_version);
            if(!is_null($sustainability_version)) Session::flash('sustainability_version', $sustainability_version);
            if(!is_null($limitation_version)) Session::flash('limitation_version', $limitation_version);
            if(!is_null($risk_assumption_version)) Session::flash('risk_assumption_version', $risk_assumption_version);
            if(!is_null($literature_cited_version)) Session::flash('literature_cited_version', $literature_cited_version);
            if(!is_null($project_management_version)) Session::flash('project_management_version', $project_management_version);

            $ps_lib_select = DB::table('ps_lib')
                            ->leftJoin('proposal', 'ps_lib.proposal_idproposal', '=', 'proposal.idproposal')
                            ->where('proposal.program_id', $proposal->program_id)
                            ->where('ps_lib.is_active', 1);
            $mooe_lib_select = DB::table('mooe_lib')
                            ->leftJoin('proposal', 'mooe_lib.proposal_idproposal', '=', 'proposal.idproposal')
                            ->where('proposal.program_id', $proposal->program_id)
                            ->where('mooe_lib.is_active', 1);
            $eo_co_lib_select = DB::table('eo_co_lib')
                            ->leftJoin('proposal', 'eo_co_lib.proposal_idproposal', '=', 'proposal.idproposal')
                            ->where('proposal.program_id', $proposal->program_id)
                            ->where('eo_co_lib.is_active', 1);

            $ps_lib_funding_agencies = $ps_lib_select
                                    ->whereNotNull('ps_lib.comlib_funding_agency_id')
                                    ->leftJoin('commonlibrariesdb.agency as libagency', 'ps_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                    ->select(
                                      'ps_lib.comlib_funding_agency_id as funding_agency_id',
                                      DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as funding_agency')
                                    )
                                    ->groupBy('funding_agency_id');

            $mooe_lib_funding_agencies = $mooe_lib_select
                                      ->whereNotNull('mooe_lib.comlib_funding_agency_id')
                                      ->leftJoin('commonlibrariesdb.agency as libagency', 'mooe_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                      ->select(
                                        'mooe_lib.comlib_funding_agency_id as funding_agency_id',
                                        DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as funding_agency')
                                      )
                                      ->groupBy('funding_agency_id');

            $eo_co_lib_funding_agencies = $eo_co_lib_select
                                        ->whereNotNull('eo_co_lib.comlib_funding_agency_id')
                                        ->leftJoin('commonlibrariesdb.agency as libagency', 'eo_co_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                        ->select(
                                          'eo_co_lib.comlib_funding_agency_id as funding_agency_id',
                                          DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as funding_agency')
                                        )
                                        ->groupBy('funding_agency_id');
            $lib_funding_agencies = $ps_lib_funding_agencies->unionAll($mooe_lib_funding_agencies)->unionAll($eo_co_lib_funding_agencies)->groupBy('funding_agency_id')->orderBy('funding_agency_id');

            $lib_funding_agencies = DB::query()->fromSub($lib_funding_agencies, 'i_t')
                                      ->groupBy('funding_agency_id')
                                      ->orderBy('funding_agency_id', 'DESC')
                                      ->get();
            //yearly budget
            $program_ps_lib_items = DB::table('ps_lib')
                                    ->leftJoin('proposal', 'ps_lib.proposal_idproposal', '=', 'proposal.idproposal')
                                    ->leftJoin('commonlibrariesdb.agency as libagency', 'ps_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                    ->leftJoin('lib_dpmis_position as dpmis_position', 'ps_lib.lib_dpmis_position_idlib_dpmis_position', '=', 'dpmis_position.idlib_dpmis_position')
                                    ->whereNotNull('ps_lib.comlib_funding_agency_id')
                                    ->where('proposal.program_id', $proposal->program_id)
                                    ->where('ps_lib.is_active', 1)
                                    ->select(
                                        'year',
                                        'comlib_funding_agency_id as funding_agency_id',
                                        'libagency.acronym as funding_agency',
                                        DB::raw('COALESCE((CASE WHEN ps_lib.amount <= 0 THEN (dpmis_position.rate * ps_lib.num_duration * ps_lib.num_position) ELSE ps_lib.amount END), 0) as ps_amount
                                      ')
                                    )
                                    ->get();

            $program_mooe_lib_items = DB::table('mooe_lib')
                                        ->leftJoin('proposal', 'mooe_lib.proposal_idproposal', '=', 'proposal.idproposal')
                                        ->leftJoin('commonlibrariesdb.agency as libagency', 'mooe_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                        ->whereNotNull('mooe_lib.comlib_funding_agency_id')
                                        ->where('proposal.program_id', $proposal->program_id)
                                        ->where('mooe_lib.is_active', 1)
                                        ->select(
                                            'year',
                                            'comlib_funding_agency_id as funding_agency_id',
                                            'libagency.acronym as funding_agency',
                                            'mooe_lib.amount as mooe_amount'
                                        )
                                        ->get();
            $program_eo_co_lib_items = DB::table('eo_co_lib')
                                        ->leftJoin('proposal', 'eo_co_lib.proposal_idproposal', '=', 'proposal.idproposal')
                                        ->leftJoin('commonlibrariesdb.agency as libagency', 'eo_co_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                        ->whereNotNull('eo_co_lib.comlib_funding_agency_id')
                                        ->where('proposal.program_id', $proposal->program_id)
                                        ->where('eo_co_lib.is_active', 1)
                                        ->select(
                                            'year',
                                            'comlib_funding_agency_id as funding_agency_id',
                                            'libagency.acronym as funding_agency',
                                            'eo_co_lib.amount as eo_co_amount'
                                        )
                                        ->get();
            $budget_summary = array();
            $budget_yearly_total = array();
            $budget_summary_total = array();
            //$budget_summary[year][funding_agency_id][ps_lib, mooe_lib, eo_co]
            for($year_count = 0; $year_count < $proposal->proposal_years; $year_count++) {
                $budget_summary_total['lib_summary']['ps_amount'] = 0;
                $budget_summary_total['lib_summary']['mooe_amount'] = 0;
                $budget_summary_total['lib_summary']['eo_co_amount'] = 0;
                $budget_summary_total['lib_summary']['total_amount'] = 0;
                for($j = 0; $j < count($lib_funding_agencies); $j++) {
                    $Jfunding_agency_id = $lib_funding_agencies[$j]->funding_agency_id;
                    $budget_summary[$year_count + 1][$Jfunding_agency_id]['funding_agency'] = $lib_funding_agencies[$j]->funding_agency;
                    $budget_summary[$year_count + 1][$Jfunding_agency_id]['ps_amount'] = 0;
                    $budget_summary[$year_count + 1][$Jfunding_agency_id]['mooe_amount'] = 0;
                    $budget_summary[$year_count + 1][$Jfunding_agency_id]['eo_co_amount'] = 0;
                    $budget_summary[$year_count + 1][$Jfunding_agency_id]['total_amount'] = 0;
                    $budget_yearly_total[$year_count + 1]['total_ps_amount'] = 0;
                    $budget_yearly_total[$year_count + 1]['total_mooe_amount'] = 0;
                    $budget_yearly_total[$year_count + 1]['total_eo_co_amount'] = 0;
                    $budget_yearly_total[$year_count + 1]['total_amount'] = 0;
                    for($k = 0; $k < count($program_ps_lib_items); $k++) {
                        if(
                            $program_ps_lib_items[$k]->year == $year_count + 1 && 
                            $program_ps_lib_items[$k]->funding_agency_id == $Jfunding_agency_id
                        )
                        $budget_summary[$year_count + 1][$Jfunding_agency_id]['ps_amount'] += $program_ps_lib_items[$k]->ps_amount;
                    }
                    for($k = 0; $k < count($program_mooe_lib_items); $k++) {
                        if(
                            $program_mooe_lib_items[$k]->year == $year_count + 1 && 
                            $program_mooe_lib_items[$k]->funding_agency_id == $Jfunding_agency_id
                        )
                        $budget_summary[$year_count + 1][$Jfunding_agency_id]['mooe_amount'] += $program_mooe_lib_items[$k]->mooe_amount;
                    }  
                    for($k = 0; $k < count($program_eo_co_lib_items); $k++) {
                        if(
                            $program_eo_co_lib_items[$k]->year == $year_count + 1 && 
                            $program_eo_co_lib_items[$k]->funding_agency_id == $Jfunding_agency_id
                        )
                        $budget_summary[$year_count + 1][$Jfunding_agency_id]['eo_co_amount'] += $program_eo_co_lib_items[$k]->eo_co_amount;
                    }
                    $budget_summary[$year_count + 1][$Jfunding_agency_id]['total_amount'] = $budget_summary[$year_count + 1][$Jfunding_agency_id]['ps_amount'] + $budget_summary[$year_count + 1][$Jfunding_agency_id]['mooe_amount'] + $budget_summary[$year_count + 1][$Jfunding_agency_id]['eo_co_amount'];
                    $budget_yearly_total[$year_count + 1]['total_ps_amount'] = $budget_yearly_total[$year_count + 1]['total_ps_amount'] + $budget_summary[$year_count + 1][$Jfunding_agency_id]['ps_amount'];
                    $budget_yearly_total[$year_count + 1]['total_mooe_amount'] = $budget_yearly_total[$year_count + 1]['total_mooe_amount'] + $budget_summary[$year_count + 1][$Jfunding_agency_id]['mooe_amount'];
                    $budget_yearly_total[$year_count + 1]['total_eo_co_amount'] = $budget_yearly_total[$year_count + 1]['total_eo_co_amount'] + $budget_summary[$year_count + 1][$Jfunding_agency_id]['eo_co_amount'];
                    $budget_yearly_total[$year_count + 1]['total_amount'] = $budget_yearly_total[$year_count + 1]['total_amount'] + $budget_summary[$year_count + 1][$Jfunding_agency_id]['total_amount'];
                    $budget_summary_total['lib_summary']['ps_amount'] += $budget_summary[$year_count + 1][$Jfunding_agency_id]['ps_amount'];
                    $budget_summary_total['lib_summary']['mooe_amount'] += $budget_summary[$year_count + 1][$Jfunding_agency_id]['mooe_amount'];
                    $budget_summary_total['lib_summary']['eo_co_amount'] += $budget_summary[$year_count + 1][$Jfunding_agency_id]['eo_co_amount'];
                    $budget_summary_total['lib_summary']['total_amount'] += $budget_summary[$year_count + 1][$Jfunding_agency_id]['total_amount'];
                }
            }
            if((!is_null($proposal) && $proposal->proposal_type_id == 1) || (!is_null($proposal) && $proposal->proposal_type_id == 3) || (!is_null($proposal) && $proposal->proposal_type_id == 5)) {
                $total_yearly_budget = DB::table('view_apilibunion')
                                    ->leftJoin('proposal', 'view_apilibunion.proposal_idproposal', '=', 'proposal.idproposal')
                                    ->where('proposal.program_id', $proposal->program_id);
                $total_proposed_budget = DB::table('view_apilibunion')
                                    ->leftJoin('proposal', 'view_apilibunion.proposal_idproposal', '=', 'proposal.idproposal')
                                    ->where('proposal.program_id', $proposal->program_id);
            } else {
                $total_yearly_budget = DB::table('view_apilibunion')
                                    ->where('view_apilibunion.proposal_idproposal', $proposal_id);
                $total_proposed_budget = DB::table('view_apilibunion')
                                    ->where('view_apilibunion.proposal_idproposal', $proposal_id);
            }
            $total_yearly_budget = $total_yearly_budget
                                    ->where(function($q) {
                                        $q->orWhere('ps_lib.is_active', 1);
                                        $q->orWhere('mooe_lib.is_active', 1);
                                        $q->orWhere('eo_co_lib.is_active', 1);
                                    })
                                    ->leftJoin('ps_lib', 'view_apilibunion.idps_lib', '=', 'ps_lib.idps_lib')
                                    ->leftJoin('lib_dpmis_position as dpmis_position', 'ps_lib.lib_dpmis_position_idlib_dpmis_position', '=', 'dpmis_position.idlib_dpmis_position')
                                    ->leftJoin('mooe_lib', 'view_apilibunion.idmooe_lib', '=', 'mooe_lib.idmooe_lib')
                                    ->leftJoin('eo_co_lib', 'view_apilibunion.ideo_co_lib', '=', 'eo_co_lib.ideo_co_lib')
                                    ->select(
                                      'view_apilibunion.year',
                                      DB::raw('COALESCE(SUM(CASE WHEN ps_lib.amount <= 0 THEN (dpmis_position.rate * ps_lib.num_duration * ps_lib.num_position) ELSE ps_lib.amount END), 0) as sum_ps_lib
                                      '),
                                      DB::raw('COALESCE(SUM(mooe_lib.amount), 0) as sum_mooe_lib'),
                                      DB::raw('COALESCE(SUM(eo_co_lib.amount), 0) as sum_eo_co_lib')
                                    )
                                    ->groupBy(
                                      'view_apilibunion.year'
                                    )
                                    ->get();
            $total_proposed_budget = $total_proposed_budget
                                    ->where(function($q) {
                                        $q->orWhere('ps_lib.is_active', 1);
                                        $q->orWhere('mooe_lib.is_active', 1);
                                        $q->orWhere('eo_co_lib.is_active', 1);
                                    })
                                    ->leftJoin('ps_lib', 'view_apilibunion.idps_lib', '=', 'ps_lib.idps_lib')
                                    ->leftJoin('lib_dpmis_position as dpmis_position', 'ps_lib.lib_dpmis_position_idlib_dpmis_position', '=', 'dpmis_position.idlib_dpmis_position')
                                    ->leftJoin('mooe_lib', 'view_apilibunion.idmooe_lib', '=', 'mooe_lib.idmooe_lib')
                                    ->leftJoin('eo_co_lib', 'view_apilibunion.ideo_co_lib', '=', 'eo_co_lib.ideo_co_lib')
                                    ->select(
                                      DB::raw('COALESCE(SUM(CASE WHEN ps_lib.amount <= 0 THEN (dpmis_position.rate * ps_lib.num_duration * ps_lib.num_position) ELSE ps_lib.amount END), 0) as sum_ps_lib
                                      '),
                                      DB::raw('COALESCE(SUM(mooe_lib.amount), 0) as sum_mooe_lib'),
                                      DB::raw('COALESCE(SUM(eo_co_lib.amount), 0) as sum_eo_co_lib')
                                    );

            $total_proposed_budget = DB::query()->fromSub($total_proposed_budget, 'i_t')
                                        ->select(DB::raw('(SELECT (sum_ps_lib + sum_mooe_lib + sum_eo_co_lib)) as total_proposed_budget'))
                                        ->pluck('total_proposed_budget')
                                        ->first();



            //tracking for proposals
            $proposal_forwarded_divisions = DB::table('users_has_access_during_proposal_has_lib_proposal_status')
                                    ->leftJoin('users', 'users_has_access_during_proposal_has_lib_proposal_status.users_id', '=', 'users.id')
                                    ->leftJoin('commonlibrariesdb.pcaarrd_divisions as divisions', 'users.division', '=', 'divisions.id')
                                    ->where('proposal_has_lib_proposal_status_proposal_idproposal', $proposal_id)
                                    ->where('users_has_access_during_proposal_has_lib_proposal_status.is_active', 1)
                                    ->where('users.is_active', 1)
                                    ->select('divisions.division_acronym as division_acronym')
                                    ->groupBy('divisions.division_acronym');
            $proposal_forwarded_divisions = DB::query()->fromSub($proposal_forwarded_divisions, 'i_t')
                                                ->select(DB::raw('GROUP_CONCAT(DISTINCT `division_acronym` SEPARATOR ", ") as divisions'))
                                                ->pluck('divisions')
                                                ->first();
            $proposal_status_tracking = array();
            $proposal_status_tracking_select = DB::table('proposal_has_lib_proposal_status')
                                                    ->where('proposal_has_lib_proposal_status.proposal_idproposal',$proposal_id)
                                                    ->orderBy('created_at', 'ASC');
            $proposal_status_received = clone $proposal_status_tracking_select;
            $proposal_status_received = $proposal_status_received
                                        ->where('proposal_has_lib_proposal_status.lib_proposal_status_idlib_proposal_status', '7')
                                        ->first();
            $proposal_status_forwarded_for_evaluation = clone $proposal_status_tracking_select;
            $proposal_status_forwarded_for_evaluation = $proposal_status_forwarded_for_evaluation
                                                        ->where('proposal_has_lib_proposal_status.lib_proposal_status_idlib_proposal_status', '8')
                                                        ->first();
            $proposal_status_review_of_trep_report = clone $proposal_status_tracking_select;
            $proposal_status_review_of_trep_report = $proposal_status_review_of_trep_report
                                                    ->where('proposal_has_lib_proposal_status.lib_proposal_status_idlib_proposal_status', '16')
                                                    ->first();

            $proposal_status_tracking['received_proposal'] = $proposal_status_received;
            $proposal_status_tracking['forwarded_for_evaluation_proposal'] = $proposal_status_forwarded_for_evaluation;
            $proposal_status_tracking['review_of_trep_report_proposal'] = $proposal_status_review_of_trep_report;

            if(!is_null($proposal_status_tracking)) Session::flash('proposal_status_tracking', $proposal_status_tracking);

            if(isset($proposal_status_tracking['received_proposal']) && !is_null($proposal_status_tracking['received_proposal']->created_at)) Session::flash('proposal_status_tracking_received_proposal_created_at', $proposal_status_tracking['received_proposal']->created_at);
            if(isset($proposal_status_tracking['received_proposal']) && !is_null($proposal_status_tracking['received_proposal']->remarks)) Session::flash('proposal_status_tracking_received_proposal_remarks', $proposal_status_tracking['received_proposal']->remarks);

            if(isset($proposal_status_tracking['forwarded_for_evaluation_proposal']) && !is_null($proposal_status_tracking['forwarded_for_evaluation_proposal']->created_at)) Session::flash('proposal_status_tracking_forwarded_for_evaluation_proposal_created_at', $proposal_status_tracking['forwarded_for_evaluation_proposal']->created_at);
            if(isset($proposal_status_tracking['forwarded_for_evaluation_proposal']) && !is_null($proposal_status_tracking['forwarded_for_evaluation_proposal']->remarks)) Session::flash('proposal_status_tracking_forwarded_for_evaluation_proposal_remarks', $proposal_status_tracking['forwarded_for_evaluation_proposal']->remarks);

            if(isset($proposal_status_tracking['review_of_trep_report_proposal']) && !is_null($proposal_status_tracking['review_of_trep_report_proposal']->created_at)) Session::flash('proposal_status_tracking_review_of_trep_report_proposal_created_at', $proposal_status_tracking['review_of_trep_report_proposal']->created_at);
            if(isset($proposal_status_tracking['review_of_trep_report_proposal']) && !is_null($proposal_status_tracking['review_of_trep_report_proposal']->remarks)) Session::flash('proposal_status_tracking_review_of_trep_report_proposal_remarks', $proposal_status_tracking['review_of_trep_report_proposal']->remarks);

            if(!is_null($proposal_forwarded_divisions)) Session::flash('proposal_forwarded_divisions', $proposal_forwarded_divisions);
            if(!is_null($total_yearly_budget)) Session::flash('total_yearly_budget', $total_yearly_budget); 
            if(!is_null($total_proposed_budget)) Session::flash('total_proposed_budget', $total_proposed_budget);
            //if proposal is a program
            if((!is_null($proposal) && $proposal->proposal_type_id == 1) || (!is_null($proposal) && $proposal->proposal_type_id == 3) || (!is_null($proposal) && $proposal->proposal_type_id == 5)) {

                //get all project of programs
                $projects = DB::table('proposal')
                              ->where('program_id', $proposal->program_id)
                              ->where('proposal_type', 2)
                              ->select(
                                'proposal.*',
                                DB::raw('(SELECT pr.title FROM proposal pr WHERE proposal.project_id = pr.project_id AND (pr.proposal_type = 2 OR pr.proposal_type = 4 OR pr.proposal_type = 6) LIMIT 1) as proposal_project_title'),
                                DB::raw('(SELECT CONCAT(DATE_FORMAT(pd.`start_date`, "%M %d, %Y"), " - ", DATE_FORMAT(pd.`end_date`, "%M %d, %Y"), " (", pd.project_month_length ,") months") FROM `proposal_duration` pd WHERE proposal.idproposal = pd.proposal_idproposal AND pd.is_active = 1) as proposal_total_duration')
                              )->get();

                $proposal_researchers = DB::table('proposal_researcher')
                                  ->leftJoin('proposal', 'proposal.idproposal', '=', 'proposal_researcher.proposal_idproposal')
                                  ->leftJoin('hrisv2db.records as proposal_hris_researcher', 'proposal_researcher.hris_researcher_id', '=', 'proposal_hris_researcher.id')
                                  ->leftJoin('commonlibrariesdb.agency as commlibagency', 'proposal_hris_researcher.hr_agency_id', '=', 'commlibagency.id')
                                  ->where('program_id', $proposal->program_id)
                                  ->select(
                                    'proposal_researcher.*',
                                    DB::raw('
                                      (CASE
                                        WHEN proposal_hris_researcher.hr_sex = 1
                                          THEN "Male"
                                        WHEN proposal_hris_researcher.hr_sex = 2
                                          THEN "Female"
                                      END) as proposal_researcher_sex'),
                                    'proposal_hris_researcher.*',
                                    'commlibagency.acronym as agency_acronym'
                                  )
                                  ->groupBy('proposal_researcher.dpmis_researcher_id')
                                  ->orderBy('is_lead', 'desc')
                                  ->get();
                //budget summary
                //dost
                //number of personnel requirement
                $number_personnel = DB::table('personnel_number')
                                        ->where('proposal_idproposal', $proposal_id)
                                        ->first();
                $no_personnel_full_time = 0;
                $no_personnel_part_time = 0;
                $no_personnel_total = 0;
                if(!is_null($number_personnel)) {
                  $no_personnel_full_time = (is_null($number_personnel->full_time)) ? 0 : $number_personnel->full_time;
                  $no_personnel_part_time = (is_null($number_personnel->part_time)) ? 0 : $number_personnel->part_time;
                  $no_personnel_total = $no_personnel_full_time + $no_personnel_part_time;
                }

                //equipments
                $equipments = DB::table('equipment_summary')
                                      ->where('proposal_idproposal', $proposal_id)
                                      ->get();

                // other programs
                $other_programs;
                if(!is_null($researcher)){
                  $other_programs = DB::table('proposal')
                                      ->leftJoin('proposal_researcher', 'proposal.idproposal', '=', 'proposal_researcher.proposal_idproposal')
                                      ->leftJoin('proposal_duration', 'proposal.idproposal', '=', 'proposal_duration.proposal_idproposal')
                                      ->leftJoin('commonlibrariesdb.agency as libagency', 'proposal.comlib_agency_id', '=', 'libagency.id')
                                      ->where('proposal_researcher.hris_researcher_id', $researcher->hris_researcher_id)
                                      ->where('proposal.proposal_type', 1)
                                      ->select(
                                        'proposal.title',
                                        'proposal.comlib_agency_id',
                                        'proposal.dpmis_agency_id',
                                        'proposal_researcher.involvement',
                                        'libagency.acronym as agency_name',
                                        DB::raw('(
                                            SELECT
                                                CONCAT(
                                                  DATE_FORMAT(dur.start_date, "%b. %e, %Y"),
                                                  "-",
                                                  DATE_FORMAT(dur.end_date, "%b. %e, %Y")
                                                )
                                            FROM
                                                `proposal_duration` `dur`
                                            WHERE
                                                `dur`.`proposal_idproposal` = `proposal`.`idproposal` AND `dur`.`is_active` IS TRUE
                                        ) as implementation_period')
                                      )
                                      ->get();
                }

                if(!is_null($projects)) Session::flash('proposal_projects', $projects->toArray());
                if(!is_null($budget_summary)) Session::flash('budget_summary', $budget_summary);
                if(!is_null($budget_summary_total)) Session::flash('budget_summary_total', $budget_summary_total);
                if(!is_null($budget_yearly_total)) Session::flash('budget_yearly_total', $budget_yearly_total);
                if(!is_null($no_personnel_full_time)) Session::flash('no_personnel_full_time', $no_personnel_full_time);
                if(!is_null($no_personnel_part_time)) Session::flash('no_personnel_part_time', $no_personnel_part_time);
                if(!is_null($no_personnel_total)) Session::flash('no_personnel_total', $no_personnel_total);

                if(!is_null($equipments)) Session::flash('equipments', $equipments->toArray());
                if(isset($other_programs)) Session::flash('other_programs', $other_programs->toArray());

                //programs
                return Response::json([
                    'dost_form1' => View::make('forms/dost_form1')->render(),
                    'program_monitoring_form' => View::make('forms/proposal_monitoring_form')->render(),
                    'proposal_type' => $proposal->proposal_type_id,
                    'projects' => $projects,
                    'proposal_files' => $proposal_files,
                    'proposal_timeline' => $proposal_timeline,
                    'proposal_researchers' => $proposal_researchers,
                    'status'=>'1'
                ]);
            } else if(!is_null($proposal)) {
                $implementation_sites = DB::table('implementation_site')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->where('is_active', 1)
                                          ->get();

                $lead_implementation_site = DB::table('view_apisites')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->where('is_lead', 1)
                                          ->first();
                $personnels = DB::table('personnel')
                                ->leftJoin('lib_dpmis_position', 'personnel.lib_dpmis_position_idlib_dmis_position', '=', 'lib_dpmis_position.idlib_dpmis_position')
                                ->where('proposal_idproposal', $proposal_id)
                                ->get();

                $ps_lib_select = DB::table('ps_lib')
                            ->leftJoin('proposal', 'ps_lib.proposal_idproposal', '=', 'proposal.idproposal')
                            ->where('proposal_idproposal', $proposal_id)
                            ->where('ps_lib.is_active', 1);
                $mooe_lib_select = DB::table('mooe_lib')
                                ->leftJoin('proposal', 'mooe_lib.proposal_idproposal', '=', 'proposal.idproposal')
                                ->where('proposal_idproposal', $proposal_id)
                                ->where('mooe_lib.is_active', 1);
                $eo_co_lib_select = DB::table('eo_co_lib')
                                ->leftJoin('proposal', 'eo_co_lib.proposal_idproposal', '=', 'proposal.idproposal')
                                ->where('proposal_idproposal', $proposal_id)
                                ->where('eo_co_lib.is_active', 1);

                $ps_lib_funding_agencies = $ps_lib_select
                                        ->whereNotNull('ps_lib.comlib_funding_agency_id')
                                        ->leftJoin('commonlibrariesdb.agency as libagency', 'ps_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                        ->select(
                                          'ps_lib.comlib_funding_agency_id as funding_agency_id',
                                          DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as funding_agency')
                                        )
                                        ->groupBy('funding_agency_id');

                $mooe_lib_funding_agencies = $mooe_lib_select
                                          ->whereNotNull('mooe_lib.comlib_funding_agency_id')
                                          ->leftJoin('commonlibrariesdb.agency as libagency', 'mooe_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                          ->select(
                                            'mooe_lib.comlib_funding_agency_id as funding_agency_id',
                                            DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as funding_agency')
                                          )
                                          ->groupBy('funding_agency_id');

                $eo_co_lib_funding_agencies = $eo_co_lib_select
                                            ->whereNotNull('eo_co_lib.comlib_funding_agency_id')
                                            ->leftJoin('commonlibrariesdb.agency as libagency', 'eo_co_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                            ->select(
                                              'eo_co_lib.comlib_funding_agency_id as funding_agency_id',
                                              DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as funding_agency')
                                            )
                                            ->groupBy('funding_agency_id');
                $lib_funding_agencies = $ps_lib_funding_agencies->unionAll($mooe_lib_funding_agencies)->unionAll($eo_co_lib_funding_agencies)->groupBy('funding_agency_id')->orderBy('funding_agency_id');

                $lib_funding_agencies = DB::query()->fromSub($lib_funding_agencies, 'i_t')
                                          ->groupBy('funding_agency_id')
                                          ->orderBy('funding_agency_id', 'DESC')
                                          ->get();
                $ps_lib_lib_summary = DB::table('ps_lib')
                                        ->leftJoin('proposal', 'ps_lib.proposal_idproposal', '=', 'proposal.idproposal')
                                        ->leftJoin('commonlibrariesdb.agency as libagency', 'ps_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                        ->leftJoin('lib_dpmis_position as dpmis_position', 'ps_lib.lib_dpmis_position_idlib_dpmis_position', '=', 'dpmis_position.idlib_dpmis_position')
                                        ->where('proposal_idproposal', $proposal_id)
                                        ->where('ps_lib.is_active', 1)
                                        ->select(
                                            'comlib_funding_agency_id as funding_agency_id',
                                            'libagency.acronym as funding_agency',
                                            DB::raw('COALESCE(SUM(CASE WHEN ps_lib.amount <= 0 THEN (dpmis_position.rate * ps_lib.num_duration * ps_lib.num_position) ELSE ps_lib.amount END), 0) as sum_ps_summary
                                          ')
                                        )
                                        ->groupBy('comlib_funding_agency_id')
                                        ->get();
                $mooe_lib_lib_summary = DB::table('mooe_lib')
                                        ->leftJoin('proposal', 'mooe_lib.proposal_idproposal', '=', 'proposal.idproposal')
                                        ->leftJoin('commonlibrariesdb.agency as libagency', 'mooe_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                        ->where('proposal_idproposal', $proposal_id)
                                        ->where('mooe_lib.is_active', 1)
                                        ->select(
                                            'comlib_funding_agency_id as funding_agency_id',
                                            'libagency.acronym as funding_agency',
                                            DB::raw('COALESCE(SUM(mooe_lib.amount), 0) as sum_mooe_summary
                                          ')
                                        )
                                        ->groupBy('comlib_funding_agency_id')
                                        ->get();
                $eo_co_lib_lib_summary = DB::table('eo_co_lib')
                                        ->leftJoin('proposal', 'eo_co_lib.proposal_idproposal', '=', 'proposal.idproposal')
                                        ->leftJoin('commonlibrariesdb.agency as libagency', 'eo_co_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                        ->where('proposal_idproposal', $proposal_id)
                                        ->where('eo_co_lib.is_active', 1)
                                        ->select(
                                            'comlib_funding_agency_id as funding_agency_id',
                                            'libagency.acronym as funding_agency',
                                            DB::raw('COALESCE(SUM(eo_co_lib.amount), 0) as sum_eo_co_summary
                                          ')
                                        )
                                        ->groupBy('comlib_funding_agency_id')
                                        ->get();
                $ps_lib_lib_summary = $this->replace_funding_agency_keys($ps_lib_lib_summary);
                $mooe_lib_lib_summary = $this->replace_funding_agency_keys($mooe_lib_lib_summary);
                $eo_co_lib_lib_summary = $this->replace_funding_agency_keys($eo_co_lib_lib_summary);

                $lib_summary = array();
                $lib_summary_total = array();
                $lib_summary_total['total_ps_amount'] = 0;
                $lib_summary_total['total_mooe_amount'] = 0;
                $lib_summary_total['total_eo_co_amount'] = 0;
                $lib_summary_total['total_amount'] = 0;

                for($year_count = 0; $year_count < $proposal->proposal_years; $year_count++) {
                }
                for($i = 0; $i < count($lib_funding_agencies); $i++) {
                    $funding_agency_key = $lib_funding_agencies[$i]->funding_agency_id;
                    $lib_summary[$funding_agency_key]['funding_agency'] = $lib_funding_agencies[$i]->funding_agency;
                    $lib_summary[$funding_agency_key]['ps_amount'] = (isset($ps_lib_lib_summary[$funding_agency_key])) ? $ps_lib_lib_summary[$funding_agency_key]->sum_ps_summary : 0;
                    $lib_summary[$funding_agency_key]['mooe_amount'] = (isset($mooe_lib_lib_summary[$funding_agency_key])) ? $mooe_lib_lib_summary[$funding_agency_key]->sum_mooe_summary : 0;
                    $lib_summary[$funding_agency_key]['eo_co_amount'] = (isset($eo_co_lib_lib_summary[$funding_agency_key])) ? $eo_co_lib_lib_summary[$funding_agency_key]->sum_eo_co_summary : 0;
                    $lib_summary[$funding_agency_key]['funding_agency_total'] = $lib_summary[$funding_agency_key]['ps_amount'] + $lib_summary[$funding_agency_key]['mooe_amount'] + $lib_summary[$funding_agency_key]['eo_co_amount'];

                    $lib_summary_total['total_ps_amount'] = $lib_summary_total['total_ps_amount'] + $lib_summary[$funding_agency_key]['ps_amount'];
                    $lib_summary_total['total_mooe_amount'] = $lib_summary_total['total_mooe_amount'] + $lib_summary[$funding_agency_key]['mooe_amount'];
                    $lib_summary_total['total_eo_co_amount'] = $lib_summary_total['total_ps_amount'] + $lib_summary[$funding_agency_key]['ps_amount'];
                    $lib_summary_total['total_amount'] = $lib_summary_total['total_amount'] + $lib_summary[$funding_agency_key]['funding_agency_total'];
                }


                $other_projects = null;
                if(!is_null($researcher)){
                  $other_projects = DB::table('proposal')
                                        ->where('proposal_researcher.hris_researcher_id', $researcher->hris_researcher_id)
                                        ->where('proposal_researcher.dpmis_researcher_id', $researcher->dpmis_researcher_id)
                                        ->where('proposal_researcher.is_lead', '1')
                                        ->where('proposal.idproposal', '!=', $proposal_id)
                                        ->leftJoin('commonlibrariesdb.agency as commlibagency', 'proposal.comlib_agency_id', '=', 'commlibagency.id')
                                        ->leftJoin('proposal_researcher', 'proposal.idproposal', '=', 'proposal_researcher.proposal_idproposal')
                                        ->select('proposal.*', 'proposal_researcher.is_lead', 'commlibagency.acronym as agency_acronym')
                                        ->get();
                }
                if(!is_null($implementation_sites)) Session::flash('proposal_implementation_sites', $implementation_sites->toArray());
                if(!is_null($personnels)) Session::flash('proposal_personnels', $personnels->toArray());
                if(!is_null($other_projects)) Session::flash('other_projects', $other_projects->toArray());
                if(!is_null($lib_summary)) Session::flash('lib_summary', $lib_summary);
                if(!is_null($lib_summary_total)) Session::flash('lib_summary_total', $lib_summary_total);
                
                if($proposal->proposal_type_id == 2) {
                    //Basic or Applied Research
                    return Response::json([
                        'dost_form2_ba_research' => View::make('forms/dost_form2_ba_research')->render(),
                        'project_monitoring_form' => View::make('forms/proposal_monitoring_form')->render(),
                        'proposal_type' => $proposal->proposal_type_id,
                        'project' => $proposal,
                        'proposal_files' => $proposal_files,
                        'proposal_timeline' => $proposal_timeline,
                        'proposal_researchers' => $proposal_researchers,
                        'status'=>'1'
                    ]);
                } else if($proposal->proposal_type_id == 4){
                    //Non-R & D
                    return Response::json([
                        'dost_form3' => View::make('forms/dost_form3')->render(),
                        'project_monitoring_form' => View::make('forms/proposal_monitoring_form')->render(),
                        'proposal_type' => $proposal->proposal_type_id,
                        'project' => $proposal,
                        'proposal_files' => $proposal_files,
                        'proposal_timeline' => $proposal_timeline,
                        'proposal_researchers' => $proposal_researchers,
                        'status'=>'1'
                    ]);
                } else if($proposal->proposal_type_id == 6){
                    //Startup project
                    return Response::json([
                        'dost_form2_startups' => View::make('forms/dost_form2_startups')->render(),
                        'project_monitoring_form' => View::make('forms/proposal_monitoring_form')->render(),
                        'proposal_type' => $proposal->proposal_type_id,
                        'project' => $proposal,
                        'proposal_files' => $proposal_files,
                        'proposal_timeline' => $proposal_timeline,
                        'proposal_researchers' => $proposal_researchers,
                        'status'=>'1'
                    ]);
                } 

            }
          
        }
    }

    protected function show_lib_by_proposal_and_year(Request $request){
        //LIB
        //PS   
        //get headers
        $return_show_json = $this->show($request)->getData();
        $proposal = $return_show_json->project;
        $proposal_type = $return_show_json->proposal_type;
        $proposal_id = $request->get('proposal_id');
        $year = $request->get('year');

        $ps_lib_select = DB::table('ps_lib')
                        ->where('ps_lib.proposal_idproposal', $proposal_id)
                        ->where('year', $year)
                        ->where('ps_lib.is_active', 1);
        $mooe_lib_select = DB::table('mooe_lib')
                        ->where('mooe_lib.proposal_idproposal', $proposal_id)
                        ->where('year', $year)
                        ->where('mooe_lib.is_active', 1);
        $eo_co_lib_select = DB::table('eo_co_lib')
                        ->where('eo_co_lib.proposal_idproposal', $proposal_id)
                        ->where('year', $year)
                        ->where('eo_co_lib.is_active', 1);

        $ps_lib_funding_agencies = clone $ps_lib_select;
        $ps_lib_funding_agencies = $ps_lib_funding_agencies
                                ->whereNotNull('ps_lib.comlib_funding_agency_id')
                                ->leftJoin('commonlibrariesdb.agency as libagency', 'ps_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                ->select(
                                  'ps_lib.comlib_funding_agency_id as funding_agency_id',
                                  DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as funding_agency')
                                )
                                ->groupBy('funding_agency_id');
        $mooe_lib_funding_agencies = clone $mooe_lib_select;                          
        $mooe_lib_funding_agencies = $mooe_lib_funding_agencies
                                  ->whereNotNull('mooe_lib.comlib_funding_agency_id')
                                  ->leftJoin('commonlibrariesdb.agency as libagency', 'mooe_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                  ->select(
                                    'mooe_lib.comlib_funding_agency_id as funding_agency_id',
                                    DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as funding_agency')
                                  )
                                  ->groupBy('funding_agency_id');
        $eo_co_lib_funding_agencies = clone $eo_co_lib_select;
        $eo_co_lib_funding_agencies = $eo_co_lib_funding_agencies
                                    ->whereNotNull('eo_co_lib.comlib_funding_agency_id')
                                    ->leftJoin('commonlibrariesdb.agency as libagency', 'eo_co_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                    ->select(
                                      'eo_co_lib.comlib_funding_agency_id as funding_agency_id',
                                      DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as funding_agency')
                                    )
                                    ->groupBy('funding_agency_id');
        $project_lib_funding_agencies = $ps_lib_funding_agencies->unionAll($mooe_lib_funding_agencies)->unionAll($eo_co_lib_funding_agencies)->groupBy('funding_agency_id')->orderBy('funding_agency_id');

        $project_lib_funding_agencies = DB::query()->fromSub($project_lib_funding_agencies, 'i_t')
                                          ->groupBy('funding_agency_id')
                                          ->orderBy('funding_agency_id', 'DESC')
                                          ->get();

        $ps_lib_imp_mon_agencies = clone $ps_lib_select;
        $ps_lib_imp_mon_agencies = $ps_lib_imp_mon_agencies
                                ->whereNotNull('ps_lib.comlib_imp_mon_agency_id')
                                ->leftJoin('commonlibrariesdb.agency as libagency', 'ps_lib.comlib_imp_mon_agency_id', '=', 'libagency.id')
                                ->select(
                                  'ps_lib.comlib_imp_mon_agency_id as imp_mon_agency_id',
                                  DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as imp_mon_agency')
                                )
                                ->groupBy('imp_mon_agency_id');
        $mooe_lib_imp_mon_agencies = clone $mooe_lib_select;
        $mooe_lib_imp_mon_agencies = $mooe_lib_imp_mon_agencies
                                  ->whereNotNull('mooe_lib.comlib_imp_mon_agency_id')
                                  ->leftJoin('commonlibrariesdb.agency as libagency', 'mooe_lib.comlib_imp_mon_agency_id', '=', 'libagency.id')
                                  ->select(
                                    'mooe_lib.comlib_imp_mon_agency_id as imp_mon_agency_id',
                                    DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as imp_mon_agency')
                                  )
                                  ->groupBy('imp_mon_agency_id');
        $eo_co_lib_imp_mon_agencies = clone $eo_co_lib_select;
        $eo_co_lib_imp_mon_agencies = $eo_co_lib_imp_mon_agencies
                                    ->whereNotNull('eo_co_lib.comlib_imp_mon_agency_id')
                                    ->leftJoin('commonlibrariesdb.agency as libagency', 'eo_co_lib.comlib_imp_mon_agency_id', '=', 'libagency.id')
                                    ->select(
                                      'eo_co_lib.comlib_imp_mon_agency_id as imp_mon_agency_id',
                                      DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as imp_mon_agency')
                                    )
                                    ->groupBy('imp_mon_agency_id');
        $project_lib_imp_mon_agencies = $ps_lib_imp_mon_agencies->unionAll($mooe_lib_imp_mon_agencies)->unionAll($eo_co_lib_imp_mon_agencies)->groupBy('imp_mon_agency_id')->orderBy('imp_mon_agency_id');

        $project_lib_imp_mon_agencies = DB::query()->fromSub($project_lib_imp_mon_agencies, 'i_t')
                                          ->groupBy('imp_mon_agency_id')
                                          ->get();

        $ps_lib_counterpart_agencies = clone $ps_lib_select;
        $ps_lib_counterpart_agencies = $ps_lib_counterpart_agencies
                                ->whereNotNull('ps_lib.comlib_counterpart_agency_id')
                                ->leftJoin('commonlibrariesdb.agency as libagency', 'ps_lib.comlib_counterpart_agency_id', '=', 'libagency.id')
                                ->select(
                                  'ps_lib.comlib_counterpart_agency_id as counterpart_agency_id',
                                  DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as counterpart_agency')
                                )
                                ->groupBy('counterpart_agency_id');
        $mooe_lib_counterpart_agencies = clone $mooe_lib_select;
        $mooe_lib_counterpart_agencies = $mooe_lib_counterpart_agencies
                                  ->whereNotNull('mooe_lib.comlib_counterpart_agency_id')
                                  ->leftJoin('commonlibrariesdb.agency as libagency', 'mooe_lib.comlib_counterpart_agency_id', '=', 'libagency.id')
                                  ->select(
                                    'mooe_lib.comlib_counterpart_agency_id as counterpart_agency_id',
                                    DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as counterpart_agency')
                                  )
                                  ->groupBy('counterpart_agency_id');
        $eo_co_lib_counterpart_agencies = clone $eo_co_lib_select;
        $eo_co_lib_counterpart_agencies = $eo_co_lib_counterpart_agencies
                                    ->whereNotNull('eo_co_lib.comlib_counterpart_agency_id')
                                    ->leftJoin('commonlibrariesdb.agency as libagency', 'eo_co_lib.comlib_counterpart_agency_id', '=', 'libagency.id')
                                    ->select(
                                      'eo_co_lib.comlib_counterpart_agency_id as counterpart_agency_id',
                                      DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as counterpart_agency')
                                    )
                                    ->groupBy('counterpart_agency_id');
        $project_lib_counterpart_agencies = $ps_lib_counterpart_agencies->unionAll($mooe_lib_counterpart_agencies)->unionAll($eo_co_lib_counterpart_agencies)->groupBy('counterpart_agency_id')->orderBy('counterpart_agency_id');

        $project_lib_counterpart_agencies = DB::query()->fromSub($project_lib_counterpart_agencies, 'i_t')
                                          ->groupBy('counterpart_agency_id')
                                          ->get();

        $project_ps_lib = clone $ps_lib_select;
        $project_ps_lib = $project_ps_lib
                        ->leftJoin('lib_dpmis_position as dpmis_position', 'ps_lib.lib_dpmis_position_idlib_dpmis_position', '=', 'dpmis_position.idlib_dpmis_position')
                        ->select(
                          'year',
                          'cost_type',
                          'ps_type',
                          'comlib_funding_agency_id as funding_agency_id',
                          'comlib_imp_mon_agency_id as imp_mon_agency_id',
                          'comlib_counterpart_agency_id as counterpart_agency_id',
                          DB::raw('(SELECT CONCAT(
                            "(", ps_lib.num_position, ") ",
                            dpmis_position.position_name,
                            " @ ",
                            dpmis_position.rate,
                            " x ",
                            ps_lib.num_duration,
                            " unit "
                          )) as description'),
                          DB::raw('
                            (
                              CASE
                                WHEN amount <= 0
                                  THEN CONCAT("₱ ", FORMAT((dpmis_position.rate * ps_lib.num_duration * ps_lib.num_position), 2))
                                ELSE CONCAT("₱ ", FORMAT(amount, 2))
                                END
                            ) as amount
                          ')
                        )
                        ->get();

        $project_mooe_lib_direct_cost = clone $mooe_lib_select;              
        $project_mooe_lib_direct_cost = $project_mooe_lib_direct_cost
                                      ->where('cost_type', 0)
                                      ->select(
                                        'year',
                                        'cost_type',
                                        'comlib_mooe_classification_id as mooe_classification_id',
                                        'comlib_mooe_subcategory_id as mooe_subcategory_id',
                                        'comlib_mooe_item_id as mooe_item_id',
                                        'dpmis_mooe_classification as mooe_classification',
                                        'dpmis_mooe_subcategory as mooe_subcategory',
                                        'mooe_item',
                                        'mooe_specification as mooe_specification',
                                        'comlib_funding_agency_id as funding_agency_id',
                                        'comlib_imp_mon_agency_id as imp_mon_agency_id',
                                        'comlib_counterpart_agency_id as counterpart_agency_id',
                                        DB::raw('CONCAT("₱ ", FORMAT(SUM(amount), 2)) as amount')
                                      )
                                      ->groupBy('idmooe_lib');

        $project_mooe_lib_indirect_cost = clone $mooe_lib_select;              
        $project_mooe_lib_indirect_cost = $project_mooe_lib_indirect_cost
                                        ->where('cost_type', 1)
                                        ->select(
                                          'year',
                                          'cost_type',
                                          'comlib_mooe_classification_id as mooe_classification_id',
                                          'comlib_mooe_subcategory_id as mooe_subcategory_id',
                                          'comlib_mooe_item_id as mooe_item_id',
                                          'dpmis_mooe_classification as mooe_classification',
                                          'dpmis_mooe_subcategory as mooe_subcategory',
                                          'mooe_item',
                                          'mooe_specification as mooe_specification',
                                          'comlib_funding_agency_id as funding_agency_id',
                                          'comlib_imp_mon_agency_id as imp_mon_agency_id',
                                          'comlib_counterpart_agency_id as counterpart_agency_id',
                                          DB::raw('CONCAT("₱ ", FORMAT(SUM(amount), 2)) as amount')
                                        )
                                        ->groupBy('idmooe_lib');
        $project_mooe_lib = $project_mooe_lib_direct_cost->unionAll($project_mooe_lib_indirect_cost)->get();

        $project_eo_co_lib = clone $eo_co_lib_select;
        $project_eo_co_lib = $project_eo_co_lib
                          ->select(
                            'year',
                            'cost_type',
                            'comlib_funding_agency_id as funding_agency_id',
                            'comlib_imp_mon_agency_id as imp_mon_agency_id',
                            'comlib_counterpart_agency_id as counterpart_agency_id',
                            DB::raw('CONCAT("(", co_quantity,") ",co_description) as description'),
                            DB::raw('CONCAT("₱ ", FORMAT(amount, 2)) as amount')
                          )
                          ->get();
        $project_lib['project_lib_funding_agencies'] = (is_null($project_lib_funding_agencies) ? null : $project_lib_funding_agencies);
        $project_lib['project_lib_imp_mon_agencies'] = (is_null($project_lib_imp_mon_agencies) ? null : $project_lib_imp_mon_agencies);
        $project_lib['project_lib_counterpart_agencies'] = (is_null($project_lib_counterpart_agencies) ? null : $project_lib_counterpart_agencies);
        $project_lib['project_ps_lib'] = (is_null($project_ps_lib) ? null : $project_ps_lib);
        $project_lib['project_mooe_lib'] = (is_null($project_mooe_lib) ? null : $project_mooe_lib);
        $project_lib['project_eo_co_lib'] = (is_null($project_eo_co_lib) ? null : $project_eo_co_lib);
        return Response::json([
        'project' => $proposal,
        'proposal_type' => $proposal_type,
        'lib' => $project_lib,
        'status' => 1
        ]);
    }

    protected function show_lib_by_proposal_per_year(Request $request){
        //LIB
        //PS   
        //get headers
        $return_show_json = $this->show($request)->getData();
        $proposal = $return_show_json->project;
        $proposal_type = $return_show_json->proposal_type;
        $proposal_id = $request->get('proposal_id');
        $proposal_years = $request->get('proposal_years');

        $proposal_lib_per_year = [];
        for ($i=1; $i <= $proposal_years; $i++) { 
            $year = $i;
            // code...
            $ps_lib_select = DB::table('ps_lib')
                            ->where('ps_lib.proposal_idproposal', $proposal_id)
                            ->where('year', $year)
                            ->where('ps_lib.is_active', 1);
            $mooe_lib_select = DB::table('mooe_lib')
                            ->where('mooe_lib.proposal_idproposal', $proposal_id)
                            ->where('year', $year)
                            ->where('mooe_lib.is_active', 1);
            $eo_co_lib_select = DB::table('eo_co_lib')
                            ->where('eo_co_lib.proposal_idproposal', $proposal_id)
                            ->where('year', $year)
                            ->where('eo_co_lib.is_active', 1);

            $ps_lib_funding_agencies = clone $ps_lib_select;
            $ps_lib_funding_agencies = $ps_lib_funding_agencies
                                    ->whereNotNull('ps_lib.comlib_funding_agency_id')
                                    ->leftJoin('commonlibrariesdb.agency as libagency', 'ps_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                    ->select(
                                      'ps_lib.comlib_funding_agency_id as funding_agency_id',
                                      DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as funding_agency')
                                    )
                                    ->groupBy('funding_agency_id');
            $mooe_lib_funding_agencies = clone $mooe_lib_select;                          
            $mooe_lib_funding_agencies = $mooe_lib_funding_agencies
                                      ->whereNotNull('mooe_lib.comlib_funding_agency_id')
                                      ->leftJoin('commonlibrariesdb.agency as libagency', 'mooe_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                      ->select(
                                        'mooe_lib.comlib_funding_agency_id as funding_agency_id',
                                        DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as funding_agency')
                                      )
                                      ->groupBy('funding_agency_id');
            $eo_co_lib_funding_agencies = clone $eo_co_lib_select;
            $eo_co_lib_funding_agencies = $eo_co_lib_funding_agencies
                                        ->whereNotNull('eo_co_lib.comlib_funding_agency_id')
                                        ->leftJoin('commonlibrariesdb.agency as libagency', 'eo_co_lib.comlib_funding_agency_id', '=', 'libagency.id')
                                        ->select(
                                          'eo_co_lib.comlib_funding_agency_id as funding_agency_id',
                                          DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as funding_agency')
                                        )
                                        ->groupBy('funding_agency_id');
            $project_lib_funding_agencies = $ps_lib_funding_agencies->unionAll($mooe_lib_funding_agencies)->unionAll($eo_co_lib_funding_agencies)->groupBy('funding_agency_id')->orderBy('funding_agency_id');

            $project_lib_funding_agencies = DB::query()->fromSub($project_lib_funding_agencies, 'i_t')
                                              ->groupBy('funding_agency_id')
                                              ->orderBy('funding_agency_id', 'DESC')
                                              ->get();

            $ps_lib_imp_mon_agencies = clone $ps_lib_select;
            $ps_lib_imp_mon_agencies = $ps_lib_imp_mon_agencies
                                    ->whereNotNull('ps_lib.comlib_imp_mon_agency_id')
                                    ->leftJoin('commonlibrariesdb.agency as libagency', 'ps_lib.comlib_imp_mon_agency_id', '=', 'libagency.id')
                                    ->select(
                                      'ps_lib.comlib_imp_mon_agency_id as imp_mon_agency_id',
                                      DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as imp_mon_agency')
                                    )
                                    ->groupBy('imp_mon_agency_id');
            $mooe_lib_imp_mon_agencies = clone $mooe_lib_select;
            $mooe_lib_imp_mon_agencies = $mooe_lib_imp_mon_agencies
                                      ->whereNotNull('mooe_lib.comlib_imp_mon_agency_id')
                                      ->leftJoin('commonlibrariesdb.agency as libagency', 'mooe_lib.comlib_imp_mon_agency_id', '=', 'libagency.id')
                                      ->select(
                                        'mooe_lib.comlib_imp_mon_agency_id as imp_mon_agency_id',
                                        DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as imp_mon_agency')
                                      )
                                      ->groupBy('imp_mon_agency_id');
            $eo_co_lib_imp_mon_agencies = clone $eo_co_lib_select;
            $eo_co_lib_imp_mon_agencies = $eo_co_lib_imp_mon_agencies
                                        ->whereNotNull('eo_co_lib.comlib_imp_mon_agency_id')
                                        ->leftJoin('commonlibrariesdb.agency as libagency', 'eo_co_lib.comlib_imp_mon_agency_id', '=', 'libagency.id')
                                        ->select(
                                          'eo_co_lib.comlib_imp_mon_agency_id as imp_mon_agency_id',
                                          DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as imp_mon_agency')
                                        )
                                        ->groupBy('imp_mon_agency_id');
            $project_lib_imp_mon_agencies = $ps_lib_imp_mon_agencies->unionAll($mooe_lib_imp_mon_agencies)->unionAll($eo_co_lib_imp_mon_agencies)->groupBy('imp_mon_agency_id')->orderBy('imp_mon_agency_id');

            $project_lib_imp_mon_agencies = DB::query()->fromSub($project_lib_imp_mon_agencies, 'i_t')
                                              ->groupBy('imp_mon_agency_id')
                                              ->get();

            $ps_lib_counterpart_agencies = clone $ps_lib_select;
            $ps_lib_counterpart_agencies = $ps_lib_counterpart_agencies
                                    ->whereNotNull('ps_lib.comlib_counterpart_agency_id')
                                    ->leftJoin('commonlibrariesdb.agency as libagency', 'ps_lib.comlib_counterpart_agency_id', '=', 'libagency.id')
                                    ->select(
                                      'ps_lib.comlib_counterpart_agency_id as counterpart_agency_id',
                                      DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as counterpart_agency')
                                    )
                                    ->groupBy('counterpart_agency_id');
            $mooe_lib_counterpart_agencies = clone $mooe_lib_select;
            $mooe_lib_counterpart_agencies = $mooe_lib_counterpart_agencies
                                      ->whereNotNull('mooe_lib.comlib_counterpart_agency_id')
                                      ->leftJoin('commonlibrariesdb.agency as libagency', 'mooe_lib.comlib_counterpart_agency_id', '=', 'libagency.id')
                                      ->select(
                                        'mooe_lib.comlib_counterpart_agency_id as counterpart_agency_id',
                                        DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as counterpart_agency')
                                      )
                                      ->groupBy('counterpart_agency_id');
            $eo_co_lib_counterpart_agencies = clone $eo_co_lib_select;
            $eo_co_lib_counterpart_agencies = $eo_co_lib_counterpart_agencies
                                        ->whereNotNull('eo_co_lib.comlib_counterpart_agency_id')
                                        ->leftJoin('commonlibrariesdb.agency as libagency', 'eo_co_lib.comlib_counterpart_agency_id', '=', 'libagency.id')
                                        ->select(
                                          'eo_co_lib.comlib_counterpart_agency_id as counterpart_agency_id',
                                          DB::raw('(CASE WHEN libagency.acronym IS NULL OR libagency.agency = "" THEN "N/A" ELSE libagency.acronym END) as counterpart_agency')
                                        )
                                        ->groupBy('counterpart_agency_id');
            $project_lib_counterpart_agencies = $ps_lib_counterpart_agencies->unionAll($mooe_lib_counterpart_agencies)->unionAll($eo_co_lib_counterpart_agencies)->groupBy('counterpart_agency_id')->orderBy('counterpart_agency_id');

            $project_lib_counterpart_agencies = DB::query()->fromSub($project_lib_counterpart_agencies, 'i_t')
                                              ->groupBy('counterpart_agency_id')
                                              ->get();

            $project_ps_lib = clone $ps_lib_select;
            $project_ps_lib = $project_ps_lib
                            ->leftJoin('lib_dpmis_position as dpmis_position', 'ps_lib.lib_dpmis_position_idlib_dpmis_position', '=', 'dpmis_position.idlib_dpmis_position')
                            ->select(
                              'year',
                              'cost_type',
                              'ps_type',
                              'comlib_funding_agency_id as funding_agency_id',
                              'comlib_imp_mon_agency_id as imp_mon_agency_id',
                              'comlib_counterpart_agency_id as counterpart_agency_id',
                              DB::raw('(SELECT CONCAT(
                                "(", ps_lib.num_position, ") ",
                                dpmis_position.position_name,
                                " @ ",
                                dpmis_position.rate,
                                " x ",
                                ps_lib.num_duration,
                                " unit "
                              )) as description'),
                              DB::raw('
                                (
                                  CASE
                                    WHEN amount <= 0
                                      THEN CONCAT("₱ ", FORMAT((dpmis_position.rate * ps_lib.num_duration * ps_lib.num_position), 2))
                                    ELSE CONCAT("₱ ", FORMAT(amount, 2))
                                    END
                                ) as amount
                              ')
                            )
                            ->get();

            $project_mooe_lib_direct_cost = clone $mooe_lib_select;              
            $project_mooe_lib_direct_cost = $project_mooe_lib_direct_cost
                                          ->where('cost_type', 0)
                                          ->select(
                                            'year',
                                            'cost_type',
                                            'comlib_mooe_classification_id as mooe_classification_id',
                                            'comlib_mooe_subcategory_id as mooe_subcategory_id',
                                            'comlib_mooe_item_id as mooe_item_id',
                                            'dpmis_mooe_classification as mooe_classification',
                                            'dpmis_mooe_subcategory as mooe_subcategory',
                                            'mooe_item',
                                            'mooe_specification as mooe_specification',
                                            'comlib_funding_agency_id as funding_agency_id',
                                            'comlib_imp_mon_agency_id as imp_mon_agency_id',
                                            'comlib_counterpart_agency_id as counterpart_agency_id',
                                            DB::raw('CONCAT("₱ ", FORMAT(SUM(amount), 2)) as amount')
                                          )
                                          ->groupBy('idmooe_lib');

            $project_mooe_lib_indirect_cost = clone $mooe_lib_select;              
            $project_mooe_lib_indirect_cost = $project_mooe_lib_indirect_cost
                                            ->where('cost_type', 1)
                                            ->select(
                                              'year',
                                              'cost_type',
                                              'comlib_mooe_classification_id as mooe_classification_id',
                                              'comlib_mooe_subcategory_id as mooe_subcategory_id',
                                              'comlib_mooe_item_id as mooe_item_id',
                                              'dpmis_mooe_classification as mooe_classification',
                                              'dpmis_mooe_subcategory as mooe_subcategory',
                                              'mooe_item',
                                              'mooe_specification as mooe_specification',
                                              'comlib_funding_agency_id as funding_agency_id',
                                              'comlib_imp_mon_agency_id as imp_mon_agency_id',
                                              'comlib_counterpart_agency_id as counterpart_agency_id',
                                              DB::raw('CONCAT("₱ ", FORMAT(SUM(amount), 2)) as amount')
                                            )
                                            ->groupBy('idmooe_lib');
            $project_mooe_lib = $project_mooe_lib_direct_cost->unionAll($project_mooe_lib_indirect_cost)->get();

            $project_eo_co_lib = clone $eo_co_lib_select;
            $project_eo_co_lib = $project_eo_co_lib
                              ->select(
                                'year',
                                'cost_type',
                                'comlib_funding_agency_id as funding_agency_id',
                                'comlib_imp_mon_agency_id as imp_mon_agency_id',
                                'comlib_counterpart_agency_id as counterpart_agency_id',
                                DB::raw('CONCAT("(", co_quantity,") ",co_description) as description'),
                                DB::raw('CONCAT("₱ ", FORMAT(amount, 2)) as amount')
                              )
                              ->get();
            $project_lib['project_lib_funding_agencies'] = (is_null($project_lib_funding_agencies) ? null : $project_lib_funding_agencies);
            $project_lib['project_lib_imp_mon_agencies'] = (is_null($project_lib_imp_mon_agencies) ? null : $project_lib_imp_mon_agencies);
            $project_lib['project_lib_counterpart_agencies'] = (is_null($project_lib_counterpart_agencies) ? null : $project_lib_counterpart_agencies);
            $project_lib['project_ps_lib'] = (is_null($project_ps_lib) ? null : $project_ps_lib);
            $project_lib['project_mooe_lib'] = (is_null($project_mooe_lib) ? null : $project_mooe_lib);
            $project_lib['project_eo_co_lib'] = (is_null($project_eo_co_lib) ? null : $project_eo_co_lib);
            $proposal_lib_per_year[$i] = $project_lib;
        }
        return Response::json([
            'project' => $proposal,
            'proposal_type' => $proposal_type,
            'lib' => $proposal_lib_per_year,
            'status' => 1
        ]);
    }

    public function show_proposal_version(Request $request) {
      if($request->ajax()) {
        $target_table = $request->get('target_table');
        $version = $request->get('version');
        $idtarget = 'id'.$target_table;

        try {
          $target_html = DB::table($target_table)->where($idtarget, $version)->pluck($target_table)->first();
          
        } catch (Exception $e) {
          Session::flash('error', 'Version has not been loaded');
          return Response::json([
              'view' => View::make('partials/flash-messages')->render(),
              'status'=>'0'
          ]);
        }

        Session::flash('success', 'Version has been loaded successfully');
        return Response::json([
            'view' => View::make('partials/flash-messages')->render(),
            'status'=>'1',
            'target_html' => $target_html
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
    public function update_status(Request $request)
    {
      if($request->ajax()){
        if($request->get('proposal_id')){
          $request->session()->forget('success');
          $request->session()->forget('error');
          $proposal_id = $request->get('proposal_id');
          $remarks = $request->get('remarks');
          $status = $request->get('status');
          $approved_implementation_start_date = $request->get('approved_implementation_start_date');
          $approved_implementation_end_date = $request->get('approved_implementation_end_date');
          try {
            $current_status = DB::table('proposal_has_lib_proposal_status')
                                  ->where('proposal_idproposal', $proposal_id)
                                  ->where('is_active', 1)
                                  ->pluck('lib_proposal_status_idlib_proposal_status')
                                  ->first();
            $proposal_update_status = DB::table('proposal')
                                        ->where('proposal.idproposal', $proposal_id)
                                        ->select(
                                          DB::raw('
                                            (
                                              SELECT
                                                  `a`.`remarks`
                                              FROM
                                                  (
                                                      `proposal_has_lib_call_for_proposal` `a`
                                                  JOIN `lib_call_for_proposal` `b` ON
                                                      (
                                                          `a`.`lib_call_for_proposal_idlib_call_for_proposal` = `b`.`idlib_call_for_proposal`
                                                      )
                                                  )
                                              WHERE
                                                  `a`.`proposal_idproposal` = `proposal`.`idproposal` AND `a`.`is_active` IS TRUE AND `b`.`is_active` IS TRUE
                                          ) AS `remarks`
                                          '),
                                          DB::raw('(
                                            CASE WHEN project_id IS NULL THEN program_id
                                            ELSE project_id
                                            END
                                          ) as project_id')
                                        )
                                        ->first();
            $allowed_transitions = DB::table('lib_proposal_status_allowed_transitions')
                                    ->where('from_lib_proposal_status_idlib_proposal_status', $current_status)
                                    ->where('is_active', 1)
                                    ->pluck('to_lib_proposal_status_idlib_proposal_status');
            $allowed_transitions_text = DB::table('lib_proposal_status_allowed_transitions')
                                        ->leftJoin('lib_proposal_status', 'lib_proposal_status_allowed_transitions.to_lib_proposal_status_idlib_proposal_status', '=', 'lib_proposal_status.idlib_proposal_status')
                                        ->where('from_lib_proposal_status_idlib_proposal_status', $current_status)
                                        ->where('lib_proposal_status_allowed_transitions.is_active', 1)
                                        ->select(DB::raw('(SELECT (COALESCE(GROUP_CONCAT(DISTINCT `lib_proposal_status`.`status` SEPARATOR ", <br/>") , "N/A"))) as allowed_transitions'))
                                        ->pluck('allowed_transitions')
                                        ->first();
            $lead_division = DB::table('proposal_lead_trd')
                                    ->where('proposal_lead_trd.proposal_idproposal', $proposal_id)
                                    ->where('proposal_lead_trd.is_active', 1)
                                    ->groupBy('proposal_lead_trd.division_iddivision')
                                    ->pluck('proposal_lead_trd.division_iddivision')
                                    ->first();
            $lead_division_text = DB::table('commonlibrariesdb.pcaarrd_divisions')
                                    ->where('id', $lead_division)
                                    ->pluck('division_acronym')
                                    ->first();
            if((Auth::user()->privilege == 1 || Auth::user()->privilege == 2 || Auth::user()->division == $lead_division) || in_array($status, $allowed_transitions->toArray()) || $status == 15) {
                if($status == 16 && Auth::user()->privilege == 3 && Auth::user()->division != $lead_division){
                    if(!is_null($lead_division_text)) {
                        Session::flash('error', 'Only the lead division can consolidate comments. Please contact '.$lead_division_text. ' (lead)');
                        return Response::json([
                            'view' => View::make('partials/flash-messages')->render(),
                            'status'=>'0'
                        ]);
                    }                     
                }
                // if($status == 7) {
                //     //TODO downloading files source from DPMIS
                //     $proposalId = $proposal_id;
                //     $proposalFiles = ProposalFile::where('proposal_idproposal', $proposalId)->whereNotNull('dpmis_file_src')->where('dpmis_file_src', '<>', '')->get();

                //     if($proposalFiles->count() > 0) {
                //         foreach ($proposalFiles as $file) {
                //             $now = Carbon::now();
                //             $fileName = explode('/', $file->dpmis_file_src);
                //             $fileName = end($fileName);
                //             $proposalFilesDirectory = 'storage/proposal_files/'.$file->proposal_idproposal;
                //             $proposalFileOSEPDirectory = 'public/'.$proposalFilesDirectory;

                //             try {
                //                 if(!File::exists($proposalFileOSEPDirectory)){
                //                     File::makeDirectory($proposalFileOSEPDirectory, $mode = 0777, true, true);
                //                 }
                //                 $proposalFileOSEPDirectory = $proposalFileOSEPDirectory.'/'.$fileName;
                //                 file_put_contents($proposalFileOSEPDirectory, file_get_contents($file->dpmis_file_src));

                                
                //                 $proposalFilesDirectory = $proposalFilesDirectory.'/'.$fileName;
                //                 ProposalFile::where('idproposal_file', $file->idproposal_file)->update(
                //                     [
                //                         'file_src' => $proposalFilesDirectory,
                //                         'updated_at' => $now
                //                     ]
                //                 );
                //             } catch (Exception $e) {
                                
                //             }
                //         }
                //     }
                // }
                if($status == 16) {
                    $proposal_implementation_dates = DB::table('proposal_implementation_dates')->where('proposal_idproposal', $proposal_id)->first();

                          if(!$proposal_implementation_dates) {
                              DB::table('proposal_implementation_dates')->insert([
                                  'approved_implementation_start_date' => $approved_implementation_start_date,
                                  'proposal_idproposal' => $proposal_id,
                                  'approved_implementation_end_date' => $approved_implementation_end_date,
                                  'is_active' => 1
                              ]);
                          } else {
                              DB::table('proposal_implementation_dates')->where('proposal_idproposal', $proposal_id)
                              ->update([
                                  'approved_implementation_start_date' => $approved_implementation_start_date,
                                  'approved_implementation_end_date' => $approved_implementation_end_date,
                                  'is_active' => 1
                              ]);
                          }
                    }
                $proposal_status = DB::table('proposal_has_lib_proposal_status')
                                ->where('proposal_idproposal', $proposal_id)
                                ->update([
                                  'is_active' => 0
                                ]);

                DB::table('proposal_has_lib_proposal_status')
                    ->insert([
                    'proposal_idproposal' => $proposal_id,
                    'lib_proposal_status_idlib_proposal_status' => $status,
                    'remarks' => $remarks,
                    'is_active' => '1'
                ]);

                $new_status = DB::table('proposal_has_lib_proposal_status')
                          ->where('proposal_idproposal', $proposal_id)
                          ->where('lib_proposal_status_idlib_proposal_status', $status)
                          ->where('proposal_has_lib_proposal_status.is_active', 1)
                          ->leftJoin('lib_proposal_status', 'proposal_has_lib_proposal_status.lib_proposal_status_idlib_proposal_status', '=', 'lib_proposal_status.idlib_proposal_status')
                          ->select(
                            'proposal_has_lib_proposal_status.remarks as remarks',
                            'proposal_has_lib_proposal_status.idproposal_has_lib_proposal_status',
                            'proposal_has_lib_proposal_status.created_at as pcreated_at',
                            'lib_proposal_status.*'
                          )
                          ->first();
                try {
                    $now = Carbon::now();
                    $dpmis_auth = new Client(['proxy' => 'tcp://192.168.0.9:3128']);
                    $dpmis_auth_result = $dpmis_auth->post('http://202.90.141.23/dpmisoauth', [
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

                    $dpmis_update_status = $dpmis_auth->post('http://202.90.141.23/statuses', [

                      'headers' => [
                        'Authorization' => ' Bearer '.$dpmis_access_token,
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json'
                      ],
                      'json' => [
                        'project_id' => (!is_null($proposal_update_status->project_id) ? $proposal_update_status->project_id : 'Not Applicable'),
                        'status_id' => (!is_null($new_status->idproposal_has_lib_proposal_status) ? $new_status->idproposal_has_lib_proposal_status : '7'),
                        'status_name' => (!is_null($new_status->status) ? $new_status->status : 'N/A'),
                        'status_type' =>  (!is_null($new_status->dpmis_counterpart_status_id) ? $new_status->dpmis_counterpart_status_id : '1'),
                        'remarks' => (!is_null($new_status->remarks) ? $new_status->remarks : $new_status->status),
                        'date_created' => (!is_null($new_status->pcreated_at) ? $new_status->pcreated_at : $now),
                        'evaluation_level' => (!is_null($new_status->evaluation_level) ? $new_status->evaluation_level : '1'),
                        'is_closed' => (!is_null($new_status->is_evaluation_closed) ? $new_status->is_evaluation_closed : 'N/A'),
                        'created_by' => ((!is_null(Auth::user()->first_name) && !is_null(Auth::user()->last_name)) ? Auth::user()->first_name.' '.Auth::user()->last_name : 'Pamela Anne Tandang')

                      ]
                    ]); 
                    //forward_to_palihan
                    if($new_status->idlib_proposal_status == 15) {
                        if($this->forward_proposal_to_palihan($request) == 1) {
                            Session::flash('success', 'Proposal has been transferred to Palihan successfully');
                            return Response::json([
                                'view' => View::make('partials/flash-messages')->render(),
                                'status'=>'1'
                            ]);
                        } else {
                            Session::flash('error', 'Proposal has not been transferred to Palihan');
                            return Response::json([
                                'view' => View::make('partials/flash-messages')->render(),
                                'status'=>'0'
                            ]);
                        }
                    }

                } catch (GuzzleHttp\Exception\ClientException $e) {

                }
            } else if(!in_array($status, $allowed_transitions->toArray())){
              Session::flash('error', 'Status transition is not allowed. <br> Only allowed transitions are:<br/> <b>'.$allowed_transitions_text.'</b>');
              return Response::json([
               'view' => View::make('partials/flash-messages')->render(),
               'status'=>'0'
              ]);
            }
          } catch (Exception $e) {
            dd($e);
            Session::flash('error', 'Proposal status update has failed');
            return Response::json([
             'view' => View::make('partials/flash-messages')->render(),
             'status'=>'0'
            ]);
          }
          Session::flash('success', 'Proposal status has been updated successfully');
          return Response::json([
           'view' => View::make('partials/flash-messages')->render(),
           'status'=>'1'
          ]);

        }
      }
    }

    public function export_statuses_to_dpmis(Request $request) {
      // if($request->ajax()){
      //   $request->session()->forget('success');
      //   $request->session()->forget('error');
      //   $proposal_id = $request->get('proposal_id');
        
      //   try {
      //     set_time_limit(0);
      //     $all_statuses = DB::table('proposal_has_lib_proposal_status')
      //                         ->where('proposal_has_lib_proposal_status.lib_proposal_status_idlib_proposal_status', '!=', '6')
      //                         ->leftJoin('proposal', 'proposal_has_lib_proposal_status.proposal_idproposal', '=', 'proposal.idproposal')
      //                         ->leftJoin('lib_proposal_status', 'proposal_has_lib_proposal_status.lib_proposal_status_idlib_proposal_status', '=', 'lib_proposal_status.idlib_proposal_status')
      //                         ->select(
      //                           'proposal_has_lib_proposal_status.proposal_idproposal',
      //                           'proposal_has_lib_proposal_status.idproposal_has_lib_proposal_status',
      //                           'proposal_has_lib_proposal_status.created_at as pcreated_at',
      //                           'lib_proposal_status.*'
      //                         )
      //                         ->groupBy('proposal_has_lib_proposal_status.proposal_idproposal', 'proposal_has_lib_proposal_status.lib_proposal_status_idlib_proposal_status')
      //                         ->orderBy('lib_proposal_status.dpmis_counterpart_status_id', 'ASC')
      //                         ->get();

      //     for ($i=0; $i < count($all_statuses); $i++) {
      //       $now = Carbon::now();
      //       $proposal_update_status = DB::table('proposal')
      //                                   ->where('id', $all_statuses[$i]->proposal_idproposal)
      //                                   ->select(
      //                                     DB::raw('(
      //                                       CASE WHEN project_id IS NULL THEN program_id
      //                                       ELSE project_id
      //                                       END
      //                                     ) as project_id')
      //                                   )
      //                                   ->first();
      //       // $dpmis_auth_export = new Client(['proxy' => 'tcp://192.168.0.9:3128']);
      //       // $dpmis_auth_result_export = $dpmis_auth_export->post('http://202.90.141.23/dpmisoauth', [
      //       //   'form_params' => [
      //       //     'headers' => [
      //       //       'Content-Type' => 'application/json',
      //       //       'Accept' => 'application/json'
      //       //     ],  
      //       //     'redirect_uri' => '/oauth/receivecode',
      //       //     'client_id' => 'pcaarrd',
      //       //     'client_secret' => 'pcaarrd2020',
      //       //     'grant_type' => 'client_credentials'
      //       //   ]
      //       // ]);
      //       // $dpmis_access_token_export = (json_decode($dpmis_auth_result_export->getBody(), true)['access_token']);
      //       // $dpmis_update_status_export = $dpmis_auth_export->post('http://202.90.141.23/statuses', [
      //       //   'headers' => [
      //       //     'Authorization' => ' Bearer '.$dpmis_access_token_export,
      //       //     'Content-Type' => 'application/json',
      //       //     'Accept' => 'application/json'
      //       //   ],
      //       //   'json' => [
      //       //     'project_id' => (!is_null($proposal_update_status->project_id) ? $proposal_update_status->project_id : 'Not Applicable'),
      //       //     'status_id' => (!is_null($all_statuses[$i]->idproposal_has_lib_proposal_status) ? $all_statuses[$i]->idproposal_has_lib_proposal_status : '7'),
      //       //     'status_name' => (!is_null($all_statuses[$i]->status) ? $all_statuses[$i]->status : 'Received'),
      //       //     'status_type' =>  (!is_null($all_statuses[$i]->dpmis_counterpart_status_id) ? $all_statuses[$i]->dpmis_counterpart_status_id : '1'),
      //       //     'remarks' => (!is_null($all_statuses[$i]->remarks) ? $all_statuses[$i]->remarks : 'Not Applicable'),
      //       //     'date_created' => (!is_null($all_statuses[$i]->pcreated_at) ? $all_statuses[$i]->pcreated_at : $now),
      //       //     'evaluation_level' => (!is_null($all_statuses[$i]->evaluation_level) ? $all_statuses[$i]->evaluation_level : '1'),
      //       //     'is_closed' => (!is_null($all_statuses[$i]->is_evaluation_closed) ? $all_statuses[$i]->is_evaluation_closed : '0'),
      //       //     'created_by' => ((!is_null(Auth::user()->first_name) && !is_null(Auth::user()->last_name)) ? Auth::user()->first_name.' '.Auth::user()->last_name : 'N/A')
      //       //   ]
      //       // ]);
      //     }
      //     set_time_limit(120);
      //   } catch (Exception $e) {
      //     dd($e);
      //     Session::flash('success', 'Proposal status has failed to export');
      //     return Response::json([
      //      'view' => View::make('partials/flash-messages')->render(),
      //      'status'=>'0'
      //     ]);
      //   }
      //   Session::flash('success', 'Proposal status has been exported to DPMIS successfully');
      //   return Response::json([
      //    'view' => View::make('partials/flash-messages')->render(),
      //    'status'=>'1'
      //   ]);
      // }
    }
    public function view_forward_proposal(Request $request) {
      if($request->ajax()) {
        if($request->get('proposal_id')) {
          $request->session()->forget('success');
          $request->session()->forget('error');
          $proposal_id = $request->get('proposal_id');

          if(Auth::user()->privilege == 1 || Auth::user()->privilege == 2) {
            $forward_proposal_users = DB::table('users_has_access_during_proposal_has_lib_proposal_status')
                                        ->where('proposal_has_lib_proposal_status_proposal_idproposal', $proposal_id)
                                        ->where('users_has_access_during_proposal_has_lib_proposal_status.is_active', 1)
                                        ->groupBy('users_id')
                                        ->pluck('users_id');
          } else {
            $forward_proposal_users = DB::table('users_has_access_during_proposal_has_lib_proposal_status')
                                        ->leftJoin('users', 'users_has_access_during_proposal_has_lib_proposal_status.users_id', '=', 'users.id')
                                        ->where('proposal_has_lib_proposal_status_proposal_idproposal', $proposal_id)
                                        ->where('users_has_access_during_proposal_has_lib_proposal_status.is_active', 1)
                                        ->where('division', Auth::user()->division)
                                        ->groupBy('users_id')
                                        ->pluck('users_id');
          }

          $forward_proposal_divisions = DB::table('users_has_access_during_proposal_has_lib_proposal_status')
                                    ->leftJoin('users', 'users_has_access_during_proposal_has_lib_proposal_status.users_id', '=', 'users.id')
                                    ->where('proposal_has_lib_proposal_status_proposal_idproposal', $proposal_id)
                                    ->where('users_has_access_during_proposal_has_lib_proposal_status.is_active', 1)
                                    ->where('users.is_active', 1)
                                    ->groupBy('users.division')
                                    ->pluck('users.division');
          $lead_division = DB::table('proposal_lead_trd')
                                    ->where('proposal_lead_trd.proposal_idproposal', $proposal_id)
                                    ->where('proposal_lead_trd.is_active', 1)
                                    ->groupBy('proposal_lead_trd.division_iddivision')
                                    ->pluck('proposal_lead_trd.division_iddivision');
          return Response::json([
              'forward_proposal_users' => $forward_proposal_users,
              'forward_proposal_divisions' => $forward_proposal_divisions,
              'lead_division' => $lead_division,
              'user_privilege' => Auth::user()->privilege,
              'status'=>'1'
          ]);

        }

      }
    }

    public function forward_proposal_to_trd(Request $request) {      
      if($request->ajax()){
        if($request->get('proposal_id')){
            $request->session()->forget('success');
            $request->session()->forget('error');            
            $proposal_id = $request->get('proposal_id');
            $forward_proposal_divisions = $request->get('forward_proposal_divisions');
            $forward_proposal_users = $request->get('forward_proposal_users');
            $lead_division = $request->get('lead_division');
            $status_remarks = $request->get('status_remarks');
            $status = 8;
            $proposal_code = DB::table('proposal')
                            ->where('idproposal', $proposal_id)
                            ->select(
                                DB::raw('(
                                      CASE
                                        WHEN (proposal.project_id IS NULL OR proposal.project_id = "") AND (proposal.program_id IS NOT NULL AND proposal.program_id != "")
                                          THEN proposal.program_id
                                        WHEN (proposal.program_id IS NULL OR proposal.program_id = "") AND (proposal.project_id IS NOT NULL AND proposal.project_id != "")
                                          THEN proposal.project_id
                                        WHEN (proposal.program_id IS NOT NULL AND proposal.program_id != "" AND proposal.project_id IS NOT NULL AND proposal.project_id != "")
                                          THEN proposal.project_id
                                        ELSE "N/A"
                                      END
                                    ) AS proposal_code')
                            )
                            ->pluck('proposal_code')
                            ->first();
            //division accounts           
            // dd(!empty($forward_proposal_divisions) && (Auth::user()->privilege == 1 || Auth::user()->privilege == 2));   
            // dd(!empty($lead_division));    
            if(!empty($forward_proposal_divisions) && (Auth::user()->privilege == 1 || Auth::user()->privilege == 2)) {
                //removes privileges of division accounts
                DB::table('users_has_access_during_proposal_has_lib_proposal_status')
                            ->leftJoin('users', 'users_has_access_during_proposal_has_lib_proposal_status.users_id', '=', 'users.id')
                            ->where('users.privilege', 3)
                            ->where('users_has_access_during_proposal_has_lib_proposal_status.proposal_has_lib_proposal_status_proposal_idproposal', $proposal_id)
                            ->update(['users_has_access_during_proposal_has_lib_proposal_status.is_active' => 0]);       
                foreach ($forward_proposal_divisions as $divisions => $division) {
                    $divisions_users = DB::table('users')
                                        ->where('privilege', 3)
                                        ->where('division', $division)
                                        ->select(
                                            'users.*',
                                            DB::raw('
                                                (
                                                    SELECT
                                                        (

                                                            CASE WHEN (SELECT email FROM fed_employeedb2.view_dpmis_pmt WHERE fldEmpCode = users.employee_code) IS NOT NULL
                                                                THEN (SELECT email FROM fed_employeedb2.view_dpmis_pmt WHERE fldEmpCode = users.employee_code)
                                                            WHEN (SELECT email FROM fed_employeedb2.view_dpmis_pmt_pis_data WHERE fldEmpCode = users.employee_code) IS NOT NULL
                                                                THEN (SELECT email FROM fed_employeedb2.view_dpmis_pmt_pis_data WHERE fldEmpCode = users.employee_code)
                                                            ELSE NULL
                                                            END
                                                        )
                                                ) as email
                                            ')

                                        )
                                        ->get();
                    foreach ($divisions_users as $users => $divisions_user) {      
                        try {
                            // if(isset($divisions_user->email) && !is_null($divisions_user->email) && filter_var($divisions_user->email, FILTER_VALIDATE_EMAIL, FILTER_FLAG_EMAIL_UNICODE)) Mail::to($divisions_user->email)->send(new NotificationMail()); 
                            if(isset($divisions_user->email) && !is_null($divisions_user->email)); 
                            DB::table('users_has_access_during_proposal_has_lib_proposal_status')->insert([
                                'users_id' => $divisions_user->id,
                                'proposal_has_lib_proposal_status_proposal_idproposal' => $proposal_id,
                                'has_access' => '1',
                                'is_active' => '1'
                            ]);     
                        } catch (Exception $e) {
                          dd($e);
                        }
                    }
                }
            }

            //users
            if (!empty($forward_proposal_users) && Auth::user()->privilege == 3) {
                //removes access to users in the same division
                DB::table('users_has_access_during_proposal_has_lib_proposal_status')
                    ->leftJoin('users', 'users_has_access_during_proposal_has_lib_proposal_status.users_id', '=', 'users.id')
                    ->where('users_has_access_during_proposal_has_lib_proposal_status.proposal_has_lib_proposal_status_proposal_idproposal', $proposal_id)
                    ->where('users.division', Auth::user()->division)
                    ->where(function($q){
                        $q->orwhere('users.privilege', 4);
                        $q->orWhere('users.privilege', 5);
                    })
                    ->update(['users_has_access_during_proposal_has_lib_proposal_status.is_active' => 0]);
                foreach ($forward_proposal_users as $users => $user) {
                    try {
                        DB::table('users_has_access_during_proposal_has_lib_proposal_status')->insert([
                          'users_id' => $user,
                          'proposal_has_lib_proposal_status_proposal_idproposal' => $proposal_id,
                          'has_access' => '1',
                          'is_active' => '1'
                        ]);

                        DB::table('user_has_proposal_assigned')->insert([
                          'users_id' => $user,
                          'proposal_idproposal' => $proposal_id,
                          'is_active' => '1'
                        ]);

                        $pm_id = DB::table('users')->where('id', $user)->pluck('dpmis_pm_id')->first();
                        set_time_limit(0);
                        $now = Carbon::now();
                        $dpmis_auth = new Client(['proxy' => 'tcp://192.168.0.9:3128']);
                        $dpmis_auth_result = $dpmis_auth->post('http://202.90.141.23/dpmisoauth', 
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

                        $dpmis_user_proposal_assigned = $dpmis_auth->put('http://202.90.141.23/v1/projectManagersAssignment/'.$proposal_code,
                        [

                            'headers' => [
                                'Authorization' => ' Bearer '.$dpmis_access_token,
                                'Content-Type' => 'application/json',
                                'Accept' => 'application/json'
                            ],
                            'json' => [
                                'project_id' => (!is_null($proposal_code) ? $proposal_code : 'Not Applicable'),
                                'pm_id' => (!is_null($pm_id) ? $pm_id : 'Not Applicable')
                            ]
                        ]);
                        set_time_limit(120);
                    } catch (\GuzzleHttp\Exception\BadResponseException $e) {
                        dd($e->getResponse()->getBody()->getContents());
                    }
                }
            }

            //lead division
            if (!empty($lead_division)) {              
                try {
                DB::table('proposal_lead_trd')
                    ->where('proposal_idproposal', $proposal_id)
                    ->update([
                        'is_active' => '0'
                    ]);
                DB::table('proposal_lead_trd')->insert([
                    'proposal_idproposal' => $proposal_id,
                    'division_iddivision' => $lead_division,
                    'is_active' => '1'
                    ]);
                } catch (Exception $e) {
                  dd($e);
                }
            }
            try {
                $current_status = DB::table('proposal_has_lib_proposal_status')
                                      ->where('proposal_idproposal', $proposal_id)
                                      ->where('is_active', 1)
                                      ->pluck('lib_proposal_status_idlib_proposal_status')
                                      ->first();
                $allowed_transitions = DB::table('lib_proposal_status_allowed_transitions')
                                        ->where('from_lib_proposal_status_idlib_proposal_status', $current_status)
                                        ->where('is_active', 1)
                                        ->pluck('to_lib_proposal_status_idlib_proposal_status');
                $allowed_transitions_text = DB::table('lib_proposal_status_allowed_transitions')
                                            ->leftJoin('lib_proposal_status', 'lib_proposal_status_allowed_transitions.to_lib_proposal_status_idlib_proposal_status', '=', 'lib_proposal_status.idlib_proposal_status')
                                            ->where('from_lib_proposal_status_idlib_proposal_status', $current_status)
                                            ->where('lib_proposal_status_allowed_transitions.is_active', 1)
                                            ->select(DB::raw('(SELECT (COALESCE(GROUP_CONCAT(DISTINCT `lib_proposal_status`.`status` SEPARATOR ", <br/>") , "N/A"))) as allowed_transitions'))
                                            ->pluck('allowed_transitions')
                                            ->first();
                if((Auth::user()->privilege == 1 || Auth::user()->privilege == 2) || in_array($status, $allowed_transitions->toArray()) || $status == 15) {
                    if($status == 16 && Auth::user()->privilege == 3 && Auth::user()->division != $lead_division){
                    if(!is_null($lead_division_text)) {
                        Session::flash('error', 'Only the lead division can consolidate comments. Please contact '.$lead_division_text. ' (lead)');
                        return Response::json([
                            'view' => View::make('partials/flash-messages')->render(),
                            'status'=>'0'
                        ]);
                    }                     
                }
                $proposal_update_status = DB::table('proposal')
                                        ->where('proposal.idproposal', $proposal_id)
                                        ->select(
                                          DB::raw('(
                                            CASE WHEN project_id IS NULL THEN program_id
                                            ELSE project_id
                                            END
                                          ) as project_id')
                                        )
                                        ->first();

                $proposal_status = DB::table('proposal_has_lib_proposal_status')
                                      ->where('proposal_idproposal', $proposal_id)
                                      ->update([
                                        'is_active' => 0
                                      ]);
                DB::table('proposal_has_lib_proposal_status')
                  ->insert([
                    'proposal_idproposal' => $proposal_id,
                    'lib_proposal_status_idlib_proposal_status' => '8',
                    'remarks' => $status_remarks,
                    'is_active' => '1'
                  ]);
                $new_status = DB::table('proposal_has_lib_proposal_status')
                                ->where('proposal_idproposal', $proposal_id)
                                ->where('proposal_has_lib_proposal_status.is_active', 1)
                                ->leftJoin('lib_proposal_status', 'proposal_has_lib_proposal_status.lib_proposal_status_idlib_proposal_status', '=', 'lib_proposal_status.idlib_proposal_status')
                                ->select(
                                  'proposal_has_lib_proposal_status.remarks as remarks',
                                  'proposal_has_lib_proposal_status.idproposal_has_lib_proposal_status',
                                  'proposal_has_lib_proposal_status.created_at as pcreated_at',
                                  'lib_proposal_status.*'
                                )
                                ->first();
                $dpmis_auth_forward = new Client(['proxy' => 'tcp://192.168.0.9:3128']);
                $dpmis_auth_result_forward = $dpmis_auth_forward->post('http://202.90.141.23/dpmisoauth', [
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
                $dpmis_access_token_forward = (json_decode($dpmis_auth_result_forward->getBody(), true)['access_token']);

                $dpmis_update_status_forward = $dpmis_auth_forward->post('http://202.90.141.23/statuses', [
                  'headers' => [
                    'Authorization' => ' Bearer '.$dpmis_access_token_forward,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                  ],
                  'json' => [
                    'project_id' => (!is_null($proposal_update_status->project_id) ? $proposal_update_status->project_id : 'Not Applicable'),
                    'status_id' => (!is_null($new_status->idproposal_has_lib_proposal_status) ? $new_status->idproposal_has_lib_proposal_status : 'Not Applicable'),
                    'status_name' => (!is_null($new_status->status) ? $new_status->status : 'Not Applicable'),
                    'status_type' =>  (!is_null($new_status->dpmis_counterpart_status_id) ? $new_status->dpmis_counterpart_status_id : 'Not Applicable'),
                    'remarks' => (!is_null($new_status->remarks) ? $new_status->remarks : $new_status->remarks),
                    'date_created' => (!is_null($new_status->pcreated_at) ? $new_status->pcreated_at : 'Not Applicable'),
                    'evaluation_level' => (!is_null($new_status->evaluation_level) ? $new_status->evaluation_level : '1'),
                    'is_closed' => (!is_null($new_status->is_evaluation_closed) ? $new_status->is_evaluation_closed : '0'),
                    'created_by' => ((!is_null(Auth::user()->first_name) && !is_null(Auth::user()->last_name)) ? Auth::user()->first_name.' '.Auth::user()->last_name : 'Pamela Anne Tandang')
                  ]
                
                ]);
       
            } else if(!in_array($status, $allowed_transitions->toArray())){
                Session::flash('error', 'Status transition is not allowed. Only allowed transitions are:<br/> <b>'.$allowed_transitions_text.'</b>');
                return Response::json([
                'view' => View::make('partials/flash-messages')->render(),
                'status'=>'0'
                ]);
            }


            } catch (Exception $e) {
            dd($e);
            }

          Session::flash('success', 'Proposal has been forwarded successfully');
          return Response::json([
           'view' => View::make('partials/flash-messages')->render(),
           'status'=>'1'
          ]);
        }
      }
    }
    public function upload_files(Request $request){
      if($request->ajax()) {
          $now = Carbon::now();
          $proposal_id = $request->get('proposal_id');
          $document_type = $request->get('document_type');
          $proposal_files_directory = 'storage/proposal_files/'.$proposal_id;
          $proposal_file_details = null;

          try {
              if(!File::exists($proposal_files_directory)){
                File::makeDirectory($proposal_files_directory, $mode = 0777, true, true);
              }
              if($proposal_file = $request->file('proposal_file')) {

                $proposal_file_id = DB::table('proposal_file')
                                  ->insertGetId([
                                    'proposal_idproposal' => $proposal_id,
                                    'lib_document_type_idlib_document_type' => $document_type
                                  ]);
                $name = $proposal_id.'-'.$proposal_file_id.'-submission-supplementary.'.File::extension($proposal_file->getClientOriginalName());
                if($proposal_file->move($proposal_files_directory, $name)) {
                 $proposal_files_directory = $proposal_files_directory.'/'.$name; 
                }
                DB::table('proposal_file')
                  ->where('proposal_idproposal', $proposal_id)
                  ->where('idproposal_file', $proposal_file_id)
                  ->update([
                    'file_name' => $name,
                    'file_src' => $proposal_files_directory
                  ]);
                $proposal_file_details = DB::table('proposal_file')
                                            ->where('proposal_idproposal', $proposal_id)
                                            ->where('idproposal_file', $proposal_file_id)
                                            ->leftJoin('lib_document_type', 'proposal_file.lib_document_type_idlib_document_type', '=', 'lib_document_type.idlib_document_type')
                                            ->leftJoin('proposal', 'proposal_file.proposal_idproposal', '=', 'proposal.idproposal')
                                            ->select(
                                              'proposal_file.*',
                                              'lib_document_type.document_type as document_type',
                                              DB::raw('(
                                                      CASE
                                                        WHEN (proposal.project_id IS NULL OR proposal.project_id = "") AND (proposal.program_id IS NOT NULL AND proposal.program_id != "")
                                                          THEN proposal.program_id
                                                        WHEN (proposal.program_id IS NULL OR proposal.program_id = "") AND (proposal.project_id IS NOT NULL AND proposal.project_id != "")
                                                          THEN proposal.project_id
                                                        WHEN (proposal.program_id IS NOT NULL AND proposal.program_id != "" AND proposal.project_id IS NOT NULL AND proposal.project_id != "")
                                                          THEN proposal.project_id
                                                        ELSE "N/A"
                                                      END
                                                    ) AS proposal_code'
                                                )
                                            )
                                            ->get()
                                            ->first();
              }
          } catch (Exception $e) {
              dd($e);
              Session::flash('error', 'Error in updating to database');
              return Response::json([
               'view' => View::make('partials/flash-messages')
               ->render(),
               'status'=>'0'
              ]);
              
          }
          Session::flash('success', 'File has been uploaded successfully');
          return Response::json([
              'view' => View::make('partials/flash-messages')
              ->render(),
              'status' => '1',
              'file' => $proposal_file_details
          ]);
          
      }

    }
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
    
    //function for forward_to_palihan
    public function forward_proposal_to_palihan(Request $request) {
        $proposal_id = $request->get('proposal_id');
        $proposal_select = $this->proposal_select();
        $proposal = clone $proposal_select;
        $proposal = $proposal
                  ->where('idproposal', $proposal_id)
                  ->first();
        $proposal_leader = DB::table('proposal_researcher')
                              ->where('proposal_idproposal', $proposal_id)
                              ->where('is_lead', 1)
                              ->where('proposal_researcher.is_active', 1)
                              ->leftJoin('hrisv2db.records as proposal_hris_researcher', 'proposal_researcher.hris_researcher_id', '=', 'proposal_hris_researcher.id')
                              ->leftJoin('commonlibrariesdb.agency as commlibagency', 'proposal_hris_researcher.hr_agency_id', '=', 'commlibagency.id')
                              ->select(
                                'proposal_researcher.*',
                                DB::raw('
                                  (CASE
                                    WHEN proposal_hris_researcher.hr_sex = 1
                                      THEN "Male"
                                    WHEN proposal_hris_researcher.hr_sex = 2
                                      THEN "Female"
                                  END) as proposal_researcher_sex'),
                                'proposal_hris_researcher.*',
                                'commlibagency.agency as agency_name',
                                'commlibagency.acronym as agency_acronym'
                              )
                              ->first();
        $proposal_implementation_dates = DB::table('proposal_implementation_dates')->where('proposal_idproposal', $proposal_id)->first();
        $approved_implementation_start_date = DB::table('proposal_implementation_dates')->where('proposal_idproposal', $proposal_id)->first()->approved_implementation_start_date;
        $approved_implementation_end_date = DB::table('proposal_implementation_dates')->where('proposal_idproposal', $proposal_id)->first()->approved_implementation_end_date;
        $program = [
            'name' => (!is_null($proposal->title) && ($proposal->proposal_type_id == 1 || $proposal->proposal_type_id == 3 || $proposal->proposal_type_id == 5) ? $proposal->title : 'none'),
            'researcher' => ($proposal_leader->hr_first_name && ($proposal->proposal_type_id == 1 || $proposal->proposal_type_id == 3 || $proposal->proposal_type_id == 5)) ? [
                'first_name' => (!is_null($proposal_leader->hr_first_name && ($proposal->proposal_type_id == 1 || $proposal->proposal_type_id == 3 || $proposal->proposal_type_id == 5)) ? $proposal_leader->hr_first_name : 'NULL'),
                'middle_name' => (!is_null($proposal_leader->hr_middle_name && ($proposal->proposal_type_id == 1 || $proposal->proposal_type_id == 3 || $proposal->proposal_type_id == 5)) ? $proposal_leader->hr_middle_name : 'NULL'),
                'last_name' => (!is_null($proposal_leader->hr_last_name && ($proposal->proposal_type_id == 1 || $proposal->proposal_type_id == 3 || $proposal->proposal_type_id == 5)) ? $proposal_leader->hr_last_name : 'NULL'),
                'sex' => (!is_null($proposal_leader->proposal_researcher_sex && ($proposal->proposal_type_id == 1 || $proposal->proposal_type_id == 3 || $proposal->proposal_type_id == 5)) ? $proposal_leader->proposal_researcher_sex : 'NULL'),
                'agency' => ($proposal_leader->agency_name) ? [
                    'name' => (!is_null($proposal_leader->agency_name && ($proposal->proposal_type_id == 1 || $proposal->proposal_type_id == 3 || $proposal->proposal_type_id == 5) && ($proposal->proposal_type_id == 1 || $proposal->proposal_type_id == 3 || $proposal->proposal_type_id == 5)) ? $proposal_leader->agency_name : 'NULL'), 
                    'acronym' => (!is_null($proposal_leader->agency_acronym && ($proposal->proposal_type_id == 1 || $proposal->proposal_type_id == 3 || $proposal->proposal_type_id == 5)) ? $proposal_leader->agency_acronym : 'NULL') 
                ] : []
            ] : []
        ];

        if($proposal->proposal_type_id == 1 || $proposal->proposal_type_id == 3 || $proposal->proposal_type_id == 5) return $this->forward_program_proposal_to_palihan($program);
        else if ($proposal->proposal_type_id == 2 || $proposal->proposal_type_id == 4 || $proposal->proposal_type_id == 6) {
            $program = [];
            $program_proposal_select = $this->proposal_select();
            $program_proposal = clone $program_proposal_select;
            $program_proposal = $program_proposal
                                    ->where('program_id', $proposal->program_id)
                                    ->where(function($q){
                                        $q->orwhere('proposal.proposal_type', 1);
                                        $q->orWhere('proposal.proposal_type', 3);
                                        $q->orWhere('proposal.proposal_type', 5);
                                    })
                                    ->first();
            if(!is_null($program_proposal)) {

                $program_proposal_id = $program_proposal->proposal_id;
                $program_proposal_leader = DB::table('proposal_researcher')
                                      ->where('proposal_idproposal', $program_proposal_id)
                                      ->where('is_lead', 1)
                                      ->where('proposal_researcher.is_active', 1)
                                      ->leftJoin('hrisv2db.records as proposal_hris_researcher', 'proposal_researcher.hris_researcher_id', '=', 'proposal_hris_researcher.id')
                                      ->leftJoin('commonlibrariesdb.agency as commlibagency', 'proposal_hris_researcher.hr_agency_id', '=', 'commlibagency.id')
                                      ->select(
                                        'proposal_researcher.*',
                                        DB::raw('
                                          (CASE
                                            WHEN proposal_hris_researcher.hr_sex = 1
                                              THEN "Male"
                                            WHEN proposal_hris_researcher.hr_sex = 2
                                              THEN "Female"
                                          END) as proposal_researcher_sex'),
                                        'proposal_hris_researcher.*',
                                        'commlibagency.agency as agency_name',
                                        'commlibagency.acronym as agency_acronym'
                                      )
                                      ->first();
                $program = [
                    'name' => (!is_null($program_proposal->title) ? $program_proposal->title : 'none'),
                    'researcher' => ($program_proposal_leader->hr_first_name) ? [
                        'first_name' => (!is_null($program_proposal_leader->hr_first_name) ? $program_proposal_leader->hr_first_name : 'NULL'),
                        'middle_name' => (!is_null($program_proposal_leader->hr_middle_name) ? $program_proposal_leader->hr_middle_name : 'NULL'),
                        'last_name' => (!is_null($program_proposal_leader->hr_last_name) ? $program_proposal_leader->hr_last_name : 'NULL'),
                        'sex' => (!is_null($program_proposal_leader->proposal_researcher_sex) ? $program_proposal_leader->proposal_researcher_sex : 'NULL'),
                        'agency' => ($program_proposal_leader->agency_name) ? [
                            'name' => (!is_null($program_proposal_leader->agency_name) ? $program_proposal_leader->agency_name : 'NULL'), 
                            'acronym' => (!is_null($program_proposal_leader->agency_acronym) ? $program_proposal_leader->agency_acronym : 'NULL') 
                        ] : []
                    ] : []
                ];

            }
            $proposal->description = (substr($proposal->description, 0, 1) === '"') ? trim($proposal->description, '"') : $proposal->description;
            $proposal->target_beneficiaries = (substr($proposal->target_beneficiaries, 0, 1) === '"') ? trim($proposal->target_beneficiaries, '"') : $proposal->target_beneficiaries;
            $proposal->significance = (substr($proposal->significance, 0, 1) === '"') ? trim($proposal->significance, '"') : $proposal->significance;
            $proposal->executive_summary = (substr($proposal->executive_summary, 0, 1) === '"') ? trim($proposal->executive_summary, '"') : $proposal->executive_summary;
            
            $proposal->general_objective = (substr($proposal->general_objective, 0, 1) === '"') ? trim($proposal->general_objective, '"') : $proposal->general_objective;
            $proposal->specific_objective = (substr($proposal->specific_objective, 0, 1) === '"') ? trim($proposal->specific_objective, '"') : $proposal->specific_objective;
            $proposal->sixp_publication = (substr($proposal->sixp_publication, 0, 1) === '"') ? trim($proposal->sixp_publication, '"') : $proposal->sixp_publication;
            $proposal->sixp_patent = (substr($proposal->sixp_patent, 0, 1) === '"') ? trim($proposal->sixp_patent, '"') : $proposal->sixp_patent;
            $proposal->sixp_product = (substr($proposal->sixp_product, 0, 1) === '"') ? trim($proposal->sixp_product, '"') : $proposal->sixp_product;
            $proposal->sixp_people = (substr($proposal->sixp_people, 0, 1) === '"') ? trim($proposal->sixp_people, '"') : $proposal->sixp_people;
            $proposal->sixp_place = (substr($proposal->sixp_place, 0, 1) === '"') ? trim($proposal->sixp_place, '"') : $proposal->sixp_place;
            $proposal->sixp_policy = (substr($proposal->sixp_policy, 0, 1) === '"') ? trim($proposal->sixp_policy, '"') : $proposal->sixp_policy;

            $proposal_implementing_agencies = DB::table('implementing_agency')
                                                ->where('proposal_idproposal', $proposal_id)
                                                ->where('implementing_agency.is_active', 1)
                                                ->leftJoin('commonlibrariesdb.agency as commlibagency', 'implementing_agency.comlib_agency_id', '=', 'commlibagency.id')
                                                ->select(
                                                    'commlibagency.agency as name',
                                                    'commlibagency.acronym as acronym',
                                                    DB::raw('"Implementing" as type')
                                                )
                                                ->get()
                                                ->toArray();
            $proposal_cooperating_agencies = DB::table('cooperating_agency')
                                                ->where('proposal_idproposal', $proposal_id)
                                                ->where('cooperating_agency.is_active', 1)
                                                ->leftJoin('commonlibrariesdb.agency as commlibagency', 'cooperating_agency.comlib_agency_id', '=', 'commlibagency.id')
                                                ->select(
                                                    'commlibagency.agency as name',
                                                    'commlibagency.acronym as acronym',
                                                    DB::raw('"Cooperating" as type')
                                                )
                                                ->get()
                                                ->toArray();
            $proposal_lead_trd = DB::table('proposal_lead_trd')
                                    ->leftJoin('commonlibrariesdb.pcaarrd_divisions as pcaarrd_divisions', 'proposal_lead_trd.division_iddivision', '=', 'pcaarrd_divisions.id')
                                    ->where('proposal_idproposal', $proposal_id)
                                    ->where('proposal_lead_trd.is_active', 1)
                                    ->pluck('pcaarrd_divisions.division_acronym')
                                    ->first();

            $proposal_agencies = array_merge($proposal_implementing_agencies, $proposal_implementing_agencies);

            $proposal_osep_researchers = DB::table('proposal_researcher')
                              ->where('proposal_idproposal', $proposal_id)
                              ->leftJoin('hrisv2db.records as proposal_hris_researcher', 'proposal_researcher.hris_researcher_id', '=', 'proposal_hris_researcher.id')
                              ->leftJoin('commonlibrariesdb.agency as commlibagency', 'proposal_hris_researcher.hr_agency_id', '=', 'commlibagency.id')
                              ->select(
                                'proposal_researcher.*',
                                DB::raw('
                                  (CASE
                                    WHEN proposal_hris_researcher.hr_sex = 1
                                      THEN "Male"
                                    WHEN proposal_hris_researcher.hr_sex = 2
                                      THEN "Female"
                                  END) as proposal_researcher_sex'),
                                'proposal_hris_researcher.*',
                                'commlibagency.agency as agency_name',
                                'commlibagency.acronym as agency_acronym'
                              )
                              ->get();
            $proposal_researchers = [];
            foreach($proposal_osep_researchers as $researcher) {
                $proposal_researcher = [];
                $proposal_researcher['first_name'] = $researcher->hr_first_name;
                $proposal_researcher['middle_name'] = $researcher->hr_middle_name;
                $proposal_researcher['last_name'] = $researcher->hr_last_name;
                $proposal_researcher['sex'] = $researcher->proposal_researcher_sex;
                $proposal_researcher['is_lead'] = $researcher->is_lead;
                $proposal_researcher['agency']['name'] = $researcher->agency_name;
                $proposal_researcher['agency']['acronym'] = $researcher->agency_acronym;

                array_push($proposal_researchers, $proposal_researcher);
            }
           $proposal_implementation_sites = DB::table('implementation_site')
                                          ->where('proposal_idproposal', $proposal_id)
                                          ->where('implementation_site.is_active', 1)
                                          ->leftJoin('commonlibrariesdb.dim_regions as dim_regions', 'implementation_site.comlib_region_id', '=', 'dim_regions.comlib_region_id')
                                          ->leftJoin('commonlibrariesdb.dim_provinces as dim_provinces', 'implementation_site.comlib_province_id', '=', 'dim_provinces.comlib_province_id')
                                          ->leftJoin('commonlibrariesdb.dim_municipalities as dim_municipalities', 'implementation_site.comlib_municipality_id', '=', 'dim_municipalities.comlib_municipality_id')
                                          ->select(
                                            'dim_regions.palihan_region_id as palihan_region_id',
                                            'dim_provinces.palihan_province_id as palihan_province_id',
                                            'dim_municipalities.palihan_municipality_id as palihan_municipal_id',
                                            'dim_regions.region_value as region_name',
                                            'dim_provinces.province_value as province_name',
                                            'dim_municipalities.municipality_value as municipal_name'
                                          )
                                          ->get();
            $proposal_sites = [];
            foreach($proposal_implementation_sites as $site) {
                $proposal_site = [];
                $proposal_site['region']['palihan_region_id'] = $site->palihan_region_id;
                $proposal_site['region']['region_name'] = $site->region_name;
                $proposal_site['province']['palihan_province_id'] = $site->palihan_province_id;
                $proposal_site['province']['province_name'] = $site->province_name;
                $proposal_site['municipal']['palihan_municipal_id'] = $site->palihan_municipal_id;
                $proposal_site['municipal']['municipal_name'] = $site->municipal_name;
                array_push($proposal_sites, $proposal_site);
            }
            $proposal_start_date = (($approved_implementation_start_date) ? date_format(date_create_from_format('Y-m-d', $approved_implementation_start_date), 'Y') : '');

            $proposal_end_date = (($approved_implementation_end_date) ? date_format(date_create_from_format('Y-m-d', $approved_implementation_end_date), 'Y') : '');

            $proposal_objective = 
            '<br>General Objective: <br> '.($proposal->general_objective).
            '<br>Specific Objective:<br>'.($proposal->specific_objective);

            $proposal_output = 
            '<br>Publication:<br> '.($proposal->sixp_publication).
            '<br>Patent:<br> '.($proposal->sixp_patent).
            '<br>Product:<br> '.($proposal->sixp_product).
            '<br>People:<br> '.($proposal->sixp_people).
            '<br>Place:<br> '.($proposal->sixp_place).
            '<br>Policy:<br> '.($proposal->sixp_policy);

            $proposal_targets['publication'] = $proposal->sixp_publication;
            $proposal_targets['patent'] = $proposal->sixp_patent;
            $proposal_targets['product'] = $proposal->sixp_product;
            $proposal_targets['people'] = $proposal->sixp_people;
            $proposal_targets['place'] = $proposal->sixp_place;
            $proposal_targets['policy'] = $proposal->sixp_policy;


            //lib items
            $lib_items = [];
            $proposal_ps_lib = DB::table('ps_lib')
                            ->leftJoin('commonlibrariesdb.agency as funding_agency', 'ps_lib.comlib_funding_agency_id', '=', 'funding_agency.id')
                            ->leftJoin('commonlibrariesdb.agency as implementing_agency', 'ps_lib.comlib_imp_mon_agency_id', '=', 'implementing_agency.id')
                            ->leftJoin('commonlibrariesdb.agency as counterpart_agency', 'ps_lib.comlib_counterpart_agency_id', '=', 'counterpart_agency.id')
                            ->leftJoin('lib_dpmis_position as dpmis_position', 'ps_lib.lib_dpmis_position_idlib_dpmis_position', '=', 'dpmis_position.idlib_dpmis_position')
                            ->where('proposal_idproposal', $proposal_id)
                            ->where('ps_lib.is_active', 1)
                            ->select(
                                'ps_lib.cost_type as cost_type',
                                'ps_lib.year as year',
                                'ps_lib.num_position as quantity',
                                DB::raw('COALESCE((CASE WHEN ps_lib.amount <= 0 THEN (dpmis_position.rate * ps_lib.num_duration * ps_lib.num_position) ELSE ps_lib.amount END), 0) as amount
                                '),
                                DB::raw('"PS" as expense'),
                                DB::raw('(CASE WHEN `ps_lib`.`ps_type` = 0 THEN "Salaries" ELSE "Honorarium" END) as "group"'),
                                'dpmis_position.position_name as class',
                                'funding_agency.agency as funding_agency_name',
                                'funding_agency.acronym as funding_agency_acronym',
                                'implementing_agency.agency as implementing_agency_name',
                                'implementing_agency.acronym as implementing_agency_acronym',
                                'counterpart_agency.agency as counterpart_agency_name',
                                'counterpart_agency.acronym as counterpart_agency_acronym',
                                'dpmis_position.comlib_position_id as position_id',
                                'dpmis_position.position_name as position_name',
                                'dpmis_position.year_of_rate as position_year_of_rate'
                            )
                            ->orderBy('ps_lib.year', 'ASC')
                            ->get();
            foreach($proposal_ps_lib as $ps_lib_item) {
                $proposal_ps_lib_item = [];
                $proposal_ps_lib_item['cost_type'] = $ps_lib_item->cost_type;
                $proposal_ps_lib_item['year'] = $ps_lib_item->year;
                $proposal_ps_lib_item['quantity'] = $ps_lib_item->quantity;
                $proposal_ps_lib_item['amount'] = $ps_lib_item->amount;
                $proposal_ps_lib_item['expense'] = $ps_lib_item->expense;
                $proposal_ps_lib_item['group'] = $ps_lib_item->group;
                $proposal_ps_lib_item['class'] = $ps_lib_item->class;
                $proposal_ps_lib_item['funding_agency']['name'] = $ps_lib_item->funding_agency_name;
                $proposal_ps_lib_item['funding_agency']['acronym'] = $ps_lib_item->funding_agency_acronym;
                $proposal_ps_lib_item['implementing_agency']['name'] = $ps_lib_item->implementing_agency_name;
                $proposal_ps_lib_item['implementing_agency']['acronym'] = $ps_lib_item->implementing_agency_acronym;
                $proposal_ps_lib_item['counterpart_agency']['name'] = $ps_lib_item->counterpart_agency_name;
                $proposal_ps_lib_item['counterpart_agency']['acronym'] = $ps_lib_item->counterpart_agency_acronym;
                $proposal_ps_lib_item['position']['id'] = $ps_lib_item->position_id;
                $proposal_ps_lib_item['position']['name'] = $ps_lib_item->position_name;
                $proposal_ps_lib_item['position']['year_of_rate'] = $ps_lib_item->position_year_of_rate;

                array_push($lib_items, $proposal_ps_lib_item);
            }

            $proposal_mooe_lib = DB::table('mooe_lib')
                            ->leftJoin('commonlibrariesdb.agency as funding_agency', 'mooe_lib.comlib_funding_agency_id', '=', 'funding_agency.id')
                            ->leftJoin('commonlibrariesdb.agency as implementing_agency', 'mooe_lib.comlib_imp_mon_agency_id', '=', 'implementing_agency.id')
                            ->leftJoin('commonlibrariesdb.agency as counterpart_agency', 'mooe_lib.comlib_counterpart_agency_id', '=', 'counterpart_agency.id')
                            ->where('proposal_idproposal', $proposal_id)
                            ->where('mooe_lib.is_active', 1)
                            ->select(
                                'mooe_lib.cost_type as cost_type',
                                'mooe_lib.year as year',
                                DB::raw('"1" as quantity'),
                                'mooe_lib.amount as amount',
                                DB::raw('"MOOE" as expense'),
                                'mooe_lib.dpmis_mooe_classification as group',
                                'mooe_lib.dpmis_mooe_subcategory as class',
                                'funding_agency.agency as funding_agency_name',
                                'funding_agency.acronym as funding_agency_acronym',
                                'implementing_agency.agency as implementing_agency_name',
                                'implementing_agency.acronym as implementing_agency_acronym',
                                'counterpart_agency.agency as counterpart_agency_name',
                                'counterpart_agency.acronym as counterpart_agency_acronym'
                            )
                            ->orderBy('mooe_lib.year', 'ASC')
                            ->get();
            foreach($proposal_mooe_lib as $mooe_lib_item) {
                $proposal_mooe_lib_item = [];
                $proposal_mooe_lib_item['cost_type'] = $mooe_lib_item->cost_type;
                $proposal_mooe_lib_item['year'] = $mooe_lib_item->year;
                $proposal_mooe_lib_item['quantity'] = $mooe_lib_item->quantity;
                $proposal_mooe_lib_item['amount'] = $mooe_lib_item->amount;
                $proposal_mooe_lib_item['expense'] = $mooe_lib_item->expense;
                $proposal_mooe_lib_item['group'] = $mooe_lib_item->group;
                $proposal_mooe_lib_item['class'] = $mooe_lib_item->class;
                $proposal_mooe_lib_item['funding_agency']['name'] = $mooe_lib_item->funding_agency_name;
                $proposal_mooe_lib_item['funding_agency']['acronym'] = $mooe_lib_item->funding_agency_acronym;
                $proposal_mooe_lib_item['implementing_agency']['name'] = $mooe_lib_item->implementing_agency_name;
                $proposal_mooe_lib_item['implementing_agency']['acronym'] = $mooe_lib_item->implementing_agency_acronym;
                $proposal_mooe_lib_item['counterpart_agency']['name'] = $mooe_lib_item->counterpart_agency_name;
                $proposal_mooe_lib_item['counterpart_agency']['acronym'] = $mooe_lib_item->counterpart_agency_acronym;
                $proposal_mooe_lib_item['position'] = [];

                array_push($lib_items, $proposal_mooe_lib_item);
            }

            $proposal_eo_co_lib = DB::table('eo_co_lib')
                            ->leftJoin('commonlibrariesdb.agency as funding_agency', 'eo_co_lib.comlib_funding_agency_id', '=', 'funding_agency.id')
                            ->leftJoin('commonlibrariesdb.agency as implementing_agency', 'eo_co_lib.comlib_imp_mon_agency_id', '=', 'implementing_agency.id')
                            ->leftJoin('commonlibrariesdb.agency as counterpart_agency', 'eo_co_lib.comlib_counterpart_agency_id', '=', 'counterpart_agency.id')
                            ->where('proposal_idproposal', $proposal_id)
                            ->where('eo_co_lib.is_active', 1)
                            ->select(
                                'eo_co_lib.cost_type as cost_type',
                                'eo_co_lib.year as year',
                                'eo_co_lib.co_quantity as quantity',
                                'eo_co_lib.amount as amount',
                                DB::raw('"EO" as expense'),
                                DB::raw('(CASE WHEN eo_co_lib.cost_type = 0 THEN "EO Direct Cost" ELSE "EO Indirect Cost" END) as "group"'),
                                DB::raw('CONCAT("(", eo_co_lib.co_quantity, ") ", eo_co_lib.co_description) as "class"'),
                                'funding_agency.agency as funding_agency_name',
                                'funding_agency.acronym as funding_agency_acronym',
                                'implementing_agency.agency as implementing_agency_name',
                                'implementing_agency.acronym as implementing_agency_acronym',
                                'counterpart_agency.agency as counterpart_agency_name',
                                'counterpart_agency.acronym as counterpart_agency_acronym'
                            )
                            ->orderBy('eo_co_lib.year', 'ASC')
                            ->get();

            foreach($proposal_eo_co_lib as $eo_co_lib_item) {
                $proposal_eo_co_lib_item = [];
                $proposal_eo_co_lib_item['cost_type'] = $eo_co_lib_item->cost_type;
                $proposal_eo_co_lib_item['year'] = $eo_co_lib_item->year;
                $proposal_eo_co_lib_item['quantity'] = $eo_co_lib_item->quantity;
                $proposal_eo_co_lib_item['amount'] = $eo_co_lib_item->amount;
                $proposal_eo_co_lib_item['expense'] = $eo_co_lib_item->expense;
                $proposal_eo_co_lib_item['group'] = $eo_co_lib_item->group;
                $proposal_eo_co_lib_item['class'] = $eo_co_lib_item->class;
                $proposal_eo_co_lib_item['funding_agency']['name'] = $eo_co_lib_item->funding_agency_name;
                $proposal_eo_co_lib_item['funding_agency']['acronym'] = $eo_co_lib_item->funding_agency_acronym;
                $proposal_eo_co_lib_item['implementing_agency']['name'] = $eo_co_lib_item->implementing_agency_name;
                $proposal_eo_co_lib_item['implementing_agency']['acronym'] = $eo_co_lib_item->implementing_agency_acronym;
                $proposal_eo_co_lib_item['counterpart_agency']['name'] = $eo_co_lib_item->counterpart_agency_name;
                $proposal_eo_co_lib_item['counterpart_agency']['acronym'] = $eo_co_lib_item->counterpart_agency_acronym;
                $proposal_eo_co_lib_item['position'] = [];

                array_push($lib_items, $proposal_eo_co_lib_item);
            }

            $project = ($proposal->proposal_code && $proposal->title) ? [
                'dpmis_code' =>(!is_null($proposal->proposal_code) ? $proposal->proposal_code : 'NULL'),
                'title' => (!is_null($proposal->title) ? $proposal->title : 'NULL'),
                'program' => $program,
                'lead_trd' => $proposal_lead_trd,
                'start_date' => ($proposal_start_date),
                'end_date' => ($proposal_end_date),
                'approved_implementation_start_date' => $approved_implementation_start_date,
                'approved_implementation_end_date' => $approved_implementation_end_date,
                'description' => (!is_null($proposal->description) ? $proposal->description : 'NULL'),
                'objectives' => ($proposal_objective),
                'beneficiaries' => (!is_null($proposal->target_beneficiaries) ? $proposal->target_beneficiaries : 'NULL'),
                'totalyear' => (!is_null($proposal->proposal_years) ? $proposal->proposal_years : '1'),
                'expectedoutput' => ($proposal_output),
                'rationale' => (!is_null($proposal->significance) ? $proposal->significance : 'NULL'),
                'abstract' => (!is_null($proposal->executive_summary) ? $proposal->executive_summary : 'NULL'),
                'agencies' => $proposal_agencies,
                'researchers' => $proposal_researchers,
                'sites' => $proposal_sites,
                'targets' => $proposal_targets,
                'lib_items' => $lib_items

            ] : [];

            return $this->forward_project_proposal_to_palihan($project);
        }

    }

    public function download_proposal_files(Request $request) {
        if($request->ajax()) {
            $now = Carbon::now();
            $proposal_id = $request->get('proposal_id');
            $proposal = $this->show($request)->getData();

            $document_type = $request->get('document_type');
            $proposal_files_directory = 'storage/proposal_files/'.$proposal_id.'/zip_files/';
            $proposal_file_details = null;
            $proposal_zip_file = '';

            if(!File::exists($proposal_files_directory)){
                File::makeDirectory($proposal_files_directory, $mode = 0777, true, true);
            }

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('forms.dost_form2_ba_research');
            $pdf->save($proposal_files_directory.'proposal.pdf');
            return $pdf->stream('proposal.pdf');
            
        }
    }
    /**=============Private functions=============**/
    private function forward_program_proposal_to_palihan($program_proposal) {
        try {
            $program = [
                'name' => $program_proposal['name'],
                'researcher' => $program_proposal['researcher']
            ];
            $palihan_forward_auth = new Client();
            $palihan_auth_result = $palihan_forward_auth->post('http://192.168.0.3/osep_palihan_api/palihanoauth',[
                'form_params' => [
                    'headers' => [
                      'Content-Type' => 'application/json',
                      'Accept' => 'application/json'
                    ],  
                    'redirect_uri' => '/oauth/receivecode',
                    'client_id' => 'osep_palihan_api',
                    'client_secret' => 'osep_palihan_api',
                    'grant_type' => 'client_credentials'
                ]
            ]);
            $palihan_access_token = (json_decode($palihan_auth_result->getBody(), true)['access_token']);
            $palihan_forward_program_proposal_client = new Client(
            [
                'headers' => [
                    'Authorization' => ' Bearer '.$palihan_access_token,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]);
            $palihan_forward_program_proposal = $palihan_forward_program_proposal_client->post('http://192.168.0.3/osep_palihan_api/programs', 
                [
                    'json' => ($program)
                ]
            );

            $palihan_forward_program_proposal_status = ($palihan_forward_program_proposal->getStatusCode());
            if($palihan_forward_program_proposal_status == 201) return 1;
            else return 0;
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            dd($e->getResponse()->getBody()->getContents());
        }
    }

    private function forward_project_proposal_to_palihan($project_proposal) {
        try {
            $project = [
                'dpmis_code' => $project_proposal['dpmis_code'],
                'title' => $project_proposal['title'],
                'program' => $project_proposal['program'],
                'lead_trd' => $project_proposal['lead_trd'],
                'start_date' => $project_proposal['start_date'],
                'end_date' => $project_proposal['end_date'],
                'approved_implementation_start_date' => $project_proposal['approved_implementation_start_date'],
                'approved_implementation_end_date' => $project_proposal['approved_implementation_end_date'],
                'description' => $project_proposal['description'],
                'objectives' => $project_proposal['objectives'],
                'beneficiaries' => $project_proposal['beneficiaries'],
                'totalyear' => $project_proposal['totalyear'],
                'expectedoutput' => $project_proposal['expectedoutput'],
                'rationale' => $project_proposal['rationale'],
                'abstract' => $project_proposal['abstract'],
                'agencies' => $project_proposal['agencies'],
                'researchers' => $project_proposal['researchers'],
                'sites' => $project_proposal['sites'],
                'targets' => $project_proposal['targets'],
                'lib_items' => $project_proposal['lib_items']
            ];
            $palihan_forward_auth = new Client();
            $palihan_auth_result = $palihan_forward_auth->post('http://192.168.0.3/osep_palihan_api/palihanoauth',[
                'form_params' => [
                    'headers' => [
                      'Content-Type' => 'application/json',
                      'Accept' => 'application/json'
                    ],  
                    'redirect_uri' => '/oauth/receivecode',
                    'client_id' => 'osep_palihan_api',
                    'client_secret' => 'osep_palihan_api',
                    'grant_type' => 'client_credentials'
                ]
            ]);
            $palihan_access_token = (json_decode($palihan_auth_result->getBody(), true)['access_token']);
            $palihan_forward_project_proposal_client = new Client(
            [
                'headers' => [
                    'Authorization' => ' Bearer '.$palihan_access_token,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]);
            $palihan_forward_project_proposal = $palihan_forward_project_proposal_client->post('http://192.168.0.3/osep_palihan_api/projects',
                [
                    'json' => ($project)
                ]
            );
            $palihan_forward_project_proposal_status = ($palihan_forward_project_proposal->getStatusCode());
            if($palihan_forward_project_proposal_status == 201) return 1;
            else return 0;
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            dd($e->getResponse()->getBody()->getContents());

        }
    }

}

