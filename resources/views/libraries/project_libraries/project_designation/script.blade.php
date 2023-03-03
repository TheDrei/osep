
      {{-- table start --}}
        var project_designation_table = $('#project_designation_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('project_designation.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'project_designation', name: 'project_designation'}, 
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
        var project_designation_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#project_designation_modal').on('hidden.bs.modal', function(){       
            init_view_project_designation();
           clear_fields()
            project_designation_table.ajax.reload()
          });  

          $('#project_designation_modal').on('shown.bs.modal', function () {
            $('#project_designation_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_project_designation(){
            $('.project-designation-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_project_designation(project_designation_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('project_designation.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : project_designation_id
              }
            });
            return request;
          }

          $('#project_designation_table').on('click', '.view-project-designation', function(e){     
            $('#project_designation_modal_header').html("View Field of Specialization");     
            project_designation_id = $(this).parents('tr').attr('data-id');
            init_view_project_designation();   
            var request = view_project_designation(project_designation_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#project_designation_name').val(data['project_designation']['project_designation'])  
                $('#municipality_id').val(data['project_designation']['municipality_id'])                  
                $('#project_designation_tags').val(data['project_designation']['tags']) 
                if(data['project_designation']['is_verified'] == 1) {
                  $('#project_designation_is_verified').iCheck('check'); 
                }    
                if(data['project_designation']['is_active'] == 1) {
                  $('#project_designation_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#project_designation_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_project_designation(){
            init_view_project_designation();
            $('.project-designation-field')
              .attr('disabled', false);

            $('#add_project_designation.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_project_designation(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('project_designation.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'project_designation' : $('#project_designation_name').val(),
                'project_designation_group_id' : $('#project_designation_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#project_designation_tags').val(),
                'is_verified' :  ($('#project_designation_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#project_designation_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_project_designation').on('click', function(e){ 
           clear_fields();
            init_add_project_designation();          
            $('#project_designation_modal_header').html("Add Field of Specialization");
            $('#project_designation_modal').modal('toggle')
          })

          $('#add_project_designation').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#project_designation_id)')) --}}
            var request = add_project_designation();
            request.then(function(data) {
              $('#project_designation_modal').modal('toggle')
              project_designation_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_project_designation(){
            init_view_project_designation()
            $('.project-designation-field')
              .attr('disabled', false);

            $('#update_project_designation.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_project_designation(project_designation_id){  
            // error_checking($('.project-designation-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('project_designation.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : project_designation_id,
                'project_designation' : $('#cproject_designationname').val(),
                'project_designation_group_id' : $('#project_designation_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#project_designation_tags').val(),
                'is_verified' :  ($('#project_designation_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#project_designation_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_project_designation').on('click', function(e){
            var request = update_project_designation(project_designation_id);
            request.then(function(data) {
              $('#project_designation_modal').modal('toggle')
              project_designation_table.ajax.reload()             
            })
          })

          $('#project_designation_table').on('click', '.update-project-designation', function(e){
            $('#project_designation_modal_header').html("Update Field of Specialization");         
            init_update_project_designation();
            project_designation_id = $(this).parents('tr').attr('data-id');
            var request = view_project_designation(project_designation_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#project_designation_name').val(data['project_designation']['project_designation'])  
                $('#project_designation_group_id').val(data['project_designation']['project_designation_group_id'])                  
                $('#sector_id').val(data['project_designation']['sector_id']) 
                $('#project_designation_tags').val(data['project_designation']['tags']) 
                if(data['project_designation']['is_verified'] == 1) {
                  $('#project_designation_is_verified').iCheck('check'); 
                }    
                if(data['project_designation']['is_active'] == 1) {
                  $('#project_designation_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#project_designation_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#project_designation_table').on('click', '.delete-project-designation', function(e){
            project_designation_id = $(this).parents('tr').attr('data-id');
            delete_project_designation(project_designation_id);
          })

          function delete_project_designation(project_designation_id){
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
                  url: "{{ route('project_designation.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : project_designation_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    project_designation_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}