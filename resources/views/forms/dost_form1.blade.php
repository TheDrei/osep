<!DOCTYPE html>
<html>
<head>
	<title>DOST Form 1 Detailed Program Proposal</title>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<style type="text/css">
		@page{
			margin-top: 72pt;
		}
		body.form1 > * {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}
		body.form1 {
			max-width: 1100pt;
			margin: auto;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 10pt;
			font-weight: normal;
		}
		table.form1 {
            text-indent: initial;
            white-space: normal;
            line-height: normal;
            font-weight: normal;
            font-style: normal;
            color: -internal-quirk-inherit;
            text-align: start;
            font-variant: normal;
            border-spacing: 0;
            width: 100%;
            margin: 1% 0;
            word-break: break-word;
        }

        img {
        	max-width: 100%;
	        max-height: 100%;
        }
        span.form1.comments-allow, p.form1.comments-allow { line-height: 2; }
        select.form1.versioning { color: white !important; background: #28a745!important; border-radius: 12px; padding-right: 5px; padding-left: 5px;}
        select.form1.versioning > option { font-weight: bold; }
        .form1.text-center { text-align: center !important; }
        .form1.font-weight-bold { font-weight: bold !important; }
        .form1.text-capital { text-transform: capitalize !important; }
        .form1.text-size-12 { font-size: 12pt !important; }
        .form1.text-size-10 { font-size: 10pt !important; }
        .form1.text-size-8 { font-size: 8pt !important; }
        .form1.font-italicize { font-style: italic !important; }
        .form1.border-none { border: none !important; }
        .form1.border-1px-solid-black { border: 1px solid black;}
        .form1.border-bottom-1px-solid-black { border-bottom: 1px solid black; }
        .form1.text-justify { text-align: justify; }
        .form1.text-left { text-align: left; }
        .form1.padding-left-2per { padding-left: 2% !important; }
        .form1.padding-left-4per { padding-left: 4% !important; }
        .form1.padding-right-2per { padding-right: 2% !important; }
        .form1.width-25per { width: 25% !important }
        .form1.min-height-15pt { min-height: 15pt !important; }
        .form1.align-top { vertical-align: top !important; }

        .form1.clearfix { clear: both; }
        .form1.wcol-2-20-78 > div:first-child {
            float: left;
            width: 20%;
            padding: 0 2px;
         }

         .form1.wcol-2-20-78 > div:nth-child(2) {
            float: left;
            width: 78%;
            padding: 0 2px;
         }

        .form1.pages {
        	page-break-after: always;
        }
        table.form1 p { padding: 1px; margin: 0; }
        .form1.comment-section { padding: 0.5%; margin: 0.3%; }
        .form1.proposal-gad-responsiveness { content: "\00a0"; }
        .form1.comment-header { padding-left: 0.8%; }
        .form1.comments-allow { text-align: justify; margin-top: 1%; margin-bottom: 1%; }
	</style>
</head>
<body class="form1">
	<div class="form1 pages page-1">
		<table class="form1 form1-header border-none">
			<tr>
				<td colspan="1" rowspan="4">
					<p class="text-center text-capital form1">
						<span class="proposal-monitoring-form" style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 76.80px; height: 59.20px;">
	               	<img alt="DOST LOGO" src="{{ asset('storage/images/util/dost_logo.png') }}" style="width: 76.80px; height: 59.20px; margin-left: -0.00px; margin-top: -0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title="">
		               </span>
					</p>
				</td>
				<td colspan="1" rowspan="1">
					<p class="font-weight-bold text-center form1">
						DOST Form 1
					</p>
				</td>
			</tr>
			<tr>
				<td colspan="1" rowspan="1">
					<p class="font-weight-bold text-size-12 text-center text-capital form1">
						DETAILED RESEARCH & DEVELOPMENT PROGRAM PROPOSAL
					</p>
				</td>
			</tr>
			<tr>
				<td colspan="1" rowspan="1">
					<p class="font-weight-bold text-center text-capital form1">
						(For the Whole Program)
					</p>
				</td>
			</tr>
			<tr>
				<td colspan="1" rowspan="1">
					<p class="font-weight-bold text-center text-capital form1">
						(To be accomplished by the researcher)
					</p>
				</td>
			</tr>
		</table>
		<div class="form1 border-1px-solid-black">
			<div class="form1 program-profile comment-section" data-comments-section-id="1">
				<div class="form1">
					<span class="form1 font-weight-bold text-capital comment-header">
						(1) PROGRAM PROFILE
					</span>
				</div>
				<div class="form1">
					<span class="form1">
						Program Title:
					</span>
					<span class="form1 border-none comments-allow proposal-program-title" data-proposal-field-id="1">
						{{ Session::get("proposal")->proposal_program_title ?? "N/A"}}
					</span>
				</div>
				<div class="form1">
					<span class="form1">
						Program Leader/Sex:
					</span>
					<span class="form1 border-none comments-allow proposal-program-leader" data-proposal-field-id="2">
						{{ Session::get("proposal_leader_hris")->hr_first_name ?? "N/A"}} {{ Session::get("proposal_leader_hris")->hr_last_name ?? "N/A"}} / {{ Session::get("proposal_leader_hris")->proposal_researcher_sex ?? "N/A"}}
					</span>
				</div>
				<div class="form1">
					<span class="form1">
						Program Duration (number of months):
					</span>
					<span class="form1 border-none comments-allow proposal-program-duration" data-proposal-field-id="3">
						{{ Session::get("proposal")->proposal_total_duration ?? "N/A"}}
					</span>
				</div>
				<div class="form1 padding-left-2per">
					<span class="form1">
						Program Start Date:
					</span>
					<span class="form1 border-none comments-allow proposal-start-date" data-proposal-field-id="4">
						{{ Session::get("proposal")->start_date ?? "N/A"}}
					</span>
				</div>
				<div class="form1 padding-left-2per">
					<span class="form1">
						Program End Date:
					</span>
					<span class="form1 border-none comments-allow proposal-end-date" data-proposal-field-id="5">
						{{ Session::get("proposal")->end_date ?? "N/A"}}
					</span>
				</div>
				<div class="form1">
					<span class="form1">
						Implementing Agency 
					</span>
					<span class="form1 text-size-8">
						(Name of University-College-Institute, Department/Organization or Company):
					</span>
					<span class="form1 comments-allow proposal-implementing-agencies" data-proposal-field-id="6">
						{{ Session::get("lead_implementing_agency")->agency ?? "N/A"}}
					</span>
				</div>
				<div class="form1">
					<span class="form1">
						Address/Telephone/Fax/Email 
					</span>
					<span class="form1 text-size-8">
						(Barangay, Municipality, District, Province, Region):
					</span>
					<span class="form1 comments-allow proposal-address" data-proposal-field-id="7">
						{{ Session::get("proposal_leader_hris")->hr_address ?? "N/A"}} / {{ Session::get("proposal_leader_hris")->hr_mobile_num ?? "N/A"}} / {{ Session::get("proposal_leader_hris")->hr_fax_num ?? "N/A"}}  / {{ Session::get("proposal_leader_hris")->hr_email ?? "N/A"}}
					</span>
				</div>
				<table class="form1 proposal-title-of-component-projects" data-proposal-field-id="8">
					<tr class="form1">
						<td class="form1 border-1px-solid-black">
							<p class="form1 font-weight-bold text-center">
								Title of Component Projects:
							</p>
						</td>
						<td class="form1 border-1px-solid-black">
							<p class="form1 text-center font-weight-bold">
								Project Duration
							</p>
							<p class="form1 text-center">
								(number of months):
							</p>
						</td>
						<td class="form1 border-1px-solid-black">
							<p class="form1 font-weight-bold text-center">
								Project Start Date:
							</p>
						</td>
						<td class="form1 border-1px-solid-black">
							<p class="form1 font-weight-bold text-center">
								Project End Date:
							</p>
						</td>
					</tr>
					@if( Session::has("proposal_projects") && count(Session::get("proposal_projects")) >= 1)
		            	@foreach (Session::get("proposal_projects") as $project)
		            	<tr class="form1">
							<td class="form1 border-1px-solid-black padding-left-2per">
								<p class="form1">
									<span class="form1 font-weight-bold">
										{{ $loop->iteration }}.)
									</span>
									<span class="form1 comments-allow proposal-program-project-list-title-{{ $loop->iteration }}">
										{{ $project->title ?? "N/A" }}
									</span>
								</p>
							</td>
							<td class="form1 border-1px-solid-black text-center">
								<span class="form1 comments-allow proposal-program-project-list-total-duration-{{ $loop->iteration }}">
									{{ $project->proposal_total_duration ?? "N/A" }}
								</span>
							</td>
							<td class="form1 border-1px-solid-black text-center">
								<span class="form1 comments-allow proposal-program-project-list-start-date-{{ $loop->iteration }}">
									{{ $project->start_date ?? "N/A"}}
								</span>
							</td>
							<td class="form1 border-1px-solid-black text-center">
								<span class="form1 comments-allow proposal-program-project-list-end-date-{{ $loop->iteration }}">
									{{ $project->end_date ?? "N/A"}}
								</span>
							</td>
						</tr>
		            	@endforeach
		            @else
		            	<tr class="form1">
		            		<td rowspan="1" colspan="4" class="form1 border-1px-solid-black text-center">
		            			<span class="form1 font-weight-bold text-capital">
		            				No data available
		            			</span>
		            		</td>
		            	</tr>
		        	@endif
				</table>
			</div>
			<div class="form1 comment-section proposal-program-summary" data-comments-section-id="2">
				<div class="form1">
					<span class="form1 font-weight-bold text-capital comment-header">
						(2) PROGRAM SUMMARY
					</span>
					<span class="form1 text-size-8">
						(Not to exceed two (2) (pages))
					</span>
				</div>
				<div class="form1">
					<p class="form1 text-size-8">
						Objectives of the Program:
					</p>
				</div>
				<div class="form1 container-versioning">
					<span class="form1 text-size-8">
						General:
					</span>
					<select class="form1 font-weight-bold versioning" data-table="general_objective" data-replace-html="proposal-objectives-general">
						<option selected disabled>N/A</option>
						@if( Session::has("general_objective_version") )
							@foreach (Session::get("general_objective_version") as $index => $version)
								@if ($version->is_active == 1)
									<option value="{{ $version->idobjective }}" selected="selected">Version {{ $index + 1 }}</option>
								@else
									<option value="{{ $version->idobjective }}">Version {{ $index + 1 }}</option>
								@endif
							@endforeach
		    			@endif
					</select>
					<div class="form1 padding-right-2per comments-allow proposal-objectives-general" data-proposal-field-id="9">
						@if (substr(Session::get("proposal")->general_objective, 0, 1) === '"')
		                	{!! trim(Session::get("proposal")->general_objective, '"') ?? "N/A" !!}
		            	@else
		                	{!! Session::get("proposal")->general_objective ?? "N/A" !!}
		                @endif
					</div>
				</div>
				<div class="form1 container-versioning">
					<span class="form1 text-size-8">
						Specific:
					</span>
					<select class="form1 font-weight-bold versioning" data-table="specific_objective" data-replace-html="proposal-objectives-specific">
						<option selected disabled>N/A</option>
						@if( Session::has("specific_objective_version") )
							@foreach (Session::get("specific_objective_version") as $index => $version)
								@if ($version->is_active == 1)
									<option value="{{ $version->idobjective }}" selected="selected">Version {{ $index + 1 }}</option>
								@else
									<option value="{{ $version->idobjective }}">Version {{ $index + 1 }}</option>
								@endif
							@endforeach
		    			@endif
					</select>
					<div class="form1 padding-right-2per comments-allow proposal-objectives-specific" data-proposal-field-id="10">
						@if (substr(Session::get("proposal")->specific_objective, 0, 1) === '"')
		                	{!! trim(Session::get("proposal")->specific_objective, '"') ?? "N/A" !!}
		            	@else
		                	{!! Session::get("proposal")->specific_objective ?? "N/A" !!}
		                @endif
						
					</div>
				</div>
				<div class="form1 container-versioning">
					<span class="form1 text-size-8">
						Significance/Impact to knowledge advancement and to the society:
					</span>
					<select class="form1 font-weight-bold versioning" data-table="significance" data-replace-html="proposal-significance">
						<option selected disabled>N/A</option>
						@if( Session::has("significance_version") )
							@foreach (Session::get("significance_version") as $index => $version)
								@if ($version->is_active == 1)
									<option value="{{ $version->idsignificance  }}" selected="selected">Version {{ $index + 1 }}</option>
								@else
									<option value="{{ $version->idsignificance  }}">Version {{ $index + 1 }}</option>
								@endif
							@endforeach
		    			@endif
					</select>
					<div class="form1 padding-right-2per comments-allow proposal-significance" data-proposal-field-id="11">
						@if (substr(Session::get("proposal")->significance, 0, 1) === '"')
		                	{!! trim(Session::get("proposal")->significance, '"') ?? "N/A" !!}
		                @else
		                	{!! Session::get("proposal")->significance ?? "N/A" !!}
		                @endif
					</div>
				</div>
				<div class="form1 container-versioning">
					<span class="form1 text-size-8">
						Methodology:
					</span>
					<select class="form1 font-weight-bold versioning" data-table="methodology" data-replace-html="proposal-methodology">
						<option selected disabled>N/A</option>
						@if( Session::has("methodology_version") )
							@foreach (Session::get("methodology_version") as $index => $version)
								@if ($version->is_active == 1)
									<option value="{{ $version->idmethodology  }}" selected="selected">Version {{ $index + 1 }}</option>
								@else
									<option value="{{ $version->idmethodology  }}">Version {{ $index + 1 }}</option>
								@endif
							@endforeach
		    			@endif
					</select>
					<div class="form1 padding-right-2per comments-allow proposal-methodology" data-proposal-field-id="12">
						@if (substr(Session::get("proposal")->methodology, 0, 1) === '"')
	            			{!! trim(Session::get("proposal")->methodology, '"') ?? "N/A" !!}
	            		@else
	              			{!! Session::get("proposal")->methodology ?? "N/A" !!}
	            		@endif
					</div>
				</div>
				<div class="form1 container-versioning">
					<span class="form1 text-size-8">
						Conceptual Framework (how the projects are interrelated):
					</span>
					<select class="form1 font-weight-bold versioning" data-table="scientific_framework" data-replace-html="proposal-scientific-framework">
						<option selected disabled>N/A</option>
						@if( Session::has("scientific_framework_version") )
							@foreach (Session::get("scientific_framework_version") as $index => $version)
								@if ($version->is_active == 1)
									<option value="{{ $version->idscientific_framework  }}" selected="selected">Version {{ $index + 1 }}</option>
								@else
									<option value="{{ $version->idscientific_framework  }}">Version {{ $index + 1 }}</option>
								@endif
							@endforeach
		    			@endif
					</select>
					<div class="form1 padding-right-2per comments-allow proposal-scientific-framework" data-proposal-field-id="13">
						@if (substr(Session::get("proposal")->scientific_framework, 0, 1) === '"')
	            			{!! trim(Session::get("proposal")->scientific_framework, '"') ?? "N/A" !!}
	            		@else
	              			{!! Session::get("proposal")->scientific_framework ?? "N/A" !!}
	            		@endif
					</div>
				</div>
				<div class="form1 container-versioning">
					<span class="form1 text-size-8">
						Discussion of possible complementation or utilization of related DOST-GIA funded Programs/projects previously handled by the same Program Leader (if any)
					</span>
					<select class="form1 font-weight-bold versioning" data-table="discussion" data-replace-html="proposal-discussion">
						<option selected disabled>N/A</option>
						@if( Session::has("discussion_version") )
							@foreach (Session::get("discussion_version") as $index => $version)
								@if ($version->is_active == 1)
									<option value="{{ $version->iddiscussion  }}" selected="selected">Version {{ $index + 1 }}</option>
								@else
									<option value="{{ $version->iddiscussion  }}">Version {{ $index + 1 }}</option>
								@endif
							@endforeach
		    			@endif
					</select>
					<div class="form1 padding-right-2per comments-allow proposal-discussion" data-proposal-field-id="14">
						@if (substr(Session::get("proposal")->discussion, 0, 1) === '"')
	            			{!! trim(Session::get("proposal")->discussion, '"') ?? "N/A" !!}
	            		@else
	              			{!! Session::get("proposal")->discussion ?? "N/A" !!}
	            		@endif
					</div>
				</div>
				<div class="form1">
					<span class="form1 text-size-8">
						Gender Sensitivity/Responsiveness [based on the Harmonized Gender and Development Guidelines (HGDG)]. See attached GAD Checklist. Indicate the GAD Score of component projects.
					</span>
				</div>
				<div class="form1 padding-right-2per comments-allow proposal-gad-responsiveness" data-proposal-field-id="15">
					@if (substr(Session::get("proposal")->gad_score, 0, 1) === '"')
						{!! trim(Session::get("proposal")->gad_score, '"') ?? "N/A" !!}
					@else
						{!! Session::get("proposal")->gad_score ?? "N/A" !!}
					@endif
				</div>
			</div>
		</div>
		<div class="form1 budget-summary-for-the-whole-program comment-section" data-proposal-field-id="16" data-comment-section-id="3">
			<div class="form1">
				<span class="form1 font-weight-bold text-capital comment-header">
					(3) BUDGET SUMMARY FOR THE WHOLE PROGRAM
				</span>
				<span class="form1 font-weight-bold text-size-8">
					(include Counterpart Funds)
				</span>
			</div>
			<table class="form1">
				<tbody class="form1">
					<tr class="form1">
						<td colspan="5" class="form1 border-1px-solid-black">
							<p class="form1 font-weight-bold">
								Total Budget:
							</p>
						</td>
					</tr>
					@if( Session::has("budget_summary")  && count(Session::get("budget_summary")) >= 1)
						@foreach (Session::get("budget_summary") as $year => $funding_agency)
							<tr class="form1">
								<td colspan="5" class="form1 border-1px-solid-black">
									<p class="form1 font-weight-bold">
										Y{{ $year }} Budget:
									</p>
								</td>
							</tr>
							<tr class="form1">
								<td class="form1 border-1px-solid-black">
								 	<p class="form1 text-capital font-weight-bold text-center">
								 		SOURCE OF FUND
								 	</p>
								</td>
								<td class="form1 border-1px-solid-black">
								 	<p class="form1 text-capital font-weight-bold text-center">
								 		PS
								 	</p>
								</td>
								<td class="form1 border-1px-solid-black">
								 	<p class="form1 text-capital font-weight-bold text-center">
								 		MOOE
								 	</p>
								</td>
								<td class="form1 border-1px-solid-black">
								 	<p class="form1 text-capital font-weight-bold text-center">
								 		EO
								 	</p>
								</td>
								<td class="form1 border-1px-solid-black">
								 	<p class="form1 text-capital font-weight-bold text-center">
								 		TOTAL
								 	</p>
								</td>
							</tr>
							@foreach($funding_agency as $funding_agency_id => $lib_item)
								<tr class="form1">
									<td class="form1 border-1px-solid-black">
									 	<p class="form1 text-capital text-center comments-allow proposal-budget-summary-year-{{ $year }}-funding-agency-{{ $loop->iteration }}">
									 		{{ $lib_item["funding_agency"] }}
									 	</p>
									</td>
									<td class="form1 border-1px-solid-black">
									 	<p class="form1 text-capital text-center comments-allow proposal-budget-year-{{ $year }}-summary-ps-amount-{{ $loop->iteration }}">
									 		₱ {{ number_format($lib_item["ps_amount"], 2) ?? "0"}}
									 	</p>
									</td>
									<td class="form1 border-1px-solid-black">
									 	<p class="form1 text-capital text-center comments-allow proposal-budget-year-{{ $year }}-summary-mooe-amount-{{ $loop->iteration }}">
									 		₱ {{ number_format($lib_item["mooe_amount"], 2) ?? "0"}}
									 	</p>
									</td>
									<td class="form1 border-1px-solid-black">
									 	<p class="form1 text-capital text-center comments-allow proposal-budget-year-{{ $year }}-summary-eo-co-amount-{{ $loop->iteration }}">
									 		₱ {{ number_format($lib_item["eo_co_amount"], 2) ?? "0"}}
									 	</p>
									</td>
									<td class="form1 border-1px-solid-black">
									 	<p class="form1 text-capital text-center font-weight-bold comments-allow proposal-budget-summary-funding-agency-total-amount-{{ $loop->iteration }}">
									 		₱ {{ number_format($lib_item["total_amount"], 2) ?? "0"}}
									 	</p>
									</td>
								</tr>
							@endforeach
							@if( Session::has("budget_yearly_total") )
								<tr class="form1">
									<td class="form1 border-1px-solid-black">
									 	<p class="form1 text-capital font-weight-bold text-center">
									 		TOTAL
									 	</p>
									</td>
									<td class="form1 border-1px-solid-black">
									 	<p class="form1 text-capital text-center comments-allow proposal-budget-summary-total-yearly-year-{{ $year }}-ps-amount-{{ $loop->iteration }}">
									 		₱ {{ number_format(Session::get("budget_yearly_total")[$year]['total_ps_amount'], 2) ?? '0' }}
									 	</p>
									</td>
									<td class="form1 border-1px-solid-black">
									 	<p class="form1 text-capital text-center comments-allow proposal-budget-summary-total-yearly-year-{{ $year }}-mooe-amount-{{ $loop->iteration }}">
									 		₱ {{ number_format(Session::get("budget_yearly_total")[$year]['total_mooe_amount'], 2) ?? '0' }}
									 	</p>
									</td>
									<td class="form1 border-1px-solid-black">
									 	<p class="form1 text-capital text-center comments-allow proposal-budget-summary-total-yearly-year-{{ $year }}-eo-co-amount-{{ $loop->iteration }}">
									 		₱ {{ number_format(Session::get("budget_yearly_total")[$year]['total_eo_co_amount'], 2) ?? '0' }}
									 	</p>
									</td>
									<td class="form1 border-1px-solid-black">
									 	<p class="form1 text-capital text-center font-weight-bold comments-allow proposal-budget-summary-total-yearly-year-{{ $year }}-total-amount-{{ $loop->iteration }}">
									 		₱ {{ number_format(Session::get("budget_yearly_total")[$year]['total_amount'], 2) ?? '0' }}
									 	</p>
									</td>
								</tr>
							@endif
						@endforeach
					@else
						<tr class="form1">
							<td colspan="5" class="form1 border-1px-solid-black text-center">
								<span class="form1 font-weight-bold text-capital">
									No data available
								</span>
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
		<div class="form1 number-of-personnel-requirement comment-section" data-proposal-field-id="17" data-comments-section-id="4">
			<div class="form1">
				<span class="form1 font-weight-bold text-capital comment-header">
					(4) NUMBER OF PERSONNEL REQUIREMENT
				</span>
			</div>
			<table class="form1">
				<tr class="form1">
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 font-weight-bold text-center">
					 		Full-time
					 	</p>
					</td>
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 font-weight-bold text-center">
					 		Part-time
					 	</p>
					</td>
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 font-weight-bold text-center">
					 		Total
					 	</p>
					</td>
				</tr>
				<tr class="form1 min-height-15pt">
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 text-capital text-center comments-allow proposal-number-of-personnel-requirement-number-full-time">
					 		{{ Session::get("no_personnel_full_time") ?? "0"}}
					 	</p>
					</td>
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 text-capital text-center comments-allow proposal-number-of-personnel-requirement-number-part-time">
					 		{{ Session::get("no_personnel_part_time") ?? "0"}}
					 	</p>
					</td>
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 text-capital text-center comments-allow proposal-number-of-personnel-requirement-number-total">
					 		{{ Session::get("no_personnel_total") ?? "0"}}
					 	</p>
					</td>
				</tr>
			</table>
		</div>
		<div class="form1 summary-of-equipment comment-section" data-comments-section-id="5" data-proposal-field-id="18">
			<div class="form1">
				<span class="form1 font-weight-bold text-capital comment-header">
					(5) SUMMARY OF EQUIPMENT RELEVANT TO THE PROGRAM
				</span>
				<span class="form1 font-weight-bold comment-header">
					(include equipment as provided in the program line-item budget)
				</span>
			</div>
			<table class="form1">
				<tr class="form1">
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 font-weight-bold text-center">
					 		Name of Equipment
					 	</p>
					</td>
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 font-weight-bold text-center">
					 		Existing Equipment in the Implementing Agency (number)
					 	</p>
					</td>
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 font-weight-bold text-center">
					 		Existing Equipment from Other Collaborating Agency/ies (Local and Abroad) (number)
					 	</p>
					</td>
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 font-weight-bold text-center">
					 		To Be Purchased (number)
					 	</p>
					</td>
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 font-weight-bold text-center">
					 		Justification for the Purchase
					 	</p>
					</td>
				</tr>
				@if( Session::has("equipments") && count(Session::get("equipments")) >= 1)
	            	@foreach (Session::get("equipments") as $equipment)
						<tr class="form1 min-height-15pt">
							<td class="form1 border-1px-solid-black">
							 	<p class="form1 text-capital text-center comments-allow proposal-equipment-summary-name-{{ $loop->iteration }}">
							 		{{ $equipment->equipment_name ?? 'N/A' }}
							 	</p>
							</td>
							<td class="form1 border-1px-solid-black">
							 	<p class="form1 text-capital text-center comments-allow proposal-equipment-summary-implementing-agency-{{ $loop->iteration }}">
							 		{{ $equipment->equipment_count ?? 'N/A' }}
							 	</p>
							</td>
							<td class="form1 border-1px-solid-black">
							 	<p class="form1 text-capital text-center comments-allow proposal-equipment-summary-collaborating-agency-{{ $loop->iteration }}">
							 		{{ $equipment->num_existing_equipment_collaborating ?? 'N/A' }}
							 	</p>
							</td>
							<td class="form1 border-1px-solid-black">
							 	<p class="form1 text-capital text-center comments-allow proposal-equipment-summary-to-be-purchased-{{ $loop->iteration }}">
							 		{{ $equipment->equipment_to_purchase ?? 'N/A' }}
							 	</p>
							</td>
							<td class="form1 border-1px-solid-black">
							 	<p class="form1 text-capital text-center comments-allow proposal-equipment-summary-justification-{{ $loop->iteration }}">
							 		{{ $equipment->justification ?? 'N/A' }}
							 	</p>
							</td>
						</tr>
	            	@endforeach
	            @else
	            	<tr class="form1">
						<td colspan="5" class="form1 border-1px-solid-black text-center">
							<span class="form1 font-weight-bold text-capital">
								No data available
							</span>
						</td>
					</tr>
              	@endif
			</table>
		</div>
		<div class="form1 other-ongoing-programs comment-section" data-comments-section-id="6" data-proposal-field-id="19">
			<div class="form1">
				<span class="form1 font-weight-bold text-capital comment-header">
					(6) OTHER ONGOING PROGRAMS BEING HANDLED BY THE PROGRAM LEADER:
				</span>
				<span class="form1 font-weight-bold">
					@if (Session::get("other_programs"))
						{{ count(Session::get("other_programs")) ?? _____ }}
					@else _____
					@endif
				</span>
				<span class="form1">
					(number)
				</span>
			</div>
			<table class="form1">
				<tr class="form1">
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 font-weight-bold text-center">
					 		Title of the Program
					 	</p>
					</td>
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 font-weight-bold text-center">
					 		Implementation Period (mm/dd/yy)
					 	</p>
					</td>
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 font-weight-bold text-center">
					 		Funding Agency
					 	</p>
					</td>
					<td class="form1 border-1px-solid-black">
					 	<p class="form1 font-weight-bold text-center">
					 		Involvement in the Program
					 	</p>
					</td>
				</tr>
				@if( Session::has("other_programs") && count(Session::get("other_programs")) >= 1)
	            	@foreach (Session::get("other_programs") as $other_program)
						<tr class="form1 min-height-15pt">
							<td class="form1 border-1px-solid-black">
							 	<p class="form1 text-capital text-center comments-allow proposal-other-programs-title-{{ $loop->iteration }}">
							 		{{ $other_program->title ?? 'N/A' }}
							 	</p>
							</td>
							<td class="form1 border-1px-solid-black">
							 	<p class="form1 text-capital text-center comments-allow proposal-other-programs-implementation-period-{{ $loop->iteration }}">
							 		{{ $other_program->implementation_period ?? 'N/A' }}
							 	</p>
							</td>
							<td class="form1 border-1px-solid-black">
							 	<p class="form1 text-capital text-center comments-allow proposal-other-programs-funding-agency-{{ $loop->iteration }}">
							 		{{ $other_program->implementation_period ?? 'N/A' }}
							 	</p>
							</td>
							<td class="form1 border-1px-solid-black">
							 	<p class="form1 text-capital text-center comments-allow proposal-other-programs-involvement-{{ $loop->iteration }}">
							 		{{ $other_program->involvement ?? 'N/A' }}
							 	</p>
							</td>
						</tr>
	            	@endforeach
	            @else
	            	<tr class="form1">
						<td colspan="4" class="form1 border-1px-solid-black text-center">
							<span class="form1 font-weight-bold text-capital">
								No data available
							</span>
						</td>
					</tr>
	            @endif
			</table>
		</div>
		<div class="form1 comment-section" data-comments-section-id="7">
			<div class="form1">
				<p class="form1 font-weight-bold text-justify">
					I hereby certify the truth of the foregoing and have no pending financial and/or technical obligations from the DOST and its attached Agencies. I further certify that the programs/projects being handled is within the prescribed number as stipulated in the DOST-GIA Guidelines.  Any willful omission/false statement shall be a basis of disapproval and cancellation of the Program.	
				</p>
			</div>
			<table class="form1">
				<tr class="form1">
					<td class="form1 border-1px-solid-black">
						<p class="form1 font-weight-bold">
							(7)
						</p>
					</td>
					<td class="form1 border-1px-solid-black">
						<p class="form1 font-weight-bold text-center">
							SUBMITTED BY (Program Leader)
						</p>
					</td>
					<td class="form1 border-1px-solid-black">
						<p class="form1 font-weight-bold text-center">
							ENDORSED BY (Head of the Agency)
						</p>
					</td>
				</tr>
				<tr class="form1">
					<td class="form1 border-1px-solid-black">
						<p class="form1">
							Signature
						</p>
					</td>
					<td class="form1 border-1px-solid-black">
						
					</td>
					<td class="form1 border-1px-solid-black">
						
					</td>
				</tr>
				<tr class="form1">
					<td class="form1 border-1px-solid-black">
						<p class="form1">
							Printed Name
						</p>
					</td>
					<td class="form1 border-1px-solid-black text-center">
						{{ Session::get("proposal_leader_hris")->hr_first_name ?? "N/A"}} {{ Session::get("proposal_leader_hris")->hr_last_name ?? "N/A"}} 
					</td>
					<td class="form1 border-1px-solid-black text-center">
						
					</td>
				</tr>
				<tr class="form1">
					<td class="form1 border-1px-solid-black">
						<p class="form1">
							Designation/Title
						</p>
					</td>
					<td class="form1 border-1px-solid-black text-center">
						Program Leader
					</td>
					<td class="form1 border-1px-solid-black text-center">
						
					</td>
				</tr>
				<tr class="form1">
					<td class="form1 border-1px-solid-black">
						<p class="form1">
							Date
						</p>
					</td>
					<td class="form1 border-1px-solid-black text-center">
						
					</td>
					<td class="form1 border-1px-solid-black text-center">
						
					</td>
				</tr>
			</table>
			<div class="form1">
				<span class="form1 font-weight-bold text-size-8">
					Note:
				</span>
				<span class="form1 font-italicize text-size-8">
					See guidelines/definitions at the back.
				</span>
			</div>
		</div>
	</div>
	<div class="form1 pages page-2">
		<div class="form1 text-center">
			<p class="form1 font-weight-bold">
				DOST Form 1
			</p>
			<p class="form1 font-weight-bold">
				DETAILED R & D PROGRAM PROPOSAL
			</p>
		</div>
		<div class="form1 text-justify">
			<div class="form1 wcol-2-20-78">
				<div class="form1">
					<p class="form1 font-weight-bold text-left">
						I. General Instruction:
					</p>
				</div>
				<div class="form1">
					<p class="form1">
						Submit through the DOST Project Management Information System (DPMIS), http://dpmis.dost.gov.ph, the detailed R&D proposal for the whole Program together with the detailed proposal of the component projects and a 1-page curriculum vitae of the Program Leader. Also, submit four (4) copies of the proposal together with its supporting documents. Use Arial font, 11 font size.
					</p>
				</div>
			</div>
			<p class="form1 font-weight-bold">
				II. Operational Definition of Terms:
			</p>
			<p class="form1 padding-left-2per">
				<span class="form1 font-weight-bold">
					1. Program -
				</span>
				<span class="form1">
					refers to a group of interrelated or complementing S&T projects that require an interdisciplinary or multidisciplinary approach to meet established goal(s) within a specific time frame.
				</span>
			</p>
			<p class="form1 padding-left-4per">
				<span class="form1 font-weight-bold">
					Title-
				</span>
				<span class="form1">
					the identification of the Program and the component projects
				</span>
			</p>
			<p class="form1 padding-left-4per">
				<span class="form1 font-weight-bold">
					Program Leader -
				</span>
				<span class="form1">
					refers to the person who plans, organizes and supervises the overall activities of a program and is a Project Leader of at least one (1) of the projects under a program.
				</span>
			</p>
			<p class="form1 padding-left-4per">
				<span class="form1 font-weight-bold">
					Program/Project Duration-
				</span>
				<span class="form1">
					refers to the grant period or timeframe that covers the approved start and completion dates of the program/project, and the number of months the program/project will be implemented.
				</span>
			</p>


			<p class="form1 padding-left-4per">
				<span class="form1 font-weight-bold">
					Implementing Agency-
				</span>
				<span class="form1">
					the primary organization involved in the execution of a program/project which can be a public or private entity
				</span>
			</p>

			<p class="form1 padding-left-4per">
				<span class="form1 font-weight-bold">
					Project-
				</span>
				<span class="form1">
					refers to the basic unit in the investigation of specific S&T problem/s with predetermined objective(s) to be accomplished within a specific time frame.
				</span>
			</p>

			<p class="form1 padding-left-2per">
				<span class="form1 font-weight-bold">
					2. Program Summary-
				</span>
				<span class="form1">
					brief overview of the Program, include discussions on the objectives, significance/impact of the study to the advancement of knowledge and to the society, methodology, and results of related Programs/projects previously handled by the same Program Leader, if any.
				</span>
			</p>

			<p class="form1 padding-left-2per">
				<span class="form1 font-weight-bold">
					3. Budget Summary-
				</span>
				<span class="form1">
					personnel services (PS), maintenance and other operating expenses (MOOE), and equipment outlay (EO) requirement of the whole program by source (including Counterpart Funds) for Year 1 and for the whole duration of the Program. Please refer to the DOST-GIA Guidelines for the details (Section IX.B of DOST Administrative Order (A.O.) 011, s. 2020).
				</span>
			</p>

			<p class="form1 padding-left-4per">
				<span class="form1 font-weight-bold">
					a. PS-
				</span>
				<span class="form1">
					total requirement for wages, salaries, honoraria, additional hire and other personnel benefits.
				</span>
			</p>
			<p class="form1 padding-left-4per">
				<span class="form1 font-weight-bold">
					b. MOOE
				</span>
				<span class="form1">
					total requirement for supplies and materials, travel expenses, communication, and other services.
				</span>
			</p>
			<p class="form1 padding-left-4per">
				<span class="form1 font-weight-bold">
					c. EO-
				</span>
				<span class="form1">
					total requirement for facilities and equipment needed by the Program.  Include existing equipment that are critical project components from other collaborating agency/ies.

				</span>
			</p>

			<p class="form1 padding-left-2per">
				<span class="form1 font-weight-bold">
					4. Number of Personnel Requirement-
				</span>
				<span class="form1">
					number of full time and part time personnel to be involved in the Program.
				</span>
			</p>

			<p class="form1 padding-left-2per">
				<span class="form1 font-weight-bold">
					5. Equipment Relevant to the Program- 
				</span>
				<span class="form1">
					existing equipment in the agency to be used in the Program and additional units to be purchased, if needed, and new equipment.  Include equipment as provided in the program line-item budget.
				</span>
			</p>

			<p class="form1 padding-left-2per">
				<span class="form1 font-weight-bold">
					6. Other Ongoing Programs Being Handled by the Program Leader-
				</span>
				<span class="form1">
					list of ongoing Programs/projects being handled by the Program Leader funded by the DOST-GIA Program and other sources, and the accompanying responsibilities relevant to the Program/project.
				</span>
			</p>

			<p class="form1 padding-left-2per">
				<span class="form1 font-weight-bold">
					7. Endorsed By-
				</span>
				<span class="form1">
					Head of the Agency or authorized representative who recommends the Program.
				</span>
			</p>
		</div>
	</div>
</body>
</html>