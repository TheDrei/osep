@extends('layouts.template-projects')

@section('table-content')
	<div class="card-header bg-info text-center">
	  <h3 class="display-5">Projects Table</h3>
	</div>
	<div class="card-body">
	  <div class="table-responsive">
	    <table id="all_projects_table" class="table table-bordered table-striped w-100">
	      <thead>
	        <th>Project ID</th>
	        <th>DPMIS Code</th>
	        <th>Project Title</th>
	        <th>Project Status</th>	        
	        <th>is Current Status</th>	        
	        <th>Forwarded to DPMIS</th>	        
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
         responsive: true,
         stateSave: true,
         dom: 'Bfrtip',
			ajax: {
				url: "{{ route('projects.all_projects') }}",
				method: "GET"
			},
			data: {
				'_token': '{{ csrf_token() }}'
			},
			columns: [
					{data: 'project_id', name: 'project_id'},					
					{data: 'dpmis_code', name: 'dpmis_code'},					
					{data: 'title', name: 'title'},					
					{data: 'status', name: 'status'},
					{data: 'is_active', name: 'is_active',
						render: function (data, type, row) {
						if (type === 'display' || type === 'filter' ) {
							return data=='1' ? 'Yes' : 'No';
						}
							return data;
						}
					},
					{data: 'forwarded_to_dpmis', name: 'forwarded_to_dpmis',
						render: function (data, type, row) {
						if (type === 'display' || type === 'filter' ) {
							return data=='1' ? 'Yes' : 'No';
						}
							return data;
						}
					},
					{data: 'action', orderable: false, searchable: false}     				
			],
		});

		$('#all_projects_table').on('click', '.forward-project-status-to-dpmis', function(e) {
        e.preventDefault()
		  dpmis_code = $(this).parents('tr').attr('data-id'); 
		//   alert(dpmis_code);
        $.confirm({
          title: 'Notification!',
          content: '<div class="py-2">Are you sure you want to forward project status to DPMIS?</div>',
          buttons: {            
				Yes: function(){
              loader.open()
              var request = forward_project_status_to_dpmis(dpmis_code);
              request.then(function(data){
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                  //   buttons:{
                     //  Confirm: function(){
                        // all_projects_table.ajax.reload(null, false)
                     //  }
                  //   }
                  })
						all_projects_table.ajax.reload(null, false)
                } else {
                  $.alert({
                    title: 'Notification',
                    content: data['view']
                  })
                }
              })
            },
            No: function(){
            }
          }
        })        
      })

		function forward_project_status_to_dpmis(dpmis_code) {
			// alert(dpmis_code);
        var request = $.ajax({
          url: "{{ route('projects.forward_project_status_to_dpmis')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'dpmis_code' : dpmis_code
          }
        })

        return request;
      }

		function forward_project_status_to_dpmis2(dpmis_code){
        var request = $.ajax({
          url: "{{ route('projects.forward_project_status_to_dpmis')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
				'dpmis_code' : dpmis_code,
				'status_id': project_status_id,
				'status_name':project_status,
				'status_type': dpmis_counterpart_status_id,
          }
        })
        return request;
      }

	</script>
@endsection