<!DOCTYPE html>
<html>
   <head>
      <meta content="text/html; charset=UTF-8" http-equiv="content-type">
      <style type="text/css">
         body.comment-form > * {
            padding:0;
            margin:0;
            box-sizing: border-box;
         }

         body.comment-form {
            max-width: 1100pt;
            margin: auto;
         }
         table.comment-form{
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
         p.comment-form, span.comment-form {
            color: #000000;
            text-decoration: none;
            vertical-align: baseline;
            font-style: normal;
         }
         div.comment-form {
            padding: 0.1% 0;
         }
         table.comment-form td,table.comment-form th{padding:0; margin: 0;}
         table.comment-form tbody tr {
            height: 8.5pt;
         }
         table.comment-form tbody td {
            padding-left: 3pt;
            border: 1px solid black;
            word-break: break-word;
         }
         table.comment-form p, table.comment-form span {
            line-height: 1;
            font-weight: 400;
            font-size: 7pt;
            font-family: "Arial";
         }

         .comment-form.text-center {
            text-align: center
         }

         .comment-form.clearfix {
            clear: both;
         }

         .comment-form.borderline {border-bottom: 2px solid black; margin: 1% 0;}
         
         table.comment-form .comment-form.c2 {
            text-align: center
         }

         table.comment-form .comment-form.c2 p.comment-form {
            font-weight: 700;
            font-size: 12pt;
            font-family: "Arial";
         }

         table.comment-form.comments-table tr td:nth-child(1) { width: 10%; }
         table.comment-form.comments-table tr td:nth-child(2) { width: 10%; }
         table.comment-form.comments-table tr td:nth-child(3) { width: 10%; }
         table.comment-form.comments-table tr td:nth-child(4) { width: 70%; }
         .comment-form.page-1, .comment-form.page-2 {
            font-size: 10pt;
            font-family: "Arial Narrow";
            page-break-after: always;
         }

         .comment-form.page-1 > div.comment-form, .comment-form.page-2 {
            margin: 1.5% 0;
         }
         .comment-form.page-2 table th, .comment-form.page-2 table td {
            padding: 0.8%;
         }
         .comment-form.page-2 > table:nth-of-type(2) tr:first-child td {
            text-align: center;
         }
         .comment-form.page-2 > table:nth-of-type(2) td span {
            font-size: 10pt;
            font-family: "Arial Narrow";
         }
         .comment-form.page-2 > table:nth-of-type(2) td {
            padding: 1% 0.5%;
         }
         ol.comment-form li{
            list-style: upper-alpha;
         }
         .comment-form.wcol-2, .comment-form.wcol-3 {width: 100%; margin: 1% 0;}

         .comment-form.wcol-2 > div:not(:last-child),
         .comment-form.wcol-3 > div:not(:last-child){
            float: left;
            width: 50%;
            padding: 0 2px;
         }
         .comment-form.wcol-3 > div:first-child {width: 5%;}
         .comment-form.wcol-3 > div:nth-child(2) {width: 10%;}
         .comment-form.wcol-3 > div:nth-child(3) {width: 80%;}
         .comment-form.wcol-2.val > div:first-child {width: 12%;}
         
         .comment-form.wcol-2.val > div:nth-child(2) {
            width: 88%;
            border-bottom: 1px solid black;
         }
         .comment-form.wcol-2.val > div:nth-child(2) > div,
         .comment-form.wcol-3 > div:nth-child(3) > div {
            width: 100%;
            border-bottom: 1px solid black;
         }

         .comment-form.wcol-2.val.trd > div:first-child,
         .comment-form.wcol-2.staff-in-charge > div:not(:last-child) > div:nth-child(2) > div:first-child {border-bottom: 1px solid black;}
         .comment-form.wcol-2.staff-in-charge > div:not(:last-child) > div:nth-child(2) > div:first-child {width: 90%;}
         .comment-form.wcol-2.val.trd > div:nth-child(2) {border-bottom: transparent;}
         .comment-form.wcol-3 > div:nth-child(3) {width: 10%;}
         .comment-form.tracking-code .wcol-2.val > div:first-child {width: 25%;}
         .comment-form.tracking-code .wcol-2.val > div:nth-child(2) {width: 75%;}

         .comment-form.proponent-agency.wcol-2.val > div:first-child {width: 15%;}
         .comment-form.proponent-agency.wcol-2.val > div:nth-child(2) {width: 85%;}

         .comment-form.duration.wcol-2.val > div:first-child {width: 18%;}
         .comment-form.duration.wcol-2.val > div:nth-child(2) {width: 82%;}

         .comment-form.project-site.wcol-2.val > div:first-child {width: 35%;}
         .comment-form.project-site.wcol-2.val > div:nth-child(2) {width: 65%;}

         .comment-form.project-site.wcol-2.val > div:first-child {width: 35%;}
         .comment-form.project-site.wcol-2.val > div:nth-child(2) {width: 65%;}
         
         .comment-form.forwarded-to.wcol-2.val > div:first-child {width: 25%;}
         .comment-form.forwarded-to.wcol-2.val > div:nth-child(2) {width: 75%;}

         .comment-form.date-forwarded.wcol-2.val > div:first-child {width: 25%;}
         .comment-form.date-forwarded.wcol-2.val > div:nth-child(2) {width: 75%;}

         .comment-form.due-date.wcol-2.val > div:first-child {width: 25%;}
         .comment-form.due-date.wcol-2.val > div:nth-child(2) {width: 75%;}

         .comment-form.implementing-agency.wcol-2.val > div:first-child {width: 16.5%;}
         .comment-form.implementing-agency.wcol-2.val > div:nth-child(2) {width: 83.5%;}

         .comment-form.funding-agency.wcol-2.val > div:first-child {width: 13%;}
         .comment-form.funding-agency.wcol-2.val > div:nth-child(2) {width: 87%;}

         .comment-form.ded-rd.wcol-2.val > div:first-child {width: 60%;}
         .comment-form.ded-rd.wcol-2.val > div:nth-child(2) {width: 40%;}

         .comment-form.wcol-2.val.proposed-budget > div:first-child {width: 30%;}
         .comment-form.wcol-2.val.proposed-budget > div:nth-child(2) {width: 70%; border-bottom: none;}

         .comment-form.wcol-2.val:not(.proposed-budget) > div:nth-child(2)::before,
         .comment-form.wcol-2.val > div:nth-child(2) > div::before, .wcol-3 > div:nth-child(3) > div::before,
         .comment-form.wcol-2.val.trd > div:first-child::before,
         .comment-form.wcol-2.staff-in-charge > div:not(:last-child) > div:nth-child(2) > div:first-child::before{content:'\00a0';}
         
         .comment-form.wcol-2.val.ded-rd > div:nth-child(2),
         .comment-form.wcol-2.val.ded-rd > div:nth-child(2) > div:nth-child(2) {border-bottom: transparent;}

         .comment-form.tracking-code {padding-left: 3.5%;}
         .comment-form.action-taken {padding-top: 1%;padding-left: 5%;}
         .comment-form.action-taken span, .page-1 > div:last-child span.note {font-style: italic;}
         .comment-form.staff-in-charge div {padding: 1.2% 0;}

         .comment-form.padding-top-1per { padding-top: 1% !important; }

      </style>
   </head>
   <body class="comment-form">
         <div class="comment-form page-1">
            <div class="comment-form oed-rd">
               <h3 class="comment-form">Proposal Information</h3>
               <div class="comment-form wcol-2 tracking-code">
                  <div class="comment-form wcol-2 val">
                     <div class="comment-form">
                        <span class="comment-form">Tracking Code:</span>
                     </div>
                     <div class="comment-form">
                        <span class="comment-form proposal-tracking-code">
                           @if (Session::get("proposal")->proposal_code)
                              {{ Session::get("proposal")->proposal_code }}
                           @elseif (Session::get("proposal")->program_id)
                              {{ Session::get("proposal")->program_id }}
                           @else "N/A"
                           @endif
                        </span>
                     </div>
                     <div class="comment-form clearfix"></div>
                  </div>
                  <div class="comment-form wcol-2 val">
                     <div class="comment-form">
                        <span class="comment-form">Date Received:</span>
                     </div>
                     <div class="comment-form">
                        <span class="comment-form proposal-date-received">{{ Session::get("proposal")->date_forwarded_through_api ?? "N/A"}}</span>
                     </div>
                     <div class="comment-form clearfix"></div>
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form wcol-2 val program-title">
                  <div class="comment-form">
                     <span class="comment-form">Program Title:</span>
                  </div>
                  <div class="comment-form">
                     <span class="comment-form proposal-program-title">{{ Session::get("proposal")->proposal_program_title ?? "N/A"}}</span>
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form wcol-2 val project-title">
                  <div class="comment-form">
                     <span class="comment-form">Project Title:</span>
                  </div>
                  <div class="comment-form">
                     <span class="comment-form proposal-project-title">{{ Session::get("proposal")->proposal_project_title ?? "N/A"}}</span>
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form borderline"></div>
               <div class="comment-form wcol-2 val researchers">
                  <div class="comment-form">
                     <span class="comment-form">Researcher(s):</span>
                  </div>
                  <div class="comment-form">
                     <span class="comment-form proposal-researchers">{{ Session::get("proposal_leader_hris")->hr_first_name ?? "N/A"}} {{ Session::get("proposal_leader_hris")->hr_last_name ?? "N/A"}}</span>
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form wcol-2 val proponent-agency">
                  <div class="comment-form">
                     <span class="comment-form">Proponent Agency:</span>
                  </div>
                  <div class="comment-form">
                     <span class="comment-form proposal-proponent-agency">{{ Session::get("proposal_leader_hris")->agency_acronym ?? "N/A"}}</span>
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form wcol-2 val consortium">
                  <div class="comment-form">
                     <span class="comment-form">Consortium:</span>
                  </div>
                  <div class="comment-form">
                     <span class="comment-form proposal-consortium"></span>
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form wcol-2 val duration">
                  <div class="comment-form">
                     <span class="comment-form">Duration (no. of years/ date covered):</span>
                  </div>
                  <div class="comment-form">
                     <span class="comment-form proposal-duration">{{ Session::get("proposal")->proposal_total_duration ?? "N/A"}}</span>
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form wcol-2">
                  <div class="comment-form wcol-2 val proposed-budget">
                     <div class="comment-form">
                        <span class="comment-form">Proposed Budget: </span>
                     </div>
                     <div class="comment-form">
                        @if (!is_null(Session::get("total_yearly_budget")))
                           @foreach(Session::get("total_yearly_budget") as $index => $yBudget)
                              <div class="comment-form">
                                 <span class="comment-form proposal-proposed-budget-1"><b>Year {{ $loop->iteration }}: ₱ </b>{{ number_format(($yBudget->sum_ps_lib + $yBudget->sum_mooe_lib + $yBudget->sum_eo_co_lib) ?? '0', 2) ?? '0' }}

                                 </span>
                              </div>
                           @endforeach
                        @endif
                     </div>
                     <div class="comment-form clearfix"></div>
                  </div>
                  <div class="comment-form wcol-2 val proposed-budget-total">
                     <div class="comment-form">
                        <span class="comment-form">Total: <b> ₱ </b> </span>
                     </div>
                     <div class="comment-form">
                        <span class="comment-form proposal-proposed-budget-total">{{ number_format(Session::get("total_proposed_budget") ?? '0', 2) ?? '0' }}</span>
                     </div>
                     <div class="comment-form clearfix"></div>
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form wcol-3">
                  <div class="comment-form">
                     <span class="comment-form">Type:</span>
                  </div>
                  <div class="comment-form">
                     <div class="comment-form">
                        <span class="comment-form">Program</span>
                     </div>
                     <div class="comment-form">
                        <span class="comment-form">Project</span>
                     </div>
                  </div>
                  <div class="comment-form">
                     @if( Session::get("proposal")->proposal_type_id == 1 or Session::get("proposal")->proposal_type_id == 3 or Session::get("proposal")->proposal_type_id == 5)
                        <div class="comment-form text-center">
                           <span class="comment-form proposal-is-program">✓</span>
                        </div>
                     @else
                        <div class="comment-form text-center">
                           <span class="comment-form proposal-is-program"></span>
                        </div>
                     @endif
                     @if( Session::get("proposal")->proposal_type_id == 2 or Session::get("proposal")->proposal_type_id == 4 or Session::get("proposal")->proposal_type_id == 6)
                        <div class="comment-form text-center">
                           <span class="comment-form proposal-is-project">✓</span>
                        </div>
                     @else
                        <div class="comment-form text-center">
                           <span class="comment-form proposal-is-project"></span>
                        </div>
                     @endif
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form wcol-2 val project-site">
                  <div class="comment-form">
                     <span class="comment-form">Project Site Province/Municipality/Region):</span>
                  </div>
                  <div class="comment-form">
                     <span class="comment-form proposal-project-site">{{ Session::get("lead_implementation_site")['dpmis_province'] ?? "N/A"}} / {{ Session::get("lead_implementation_site")['dpmis_municipality'] ?? "N/A"}} / {{ Session::get("lead_implementation_site")['dpmis_region'] ?? "N/A"}}</span>
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form wcol-2 val commodity">
                  <div class="comment-form">
                     <span class="comment-form">Commodity/ISP:</span>
                  </div>
                  <div class="comment-form">
                     <span class="comment-form proposal-commodity">{{ Session::get("proposal")->dpmis_hnrda_item ?? "N/A"}}</span>
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form wcol-2 val rd-area">
                  <div class="comment-form">
                     <span class="comment-form">R&amp;D Area:</span>
                  </div>
                  <div class="comment-form">
                     <span class="comment-form proposal-rd-area">{{ Session::get("proposal")->hnrda_classification ?? "N/A"}}</span>
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form wcol-2 val banner-program">
                  <div class="comment-form">
                     <span class="comment-form">Banner Program:</span>
                  </div>
                  <div class="comment-form">
                     <span class="comment-form proposal-banner-program"></span>
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form wcol-2">
                  <div class="comment-form wcol-2 val forwarded-to">
                     <div class="comment-form">
                        <span class="comment-form">Forwarded to: </span>
                     </div>
                     <div class="comment-form">
                        <span class="comment-form proposal-forwarded-to">{{ Session::get("proposal_forwarded_divisions") ?? "N/A"}}</span>
                     </div>
                     <div class="comment-form clearfix"></div>
                  </div>
                  <div class="comment-form">
                     <div class="comment-form wcol-2 val date-forwarded">
                        <div class="comment-form">
                           <span class="comment-form">Date forwarded: </span>
                        </div>
                        <div class="comment-form">
                           <span class="comment-form proposal-date-forwarded">{{ Session::get("proposal_status_tracking")['forwarded_for_evaluation_proposal']->created_at ?? "N/A"}}</span>
                        </div>
                        <div class="comment-form clearfix"></div>
                     </div>
                     <div class="comment-form wcol-2 val due-date">
                        <div class="comment-form">
                           <span class="comment-form">Due Date: </span>
                        </div>
                        <div class="comment-form">
                           <span class="comment-form proposal-due-date"></span>
                        </div>
                        <div class="comment-form clearfix"></div>
                     </div>
                  </div>
                  <div class="comment-form clearfix"></div>
               </div>
               <div class="comment-form borderline"></div>
               <div class="comment-form page-2">
                  <h3 class="comment-form">Comments</h3>
                  <table class="comment-form comments-table">
                     <tbody>
                        <tr>
                           <td colspan="1" rowspan="1">
                              <span class="comment-form">Section</span>
                           </td>
                           <td colspan="1" rowspan="1">
                              <span class="comment-form">Field</span>
                           </td>
                           <td colspan="1" rowspan="1">
                              <span class="comment-form">Commenter</span>
                           </td>
                           <td colspan="2" rowspan="1">
                              <span class="comment-form">Comments</span>
                           </td>
                        </tr>
                        @if( Session::has("proposal_comments") && count(Session::get("proposal_comments")) >= 1 )
                           @foreach (Session::get("proposal_comments") as $proposal_comment)
                              <tr>
                                 <td colspan="1" rowspan="1"><span class="comment-form">{{ $proposal_comment->comment_section ?? "N/A"}}</span></td>
                                 <td colspan="1" rowspan="1"><span class="comment-form">{{ $proposal_comment->proposal_field ?? "N/A"}}</span></td>
                                 <td colspan="1" rowspan="1" class="text-center"><span class="comment-form">{{ $proposal_comment->username ?? "N/A"}}</span></td>
                                 <td colspan="2" rowspan="1">
                                    @if($proposal_comment->is_inline == 0)
                                       {!! $proposal_comment->comments ?? "N/A" !!}
                                    @else
                                       <div class="comment-form">
                                          <i>"{!! $proposal_comment->comment_text ?? "N/A" !!}"</i> 
                                       </div>
                                       <div class="comment-form padding-top-1per">
                                         {!! $proposal_comment->comments ?? "N/A" !!} 
                                       </div>
                                    @endif
                                 </td>
                              </tr>
                           @endforeach
                        @else
                           <tr>
                              <td colspan="5" class="text-center">
                                 <span class="comment-form">
                                    No data available
                                 </span>
                              </td>
                           </tr>
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
   </body>
</html>
