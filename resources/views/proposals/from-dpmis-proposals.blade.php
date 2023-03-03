@extends('layouts.template-proposals')

@section('table-content')
	<div class="card-header bg-info text-center">
	  <h3 class="display-5">Received from DPMIS Proposals Table</h3>
	</div>
	<div class="card-body">
	  <div class="table-responsive">
	    <table id="proposals_table" class="table table-bordered table-striped w-100">
	      <thead>
	        <th>Proposal Type</th>
	        <th>Proposal Code</th>
	        <th>Monitoring Cluster</th>
	        <th>Title</th>
	        <th>Duration</th>
	        <th>Date Forwarded (API)</th>
	        <th>Date Submitted (DPMIS)</th>
	        <th>Proposal Call</th>
	        <th>GAD Score</th>
	        <th>Status</th>
	        <th>Action</th>
	      </thead>
	      <tbody>
	      </tbody>
	    </table>
	  </div>
	</div>
@endsection
@section('table-initialize')
	<script type="text/javascript">
		var proposals_table = $('#proposals_table').DataTable({
	        processing: true,
	        serverSide: true,
	        data: {
	          '_token': '{{ csrf_token() }}'
	        },
	        ajax: {
	          url: "{{ route('proposals.table_from_dpmis_proposals') }}",
	          method: "GET"
	        },
	        columns: [
	            {data: 'proposal_type', name: 'proposal_type'},
	            {data: 'proposal_code', name: 'proposal_code'},
	            {data: 'monitoring_agency_division', name: 'monitoring_agency_division'},
	            {data: 'title', name: 'title'},
	            {data: 'duration', name: 'duration'},
	            {data: 'date_forwarded_through_api', name: 'date_forwarded_through_api'},
	            {data: 'dpmis_date_submitted', name: 'dpmis_date_submitted'},
	            {data: 'call_for_proposal', name: 'call_for_proposal'},
	            {data: 'gad_score', name: 'gad_score'},
	            {data: 'proposal_status', name: 'proposal_status'},
	            {data: 'action', orderable: false, searchable: false}
	        ],
	        order: [
	        	[ 1, "desc" ],
	        	[ 0, "asc" ]
	        ]

	      });
	</script>
@endsection