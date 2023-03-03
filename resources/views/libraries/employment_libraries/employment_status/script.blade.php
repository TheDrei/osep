

      {{-- table start --}}
        var employment_status_table = $('#employment_status_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('employment_status.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'employment_status', name: 'employment_status'},      
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
        var employment_status_id;       
      {{-- table end --}}
      
      {{-- START --}}
        {{-- modal start --}}
          $('#employment_status_modal').on('hidden.bs.modal', function(){       
            init_view_employment_status();
           clear_fields()
            employment_status_table.ajax.reload()
          });  

          $('#employment_status_modal').on('shown.bs.modal', function () {
            $('#employment_status_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_employment_status(){
            $('.employment-status-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_employment_status(employment_status_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('employment_status.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : employment_status_id
              }
            });
            return request;
          }

          $('#employment_status_table').on('click', '.view-employment-status', function(e){     
            $('#employment_status_modal_header').html("View employment_status");     
            employment_status_id = $(this).parents('tr').attr('data-id');
            init_view_employment_status();   
            var request = view_employment_status(employment_status_id);   
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#employment_status_name').val(data['employment_status']['employment_status'])              
                $('#employment_status_tags').val(data['employment_status']['tags'])    
                if(data['employment_status']['is_verified'] == 1) {
                  $('#employment_status_is_verified').iCheck('check'); 
                }    
                if(data['employment_status']['is_active'] == 1) {
                  $('#employment_status_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#employment_status_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_employment_status(){
            init_view_employment_status();
            $('.employment-status-field')
              .attr('disabled', false);

            $('#add_employment_status.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_employment_status(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('employment_status.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'employment_status' : $('#employment_status_name').val(),            
                'tags' : $('#employment_status_tags').val(),
                'is_verified' :  ($('#employment_status_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#employment_status_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_employment_status').on('click', function(e){           
           clear_fields();
            init_add_employment_status();          
            $('#employment_status_modal_header').html("Add employment_status");
            $('#employment_status_modal').modal('toggle')
          })

          $('#add_employment_status').on('click', function(e){            
            var request = add_employment_status();
            request.then(function(data) {
              $('#employment_status_modal').modal('toggle')
              employment_status_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_employment_status(){
            init_view_employment_status()
            $('.employment-status-field')
              .attr('disabled', false);

            $('#update_employment_status.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_employment_status(employment_status_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('employment_status.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : employment_status_id,
                'employment_status' : $('#employment_status_name').val(),              
                'tags' : $('#employment_status_tags').val(),
                'is_verified' :  ($('#employment_status_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#employment_status_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_employment_status').on('click', function(e){
            var request = update_employment_status(employment_status_id);
            request.then(function(data) {
              $('#employment_status_modal').modal('toggle')
              employment_status_table.ajax.reload()             
            })
          })

          $('#employment_status_table').on('click', '.update-employment-status', function(e){
            $('#employment_status_modal_header').html("Update employment_status");         
            init_update_employment_status();
            employment_status_id = $(this).parents('tr').attr('data-id');
            var request = view_employment_status(employment_status_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#employment_status_name').val(data['employment_status']['employment_status'])                               
                $('#employment_status_tags').val(data['employment_status']['tags'])    
                if(data['employment_status']['is_verified'] == 1) {
                  $('#employment_status_is_verified').iCheck('check'); 
                }    
                if(data['employment_status']['is_active'] == 1) {
                  $('#employment_status_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#employment_status_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start  --}}
          $('#employment_status_table').on('click', '.delete-employment-status', function(e){
            employment_status_id = $(this).parents('tr').attr('data-id');
            delete_employment_status(employment_status_id);
          })

          function delete_employment_status(employment_status_id){
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
                  url: "{{ route('employment_status.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : employment_status_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    employment_status_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}    
      {{-- END --}}

  
   