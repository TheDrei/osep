@extends('layouts.template-projects')

@section('table-content')
	<div class="card-header bg-info text-center">
	  <h3 class="display-5">Projects Table</h3>
	</div>
	<div class="card-body">
	  <div class="table-responsive">
	    <table id="all_projects_table" class="table table-bordered table-striped w-100">
	      <thead>
	        <th>DPMIS Code</th>
	        <th>Project Title</th>
	        <th>Project Status</th>	        
	        <th></th>
	      </thead>
	      <tbody>
	      </tbody>
	    </table>
	  </div>
	</div>
@endsection
@section('table-initialize')
	<script type="text/javascript">
		var all_projects_table = $('#all_projects_table').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url: "{{ route('projects.all_projects') }}",
				method: "GET"
			},
			columns: [
					{data: 'dpmis_code', name: 'dpmis_code'},					
					// {data: 'action', orderable: false, searchable: false}
			]
		});
	</script>
@endsection