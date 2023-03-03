
      {{-- table start --}}
        var authoring_type_table = $('#authoring_type_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('authoring_type.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'authoring_type', name: 'authoring_type'}, 
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
        var authoring_type_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#authoring_type_modal').on('hidden.bs.modal', function(){       
            init_view_authoring_type();
            clear_fields()
            authoring_type_table.ajax.reload()
          });  

          $('#authoring_type_modal').on('shown.bs.modal', function () {
            $('#authoring_type_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_authoring_type(){
            $('.authoring-type-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_authoring_type(authoring_type_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('authoring_type.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : authoring_type_id
              }
            });
            return request;
          }

          $('#authoring_type_table').on('click', '.view-authoring-type', function(e){     
            $('#authoring_type_modal_header').html("View Field of Specialization");     
            authoring_type_id = $(this).parents('tr').attr('data-id');
            init_view_authoring_type();   
            var request = view_authoring_type(authoring_type_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#authoring_type_name').val(data['authoring_type']['authoring_type'])  
                $('#municipality_id').val(data['authoring_type']['municipality_id'])                  
                $('#authoring_type_tags').val(data['authoring_type']['tags']) 
                if(data['authoring_type']['is_verified'] == 1) {
                  $('#authoring_type_is_verified').iCheck('check'); 
                }    
                if(data['authoring_type']['is_active'] == 1) {
                  $('#authoring_type_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#authoring_type_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_authoring_type(){
            init_view_authoring_type();
            $('.authoring-type-field')
              .attr('disabled', false);

            $('#add_authoring_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_authoring_type(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('authoring_type.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'authoring_type' : $('#authoring_type_name').val(),
                'authoring_type_group_id' : $('#authoring_type_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#authoring_type_tags').val(),
                'is_verified' :  ($('#authoring_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#authoring_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_authoring_type').on('click', function(e){ 
            init_add_authoring_type();          
            $('#authoring_type_modal_header').html("Add Field of Specialization");
            $('#authoring_type_modal').modal('toggle')
          })

          $('#add_authoring_type').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#authoring_type_id)')) --}}
            var request = add_authoring_type();
            request.then(function(data) {
              $('#authoring_type_modal').modal('toggle')
              authoring_type_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_authoring_type(){
            init_view_authoring_type()
            $('.authoring-type-field')
              .attr('disabled', false);

            $('#update_authoring_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_authoring_type(authoring_type_id){  
            // error_checking($('.authoring-type-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('authoring_type.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : authoring_type_id,
                'authoring_type' : $('#cauthoring_typename').val(),
                'authoring_type_group_id' : $('#authoring_type_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#authoring_type_tags').val(),
                'is_verified' :  ($('#authoring_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#authoring_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_authoring_type').on('click', function(e){
            var request = update_authoring_type(authoring_type_id);
            request.then(function(data) {
              $('#authoring_type_modal').modal('toggle')
              authoring_type_table.ajax.reload()             
            })
          })

          $('#authoring_type_table').on('click', '.update-authoring-type', function(e){
            $('#authoring_type_modal_header').html("Update Field of Specialization");         
            init_update_authoring_type();
            authoring_type_id = $(this).parents('tr').attr('data-id');
            var request = view_authoring_type(authoring_type_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#authoring_type_name').val(data['authoring_type']['authoring_type'])  
                $('#authoring_type_group_id').val(data['authoring_type']['authoring_type_group_id'])                  
                $('#sector_id').val(data['authoring_type']['sector_id']) 
                $('#authoring_type_tags').val(data['authoring_type']['tags']) 
                if(data['authoring_type']['is_verified'] == 1) {
                  $('#authoring_type_is_verified').iCheck('check'); 
                }    
                if(data['authoring_type']['is_active'] == 1) {
                  $('#authoring_type_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#authoring_type_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#authoring_type_table').on('click', '.delete-authoring-type', function(e){
            authoring_type_id = $(this).parents('tr').attr('data-id');
            delete_authoring_type(authoring_type_id);
          })

          function delete_authoring_type(authoring_type_id){
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
                  url: "{{ route('authoring_type.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : authoring_type_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    authoring_type_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}