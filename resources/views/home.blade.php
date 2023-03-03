@extends('layouts.app')

@section('content')

<section class="content-header">

  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Home</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active"><a href="{{ route('home')}}">Home</a></li>
        </ol>
      </div>
    </div>
  </div>
</section>
<hr>
<section class="content">
  <div class="container-fluid">
    <div class="clearfix">
      <button type="button"  style="background-color:#1e88c3;" class="btn btn-info btn-lg float-right" data-toggle="modal" data-target="#dashboard_filters">
        <i class="fas fa-filter pr-1"></i>
        <span>Filters</span>
      </button>
    </div>
    <div class="row py-3">
      <div class="col-md-12">
        <div class="alert alert-info" style="background-color:#1e88c3;" role="alert">
          <div class="text-center">
            <h3>
              Applied Filters:
            </h3>
          </div>
          <hr>
          <ul>
            <!-- <li class="py-3">
              Date Range: <label id="date_range"></label>
            </li> -->
            <li class="py-3">
              Date Received (from DPMIS): <label id="date_received"></label>
            </li>
            <li class="py-3">
              Lead TRD: <label id="lead_trd"></label>
            </li>
          </ul>
        </div>
      </div>
    </div>
   <div class="row">
      <div class="col-md-2">
        <div class="small-box bg-primary">
          <div class="inner">
            <h5>
              <!-- {{ $total_count ?? 0 }}  -->
              <span id="count_proposals"></span>
            </h5>
            <p>Total Proposals</p>
          </div>
          <div class="icon">
            <i class="fas fa-clipboard-list"></i>
          </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="small-box bg-secondary">
          <div class="inner">
            <h5>
              <!-- {{ $fromdpmis ?? 0 }}  -->
              <span id="count_from_dpmis"></span>
            </h5>
            <p>From DPMIS</p>
          </div>
          <div class="icon">
            <i class="fas fa-plus"></i>
          </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="small-box bg-info">
          <div class="inner">
            <h5>
              <!-- {{ $received ?? 0 }}  -->
              <span id="count_received"></span>
            </h5>
            <p>Received</p>
          </div>
          <div class="icon">
            <i class="fas fa-check"></i>
          </div>
        </div>
      </div>


      <div class="col-md-2">
        <div class="small-box bg-warning">
          <div class="inner">
            <h5>
              <!-- {{ $under_evaluation ?? 0 }}  -->
              <span id="count_under_evaluation"></span>
            </h5>
            <p>Under Evaluation</p>
          </div>
          <div class="icon">
            <i class="fas fa-search"></i>
          </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="small-box bg-success">
          <div class="inner">
            <h4>
              <!-- {{ $approved ?? 0 }}  -->
              <span id="count_approved"></span>
            </h4>
            <p>Approved</p>
          </div>
          <div class="icon">
            <i class="fas fa-thumbs-up"></i>
          </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="small-box bg-danger">
          <div class="inner">
            <h4>
              <!-- {{ $disapproved ?? 0 }}  -->
              <span id="count_disapproved"></span>
            </h4>
            <p>Disapproved</p>
          </div>
          <div class="icon">
            <i class="fas fa-thumbs-down"></i>
          </div>
        </div>
      </div>
   
      </div>
    <div class="row py-3">
      <div class="col-md-4">
        <div class="card py-3">
          <div class="card-header">
            <h5 class="text-center">
              Proposal Count by Month
            </h5>
          </div>
          <div class="card-body">
            <canvas id="proposal_count_by_month"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card py-3">
          <div class="card-header">
            <h5 class="text-center">
              Proposal Count by Quarter
            </h5>
          </div>
          <div class="card-body">
            <canvas id="proposal_count_by_quarter"></canvas>  
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card py-3">
          <div class="card-header">
            <h5 class="text-center">
              Proposal Count by Year
            </h5>
          </div>
          <div class="card-body">
            <canvas id="proposal_count_by_year"></canvas>  
          </div>
        </div>
      </div>
    </div>
    <!-- Drei -->
    <div class="row py-3">
      <div class="col-md-6">
        <div class="card py-3">
          <div class="card-header">
            <h5 class="text-center">
              Proposal Count by TRD
            </h5>
          </div>
          <div class="card-body">
            <canvas id="proposal_count_by_trd"></canvas>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card py-3">
          <div class="card-header">
            <h5 class="text-center">
              Proposal Count by Type
            </h5>
          </div>
          <div class="card-body">
            <canvas id="proposal_count_by_type"></canvas>  
          </div>
        </div>
      </div>
    </div>
   
    <div class="row py-3">
      <div class="col-md-6">
        <div class="card py-3">
          <div class="card-header">
            <h5 class="text-center">
            Proposal Count by Agency (Table)
            </h5>
          </div>
          <div class="card-body" style="height:500px;  overflow-x:auto;">
          <div id="table_count_agency"></div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card py-3">
          <div class="card-header">
            <h5 class="text-center">
            Proposal Count by Region (Table)
            </h5>
          </div>
          <div class="card-body" style="height:500px;  overflow-x:auto;">
          <div id="table_count_region"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="row py-3">
    <div class="col-md-6">
        <div class="card py-3">
          <div class="card-header">
            <h5 class="text-center">
            Proposal Count by Call (Table)
            </h5>
          </div>
          <div class="card-body" style="height:300px;  overflow-x:auto;">
          <div id="table_count_call"></div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card py-3">
          <div class="card-header">
            <h5 class="text-center">
            Proposal Count by TRD (Table)
            </h5>
          </div>
          <div class="card-body" style="height:300px;  overflow-x:auto;">
          <div id="table_count_trd"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="row py-3" >
    <div class="col-md-6" style="display:none;">
        <div class="card py-3">
          <div class="card-header">
            <h5 class="text-center">
              Proposal Count by Call
            </h5>
          </div>
          <div class="card-body">
            <canvas id="proposal_count_by_call" height="250px"></canvas>  
          </div>
        </div>
    </div>

    <div class="col-md-6"  style="display:none;">
        <div class="card py-3">
          <div class="card-header">
            <h5 class="text-center">
              Proposal count by Region
            </h5>
          </div>
          <div class="card-body">
            <canvas id="proposal_count_by_region" height="250px"></canvas>  
          </div>
        </div>
      </div>
    </div>

    <div class="row py-3" style="display:none;">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">
              Proposal Count by Agency
            </h5>
          </div>
          <div class="card-body">
            <canvas id="proposal_count_by_agency"></canvas>  
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="row py-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">
              Implementation Site Count of Proposals by Region
            </h5>
          </div>
          <div class="card-body">
            <canvas id="proposal_count_by_region1"></canvas>  
          </div>
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">
              DOST Budget
            </h5>
          </div>
          <div class="card-body">
            <canvas id="dost_budget"></canvas>  
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">
              Counterpart Budget
            </h5>
          </div>
          <div class="card-body">
            <canvas id="counterpart_budget"></canvas>  
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="modal fade" id="dashboard_filters" tabindex="-1" role="dialog" aria-labelledby="dashboard_filters_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dashboard_filters_label">Filters</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled">
          <!-- <li class="py-3">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>
                    Start Month:
                  </label>
                  <select id="filter_start_month" class="form-control filter-reports">
                    <option value="" disabled hidden selected></option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>
                    Start Year:
                  </label>
                  <select id="filter_start_year" class="form-control filter-reports">
                    <option value="" disabled hidden selected></option>
                    @for($i=2000; $i<=2040; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>
          </li>
          <li class="py-3">
           <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>
                    End Month:
                  </label>
                  <select id="filter_end_month" class="form-control filter-reports">
                    <option value="" disabled hidden selected></option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>
                    End Year:
                  </label>
                  <select id="filter_end_year" class="form-control filter-reports">
                    <option value="" disabled hidden selected></option>
                    @for($i=2000; $i<=2040; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>
          </li> -->
          <li class="py-3">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>
                    Start Month (Date received):
                  </label>
                  <select id="filter_date_received_start_month" class="form-control filter-reports">
                    <option value="" disabled hidden selected></option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>
                    Start Year (Date received):
                  </label>
                  <select id="filter_date_received_start_year" class="form-control filter-reports">
                    <option value="" disabled hidden selected></option>
                    @for($i=2000; $i<=2040; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>
          </li>
          <li class="py-3">
           <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>
                    End Month (Date received):
                  </label>
                  <select id="filter_date_received_end_month" class="form-control filter-reports">
                    <option value="" disabled hidden selected></option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>
                    End Year (Date received):
                  </label>
                  <select id="filter_date_received_end_year" class="form-control filter-reports">
                    <option value="" disabled hidden selected></option>
                    @for($i=2000; $i<=2040; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                </div>
              </div>
            </div>
          </li>
          <li class="py-3">
           <div class="row">
              <div class="col-md-12">
                <div class="filter_lead_trd_fg form-group">
                  <label>
                    Lead TRD:
                  </label>
                  <select id="filter_lead_trd" type="text" name="filter_lead_trd" class="form-control select2 filter-reports" multiple="multiple">
                  @foreach ($divisions as $division)
                    <option value="{{ $division->id }}" selected="selected"> {{ $division->division_acronym }}</option>
                  @endforeach
                </select>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="filter_report" type="button" class="btn btn-info">Filter</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
      let filters = {};
      var dost_colors = [
        '#288cca',
        '#047234',
        '#90c53f',
        '#48c4d3',
        '#1034ef'
      ];
      
      var colors_array = 
      [  
        '#CC0066',
        '#99CC66',
        '#CC00FF',
        '#666699',
        '#999966',
        '#FF0033',
        '#FFCC66',
        '#9900FF',
        '#6600FF',
        '#336666',
        '#CC99CC',
        '#CCFF66',
        '#3366FF',
        '#6699FF',
        '#333399',
        '#66CC66',
        '#CCFF00',
        '#009933',
        '#000066',
        '#FFFF00',
        '#CC9966',
        '#FF6699',
        '#99FF33',
        '#666666',
        '#FF0000',
        '#99FF66',
        '#CC6666',
        '#3366CC',
        '#660066',
        '#669966',
        '#99CC33',
        '#9966CC',
        '#3333CC',
        '#FF6633',
        '#3399FF',
        '#336633',
        '#9933FF',
        '#339999',
        '#FF3333',
        '#CC66FF',
        '#9933CC',
        '#339900',
        '#66CC00',
        '#CC99FF',
        '#006633',
        '#33FF66',
        '#FF6666',
        '#CCFFCC',
        '#990000',
        '#006666',
        '#6666FF',
        '#99FF00',
        '#CCCC99',
        '#99CC00',
        '#FF66CC',
        '#0000CC',
        '#00FF00',
        '#CC9999',
        '#00FF99',
        '#660000',
        '#33FF33',
        '#6633FF',
        '#990099',
        '#330099',
        '#330066',
        '#CC3399',
        '#33CC99',
        '#00CC00',
        '#00CCCC',
        '#999900',
        '#99FF99',
        '#FF3366',
        '#CC6699',
        '#3333FF',
        '#00CC33',
        '#33FF99',
        '#FFCCCC',
        '#99FFCC',
        '#0066CC',
        '#0099CC',
        '#CC3333',
        '#0099FF',
        '#CC00CC',
        '#003366',
        '#CCFFFF',
        '#996633',
        '#FFCC00',
        '#660033',
        '#996600',
        '#66FF66',
        '#006699',
        '#9900CC',
        '#3300FF',
        '#33FFCC',
        '#336699',
        '#99FFFF',
        '#33CCFF',
        '#CCCC33',
        '#3399CC',
        '#00FF33',
        '#66FF99',
        '#66CC33',
        '#990066',
        '#003333',
        '#CCCC00',
        '#00CCFF',
        '#993333',
        '#66CC99',
        '#333366',
        '#330033',
        '#993300',
        '#993366',
        '#669999',
        '#00FFCC',
        '#33CC00',
        '#CCCC66',
        '#00FF66',
        '#FF3300',
        '#9999CC',
        '#FFFFCC',
        '#333300',
        '#FF99CC',
        '#99CCFF',
        '#FFFF33',
        '#CC66CC',
        '#999933',
        '#3300CC',
        '#6600CC',
        '#999999',
        '#CC6633',
        '#990033',
        '#CC0099',
        '#003300',
        '#66FF00',
        '#6699CC',
        '#9966FF',
        '#00CC66',
        '#666600',
        '#FF00CC',
        '#0033CC',
        '#CC33FF',
        '#FF9933',
        '#6666CC',
        '#009966',
        '#339966',
        '#FF9999',
        '#FF9900',
        '#003399',
        '#0066FF',
        '#9999FF',
        '#FF33FF',
        '#996666',
        '#CCCCCC',
        '#000099',
        '#99CC99',
        '#336600',
        '#CC3300',
        '#00FFFF',
        '#33CC66',
        '#FF66FF',
        '#663333',
        '#00CC99',
        '#66CCCC',
        '#663399',
        '#FF0099',
        '#33FF00',
        '#FFCCFF',
        '#FF3399',
        '#FFCC99',
        '#66FFFF',
        '#CCCCFF',
        '#CC0033',
        '#663300',
        '#669933',
        '#33CCCC',
        '#33FFFF',
        '#66CCFF',
        '#99CCCC',
        '#CC3366',
        '#006600',
        '#009999',
        '#0000FF',
        '#CC9933',
        '#660099',
        '#FF0066',
        '#FF00FF',
        '#0033FF',
        '#FFCC33',
        '#33CC33',
        '#FFFF99',
        '#CCFF33',
        '#663366',
        '#CCFF99',
        '#000033',
        '#FF99FF',
        '#993399',
        '#CC9900',
        '#333333',
        '#FF33CC',
        '#FFFF66',
        '#669900',
        '#6633CC',
        '#66FFCC',
        '#996699',
        '#666633',
        '#66FF33',
        '#CC6600',
        '#339933',
        '#CC0000',
        '#FF9966',
        '#330000',
        '#CC33CC',
        '#FF6600',
        '#009900'
      ]

         // Added by Drei: alwaysShowTooltip plugin block
        const alwaysShowTooltip = {
        id: 'alwaysShowTooltip',
        afterDraw(chart, args, options){
          const { ctx } = chart;
          ctx.save();
          // console.log(chart)
           chart.data.datasets.forEach((dataset,i) => {
              chart.getDatasetMeta(i).data.forEach((datapoint, index) => {
              const {x, y} = datapoint.tooltipPosition();
              // console.log(datapoint.tooltipPosition());

              // console.log(chart.data.datasets[i].data[index]);
              const text = chart.data.labels[index]+ ': '+ chart.data.datasets[i].data[index];
              const textWidth = ctx.measureText(text).width;
              // console.log(textWidth);
              
              ctx.fillStyle = 'rgba(0,0,0, 0.8)';
         
              ctx.fillRect(x - ((textWidth+2)/2), y -25 , textWidth+2, 20);

              //triangle
              ctx.beginPath();
              ctx.moveTo(x, y);
              ctx.lineTo(x - 5, y - 5);
              ctx.lineTo(x + 5, y - 5);
              ctx.fill();
              ctx.restore();

              //text
              ctx.font = '12px Arial';
              ctx.fillStyle = 'white';
              ctx.fillText(text, x - (textWidth / 2), y - 10);
              ctx.restore();
            })
          })
        }
      };
      //end show tool tip plugin block

      var ctxbar = $('#proposal_count_by_trd')[0].getContext('2d');
      var proposal_count_by_trd = new Chart(ctxbar, {
          type: 'bar',
          options: {
          legend: {
              display: false
            }
          },
          plugins: [alwaysShowTooltip]
      });

      var ctxbar = $('#proposal_count_by_call')[0].getContext('2d');
      var proposal_count_by_call = new Chart(ctxbar, {
          type: 'pie',
          options: {
          legend: {
              display: true
            }
          }
      });

      var ctxpie = $('#proposal_count_by_type')[0].getContext('2d');
      var proposal_count_by_type = new Chart(ctxpie, {
          type: 'pie',
          plugins: [alwaysShowTooltip]
      });

      var ctxpie = $('#proposal_count_by_agency')[0].getContext('2d');
      var proposal_count_by_agency = new Chart(ctxpie, {
          type: 'pie'
      });
       

      var ctxpie = $('#proposal_count_by_region')[0].getContext('2d');
      var proposal_count_by_region = new Chart(ctxpie, {
          type: 'pie',
      });

      var ctxbar = $('#dost_budget')[0].getContext('2d');
      var dost_budget = new Chart(ctxbar, {
          type: 'pie',
          options: {
            tooltips: {
            enabled: false
            },
            legend: {
              display: false
            },
            scales: {
              yAxes:[{
                  stacked:true,
                  gridLines: {
                    display:true,
                    color:"rgba(255,99,132,0.2)"
                  },
                  ticks: {
                          min: 0,
                          callback: function(value, index, values) {
                              if (Math.floor(value) === value) {
                                  return value;
                              }
                          }
                      }
              }],
              xAxes:[{
                  gridLines: {
                    display:false
                  }
              }]
            }
          },
          plugins: [alwaysShowTooltip]
      });

      var ctxbar = $('#counterpart_budget')[0].getContext('2d');

      var counterpart_budget = new Chart(ctxbar, {
          type: 'pie',
          options: {
            tooltips: {
            enabled: false
            },
            legend: {
              display: false
            },
            scales: {
              yAxes:[{
                  stacked:true,
                  gridLines: {
                    display:true,
                    color:"rgba(255,99,132,0.2)"
                  },
                  ticks: {
                    min: 0,
                    callback: function(value, index, values) {
                      if (Math.floor(value) === value) {
                          return value;
                      }
                    }
                  }
              }],
              xAxes:[{
                  gridLines: {
                    display:false
                  }
              }]
            }
          },
          plugins: [alwaysShowTooltip]
      });

      var ctxline = $('#proposal_count_by_month')[0].getContext('2d');
      var proposal_count_by_month = new Chart(ctxline, {
          type: 'line',
          options: {
            legend: {
              display: false
            }
          }
      });

      var ctxline = $('#proposal_count_by_quarter')[0].getContext('2d');
      var proposal_count_by_quarter = new Chart(ctxline, {
          type: 'line',
          options: {
            legend: {
              display: false
            }
          }
      });

      var ctxline = $('#proposal_count_by_year')[0].getContext('2d');
      var proposal_count_by_year = new Chart(ctxline, {
          type: 'line',
          options: {
            legend: {
              display: false
            }
          }
      });    

      var initial = true;

      $('.select2#filter_lead_trd').select2({
        dropdownParent: $('.filter_lead_trd_fg'),
        width: '100%',
        theme: 'bootstrap'
      })

      function init_filters() {
        start_month = '{{ $start_month }}';
        start_year = '{{ $start_year }}';
        end_month = '{{ $end_month }}';
        end_year = '{{ $end_year }}';

        // $('#filter_start_month').val(start_month).change()
        // $('#filter_start_year').val(start_year).change()
        // $('#filter_end_month').val(end_month).change()
        // $('#filter_end_year').val(end_year).change()

        $('#filter_date_received_start_month').val(start_month).change()
        $('#filter_date_received_start_year').val(start_year).change()
        $('#filter_date_received_end_month').val(end_month).change()
        $('#filter_date_received_end_year').val(end_year).change()


        $('#filter_lead_trd').select2('destroy').find('option').prop('selected', 'selected').end().select2();

        $('#filter_report').trigger('click')
        initial = false
      }
      // Added by Drei
      function view_proposal_count_all() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_all')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })
        return request;
      }

      function view_proposal_count_from_dpmis() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_from_dpmis')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })
        return request;
      }

      function view_proposal_count_received() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_received')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })
        return request;
      }

      function view_proposal_count_under_evaluation() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_under_evaluation')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })
        return request;
      }

      function view_proposal_count_approved() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_approved')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })
        return request;
      }

      function view_proposal_count_disapproved() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_disapproved')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })
        return request;
      }

      function view_proposal_count_by_trd() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_by_trd')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })

        return request;
      }

      function view_proposal_count_by_call() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_by_call')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })

        return request;
      }

      // End

      function view_proposal_count_by_type() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_by_type')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })

        return request;
      }

      function view_proposal_count_by_agency() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_by_agency')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })

        return request;
      }

      function view_proposal_count_by_region() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_by_region')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })

        return request;
      }

      function view_dost_budget() {
        var request = $.ajax({
          url: "{{ route('reports.view_dost_budget')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })

        return request;
      }

      function view_counterpart_budget() {
        var request = $.ajax({
          url: "{{ route('reports.view_counterpart_budget')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })

        return request;
      }

      function view_proposal_count_by_month() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_by_month')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })

        return request;
      }

      function view_proposal_count_by_quarter() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_by_quarter')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })

        return request;
      }

      function view_proposal_count_by_year() {
        var request = $.ajax({
          url: "{{ route('reports.view_proposal_count_by_year')}}",
          method: 'GET',
          data: {
            '_token' : '{{ csrf_token() }}',
            'filters' : filters
          }
        })

        return request;
      }

      $('#filter_report').on('click', function(e){
        $('.filter-reports').each(function(){
          filters[$(this).attr('id')] = $(this).val()
        })

        if(!initial) {
          $('#dashboard_filters').modal('toggle')
        }

        var start_month = $('#filter_start_month option:selected').text()
        var start_year = $('#filter_start_year option:selected').text()
        var end_month = $('#filter_end_month option:selected').text()
        var end_year = $('#filter_end_year option:selected').text()
        var date_received_start_month = $('#filter_date_received_start_month option:selected').text()
        var date_received_start_year = $('#filter_date_received_start_year option:selected').text()
        var date_received_end_month = $('#filter_date_received_end_month option:selected').text()
        var date_received_end_year = $('#filter_date_received_end_year option:selected').text()
        var lead_trd = $('#filter_lead_trd option:selected').text().trim().replace(/ /g, ', ')

        $('#date_range').text(start_month + ' ' + start_year + ' - ' + end_month + ' ' + end_year)
        $('#date_received').text(date_received_start_month + ' ' + date_received_start_year + ' - ' + date_received_end_month + ' ' + date_received_end_year)
        $('#lead_trd').text(lead_trd)
        var request_proposal_count_by_type = view_proposal_count_by_type();
        request_proposal_count_by_type.then(function(data_proposal_count_by_type){
          if(data_proposal_count_by_type['status'] == 1){
            title_type = [];
            count_type = [];
            for (var i = 0; i < data_proposal_count_by_type['view_proposal_count_by_type'].length; i++) {
              count_type.push(data_proposal_count_by_type['view_proposal_count_by_type'][i]['count'])
              title_type.push(data_proposal_count_by_type['view_proposal_count_by_type'][i]['title'])
            }
            var total_dataset = {
              backgroundColor: dost_colors,
              borderWidth: 1,
              data: count_type
            }
            proposal_count_by_type.data.labels = title_type 
            proposal_count_by_type.data.datasets[0] = total_dataset
            proposal_count_by_type.update()

          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error in Proposal Count by Type'
            })
          }
        });

      

        var request_proposal_count_all = view_proposal_count_all();
        request_proposal_count_all.then(function(data_proposal_count_all){
          if(data_proposal_count_all['status'] == 1){
            $("#count_proposals").html(data_proposal_count_all['view_proposal_count_all']);
          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error Counting All Proposals'
            })
          }
        });

        var request_proposal_count_from_dpmis = view_proposal_count_from_dpmis();
        request_proposal_count_from_dpmis.then(function(data_proposal_count_from_dpmis){
          if(data_proposal_count_from_dpmis['status'] == 1){
            $("#count_from_dpmis").html(data_proposal_count_from_dpmis['view_proposal_count_from_dpmis']);
          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error Counting All Proposals from DPMIS'
            })
          }
        });

        var request_proposal_count_received = view_proposal_count_received();
        request_proposal_count_received.then(function(data_proposal_count_received){
          if(data_proposal_count_received['status'] == 1){
            $("#count_received").html(data_proposal_count_received['view_proposal_count_received']);
          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error Counting All Received Proposals'
            })
          }
        });

        var request_proposal_count_under_evaluation = view_proposal_count_under_evaluation();
        request_proposal_count_under_evaluation.then(function(data_proposal_count_under_evaluation){
          if(data_proposal_count_under_evaluation['status'] == 1){
            $("#count_under_evaluation").html(data_proposal_count_under_evaluation['view_proposal_count_under_evaluation']);
          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error Counting All Proposals Under Evaluation'
            })
          }
        });

        var request_proposal_count_approved = view_proposal_count_approved();
        request_proposal_count_approved.then(function(data_proposal_count_approved){
          if(data_proposal_count_approved['status'] == 1){
            $("#count_approved").html(data_proposal_count_approved['view_proposal_count_approved']);
          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error Counting All Proposals Approved'
            })
          }
        });

        var request_proposal_count_disapproved = view_proposal_count_disapproved();
        request_proposal_count_disapproved.then(function(data_proposal_count_disapproved){
          if(data_proposal_count_disapproved['status'] == 1){
            $("#count_disapproved").html(data_proposal_count_disapproved['view_proposal_count_disapproved']);
          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error Counting All Proposals Disapproved'
            })
          }
        });
        
        var request_proposal_count_by_trd = view_proposal_count_by_trd();
        request_proposal_count_by_trd.then(function(data_proposal_count_by_trd){
          if(data_proposal_count_by_trd['status'] == 1){
            title_type = [];
            count_type = [];
            for (var i = 0; i < data_proposal_count_by_trd['view_proposal_count_by_trd'].length; i++) {
              count_type.push(data_proposal_count_by_trd['view_proposal_count_by_trd'][i]['count'])
              title_type.push(data_proposal_count_by_trd['view_proposal_count_by_trd'][i]['title'])
            }

            //Added by Drei 
            var dataToTable = function (dataset) {
                    var html = '<table class="table-bordered table-striped w-100">';
                    html += '<thead><tr>';
                    var columnCount = 0;
                    jQuery.each(dataset.datasets, function (idx, item) {
                        html += '<th style="text-align:center;">' + item.label + '</th>';
                        columnCount += 1;
                    });
                    html += '</tr></thead>';
                    jQuery.each(dataset.labels, function (idx, item) {
                        html += '<tr>';
                        for (i = 0; i < columnCount; i++) {
                            html += '<td>' + (dataset.datasets[i].data[idx] === '0' ? '-' : dataset.datasets[i].data[idx]) + '</td>';
                        }
                        html += '</tr>';
                    });

                    html += '</tr><tbody></table>';

                    return html;
                };

               var labels = title_type.map(function(e) {
                    return e;
                  });
              
                var trd_name_data = title_type.map(function(e) {
                  return e;
                });

                var trd_count_data = count_type.map(function(e) {
                  return e;
                });

                var data = {
                    labels: labels,
                    datasets: [
                        {
                            label: "TRD",
                            data: trd_name_data,
                        },
                        {
                            label: "Count",
                            data: trd_count_data,
                        }
                    ]
                };
   
           //Added by Drei 
            var total_dataset = {
              backgroundColor: colors_array,
              borderWidth: 1,
              data: count_type
            }
            proposal_count_by_trd.data.labels = title_type 
            proposal_count_by_trd.data.datasets[0] = total_dataset
            proposal_count_by_trd.update()
            jQuery('#table_count_trd').html(dataToTable(data));

          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error in Proposal Count by TRD'
            })
          }
        });

        var request_proposal_count_by_call = view_proposal_count_by_call();
        request_proposal_count_by_call.then(function(data_proposal_count_by_call){
          if(data_proposal_count_by_call['status'] == 1){
            title_type = [];
            count_type = [];
            for (var i = 0; i < data_proposal_count_by_call['view_proposal_count_by_call'].length; i++) {
              count_type.push(data_proposal_count_by_call['view_proposal_count_by_call'][i]['count'])
              title_type.push(data_proposal_count_by_call['view_proposal_count_by_call'][i]['title'])
            }

             //Added by Drei 
             var dataToTable = function (dataset) {
                    var html = '<table class="table-bordered table-striped w-100">';
                    html += '<thead><tr>';
                    var columnCount = 0;
                    jQuery.each(dataset.datasets, function (idx, item) {
                        html += '<th style="text-align:center;">' + item.label + '</th>';
                        columnCount += 1;
                    });
                    html += '</tr></thead>';
                    jQuery.each(dataset.labels, function (idx, item) {
                        html += '<tr>';
                        for (i = 0; i < columnCount; i++) {
                            html += '<td>' + (dataset.datasets[i].data[idx] === '0' ? '-' : dataset.datasets[i].data[idx]) + '</td>';
                        }
                        html += '</tr>';
                    });

                    html += '</tr><tbody></table>';

                    return html;
                };

               var labels = title_type.map(function(e) {
                    return e;
                  });
              
                var call_name_data = title_type.map(function(e) {
                  return e;
                });

                var call_count_data = count_type.map(function(e) {
                  return e;
                });

                var data = {
                    labels: labels,
                    datasets: [
                        {
                            label: "Call Name",
                            data: call_name_data,
                        },
                        {
                            label: "Count",
                            data: call_count_data,
                        }
                    ]
                };
   
           //Added by Drei 

            
            var total_dataset = {
              backgroundColor: colors_array,
              borderWidth: 1,
              data: count_type
            }
            proposal_count_by_call.data.labels = title_type 
            proposal_count_by_call.data.datasets[0] = total_dataset
            proposal_count_by_call.update()
            jQuery('#table_count_call').html(dataToTable(data));

          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error in Proposal Count by Call'
            })
          }
        });

        // End

        var request_proposal_count_by_agency = view_proposal_count_by_agency();
        request_proposal_count_by_agency.then(function(data_proposal_count_by_agency){
        if(data_proposal_count_by_agency['status'] == 1){
            title_agency = [];
            count_agency = [];
     
           for (var i = 0; i < data_proposal_count_by_agency['view_proposal_count_by_agency'].length; i++) {
                      count_agency.push(data_proposal_count_by_agency['view_proposal_count_by_agency'][i]['count'])
                      title_agency.push(data_proposal_count_by_agency['view_proposal_count_by_agency'][i]['title'])
           }
           
            var total_dataset = {
              backgroundColor: colors_array,
              borderWidth: 1,
              data: count_agency
            }

            //Added by Drei 
            var dataToTable = function (dataset) {
                    var html = '<table class="table-bordered table-striped w-100">';
                    html += '<thead><tr>';
                    var columnCount = 0;
                    jQuery.each(dataset.datasets, function (idx, item) {
                        html += '<th style="text-align:center;">' + item.label + '</th>';
                        columnCount += 1;
                    });
                    html += '</tr></thead>';
                    jQuery.each(dataset.labels, function (idx, item) {
                        html += '<tr>';
                        for (i = 0; i < columnCount; i++) {
                            html += '<td>' + (dataset.datasets[i].data[idx] === '0' ? '-' : dataset.datasets[i].data[idx]) + '</td>';
                        }
                        html += '</tr>';
                    });

                    html += '</tr><tbody></table>';

                    return html;
                };

               var labels = title_agency.map(function(e) {
                    return e;
                  });
              
                var agency_name_data = title_agency.map(function(e) {
                  return e;
                });

                var agency_count_data = count_agency.map(function(e) {
                  return e;
                });

                var data = {
                    labels: labels,
                    datasets: [
                        {
                            label: "Agency",
                            data: agency_name_data,
                        },
                        {
                            label: "Count",
                            data: count_agency,
                        }
                    ]
                };
   
           //Added by Drei 
            
            proposal_count_by_agency.data.labels = title_agency 
            proposal_count_by_agency.data.datasets[0] = total_dataset
            proposal_count_by_agency.update()
            //Drei
            jQuery('#table_count_agency').html(dataToTable(data));
            
          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error in Proposal Count by Agency'
            })
          }
        });

        var request_proposal_count_by_region = view_proposal_count_by_region();
        request_proposal_count_by_region.then(function(data_proposal_count_by_region){
          if(data_proposal_count_by_region['status'] == 1){
            title_region = [];
            count_region = [];

            for (var i = 0; i < data_proposal_count_by_region['view_proposal_count_by_region'].length; i++) {
              count_region.push(data_proposal_count_by_region['view_proposal_count_by_region'][i]['count'])
              title_region.push(data_proposal_count_by_region['view_proposal_count_by_region'][i]['title'])
            }

               //Added by Drei 
               var dataToTable = function (dataset) {
                    var html = '<table class="table-bordered table-striped w-100">';
                    html += '<thead><tr>';
                    var columnCount = 0;
                    jQuery.each(dataset.datasets, function (idx, item) {
                        html += '<th style="text-align:center;">' + item.label + '</th>';
                        columnCount += 1;
                    });
                    html += '</tr></thead>';
                    jQuery.each(dataset.labels, function (idx, item) {
                        html += '<tr>';
                        for (i = 0; i < columnCount; i++) {
                            html += '<td>' + (dataset.datasets[i].data[idx] === '0' ? '-' : dataset.datasets[i].data[idx]) + '</td>';
                        }
                        html += '</tr>';
                    });

                    html += '</tr><tbody></table>';

                    return html;
                };

               var labels = title_region.map(function(e) {
                    return e;
                  });
              
                var region_name_data = title_region.map(function(e) {
                  return e;
                });

                var region_count_data = count_region.map(function(e) {
                  return e;
                });

                var data = {
                    labels: labels,
                    datasets: [
                        {
                            label: "Agency",
                            data: region_name_data,
                        },
                        {
                            label: "Count",
                            data: region_count_data,
                        }
                    ]
                };
   
           //Added by Drei 

            var total_dataset = {
              backgroundColor: colors_array,
              borderWidth: 1,
              data: count_region
            }
            proposal_count_by_region.data.labels = title_region 
            proposal_count_by_region.data.datasets[0] = total_dataset
            proposal_count_by_region.update()
             //Drei
             jQuery('#table_count_region').html(dataToTable(data));

          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error in Proposal Count by Region'
            })
          }
        });

        var request_dost_budget = view_dost_budget();
        request_dost_budget.then(function(data_dost_budget){
          if(data_dost_budget['status'] == 1) {
            
            title_dost_budget = []
            amount_dost_budget = []
            for (var key of Object.keys(data_dost_budget['view_dost_budget'][0])){
              title_dost_budget.push(key)
              amount_dost_budget.push(data_dost_budget['view_dost_budget'][0][key])
            }

            var total_dataset = {
              backgroundColor: dost_colors,
              borderWidth: 1,
              data: amount_dost_budget
            }

            dost_budget.data.labels = title_dost_budget 
            dost_budget.data.datasets[0] = total_dataset
            dost_budget.update()

          }
        })

        var request_counterpart_budget = view_counterpart_budget();
        request_counterpart_budget.then(function(data_counterpart_budget){
          if(data_counterpart_budget['status'] == 1) {
            
            title_counterpart_budget = []
            amount_counterpart_budget = []
            for (var key of Object.keys(data_counterpart_budget['view_counterpart_budget'][0])){
              title_counterpart_budget.push(key)
              amount_counterpart_budget.push(data_counterpart_budget['view_counterpart_budget'][0][key])
            }

            var total_dataset = {
              backgroundColor: dost_colors,
              borderWidth: 1,
              data: amount_counterpart_budget
            }

            counterpart_budget.data.labels = title_counterpart_budget 
            counterpart_budget.data.datasets[0] = total_dataset
            counterpart_budget.update()

          }
        })

        var request_proposal_count_by_month = view_proposal_count_by_month();
        request_proposal_count_by_month.then(function(data_proposal_count_by_month){
          if(data_proposal_count_by_month['status'] == 1){
            title_month = [];
            count_month = [];

            for (var i = 0; i < data_proposal_count_by_month['view_proposal_count_by_month'].length; i++) {
              count_month.push(data_proposal_count_by_month['view_proposal_count_by_month'][i]['count'])
              title_month.push(data_proposal_count_by_month['view_proposal_count_by_month'][i]['title'])
            }

            var total_dataset = {
              backgroundColor: colors_array,
              pointRadius: 5,
              // borderColor: '#000000',
              borderWidth: 1,
              data: count_month
            }
            proposal_count_by_month.data.labels = title_month 
            proposal_count_by_month.data.datasets[0] = total_dataset
            proposal_count_by_month.update()

          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error in Proposal Count by Month'
            })
          }
        });

        var request_proposal_count_by_quarter = view_proposal_count_by_quarter();
        request_proposal_count_by_quarter.then(function(data_proposal_count_by_quarter){
          if(data_proposal_count_by_quarter['status'] == 1){
            title_quarter = [];
            count_quarter = [];

            for (var i = 0; i < data_proposal_count_by_quarter['view_proposal_count_by_quarter'].length; i++) {
              count_quarter.push(data_proposal_count_by_quarter['view_proposal_count_by_quarter'][i]['count'])
              title_quarter.push(data_proposal_count_by_quarter['view_proposal_count_by_quarter'][i]['title'])
            }

            var total_dataset = {
              backgroundColor: colors_array,
              pointRadius: 5,
              // borderColor: '#000000',
              borderWidth: 1,
              data: count_quarter
            }
            proposal_count_by_quarter.data.labels = title_quarter 
            proposal_count_by_quarter.data.datasets[0] = total_dataset
            proposal_count_by_quarter.update()

          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error in Proposal Count by Quarter'
            })
          }
        });

        var request_proposal_count_by_year = view_proposal_count_by_year();
        request_proposal_count_by_year.then(function(data_proposal_count_by_year){
          if(data_proposal_count_by_year['status'] == 1){
            title_year = [];
            count_year = [];

            for (var i = 0; i < data_proposal_count_by_year['view_proposal_count_by_year'].length; i++) {
              count_year.push(data_proposal_count_by_year['view_proposal_count_by_year'][i]['count'])
              title_year.push(data_proposal_count_by_year['view_proposal_count_by_year'][i]['title'])
            }

            var total_dataset = {
              backgroundColor: colors_array,
              pointRadius: 5,
              // borderColor: '#000000',
              borderWidth: 1,
              data: count_year
            }
            proposal_count_by_year.data.labels = title_year 
            proposal_count_by_year.data.datasets[0] = total_dataset
            proposal_count_by_year.update()

          } else {
            $.alert({
              title: 'Notification!',
              content: 'Error in Proposal Count by Year'
            })
          }
          
        });


      })

      $('.new-notification').popover({
        container: 'body'
      })

      //functions
      init_filters()

    })

  </script>
@endsection
