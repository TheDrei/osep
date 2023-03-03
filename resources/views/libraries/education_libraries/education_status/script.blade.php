

      {{-- table start --}}
        var education_status_table = $('#education_status_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('education_status.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'education_status', name: 'education_status'},       
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
        var education_status_id;       
      {{-- table end --}}
  
      {{-- START --}}
        {{-- modal start --}}
          $('#education_status_modal').on('hidden.bs.modal', function(){       
            init_view_education_status();
           clear_fields()
            education_status_table.ajax.reload()
          });  

          $('#education_status_modal').on('shown.bs.modal', function () {
            $('#education_status_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_education_status(){
            $('.education-status-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_education_status(education_status_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('education_status.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : education_status_id
              }
            });
            return request;
          }

          $('#education_status_table').on('click', '.view-education-status', function(e){     
            $('#education_status_modal_header').html("View Education status");     
            education_status_id = $(this).parents('tr').attr('data-id');
            init_view_education_status();   
            var request = view_education_status(education_status_id);   
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#education_status_name').val(data['education_status']['education_status'])    
                $('#education_status_tags').val(data['education_status']['tags'])    
                if(data['education_status']['is_verified'] == 1) {
                  $('#education_status_is_verified').iCheck('check'); 
                }    
                if(data['education_status']['is_active'] == 1) {
                  $('#education_status_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#education_status_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_education_status(){
            init_view_education_status();
            $('.education-status-field')
              .attr('disabled', false);

            $('#add_education_status.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_education_status(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('education_status.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'education_status' : $('#education_status_name').val(),
                'tags' : $('#education_status_tags').val(),
                'is_verified' :  ($('#education_status_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#education_status_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_education_status').on('click', function(e){ 
            
           clear_fields();
            init_add_education_status();          
            $('#education_status_modal_header').html("Add Education status");
            $('#education_status_modal').modal('toggle')
          })

          $('#add_education_status').on('click', function(e){            
            var request = add_education_status();
            request.then(function(data) {
              $('#education_status_modal').modal('toggle')
              education_status_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_education_status(){
            init_view_education_status()
            $('.education-status-field')
              .attr('disabled', false);

            $('#update_education_status.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_education_status(education_status_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('education_status.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : education_status_id,
                'education_status' : $('#education_status_name').val(),
                'acronym' : $('#education_status_acronym').val(),
                'tags' : $('#education_status_tags').val(),
                'is_verified' :  ($('#education_status_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#education_status_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_education_status').on('click', function(e){
            var request = update_education_status(education_status_id);
            request.then(function(data) {
              $('#education_status_modal').modal('toggle')
              education_status_table.ajax.reload()             
            })
          })

          $('#education_status_table').on('click', '.update-education-status', function(e){
            $('#education_status_modal_header').html("Update Education status");         
            init_update_education_status();
            education_status_id = $(this).parents('tr').attr('data-id');
            var request = view_education_status(education_status_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#education_status_name').val(data['education_status']['education_status'])                
                $('#education_status_acronym').val(data['education_status']['acronym'])                
                $('#education_status_tags').val(data['education_status']['tags'])    
                if(data['education_status']['is_verified'] == 1) {
                  $('#education_status_is_verified').iCheck('check'); 
                }    
                if(data['education_status']['is_active'] == 1) {
                  $('#education_status_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#education_status_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#education_status_table').on('click', '.delete-education-status', function(e){
            education_status_id = $(this).parents('tr').attr('data-id');
            delete_education_status(education_status_id);
          })

          function delete_education_status(education_status_id){
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
                  url: "{{ route('education_status.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : education_status_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    education_status_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}      
      {{-- END --}}
 