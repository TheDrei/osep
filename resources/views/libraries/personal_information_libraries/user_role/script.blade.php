
      {{-- table start --}}
        var user_role_table = $('#user_role_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('user_role.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'user_role', name: 'user_role'}, 
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
        var user_role_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#user_role_modal').on('hidden.bs.modal', function(){       
            init_view_user_role();
           clear_fields()
            user_role_table.ajax.reload()
          });  

          $('#user_role_modal').on('shown.bs.modal', function () {
            $('#user_role_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_user_role(){
            $('.user-role-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_user_role(user_role_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('user_role.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : user_role_id
              }
            });
            return request;
          }

          $('#user_role_table').on('click', '.view-user-role', function(e){     
            $('#user_role_modal_header').html("View Field of Specialization");     
            user_role_id = $(this).parents('tr').attr('data-id');
            init_view_user_role();   
            var request = view_user_role(user_role_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#user_role_name').val(data['user_role']['user_role'])  
                $('#municipality_id').val(data['user_role']['municipality_id'])                  
                $('#user_role_tags').val(data['user_role']['tags']) 
                if(data['user_role']['is_verified'] == 1) {
                  $('#user_role_is_verified').iCheck('check'); 
                }    
                if(data['user_role']['is_active'] == 1) {
                  $('#user_role_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#user_role_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_user_role(){
            init_view_user_role();
            $('.user-role-field')
              .attr('disabled', false);

            $('#add_user_role.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_user_role(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('user_role.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'user_role' : $('#user_role_name').val(),
                'user_role_group_id' : $('#user_role_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#user_role_tags').val(),
                'is_verified' :  ($('#user_role_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#user_role_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_user_role').on('click', function(e){ 
           clear_fields();
            init_add_user_role();          
            $('#user_role_modal_header').html("Add Field of Specialization");
            $('#user_role_modal').modal('toggle')
          })

          $('#add_user_role').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#user_role_id)')) --}}
            var request = add_user_role();
            request.then(function(data) {
              $('#user_role_modal').modal('toggle')
              user_role_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_user_role(){
            init_view_user_role()
            $('.user-role-field')
              .attr('disabled', false);

            $('#update_user_role.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_user_role(user_role_id){  
            // error_checking($('.user-role-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('user_role.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : user_role_id,
                'user_role' : $('#cuser_rolename').val(),
                'user_role_group_id' : $('#user_role_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#user_role_tags').val(),
                'is_verified' :  ($('#user_role_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#user_role_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_user_role').on('click', function(e){
            var request = update_user_role(user_role_id);
            request.then(function(data) {
              $('#user_role_modal').modal('toggle')
              user_role_table.ajax.reload()             
            })
          })

          $('#user_role_table').on('click', '.update-user-role', function(e){
            $('#user_role_modal_header').html("Update Field of Specialization");         
            init_update_user_role();
            user_role_id = $(this).parents('tr').attr('data-id');
            var request = view_user_role(user_role_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#user_role_name').val(data['user_role']['user_role'])  
                $('#user_role_group_id').val(data['user_role']['user_role_group_id'])                  
                $('#sector_id').val(data['user_role']['sector_id']) 
                $('#user_role_tags').val(data['user_role']['tags']) 
                if(data['user_role']['is_verified'] == 1) {
                  $('#user_role_is_verified').iCheck('check'); 
                }    
                if(data['user_role']['is_active'] == 1) {
                  $('#user_role_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#user_role_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#user_role_table').on('click', '.delete-user-role', function(e){
            user_role_id = $(this).parents('tr').attr('data-id');
            delete_user_role(user_role_id);
          })

          function delete_user_role(user_role_id){
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
                  url: "{{ route('user_role.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : user_role_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    user_role_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}