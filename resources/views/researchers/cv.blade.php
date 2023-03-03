<!DOCTYPE html>
<html>
   <head>
      <title>Researcher CV</title>
      <meta content="text/html; charset=UTF-8" http-equiv="content-type">
      <style type="text/css">
         body.researcher-cv > * {
            padding:0;
            margin:0;
            box-sizing: border-box;
         }

         body.researcher-cv {
            max-width: 1100pt;
            margin: auto;
         }
         table.researcher-cv{
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
         p.researcher-cv, span.researcher-cv {
            color: #000000;
            text-decoration: none;
            vertical-align: baseline;
            font-style: normal;
         }
         div.researcher-cv {
            padding: 0.1% 0;
         }

         table.researcher-cv p, table.researcher-cv span {
            line-height: 1;
            font-weight: 400;
            font-size: 7pt;
            font-family: "Arial";
         }

         .researcher-cv.text-center {
            text-align: center
         }

         .researcher-cv.clearfix {
            clear: both;
         }

         .researcher-cv.borderline {border-bottom: 2px solid black; margin: 1% 0;}
         
         table.researcher-cv .researcher-cv.c2 {
            text-align: center
         }

         table.researcher-cv .researcher-cv.c2 p.researcher-cv {
            font-weight: 700;
            font-size: 12pt;
            font-family: "Arial";
         }

         .researcher-cv.page-1, .researcher-cv.page-2 {
            padding: 3% 0 0 4%;
            font-size: 10pt;
            font-family: "Arial Narrow";
            page-break-after: always;
         }

         .researcher-cv.page-1 > div.researcher-cv, .researcher-cv.page-2 {
            margin: 1.5% 0;
         }
         .researcher-cv.page-2 > table:nth-of-type(2) tr:first-child td {
            text-align: center;
         }
         .researcher-cv.page-2 > table:nth-of-type(2) td span {
            font-size: 10pt;
            font-family: "Arial Narrow";
         }
         .researcher-cv.page-2 > table:nth-of-type(2) td {
            padding: 1% 0.5%;
         }

         .researcher-cv.wcol-2, .researcher-cv.wcol-3 {width: 100%; margin: 1% 0;}

         .researcher-cv.wcol-2 > div:not(:last-child),
         .researcher-cv.wcol-3 > div:not(:last-child){
            float: left;
            width: 50%;
            padding: 0 2px;
         }
         .researcher-cv.wcol-2 > div:not(:last-child)::before,
         .researcher-cv.wcol-3 > div:not(:last-child)::before{
            content:'\00a0';
         }
         .researcher-cv.wcol-3 > div:first-child {width: 5%;}
         .researcher-cv.wcol-3 > div:nth-child(2) {width: 10%;}
         .researcher-cv.wcol-3 > div:nth-child(3) {width: 80%;}
         .researcher-cv.wcol-2.val > div:first-child {width: 15%;}
         
         .researcher-cv.wcol-2.val > div:nth-child(2) {
            width: 85%;
            border-bottom: 1px solid black;
         }
         .researcher-cv.wcol-2.val > div:nth-child(2) > div,
         .researcher-cv.wcol-3 > div:nth-child(3) > div {
            width: 100%;
            border-bottom: 1px solid black;
         }
         .researcher-cv.display-picture-thumbnail {
            width: 350px;
            height: 350px;
            padding: .25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: .25rem;
            max-width: 100%;
            vertical-align: middle;
         }

         img.researcher-cv {
            max-width: 100%;
            max-height: 100%;
         }

      </style>
   </head>
   <body class="researcher-cv">
      <div class="researcher-cv2 text-center researcher-header">
         <div class="researcher-cv personal-info-picture">
            @if(!empty(Session::get('researcher')['profile_picture']))
               <img alt="Proponent picture`" src="{{ Session::get('researcher')['profile_picture'] }}" class="researcher-cv display-picture-thumbnail">
            @else
               <img alt="No image available" src="{{ asset('storage/images/util/no-image.png') }}" class="researcher-cv display-picture-thumbnail">
            @endif
         </div>
         <div class="researcher-cv reseracher-header-name">
            <h1 class="researcher-cv">
               {{ Session::get("researcher")["last_name"] ?? "N/A"}}, {{ Session::get("researcher")["first_name"] ?? "N/A"}}
            </h1>
         </div>
      </div>
      <hr>
      <div class="researcher-cv page-1">
         <div class="researcher-cv personal-info section-info">
            <h2 class="researcher-cv">I. Personal Info</h2>
            <div class="researcher-cv info-body">
               <div class="researcher-cv personal-information">
                  <div class="researcher-cv wcol-2 val researcher-name">
                     <div class="researcher-cv">
                        <span class="researcher-cv">Name:</span>
                     </div>
                     <div class="researcher-cv">
                        <span class="researcher-cv researcher-name">{{ trim(Session::get("researcher")["last_name"]) ?? "N/A"}}, {{ Session::get("researcher")["first_name"] ?? "N/A"}} </span>
                     </div>
                     <div class="researcher-cv clearfix"></div>
                  </div>
                  <div class="researcher-cv wcol-2 val researcher-sex">
                     <div class="researcher-cv">
                        <span class="researcher-cv">Sex:</span>
                     </div>
                     <div class="researcher-cv">
                        <span class="researcher-cv researcher-sex">
                           @if(isset(Session::get("researcher")["gender"]))
                              @if( Session::get("researcher")["gender"] == 1 )
                                 Male
                              @elseif( Session::get("researcher")["gender"] == 2 )
                                 Female
                              @else N/A
                              @endif
                           @endif
                        </span>
                     </div>
                     <div class="researcher-cv clearfix"></div>
                  </div>
                  <div class="researcher-cv wcol-2 val researcher-mobile">
                     <div class="researcher-cv">
                        <span class="researcher-cv">Mobile:</span>
                     </div>
                     <div class="researcher-cv">
                        <span class="researcher-cv researcher-mobile">{{ Session::get("researcher")["mobile"] ?? "N/A"}}</span>
                     </div>
                     <div class="researcher-cv clearfix"></div>
                  </div>
                  <div class="researcher-cv wcol-2 val researcher-expertise">
                     <div class="researcher-cv">
                        <span class="researcher-cv">Expertise:</span>
                     </div>
                     <div class="researcher-cv">
                        <span class="researcher-cv researcher-expertise">{{ Session::get("researcher")["expertise"] ?? "N/A"}}</span>
                     </div>
                     <div class="researcher-cv clearfix"></div>
                  </div>
                  <div class="researcher-cv wcol-2 val researcher-affiliation">
                     <div class="researcher-cv">
                        <span class="researcher-cv">Affiliation:</span>
                     </div>
                     <div class="researcher-cv">
                        <span class="researcher-cv researcher-affiliation">{{ Session::get("researcher")["affiliation"] ?? "N/A"}}</span>
                     </div>
                     <div class="researcher-cv clearfix"></div>
                  </div>
                  <div class="researcher-cv wcol-2 val researcher-other-affiliation">
                     <div class="researcher-cv">
                        <span class="researcher-cv">Other Affiliation:</span>
                     </div>
                     <div class="researcher-cv">
                        <span class="researcher-cv researcher-other-affiliation">{{ Session::get("researcher")["other_affiliation"] ?? "N/A"}}</span>
                     </div>
                     <div class="researcher-cv clearfix"></div>
                  </div>
                  <div class="researcher-cv wcol-2 val researcher-address">
                     <div class="researcher-cv">
                        <span class="researcher-cv">Address:</span>
                     </div>
                     <div class="researcher-cv">
                        <span class="researcher-cv researcher-address">{{ Session::get("researcher")["address"] ?? "N/A"}}</span>
                     </div>
                     <div class="researcher-cv clearfix"></div>
                  </div>
                  <div class="researcher-cv wcol-2 val researcher-designation">
                     <div class="researcher-cv">
                        <span class="researcher-cv">Designation:</span>
                     </div>
                     <div class="researcher-cv">
                        <span class="researcher-cv researcher-designation">{{ Session::get("researcher")["designation"] ?? "N/A"}}</span>
                     </div>
                     <div class="researcher-cv clearfix"></div>
                  </div>
                  <div class="researcher-cv wcol-2 val researcher-email">
                     <div class="researcher-cv">
                        <span class="researcher-cv">Email:</span>
                     </div>
                     <div class="researcher-cv">
                        <span class="researcher-cv researcher-email">{{ Session::get("researcher")["email"] ?? "N/A"}}</span>
                     </div>
                     <div class="researcher-cv clearfix"></div>
                  </div>
                  <div class="researcher-cv wcol-2 val researcher-nrcp-member">
                     <div class="researcher-cv">
                        <span class="researcher-cv">NRCP Member:</span>
                     </div>
                     <div class="researcher-cv">
                        <span class="researcher-cv researcher-nrcp-member">
                           @if(isset(Session::get("researcher")["nrcp_member"]))
                              @if( Session::get("researcher")["nrcp_member"] == 0 )
                                 No
                              @elseif( Session::get("researcher")["nrcp_member"] == 1 )
                                 Yes
                              @else N/A
                              @endif
                           @endif
                        </span>
                     </div>
                     <div class="researcher-cv clearfix"></div>
                  </div>
                  <div class="researcher-cv wcol-2 val researcher-profile-picture">
                     <div class="researcher-cv">
                        <span class="researcher-cv">Profile picture:</span>
                     </div>
                     <div class="researcher-cv">
                        <span class="researcher-cv researcher-profile-picture">{{ Session::get("researcher")["profile_picture"] ?? "N/A"}}
                        </span>
                     </div>
                     <div class="researcher-cv clearfix"></div>
                  </div>
               </div>
            </div>
            <div class="researcher-cv borderline"></div>
         </div>
         <div class="researcher-cv education-info section-info">
            <h2 class="researcher-cv">II. Education Info</h2>
            <div class="researcher-cv info-body">
               @if(!empty(Session::get("researcher")["educations"]) && count(Session::get("researcher")["educations"]) > 0)
                  @foreach (Session::get("researcher")["educations"] as $education)
                        <h3>{{ $education['school'] }}</h3>
                        <div class="researcher-cv wcol-2 val">
                           <div class="researcher-cv">
                              <span class="researcher-cv">Level:</span>
                           </div>
                           <div class="researcher-cv">
                              <span class="researcher-cv">{{ $education['level'] ?? "N/A"}}
                              </span>
                           </div>
                           <div class="researcher-cv clearfix"></div>
                        </div>
                        <div class="researcher-cv wcol-2 val">
                           <div class="researcher-cv">
                              <span class="researcher-cv">Degree:</span>
                           </div>
                           <div class="researcher-cv">
                              <span class="researcher-cv"><b>{{ $education['degree'] ?? "N/A"}}</b>
                              </span>
                           </div>
                           <div class="researcher-cv clearfix"></div>
                        </div>
                        <div class="researcher-cv wcol-2 val">
                           <div class="researcher-cv">
                              <span class="researcher-cv">Year Graduated:</span>
                           </div>
                           <div class="researcher-cv">
                              <span class="researcher-cv">{{ $education['year_graduated'] ?? "N/A"}}
                              </span>
                           </div>
                           <div class="researcher-cv clearfix"></div>
                        </div>
                        <div class="researcher-cv wcol-2 val">
                           <div class="researcher-cv">
                              <span class="researcher-cv">Awards:</span>
                           </div>
                           <div class="researcher-cv">
                              <span class="researcher-cv">{{ $education['awards'] ?? "N/A"}}
                              </span>
                           </div>
                           <div class="researcher-cv clearfix"></div>
                        </div>
                  @endforeach
               @else <h3>None</h3>
               @endif
            </div>
            <div class="researcher-cv borderline"></div>
         </div>
         <div class="researcher-cv projects-involved-info section-info">
            <h2 class="researcher-cv">III. Projects Involved</h2>
            <div class="researcher-cv info-body">
               @if(!empty(Session::get("researchers")["project_involved"]) && count(Session::get("researchers")["project_involved"]) > 0)
                  @foreach (Session::get("researchers")["project_involved"] as $project)
                        <h3>{{ $project['title'] }}</h3>
                        <div class="researcher-cv wcol-2 val">
                           <div class="researcher-cv">
                              <span class="researcher-cv">Start date:</span>
                           </div>
                           <div class="researcher-cv">
                              <span class="researcher-cv">{{ $project['start_date'] ?? "N/A"}}
                              </span>
                           </div>
                           <div class="researcher-cv clearfix"></div>
                        </div>
                        <div class="researcher-cv wcol-2 val">
                           <div class="researcher-cv">
                              <span class="researcher-cv">End date:</span>
                           </div>
                           <div class="researcher-cv">
                              <span class="researcher-cv">{{ $project['end_date'] ?? "N/A"}}
                              </span>
                           </div>
                           <div class="researcher-cv clearfix"></div>
                        </div>
                        <div class="researcher-cv wcol-2 val">
                           <div class="researcher-cv">
                              <span class="researcher-cv">Status:</span>
                           </div>
                           <div class="researcher-cv">
                              <span class="researcher-cv"><b>{{ $project['project_status'] ?? "N/A"}}</b>
                              </span>
                           </div>
                           <div class="researcher-cv clearfix"></div>
                        </div>
                        <div class="researcher-cv wcol-2 val">
                           <div class="researcher-cv">
                              <span class="researcher-cv">Reference:</span>
                           </div>
                           <div class="researcher-cv">
                              <span class="researcher-cv"><b>{{ $project['reference'] ?? "N/A"}}</b>
                              </span>
                           </div>
                           <div class="researcher-cv clearfix"></div>
                        </div>
                        <div class="researcher-cv wcol-2 val">
                           <div class="researcher-cv">
                              <span class="researcher-cv">Funding Agency:</span>
                           </div>
                           <div class="researcher-cv">
                              <span class="researcher-cv"><b>{{ $project['funding_agency'] ?? "N/A"}}</b>
                              </span>
                           </div>
                           <div class="researcher-cv clearfix"></div>
                        </div>
                        <div class="researcher-cv wcol-2 val">
                           <div class="researcher-cv">
                              <span class="researcher-cv">Role:</span>
                           </div>
                           <div class="researcher-cv">
                              <span class="researcher-cv"><b>{{ $project['role'] ?? "N/A"}}</b>
                              </span>
                           </div>
                           <div class="researcher-cv clearfix"></div>
                        </div>
                  @endforeach
               @else <h3>None</h3>
               @endif
            </div>
            <div class="researcher-cv borderline"></div>
         </div>
      </div>
   </body>
</html>
