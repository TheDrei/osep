@extends('layouts.template-projects')

@section('table-content')
	<div class="card-header bg-info text-center">
	  <h3 class="display-5">Projects Table</h3>
	</div>
	<div class="card-body">
	  <div class="table-responsive">
	    <table id="completed_projects_table" class="table table-bordered table-striped w-100">
	      <thead>
	        <th>Project ID</th>
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
		var all_projects_table = $('#completed_projects_table').DataTable({
			processing: true,
			serverSide: true,
         responsive: true,
         stateSave: true,
         dom: 'Bfrtip',
			ajax: {
				url: "{{ route('allcompletedprojects') }}",
				method: "GET"
			},
			data: {
				'_token': '{{ csrf_token() }}'
			},
			columns: [
					{data: 'id', name: 'id'},					
					{data: 'dpmis_code', name: 'dpmis_code'},					
					{data: 'title', name: 'title'},					
					{data: 'project_status_id', name: 'project_status_id'},
					{data: 'action', orderable: false, searchable: false}     				
			],
		});

		$('#completed_projects_table').on('click', '.forward-project-status-to-dpmis', function(e) {
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
					// alert(dpmis_code);
                loader.close()
                if(data['status'] == 1){
                  $.alert({
                    title: 'Notification',
                    content: data['view'],
                    buttons:{
                      Confirm: function(){
                        all_projects_table.ajax.reload(null, false)
                      }
                    }
                  })
                } else {
                  $.alert('Error')
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
          url: "{{ route('forwardstatus')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
            'dpmis_code' : dpmis_code
          },
        })

        return request;
      }


		function forward_project_status_to_dpmis2(dpmis_code){
        var request = $.ajax({
          url: "{{ route('forwardstatus')}}",
          method: 'POST',
          data: {
            '_token' : '{{ csrf_token() }}',
			'dpmis_code' : '2020-06-A2-1936',
			'status_id': '5',
			'status_name':'Completed',
			'status_type': '15',
			'remarks' : 'Completed',
 			'date_created' : '2022-05-26 08:05:39',
  			'created_by' : 'Pamela Anne Tandang',
  			'evaluation_level' : '1',
  			'is_closed' : '0'
          }
        })
        return request;
      }

	</script>
@endsection