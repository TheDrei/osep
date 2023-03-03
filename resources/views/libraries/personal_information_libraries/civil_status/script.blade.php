
      {{-- table start --}}
        var civil_status_table = $('#civil_status_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('civil_status.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'civil_status', name: 'civil_status'}, 
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
        var civil_status_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#civil_status_modal').on('hidden.bs.modal', function(){       
            init_view_civil_status();
           clear_fields()
            civil_status_table.ajax.reload()
          });  

          $('#civil_status_modal').on('shown.bs.modal', function () {
            $('#civil_status_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_civil_status(){
            $('.civil-status-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_civil_status(civil_status_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('civil_status.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : civil_status_id
              }
            });
            return request;
          }

          $('#civil_status_table').on('click', '.view-civil-status', function(e){     
            $('#civil_status_modal_header').html("View Field of Specialization");     
            civil_status_id = $(this).parents('tr').attr('data-id');
            init_view_civil_status();   
            var request = view_civil_status(civil_status_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#civil_status_name').val(data['civil_status']['civil_status'])  
                $('#municipality_id').val(data['civil_status']['municipality_id'])                  
                $('#civil_status_tags').val(data['civil_status']['tags']) 
                if(data['civil_status']['is_verified'] == 1) {
                  $('#civil_status_is_verified').iCheck('check'); 
                }    
                if(data['civil_status']['is_active'] == 1) {
                  $('#civil_status_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#civil_status_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_civil_status(){
            init_view_civil_status();
            $('.civil-status-field')
              .attr('disabled', false);

            $('#add_civil_status.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_civil_status(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('civil_status.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'civil_status' : $('#civil_status_name').val(),
                'civil_status_group_id' : $('#civil_status_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#civil_status_tags').val(),
                'is_verified' :  ($('#civil_status_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#civil_status_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_civil_status').on('click', function(e){ 
           clear_fields();
            init_add_civil_status();          
            $('#civil_status_modal_header').html("Add Field of Specialization");
            $('#civil_status_modal').modal('toggle')
          })

          $('#add_civil_status').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#civil_status_id)')) --}}
            var request = add_civil_status();
            request.then(function(data) {
              $('#civil_status_modal').modal('toggle')
              civil_status_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_civil_status(){
            init_view_civil_status()
            $('.civil-status-field')
              .attr('disabled', false);

            $('#update_civil_status.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_civil_status(civil_status_id){  
            // error_checking($('.civil-status-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('civil_status.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : civil_status_id,
                'civil_status' : $('#ccivil_statusname').val(),
                'civil_status_group_id' : $('#civil_status_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#civil_status_tags').val(),
                'is_verified' :  ($('#civil_status_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#civil_status_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_civil_status').on('click', function(e){
            var request = update_civil_status(civil_status_id);
            request.then(function(data) {
              $('#civil_status_modal').modal('toggle')
              civil_status_table.ajax.reload()             
            })
          })

          $('#civil_status_table').on('click', '.update-civil-status', function(e){
            $('#civil_status_modal_header').html("Update Field of Specialization");         
            init_update_civil_status();
            civil_status_id = $(this).parents('tr').attr('data-id');
            var request = view_civil_status(civil_status_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#civil_status_name').val(data['civil_status']['civil_status'])  
                $('#civil_status_group_id').val(data['civil_status']['civil_status_group_id'])                  
                $('#sector_id').val(data['civil_status']['sector_id']) 
                $('#civil_status_tags').val(data['civil_status']['tags']) 
                if(data['civil_status']['is_verified'] == 1) {
                  $('#civil_status_is_verified').iCheck('check'); 
                }    
                if(data['civil_status']['is_active'] == 1) {
                  $('#civil_status_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#civil_status_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#civil_status_table').on('click', '.delete-civil-status', function(e){
            civil_status_id = $(this).parents('tr').attr('data-id');
            delete_civil_status(civil_status_id);
          })

          function delete_civil_status(civil_status_id){
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
                  url: "{{ route('civil_status.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : civil_status_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    civil_status_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}