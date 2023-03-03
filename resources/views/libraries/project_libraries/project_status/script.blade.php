
      {{-- table start --}}
        var project_status_table = $('#project_status_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('project_status.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},              
              {data: 'gstatus', name: 'gstatus'}, 
              {data: 'gsta', name: 'gsta'}, 
              {data: 'description', name: 'description'}, 
              {data: 'tags', name: 'tags'},
              {data: 'is_verified', name: 'is_verified',
                render: function (data, type, row) {
                if (type === 'display' || type === 'filter' ) {
                  return data=='1'? 'Yes' : 'No';
                }
                  return data;
                }
              },
              {data: 'is_active', name: 'is_active',
                render: function (data, type, row) {
                if (type === 'display' || type === 'filter' ) {
                  return data=='1' ? 'Yes' : 'No';
                }
                  return data;
                }
              },
              {data: 'action', orderable: false, searchable: false}          
          ]
        });
        var project_status_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#project_status_modal').on('hidden.bs.modal', function(){       
            init_view_project_status();
           clear_fields()
            project_status_table.ajax.reload()
          });  

          $('#project_status_modal').on('shown.bs.modal', function () {
            $('#project_status_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_project_status(){
            $('.project-status-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_project_status(project_status_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('project_status.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : project_status_id
              }
            });
            return request;
          }

          $('#project_status_table').on('click', '.view-project-status', function(e){     
            $('#project_status_modal_header').html("View Field of Specialization");     
            project_status_id = $(this).parents('tr').attr('data-id');
            init_view_project_status();   
            var request = view_project_status(project_status_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#project_status_name').val(data['project_status']['project_status'])  
                $('#municipality_id').val(data['project_status']['municipality_id'])                  
                $('#project_status_tags').val(data['project_status']['tags']) 
                if(data['project_status']['is_verified'] == 1) {
                  $('#project_status_is_verified').iCheck('check'); 
                }    
                if(data['project_status']['is_active'] == 1) {
                  $('#project_status_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#project_status_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_project_status(){
            init_view_project_status();
            $('.project-status-field')
              .attr('disabled', false);

            $('#add_project_status.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_project_status(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('project_status.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'project_status' : $('#project_status_name').val(),
                'project_status_group_id' : $('#project_status_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#project_status_tags').val(),
                'is_verified' :  ($('#project_status_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#project_status_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_project_status').on('click', function(e){ 
            clear_fields();
            init_add_project_status();          
            $('#project_status_modal_header').html("Add Field of Specialization");
            $('#project_status_modal').modal('toggle')
          })

          $('#add_project_status').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#project_status_id)')) --}}
            var request = add_project_status();
            request.then(function(data) {
              $('#project_status_modal').modal('toggle')
              project_status_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_project_status(){
            init_view_project_status()
            $('.project-status-field')
              .attr('disabled', false);

            $('#update_project_status.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_project_status(project_status_id){  
            // error_checking($('.project-status-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('project_status.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : project_status_id,
                'project_status' : $('#cproject_statusname').val(),
                'project_status_group_id' : $('#project_status_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#project_status_tags').val(),
                'is_verified' :  ($('#project_status_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#project_status_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_project_status').on('click', function(e){
            var request = update_project_status(project_status_id);
            request.then(function(data) {
              $('#project_status_modal').modal('toggle')
              project_status_table.ajax.reload()             
            })
          })

          $('#project_status_table').on('click', '.update-project-status', function(e){
            $('#project_status_modal_header').html("Update Field of Specialization");         
            init_update_project_status();
            project_status_id = $(this).parents('tr').attr('data-id');
            var request = view_project_status(project_status_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#project_status_name').val(data['project_status']['project_status'])  
                $('#project_status_group_id').val(data['project_status']['project_status_group_id'])                  
                $('#sector_id').val(data['project_status']['sector_id']) 
                $('#project_status_tags').val(data['project_status']['tags']) 
                if(data['project_status']['is_verified'] == 1) {
                  $('#project_status_is_verified').iCheck('check'); 
                }    
                if(data['project_status']['is_active'] == 1) {
                  $('#project_status_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#project_status_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#project_status_table').on('click', '.delete-project-status', function(e){
            project_status_id = $(this).parents('tr').attr('data-id');
            delete_project_status(project_status_id);
          })

          function delete_project_status(project_status_id){
            Swal.fire({
              title: 'Are you sure you want to delete?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes'
            })
            .then((result) => {
              if (result.value) {
                $.ajax({
                  method: "PATCH",
                  url: "{{ route('project_status.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : project_status_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    project_status_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}