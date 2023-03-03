# Online Submission and Evaluation of Proposals

## Table of contents

- [Overview](#overview)
  - [Description](#description)
  - [ERD](#erd)
  - [Forms](#forms)
  - [Process flow](#process-flow)
- [Users](#users)
  - [Privileges](#user-privileges)
  - [Functions](#user-functions)
- [Integration with other systems](#integration-with-other-systems)
  - [DPMIS](#dpmis)
  - [Palihan](#palihan)
   - [OSEP-Palihan API](#osep-palihan-api)


## Overview

##### Description

Online Submission and Evaluation of Proposals (OSEP) is a web-based information system that is used by the agency’s divisions, project managers, and evaluators in viewing, forwarding, and evaluating proposals and associated files received through DPMIS

##### ERD

![](./readme-images/osepdb-erd-1.png)
![](./readme-images/osepdb-erd-2.png)


##### Forms

*Coordinate with SDDMU for access in the Google Drive*
- [DOST Form 1 DETAILED RESEARCH & DEVELOPMENT PROGRAM PROPOSAL (For the Whole Program)](https://docs.google.com/document/d/1cijfG7ZRljwDWtBpaQku7X8PQCZSHVJO/edit)
- [DOST Form 2 (for Basic/Applied Research) DETAILED RESEARCH & DEVELOPMENT PROJECT PROPOSAL](https://docs.google.com/document/d/1DxYgqwzgpUPdziGN_SU_6Qpba6vO4Mho/edit#heading=h.gjdgxs)
- [DOST Form 2 (for Startups) DETAILED RESEARCH & DEVELOPMENT PROJECT PROPOSAL](https://docs.google.com/document/d/12LeG1cNfiHFZ0RoPUTddhfUyB0nmk8XN/edit#heading=h.gjdgxs)
- [DOST Form 3 NON-R&D PROJECT PROPOSAL (Technology Transfer, S&T Promotion and Linkages, Policy Advocacy, Provision of S&T Services, Human Resource Development and Capacity-Building)](https://docs.google.com/document/d/1z2RdLidvI3h-qtm6Jynyw3o3mWONnOvp/edit)


##### Process Flow

###### ***DPMIS to OSEP***
1. OED-R&D or OED-ARMSS will communicate with DOST-CO to open a *Call for Proposal*
2. Proponents will encode and submit their proposals in DPMIS
3. DOST-CO will evaluate the completeness of the encoded proposal and will determine which council will evaluate the proposal
4. If PCAARRD is identified to evaluate the proposal, DOST-CO will forward the proposal through the DPMIS-OSEP API
5. An email will also be sent to PCAARRD’s corporate email to notify the council that a proposal has been sent from DPMIS to OSEP
6. If the proposal has been successfully sent to OSEP, it will appear in  the **From DPMIS** tab
7. OED-R&D will open their account in OSEP (as admin) to verify the completeness of the proposal.
8. If the proposal is complete, the admin account must click on the **Action▼**button, then select the **Received** button to acknowledge that PCAARRD has received the proposal from DPMIS
9. After verifying the completeness of the proposal, OED-R&D/OED-ARMSS will then identify the divisions to evaluate the proposal
10. OED-R&D/OED-ARMSS will then forward the proposal to the identified divisions by clicking the **Action▼**button and then selecting the **Forward Proposal**, they will need to identify the **Lead TRD** and **Co-evaluator**
11. Each division that was identified as evaluators will then identify within its division the PMT managers and/or ISP managers to evaluate the proposals, the division account will need to click the **Action▼**button - and then select the **Forward Proposal**
12. PMT managers and/or ISP managers will be allowed to comment  on the proposals for n days, after that commenting will be disabled
13. The **Lead TRD** will check all the comments of the proposal and will decide which one to keep or update, they will need to click on the **Action▼** button and then select the Consolidate Comments.
14. After the lead TRD has consolidated the comments, OED-R&D/OED-ARMSS will then check on the consolidated comments and will have the final list of comments to send to DPMIS.
15. The proponent will now act upon the comments, after proposal revision, the proposal will now be endorsed to the DC/GC/Execomm meeting.
16. If the proposal is approved in the meeting, the proposal will then be forwarded to **Palihan** through the OSEP-Palihan API


###### ***OSEP to Palihan***
- If the proposal is approved, it will be sent to **Palihan** through the OSEP-Palihan API


## Users

##### User Privileges

1. **Administrator**
   - System administrator. Can perform all administration and other functions. (OED-R&D)
2. **Cluster**
   - OED-R&D and OED-ARMSS. Checks the completeness of the proposal forwarded from DPMIS then forwards the proposal *Division accounts*

3. **Division**
   - TRDs. Receives the forwarded proposal from OED-R&D or OED-ARMSS, forward the proposal to individual TREP or PMs to evaluate
4. **TREP**
   - TREP, evaluates the proposal and provide comments

##### Functions

1. **Administrator**
   - All actions for proposals
   - Administrative functions (includes account management and system library management)

2. **Cluster**
   - All actions for proposals for their cluster
   - Administrative functions (includes account management and system library management)


3. **Division**
   - View proposal
   - View researcher info
   - Comment on proposal
   - Download files
   - Forward Proposal (PMs)
   - Endorse to DC
   - Endorsed, Approved, Disapproved (DC, GC, Execom, Usec for R & D)
   - Request for revision
   - Disapprove proposal
   - Refer proposal to other institution
   - Withdraw proposal
   - Review proposal


4. **TREP**
   - View proposal
   - View researcher info
   - Comment on proposal
   - Download files


## Integration with other systems

- DPMIS
- Palihan
   - OSEP-Palihan API
      - [**Mapping Document**](https://docs.google.com/spreadsheets/d/16GG-Pph0NT2GA2Y-7uSFKl8C9jybEj_g/edit#gid=1782225542)

      - *Accepted JSON object sent to OSEP-Palihan API*
   ```Json
   {
      "tracking_code":"2021-07-A2-PCAARRD-2023-5551",
      "title":"Population biology of the blue swimming crab (Portunus pelagicus) in Sulu",
      "program":{
         "name":"Population biology of the blue swimming crab (Portunus pelagicus) in Sulu",
         "researcher":{
            "first_name":"Maribelle",
            "middle_name":"Tambihul",
            "last_name":"Hanani",
            "sex":"Female",
            "agency":{
               "name":"Mindanao State University - Sulu Development Technical College",
               "acronym":"Mindanao State University - Sulu Development Technical College"
            }
         }
      },
      "start_date":"2021",
      "end_date":"2023",
      "approved_implementation_start_date" : "2021-02-03 10:00:00",
      "approved_implementation_end_date" : "2023-02-03 10:00:00",
      "description":"\"\"",
      "objectives":"General Objective: \"<p>The primary objective of this study is to assess P. pelagicus stock in Sulu, with emphasis on population biology parameters.</p>\" Specific Objective: \"<p>The specific objectives of this research are:<br />1. Perform a monthly collection of P. pelagicus for a period of 12 months;<br />2. Characterize the length-weight relationship of local P. pelagicus stock;<br />3. Calculate the growth parameters, asymptotic length (L\u221e) and growth rate constant (K), from the length-frequency distribution using the von Bertalanffy growth function (VBGF);<br />4. Use the calculated growth parameters to infer recruitment patterns and estimate rates of mortality and exploitation;<br />5. Calculate reproductive biology parameters, specifically (a) sex ratio, (b) temporal patterns of female maturity stages, (b) gonado-somatic index (GSI), (c) size at sexual maturity, (d) fecundity;<br />6. Use the reproductive biology parameters to identify spawning season;<br />7. Determine the occurrence of cryptic Portunus species through genetic barcoding; and<br />8. Characterize differences on the biological parameters between P. pelagicus sensu stricto and the cryptic Portunus species.</p>\"",
      "beneficiaries":"\"<p>BARMM; Sitio Usadda, Pangutaran Sulu Fisher folk Community</p>\"",
      "totalyear":"2",
      "expectedoutput":"Publication: \"<ol>\r\n<li>At least one (\u22641) publication in a peer-reviewed journal on the assessment on the biological parameters: i.e; growth, reproduction, mortality, and exploitation of P. pelagicus.</li>\r\n<li>One (1) publication on the relative frequencies of P. pelagicus sensu stricto and the cryptic Portunus sp. in Sulu, as well as the fingerprinting assays developed for rapid identification.</li>\r\n</ol>\"Patent: \"<p>NA</p>\"Product: \"<ol>\r\n<li>A baseline information and protocol that can be used for succeeding projects on the growth performance of Portunus pelagicus in Sulu.</li>\r\n<li>Genetic sequences of Portunus pelagicus in Sulu that can be supplemented in existing databases.</li>\r\n</ol>\"People: \"<ol>\r\n<li>Two (2) project personnel that will be introduced and trained in laboratory aspects.</li>\r\n<li>Two (2) undergraduate student who can work on certain aspects of the research for their thesis.</li>\r\n</ol>\"Place: \"<ol>\r\n<li>One (1) Memorandum of Agreement between MSU-Sulu and UP Mindanao</li>\r\n<li>One (1) Prior Informed Consent from the local government unit of Pangutaran, Sulu, BARMM</li>\r\n</ol>\"Policy: \"<p>A policy brief on the management of P. pelagicus in Sulu. Specifically, the policy brief will (1) set the minimum landing catch size to protect juveniles, (2) propose a ban on catching during spawning season, and (3) enforce a monitoring scheme to confirm that the proposed policies are correctly implemented.</p>\"",
      "rationale":"\"<p>The blue swimming crab is among the commodity focus of the Agriculture, aquatic and natural resources (AANR) research and development agenda of DOST. Since P. pelagicus exhibit strong area-specific biological differences, assessing the local BSC stock in Sulu will ensure that the biological information that will serve as basis for management policies are appropriate for the region. Furthermore, the integration of molecular identification to screen the dataset assures that the population parameters are not confounded by the presence of P. pelagicus sensu stricto and the cryptic Portunus sp. Lastly, the sequence data can be used to develop a fingerprinting assay that can be used as a rapid and cheaper alternative for species identification.</p>\"",
      "abstract":"NULL",
      "agencies":[
         {
            "name":"University of the Philippines Mindanao",
            "acronym":"University of the Philippines Mindanao",
            "type":"Implementing"
         },
         {
            "name":"",
            "acronym":"",
            "type":"Implementing"
         },
         {
            "name":"University of the Philippines Mindanao",
            "acronym":"University of the Philippines Mindanao",
            "type":"Implementing"
         },
         {
            "name":"",
            "acronym":"",
            "type":"Implementing"
         }
      ],
      "researchers":[
         {
            "first_name":"Maribelle",
            "middle_name":"Tambihul",
            "last_name":"Hanani",
            "sex":"Female",
            "is_lead":1,
            "agency":{
               "name":"Mindanao State University - Sulu Development Technical College",
               "acronym":"Mindanao State University - Sulu Development Technical College"
            }
         }
      ],
      "sites":[
         {
            "region":{
               "palihan_region_id":14,
               "region_name":"Region XI (Davao Region)"
            },
            "province":{
               "palihan_province_id":48,
               "province_name":"Davao del Sur"
            },
            "municipal":{
               "palihan_municipal_id":602,
               "municipal_name":"Davao City"
            }
         },
         {
            "region":{
               "palihan_region_id":17,
               "region_name":"Autonomous Region in Muslim Mindanao (ARMM)"
            },
            "province":{
               "palihan_province_id":95,
               "province_name":"Sulu"
            },
            "municipal":{
               "palihan_municipal_id":1193,
               "municipal_name":"Pangutaran"
            }
         }
      ],
      "lib_items":[
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":343828.80000000005,
            "expense":"PS",
            "group":"Salaries",
            "class":"Science Research Analyst",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":{
               "id":271,
               "name":"Science Research Analyst",
               "year_of_rate":"2021"
            }
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":281548.80000000005,
            "expense":"PS",
            "group":"Salaries",
            "class":"Science Research Assistant",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":{
               "id":264,
               "name":"Science Research Assistant",
               "year_of_rate":"2021"
            }
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":105600,
            "expense":"PS",
            "group":"Honorarium",
            "class":"Project Leader",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":{
               "id":181,
               "name":"Project Leader",
               "year_of_rate":"2009"
            }
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":90000,
            "expense":"PS",
            "group":"Honorarium",
            "class":"Project Staff Level 3",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":{
               "id":182,
               "name":"Project Staff Level 3",
               "year_of_rate":"2009"
            }
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":90000,
            "expense":"PS",
            "group":"Honorarium",
            "class":"Project Staff Level 3",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":{
               "id":182,
               "name":"Project Staff Level 3",
               "year_of_rate":"2009"
            }
         },
         {
            "cost_type":1,
            "year":"2",
            "quantity":"1",
            "amount":6000,
            "expense":"PS",
            "group":"Honorarium",
            "class":"Program/Project Support Staff Level 2",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":{
               "id":183,
               "name":"Program/Project Support Staff Level 2",
               "year_of_rate":"2009"
            }
         },
         {
            "cost_type":1,
            "year":"2",
            "quantity":"1",
            "amount":6000,
            "expense":"PS",
            "group":"Honorarium",
            "class":"Program/Project Support Staff Level 2",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":{
               "id":183,
               "name":"Program/Project Support Staff Level 2",
               "year_of_rate":"2009"
            }
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":276865.2,
            "expense":"PS",
            "group":"Honorarium",
            "class":"Project Leader",
            "funding_agency":{
               "name":"Mindanao State University - Sulu Development Technical College",
               "acronym":"Mindanao State University - Sulu Development Technical College"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":{
               "id":181,
               "name":"Project Leader",
               "year_of_rate":"2009"
            }
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":160114.2,
            "expense":"PS",
            "group":"Honorarium",
            "class":"Project Staff Level 3",
            "funding_agency":{
               "name":"Mindanao State University - Sulu Development Technical College",
               "acronym":"Mindanao State University - Sulu Development Technical College"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":{
               "id":182,
               "name":"Project Staff Level 3",
               "year_of_rate":"2009"
            }
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":483411.6,
            "expense":"PS",
            "group":"Honorarium",
            "class":"Project Staff Level 3",
            "funding_agency":{
               "name":"University of the Philippines Mindanao",
               "acronym":"University of the Philippines Mindanao"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":{
               "id":182,
               "name":"Project Staff Level 3",
               "year_of_rate":"2009"
            }
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"58000.00",
            "expense":"MOOE",
            "group":"Traveling Expenses",
            "class":"Traveling Expenses-Local ",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"50000.00",
            "expense":"MOOE",
            "group":"Traveling Expenses",
            "class":"Traveling Expenses-Local ",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"2000.00",
            "expense":"MOOE",
            "group":"Communication Expenses",
            "class":"Postage and Courier Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"7200.00",
            "expense":"MOOE",
            "group":"Communication Expenses",
            "class":"Telephone Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"17988.00",
            "expense":"MOOE",
            "group":"Communication Expenses",
            "class":"Internet Subscription Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"5000.00",
            "expense":"MOOE",
            "group":"Other Maintenance and Operating Expenses",
            "class":"Transportation and Delivery Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"15125.00",
            "expense":"MOOE",
            "group":"Supplies and Materials Expenses",
            "class":"Office Supplies Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"58650.00",
            "expense":"MOOE",
            "group":"Supplies and Materials Expenses",
            "class":"Other Supplies and Materials Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"10000.00",
            "expense":"MOOE",
            "group":"Other Maintenance and Operating Expenses",
            "class":"Printing and Publication Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"57000.00",
            "expense":"MOOE",
            "group":"Other Maintenance and Operating Expenses",
            "class":"Rent/Lease Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"8400.00",
            "expense":"MOOE",
            "group":"Other Maintenance and Operating Expenses",
            "class":"Representation Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"20000.00",
            "expense":"MOOE",
            "group":"Other Maintenance and Operating Expenses",
            "class":"Subscription Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"50000.00",
            "expense":"MOOE",
            "group":"Professional Services",
            "class":"Consultancy Services",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"100000.00",
            "expense":"MOOE",
            "group":"Professional Services",
            "class":"Other Professional Services",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"50000.00",
            "expense":"MOOE",
            "group":"Labor and Wages",
            "class":"Labor and Wages",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"8400.00",
            "expense":"MOOE",
            "group":"Taxes, Insurance Premiums and Other Fees",
            "class":"Insurance Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"2",
            "quantity":"1",
            "amount":"20000.00",
            "expense":"MOOE",
            "group":"Training and Scholarship Expenses",
            "class":"Training Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":1,
            "year":"2",
            "quantity":"1",
            "amount":"28997.20",
            "expense":"MOOE",
            "group":"Utility Expenses",
            "class":"Electricity Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":"Mindanao State University - Sulu Development Technical College",
               "acronym":"Mindanao State University - Sulu Development Technical College"
            },
            "position":[
               
            ]
         },
         {
            "cost_type":1,
            "year":"2",
            "quantity":"1",
            "amount":"48328.00",
            "expense":"MOOE",
            "group":"Supplies and Materials Expenses",
            "class":"Office Supplies Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":"Mindanao State University - Sulu Development Technical College",
               "acronym":"Mindanao State University - Sulu Development Technical College"
            },
            "position":[
               
            ]
         },
         {
            "cost_type":1,
            "year":"2",
            "quantity":"1",
            "amount":"19331.00",
            "expense":"MOOE",
            "group":"Other Maintenance and Operating Expenses",
            "class":"Printing and Publication Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":"Mindanao State University - Sulu Development Technical College",
               "acronym":"Mindanao State University - Sulu Development Technical College"
            },
            "position":[
               
            ]
         },
         {
            "cost_type":1,
            "year":"2",
            "quantity":"1",
            "amount":"96656.20",
            "expense":"MOOE",
            "group":"Utility Expenses",
            "class":"Other Utility Expenses",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"1",
            "quantity":"1",
            "amount":"100000.00",
            "expense":"EO",
            "group":"EO Direct Cost",
            "class":"",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"1",
            "quantity":"1",
            "amount":"75000.00",
            "expense":"EO",
            "group":"EO Direct Cost",
            "class":"",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"1",
            "quantity":"1",
            "amount":"250000.00",
            "expense":"EO",
            "group":"EO Direct Cost",
            "class":"",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"1",
            "quantity":"2",
            "amount":"70000.00",
            "expense":"EO",
            "group":"EO Direct Cost",
            "class":"",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"1",
            "quantity":"1",
            "amount":"55000.00",
            "expense":"EO",
            "group":"EO Direct Cost",
            "class":"",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"1",
            "quantity":"1",
            "amount":"55000.00",
            "expense":"EO",
            "group":"EO Direct Cost",
            "class":"",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"1",
            "quantity":"1",
            "amount":"60000.00",
            "expense":"EO",
            "group":"EO Direct Cost",
            "class":"",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"1",
            "quantity":"1",
            "amount":"65000.00",
            "expense":"EO",
            "group":"EO Direct Cost",
            "class":"",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"1",
            "quantity":"1",
            "amount":"60000.00",
            "expense":"EO",
            "group":"EO Direct Cost",
            "class":"",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         },
         {
            "cost_type":0,
            "year":"1",
            "quantity":"1",
            "amount":"60000.00",
            "expense":"EO",
            "group":"EO Direct Cost",
            "class":"",
            "funding_agency":{
               "name":"Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development",
               "acronym":"PCAARRD"
            },
            "implementing_agency":{
               "name":null,
               "acronym":null
            },
            "position":[
               
            ]
         }
      ]
   }
   ```
