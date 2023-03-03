<!DOCTYPE html>
<html>
   <head>
      <title>R&D PROPOSAL MONITORING</title>
      <meta content="text/html; charset=UTF-8" http-equiv="content-type">
      <style type="text/css">
         /* Added by Drei */
         .proposal-add-custom input{
            background-color:transparent;
            border: 0px solid;
            width:260px;
         }

         .proposal-add-custom input:focus{
            outline:none;
         }
         /* End */

         body.proposal-monitoring-form > * {
            padding:0;
            margin:0;
            box-sizing: border-box;
         }

         body.proposal-monitoring-form {
            max-width: 1100pt;
            margin: auto;
         }
         table.proposal-monitoring-form{
            text-indent: initial;
            white-space: normal;
            line-height: normal;
            font-weight: normal;
            font-size: medium;
            font-style: normal;
            color: -internal-quirk-inherit;
            text-align: start;
            font-variant: normal;
            border-spacing: 0;
            border-collapse: collapse;
            width: 100%;
         }
         p.proposal-monitoring-form, span.proposal-monitoring-form {
            color: #000000;
            text-decoration: none;
            vertical-align: baseline;
            font-style: normal;
         }
         div.proposal-monitoring-form {
            padding: 0.1% 0;
         }
         table.proposal-monitoring-form td,table.proposal-monitoring-form th{padding:0; margin: 0;}
         table.proposal-monitoring-form tbody tr {
            height: 8.5pt;
         }
         table.proposal-monitoring-form tbody td {
            padding-left: 3pt;
            border: 1px solid black;
         }
         table.proposal-monitoring-form p, table.proposal-monitoring-form span {
            line-height: 1;
            font-weight: 400;
            font-size: 7pt;
            font-family: "Arial";
         }

         .proposal-monitoring-form.text-center {
            text-align: center
         }

         .proposal-monitoring-form.clearfix {
            clear: both;
         }

         .proposal-monitoring-form.borderline {border-bottom: 2px solid black; margin: 1% 0;}
         
         table.proposal-monitoring-form .proposal-monitoring-form.c2 {
            text-align: center
         }

         table.proposal-monitoring-form .proposal-monitoring-form.c2 p.proposal-monitoring-form {
            font-weight: 700;
            font-size: 12pt;
            font-family: "Arial";
         }

         .proposal-monitoring-form.page-1, .proposal-monitoring-form.page-2 {
            padding: 3% 0 0 4%;
            font-size: 10pt;
            font-family: "Arial Narrow";
            page-break-after: always;
         }

         .proposal-monitoring-form.page-1 > div.proposal-monitoring-form, .proposal-monitoring-form.page-2 {
            margin: 1.5% 0;
         }
         .proposal-monitoring-form.page-2 > table:nth-of-type(2) tr:first-child td {
            text-align: center;
         }
         .proposal-monitoring-form.page-2 > table:nth-of-type(2) td span {
            font-size: 10pt;
            font-family: "Arial Narrow";
         }
         .proposal-monitoring-form.page-2 > table:nth-of-type(2) td {
            padding: 1% 0.5%;
         }
         ol.proposal-monitoring-form li{
            list-style: upper-alpha;
         }

         ol.proposal-monitoring-form li span,.proposal-ded-rd-director {
            font-size: 10pt;
            font-family: "Arial Narrow";               
            font-weight: 700;
         }

         .proposal-monitoring-form.wcol-2, .proposal-monitoring-form.wcol-3 {width: 100%; margin: 1% 0;}

         .proposal-monitoring-form.wcol-2 > div:not(:last-child),
         .proposal-monitoring-form.wcol-3 > div:not(:last-child){
            float: left;
            width: 49%;
            padding: 0 2px;
         }
         .proposal-monitoring-form.wcol-3 > div:first-child {width: 5%;}
         .proposal-monitoring-form.wcol-3 > div:nth-child(2) {width: 10%;}
         .proposal-monitoring-form.wcol-3 > div:nth-child(3) {width: 80%;}
         .proposal-monitoring-form.wcol-2.val > div:first-child {width: 10%;}
         
         .proposal-monitoring-form.wcol-2.val > div:nth-child(2) {
            width: 80%;
            border-bottom: 1px solid black;
         }
         .proposal-monitoring-form.wcol-2.val > div:nth-child(2) > div,
         .proposal-monitoring-form.wcol-3 > div:nth-child(3) > div {
            width: 100%;
            border-bottom: 1px solid black;
         }

         .proposal-monitoring-form.wcol-2.val.trd > div:first-child,
         .proposal-monitoring-form.wcol-2.staff-in-charge > div:not(:last-child) > div:nth-child(2) > div:first-child {border-bottom: 1px solid black;}
         .proposal-monitoring-form.wcol-2.staff-in-charge > div:not(:last-child) > div:nth-child(2) > div:first-child {width: 90%;}
         .proposal-monitoring-form.wcol-2.val.trd > div:nth-child(2) {border-bottom: transparent;}
         .proposal-monitoring-form.wcol-3 > div:nth-child(3) {width: 10%;}
         .proposal-monitoring-form.tracking-code .wcol-2.val > div:first-child {width: 18%;}
         .proposal-monitoring-form.tracking-code .wcol-2.val > div:nth-child(2) {width: 66%;}

         .proposal-monitoring-form.proponent-agency.wcol-2.val > div:first-child {width: 8%;}
         .proposal-monitoring-form.proponent-agency.wcol-2.val > div:nth-child(2) {width: 90%;}

         .proposal-monitoring-form.duration.wcol-2.val > div:first-child {width: 14%;}
         .proposal-monitoring-form.duration.wcol-2.val > div:nth-child(2) {width: 70%;}

         .proposal-monitoring-form.project-site.wcol-2.val > div:first-child {width: 18%;}
         .proposal-monitoring-form.project-site.wcol-2.val > div:nth-child(2) {width: 65%;}
         
         .proposal-monitoring-form.forwarded-to.wcol-2.val > div:first-child {width: 25%;}
         .proposal-monitoring-form.forwarded-to.wcol-2.val > div:nth-child(2) {width: 65%;}

         .proposal-monitoring-form.date-forwarded.wcol-2.val > div:first-child {width: 25%;}
         .proposal-monitoring-form.date-forwarded.wcol-2.val > div:nth-child(2) {width: 65%;}

         .proposal-monitoring-form.due-date.wcol-2.val > div:first-child {width: 25%;}
         .proposal-monitoring-form.due-date.wcol-2.val > div:nth-child(2) {width: 65%;}

         .proposal-monitoring-form.implementing-agency.wcol-2.val > div:first-child {width: 8.5%;}
         .proposal-monitoring-form.implementing-agency.wcol-2.val > div:nth-child(2) {width: 83.5%;}

         .proposal-monitoring-form.funding-agency.wcol-2.val > div:first-child {width: 7%;}
         .proposal-monitoring-form.funding-agency.wcol-2.val > div:nth-child(2) {width: 87%;}

         .proposal-monitoring-form.ded-rd.wcol-2.val > div:first-child {width: 49%;}
         .proposal-monitoring-form.ded-rd.wcol-2.val > div:nth-child(2) {width: 40%;}

         .proposal-monitoring-form.wcol-2.val.proposed-budget > div:first-child {width: 18%;}
         .proposal-monitoring-form.wcol-2.val.proposed-budget > div:nth-child(2) {width: 70%; border-bottom: none;}

         .proposal-monitoring-form.wcol-2.val:not(.proposed-budget) > div:nth-child(2)::before,
         .proposal-monitoring-form.wcol-2.val > div:nth-child(2) > div::before, .wcol-3 > div:nth-child(3) > div::before,
         .proposal-monitoring-form.wcol-2.val.trd > div:first-child::before,
         .proposal-monitoring-form.wcol-2.staff-in-charge > div:not(:last-child) > div:nth-child(2) > div:first-child::before{content:'\00a0';}
         
         .proposal-monitoring-form.wcol-2.val.ded-rd > div:nth-child(2),
         .proposal-monitoring-form.wcol-2.val.ded-rd > div:nth-child(2) > div:nth-child(2) {border-bottom: transparent;}

         .proposal-monitoring-form.tracking-code {padding-left: 3.5%;}
         .proposal-monitoring-form.action-taken {padding-top: 1%;padding-left: 5%;}
         .proposal-monitoring-form.action-taken span, .page-1 > div:last-child span.note {font-style: italic;}
         .proposal-monitoring-form.staff-in-charge div {padding: 1.2% 0;}

      </style>
   </head>
   <body class="proposal-monitoring-form">
         <p class="proposal-monitoring-form">
            <span class="proposal-monitoring-form"></span>
         </p>
         <div class="proposal-monitoring-form page-1">
            <table class="proposal-monitoring-form">
               <tbody>
                  <tr>
                     <td colspan="1" rowspan="4">
                        <p class="proposal-monitoring-form text-center">
                           <span class="proposal-monitoring-form" style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 76.80px; height: 59.20px;">
                           <img alt="PCAARRD ISO LOGO" src="{{ asset('storage/images/util/pcaarrd_iso_logo.png') }}" style="width: 76.80px; height: 59.20px; margin-left: -0.00px; margin-top: -0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title="">
                           </span>
                        </p>
                     </td>
                     <td colspan="1" rowspan="2">
                        <p class="proposal-monitoring-form text-center">
                           PHILIPPINE COUNCIL FOR AGRICULTURE, AQUATIC AND NATURAL RESOURCES RESEARCH AND DEVELOPMENT
                        </p>
                     </td>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">Document Code</span>
                     </td>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">QMSF-RD-08-01-02</span>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">Revision No.</span>
                     </td>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">1</span>
                     </td>
                  </tr>
                  <tr>
                     <td class="proposal-monitoring-form c2" colspan="1" rowspan="2">
                        <p class="proposal-monitoring-form text-center">
                           R&amp;D PROPOSAL MONITORING
                        </p>
                     </td>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">Page Number</span>
                     </td>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">1 of 2</span>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">Effectivity Date</span>
                     </td>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">June 17, 2019</span>
                     </td>
                  </tr>
               </tbody>
            </table>
            <div class="proposal-monitoring-form oed-rd">
      	      <ol class="proposal-monitoring-form" start="1">
      	         <li><span class="proposal-monitoring-form">To be filled out by OED-RD</span></li>
      	      </ol>
               <div class="proposal-monitoring-form wcol-2 tracking-code">
                  <div class="proposal-monitoring-form wcol-2 val">
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">Tracking Code:</span>
                     </div>
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form proposal-tracking-code">
                           @if (Session::get("proposal")->proposal_code)
                              {{ Session::get("proposal")->proposal_code }}
                           @elseif (Session::get("proposal")->program_id)
                              {{ Session::get("proposal")->program_id }}
                           @else "N/A"
                           @endif
                        </span>
                     </div>
                     <div class="proposal-monitoring-form clearfix"></div>
                  </div>
                  <div class="proposal-monitoring-form wcol-2 val">
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">Date Received:</span>
                     </div>
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form proposal-date-received">{{ Session::get("proposal")->date_forwarded_through_api ?? "N/A"}}</span>
                     </div>
                     <div class="proposal-monitoring-form clearfix"></div>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val program-title">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Program Title:</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form proposal-program-title">{{ Session::get("proposal")->proposal_program_title ?? "N/A"}}</span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val project-title">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Project Title:</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form proposal-project-title">{{ Session::get("proposal")->proposal_project_title ?? "N/A"}}</span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form borderline"></div>
               <div class="proposal-monitoring-form wcol-2 val researchers">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Researcher(s):</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form proposal-researchers">{{ Session::get("proposal_leader_hris")->hr_first_name ?? "N/A"}} {{ Session::get("proposal_leader_hris")->hr_last_name ?? "N/A"}}</span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val proponent-agency">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Proponent Agency:</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form proposal-proponent-agency">{{ Session::get("proposal_leader_hris")->agency_acronym ?? "N/A"}}</span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val consortium">
                 
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Consortium:</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class = "proposal-add-custom">
                      <input class = "proposal-monitoring-form" type = "text" style = "border: transparent; width:500px;">
                     </span>
                     <span class="proposal-monitoring-form proposal-consortium"></span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val duration">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Duration (no. of years/ date covered):</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form proposal-duration">{{ Session::get("proposal")->proposal_total_duration ?? "N/A"}}</span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2">
                  <div class="proposal-monitoring-form wcol-2 val proposed-budget">
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">Proposed Budget: </span>
                     </div>
                     <div class="proposal-monitoring-form">
                        @if (!is_null(Session::get("total_yearly_budget")))
                           @foreach(Session::get("total_yearly_budget") as $index => $yBudget)
                              <div class="proposal-monitoring-form">
                                 <span class="proposal-monitoring-form proposal-proposed-budget-1"><b>Year {{ $loop->iteration }}: ₱ </b>{{ number_format(($yBudget->sum_ps_lib + $yBudget->sum_mooe_lib + $yBudget->sum_eo_co_lib) ?? '0', 2) ?? '0' }}

                                 </span>
                              </div>
                           @endforeach
                        @else
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form proposal-proposed-budget-1"><b>None</b>

                           </span>
                        </div>
                        @endif
                     </div>
                     <div class="proposal-monitoring-form clearfix"></div>
                  </div>
                  <div class="proposal-monitoring-form wcol-2 val proposed-budget-total">
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">Total: <b> ₱ </b> </span>
                     </div>
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form proposal-proposed-budget-total">{{ number_format(Session::get("total_proposed_budget") ?? '0', 2) ?? '0' }}</span>
                     </div>
                     <div class="proposal-monitoring-form clearfix"></div>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-3">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Type:</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">Program</span>
                     </div>
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">Project</span>
                     </div>
                  </div>
                  <div class="proposal-monitoring-form">
                     @if( Session::get("proposal")->proposal_type_id == 1 or Session::get("proposal")->proposal_type_id == 3 or Session::get("proposal")->proposal_type_id == 5)
                        <div class="proposal-monitoring-form text-center">
                           <span class="proposal-monitoring-form proposal-is-program">✓</span>
                        </div>
                     @else
                        <div class="proposal-monitoring-form text-center">
                           <span class="proposal-monitoring-form proposal-is-program"></span>
                        </div>
                     @endif
                     @if( Session::get("proposal")->proposal_type_id == 2 or Session::get("proposal")->proposal_type_id == 4 or Session::get("proposal")->proposal_type_id == 6)
                        <div class="proposal-monitoring-form text-center">
                           <span class="proposal-monitoring-form proposal-is-project">✓</span>
                        </div>
                     @else
                        <div class="proposal-monitoring-form text-center">
                           <span class="proposal-monitoring-form proposal-is-project"></span>
                        </div>
                     @endif
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val project-site">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Project Site Province/Municipality/Region):</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form proposal-project-site">{{ Session::get("lead_implementation_site")['dpmis_province'] ?? "N/A"}} / {{ Session::get("lead_implementation_site")['dpmis_municipality'] ?? "N/A"}} / {{ Session::get("lead_implementation_site")['dpmis_region'] ?? "N/A"}}</span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val commodity">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Commodity/ISP:</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form proposal-commodity">{{ Session::get("proposal")->dpmis_hnrda_item ?? "N/A"}}</span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val rd-area">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">R&amp;D Area:</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class = "proposal-add-custom">
                      <input class = "proposal-monitoring-form" type = "text" style ="border: transparent; width:500px;" value="{{ Session::get('proposal')->hnrda_classification ?? 'N/A'}}" >
                     </span>
                     <!-- <span class="proposal-monitoring-form proposal-rd-area">{{ Session::get("proposal")->hnrda_classification ?? "N/A"}}</span> -->
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val banner-program">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Banner Program:</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form proposal-banner-program"></span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2">
                  <div class="proposal-monitoring-form wcol-2 val forwarded-to">
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">Forwarded to: </span>
                     </div>
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form proposal-forwarded-to">{{ Session::get("proposal_forwarded_divisions") ?? "N/A"}}</span>
                     </div>
                     <div class="proposal-monitoring-form clearfix"></div>
                  </div>
                  <div class="proposal-monitoring-form">
                     <div class="proposal-monitoring-form wcol-2 val date-forwarded">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Date forwarded: </span>
                        </div>
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form proposal-date-forwarded">{{ Session::get("proposal_status_tracking")['forwarded_for_evaluation_proposal']->created_at ?? "N/A"}}</span>
                        </div>
                        <div class="proposal-monitoring-form clearfix"></div>
                     </div>
                     <div class="proposal-monitoring-form wcol-2 val due-date">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Due Date: </span>
                        </div>
                        <div class="proposal-monitoring-form">
                           <span class = "proposal-add-custom">
                           <input class = "proposal-monitoring-form" type = "text" style ="border: transparent; width:300px;" value="" >
                           </span>
                           <span class="proposal-monitoring-form proposal-due-date"></span>
                        </div>
                        <div class="proposal-monitoring-form clearfix"></div>
                     </div>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val ded-rd">
                  <div class="proposal-monitoring-form">&nbsp;</div>
                  <div class="proposal-monitoring-form text-center">
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form proposal-ded-rd-director">FELICIANO G. CALORA JR.</span>
                     </div>
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">Deputy Executive Director for R&D</span>
                     </div>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form borderline"></div>
            </div>
            <div class="proposal-monitoring-form trd">
      	      <ol start="2">
      	         <li><span class="proposal-monitoring-form">To be filled out by TRD</span></li>
      	      </ol>
               <div class="proposal-monitoring-form">
                  <span class="proposal-monitoring-form">ACTION TAKEN</span>
               </div>
               <div class="proposal-monitoring-form action-taken">
                  <div class="proposal-monitoring-form wcol-2 val trd">
                     <div class="proposal-monitoring-form"></div>
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">
                           Recommended for implementation
                        </span>
                     </div>
                  </div>
                  <div class="proposal-monitoring-form wcol-2 val trd">
                     <div class="proposal-monitoring-form"></div>
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">
                           Recommended for implementation after approval of revised proposal
                        </span>
                     </div>
                  </div>
                  <div class="proposal-monitoring-form wcol-2 val trd">
                     <div class="proposal-monitoring-form"></div>
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">
                           Not recommended for funding
                        </span>
                     </div>
                  </div>
                  <div class="proposal-monitoring-form wcol-2 val trd">
                     <div class="proposal-monitoring-form"></div>
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">
                           Not worth pursuing
                        </span>
                     </div>
                  </div>
                  <div class="proposal-monitoring-form wcol-2 val trd">
                     <div class="proposal-monitoring-form"></div>
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">
                           Cleared from duplication
                        </span>
                     </div>
                  </div>
                  <div class="proposal-monitoring-form wcol-2 val trd">
                     <div class="proposal-monitoring-form"></div>
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">
                           In duplication with completed/ongoing projects
                        </span>
                     </div>
                  </div>
               </div>
               <div class="proposal-monitoring-form wcol-2 staff-in-charge">
                  <div class="proposal-monitoring-form">
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">Staff In-charge of Evaluation:</span>
                     </div>
                     <div class="proposal-monitoring-form">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form proposal-staff-in-charge"></span>
                        </div>
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Name/Signature/Date</span>
                        </div>
                     </div>
                  </div>
                  <div class="proposal-monitoring-form">
                     <div class="proposal-monitoring-form">
                        <span class="proposal-monitoring-form">Noted:</span>
                     </div>
                     <div class="proposal-monitoring-form">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form proposal-ded-rd-director"></span>
                        </div>
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Director's Name and Signature</span>
                        </div>
                     </div>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form">
                  <span class="proposal-monitoring-form note">
                     NOTE: Please accomplish this page and return to OED-RD together with the results of the evaluation and response letter.
                  </span>
               </div>
            </div>
         </div>
         <div class="proposal-monitoring-form page-2">
            <table class="proposal-monitoring-form">
               <tbody>
                  <tr>
                     <td colspan="1" rowspan="4">
                        <p class="proposal-monitoring-form text-center">
                           <span class="proposal-monitoring-form" style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 76.80px; height: 59.20px;">
                           <img alt="PCAARRD ISO LOGO" src="{{ asset('storage/images/util/pcaarrd_iso_logo.png') }}" style="width: 76.80px; height: 59.20px; margin-left: -0.00px; margin-top: -0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title="">
                           </span>
                        </p>
                     </td>
                     <td colspan="1" rowspan="2">
                        <p class="proposal-monitoring-form text-center">
                           PHILIPPINE COUNCIL FOR AGRICULTURE, AQUATIC AND NATURAL RESOURCES RESEARCH AND DEVELOPMENT
                        </p>
                     </td>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">Document Code</span>
                     </td>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">QMSF-RD-08-01-02</span>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">Revision No.</span>
                     </td>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">1</span>
                     </td>
                  </tr>
                  <tr>
                     <td class="c2" colspan="1" rowspan="2">
                        <p class="proposal-monitoring-form text-center">
                           R&amp;D PROPOSAL MONITORING
                        </p>
                     </td>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">Page Number</span>
                     </td>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">1 of 2</span>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">Effectivity Date</span>
                     </td>
                     <td colspan="1" rowspan="1">
                        <span class="proposal-monitoring-form">June 17, 2019</span>
                     </td>
                  </tr>
               </tbody>
            </table>
            <div class="proposal-monitoring-form trd-activity">
               <ol start="3">
                  <li><span class="proposal-monitoring-form">TRD Activity Monitoring Sheet</span></li>
               </ol>
               <div class="proposal-monitoring-form wcol-2 val program-title">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Program Title:</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form proposal-program-title">{{ Session::get("proposal")->proposal_program_title ?? "N/A"}}</span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val project-title">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Project Title:</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form proposal-project-title">{{ Session::get("proposal")->proposal_project_title ?? "N/A"}}</span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val researchers">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Researcher(s):</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form proposal-researchers">{{ Session::get("proposal_leader_hris")->hr_first_name ?? "N/A"}} {{ Session::get("proposal_leader_hris")->hr_last_name ?? "N/A"}}</span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val implementing-agency">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Implementing Agency:</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form proposal-implementing-agency">{{ Session::get("lead_implementing_agency")->acronym ?? "N/A"}}</span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
               <div class="proposal-monitoring-form wcol-2 val funding-agency">
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form">Funding Agency:</span>
                  </div>
                  <div class="proposal-monitoring-form">
                     <span class="proposal-monitoring-form proposal-funding-agency">PHILIPPINE COUNCIL FOR AGRICULTURE, AQUATIC AND NATURAL RESOURCES RESEARCH AND DEVELOPMENT</span>
                  </div>
                  <div class="proposal-monitoring-form clearfix"></div>
               </div>
            </div>
            <table class="proposal-monitoring-form">
               <tbody>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Activity</span>
                        </div>
                     </td>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Date Completed</span>
                        </div>
                     </td>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Signature</span>
                        </div>
                     </td>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Remarks</span>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Receipt of proposal</span>
                        </div>
                     </td>
                     <td colspan="1" rowspan="1" class="text-center"><span>{{ Session::get("proposal_status_tracking_received_proposal_created_at") ?? "" }}</span></td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1" class="text-center"><span>{!! Session::get("proposal_status_tracking_received_proposal_remarks") !!}</span></td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Creation of Technical Review and Evaluation Panel (TREP)</span>
                        </div>
                     </td>
                     <td colspan="1" rowspan="1" class="text-center"><span>{{ Session::get("proposal_status_tracking_forwarded_for_evaluation_proposal_created_at") ?? "" }}</span></td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1" class="text-center"><span>{!! Session::get("proposal_status_tracking_forwarded_for_evaluation_proposal_remarks") !!}</span></td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Referral of proposal to TREP</span>
                        </div>
                     </td>
                     <td colspan="1" rowspan="1" class="text-center"><span>{{ !! Session::get("proposal_status_tracking_review_of_trep_report_proposal_created_at") ?? "" }}</span></td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1" class="text-center"><span>{!! Session::get("proposal_status_tracking_review_of_trep_report_proposal_remarks") !!}</span></td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Submission of TREP&#39;s Evaluation report to OED-RD</span>
                        </div>
                     </td>
                     <td colspan="1" rowspan="1" class="text-center"></td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1" class="text-center"></td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Transmittal of results of evaluation report to proponent (thru OED-RD)</span>                          
                        </div>
                     </td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1"></td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Receipt of revised proposal (thru OED-RD)</span>
                        </div>
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">1st</span>
                        </div>
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">2nd</span>                           
                        </div>
                     </td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1"></td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Endorsement of proposal to OED-RD</span>
                        </div>
                     </td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1"></td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Presentation to DC</span>
                        </div>
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">1st</span>
                        </div>
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">2nd</span>
                        </div>
                     </td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1"></td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Presentation to GC</span>
                        </div>
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">1st</span>
                        </div>
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">2nd</span>
                        </div>
                     </td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1"></td>
                  </tr>
                  <tr>
                     <td colspan="1" rowspan="1">
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">Presentation to DOST-EXECOM</span>
                        </div>
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">1st</span>                           
                        </div>
                        <div class="proposal-monitoring-form">
                           <span class="proposal-monitoring-form">2nd</span>
                        </div>
                     </td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1"></td>
                     <td colspan="1" rowspan="1"></td>
                  </tr>
               </tbody>
            </table>
         </div>
   </body>
</html>
