
      {{-- table start --}}
        var project_sector_table = $('#project_sector_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('project_sector.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'project_sector', name: 'project_sector'}, 
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
        var project_sector_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#project_sector_modal').on('hidden.bs.modal', function(){       
            init_view_project_sector();
           clear_fields()
            project_sector_table.ajax.reload()
          });  

          $('#project_sector_modal').on('shown.bs.modal', function () {
            $('#project_sector_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_project_sector(){
            $('.project-sector-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_project_sector(project_sector_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('project_sector.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : project_sector_id
              }
            });
            return request;
          }

          $('#project_sector_table').on('click', '.view-project-sector', function(e){     
            $('#project_sector_modal_header').html("View Field of Specialization");     
            project_sector_id = $(this).parents('tr').attr('data-id');
            init_view_project_sector();   
            var request = view_project_sector(project_sector_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#project_sector_name').val(data['project_sector']['project_sector'])  
                $('#municipality_id').val(data['project_sector']['municipality_id'])                  
                $('#project_sector_tags').val(data['project_sector']['tags']) 
                if(data['project_sector']['is_verified'] == 1) {
                  $('#project_sector_is_verified').iCheck('check'); 
                }    
                if(data['project_sector']['is_active'] == 1) {
                  $('#project_sector_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#project_sector_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_project_sector(){
            init_view_project_sector();
            $('.project-sector-field')
              .attr('disabled', false);

            $('#add_project_sector.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_project_sector(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('project_sector.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'project_sector' : $('#project_sector_name').val(),
                'project_sector_group_id' : $('#project_sector_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#project_sector_tags').val(),
                'is_verified' :  ($('#project_sector_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#project_sector_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_project_sector').on('click', function(e){ 
           clear_fields();
            init_add_project_sector();          
            $('#project_sector_modal_header').html("Add Field of Specialization");
            $('#project_sector_modal').modal('toggle')
          })

          $('#add_project_sector').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#project_sector_id)')) --}}
            var request = add_project_sector();
            request.then(function(data) {
              $('#project_sector_modal').modal('toggle')
              project_sector_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_project_sector(){
            init_view_project_sector()
            $('.project-sector-field')
              .attr('disabled', false);

            $('#update_project_sector.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_project_sector(project_sector_id){  
            // error_checking($('.project-sector-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('project_sector.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : project_sector_id,
                'project_sector' : $('#cproject_sectorname').val(),
                'project_sector_group_id' : $('#project_sector_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#project_sector_tags').val(),
                'is_verified' :  ($('#project_sector_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#project_sector_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_project_sector').on('click', function(e){
            var request = update_project_sector(project_sector_id);
            request.then(function(data) {
              $('#project_sector_modal').modal('toggle')
              project_sector_table.ajax.reload()             
            })
          })

          $('#project_sector_table').on('click', '.update-project-sector', function(e){
            $('#project_sector_modal_header').html("Update Field of Specialization");         
            init_update_project_sector();
            project_sector_id = $(this).parents('tr').attr('data-id');
            var request = view_project_sector(project_sector_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#project_sector_name').val(data['project_sector']['project_sector'])  
                $('#project_sector_group_id').val(data['project_sector']['project_sector_group_id'])                  
                $('#sector_id').val(data['project_sector']['sector_id']) 
                $('#project_sector_tags').val(data['project_sector']['tags']) 
                if(data['project_sector']['is_verified'] == 1) {
                  $('#project_sector_is_verified').iCheck('check'); 
                }    
                if(data['project_sector']['is_active'] == 1) {
                  $('#project_sector_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#project_sector_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#project_sector_table').on('click', '.delete-project-sector', function(e){
            project_sector_id = $(this).parents('tr').attr('data-id');
            delete_project_sector(project_sector_id);
          })

          function delete_project_sector(project_sector_id){
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
                  url: "{{ route('project_sector.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : project_sector_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    project_sector_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}