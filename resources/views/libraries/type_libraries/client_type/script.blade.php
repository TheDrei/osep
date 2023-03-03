
      {{-- table start --}}
        var client_type_table = $('#client_type_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('client_type.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'client_type', name: 'client_type'}, 
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
        var client_type_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#client_type_modal').on('hidden.bs.modal', function(){       
            init_view_client_type();
           clear_fields()
            client_type_table.ajax.reload()
          });  

          $('#client_type_modal').on('shown.bs.modal', function () {
            $('#client_type_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_client_type(){
            $('.client-type-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_client_type(client_type_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('client_type.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : client_type_id
              }
            });
            return request;
          }

          $('#client_type_table').on('click', '.view-client-type', function(e){     
            $('#client_type_modal_header').html("View Field of Specialization");     
            client_type_id = $(this).parents('tr').attr('data-id');
            init_view_client_type();   
            var request = view_client_type(client_type_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#client_type_name').val(data['client_type']['client_type'])  
                $('#municipality_id').val(data['client_type']['municipality_id'])                  
                $('#client_type_tags').val(data['client_type']['tags']) 
                if(data['client_type']['is_verified'] == 1) {
                  $('#client_type_is_verified').iCheck('check'); 
                }    
                if(data['client_type']['is_active'] == 1) {
                  $('#client_type_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#client_type_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_client_type(){
            init_view_client_type();
            $('.client-type-field')
              .attr('disabled', false);

            $('#add_client_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_client_type(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('client_type.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'client_type' : $('#client_type_name').val(),
                'client_type_group_id' : $('#client_type_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#client_type_tags').val(),
                'is_verified' :  ($('#client_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#client_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_client_type').on('click', function(e){ 
           clear_fields();
            init_add_client_type();          
            $('#client_type_modal_header').html("Add Field of Specialization");
            $('#client_type_modal').modal('toggle')
          })

          $('#add_client_type').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#client_type_id)')) --}}
            var request = add_client_type();
            request.then(function(data) {
              $('#client_type_modal').modal('toggle')
              client_type_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_client_type(){
            init_view_client_type()
            $('.client-type-field')
              .attr('disabled', false);

            $('#update_client_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_client_type(client_type_id){  
            // error_checking($('.client-type-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('client_type.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : client_type_id,
                'client_type' : $('#cclient_typename').val(),
                'client_type_group_id' : $('#client_type_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#client_type_tags').val(),
                'is_verified' :  ($('#client_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#client_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_client_type').on('click', function(e){
            var request = update_client_type(client_type_id);
            request.then(function(data) {
              $('#client_type_modal').modal('toggle')
              client_type_table.ajax.reload()             
            })
          })

          $('#client_type_table').on('click', '.update-client-type', function(e){
            $('#client_type_modal_header').html("Update Field of Specialization");         
            init_update_client_type();
            client_type_id = $(this).parents('tr').attr('data-id');
            var request = view_client_type(client_type_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#client_type_name').val(data['client_type']['client_type'])  
                $('#client_type_group_id').val(data['client_type']['client_type_group_id'])                  
                $('#sector_id').val(data['client_type']['sector_id']) 
                $('#client_type_tags').val(data['client_type']['tags']) 
                if(data['client_type']['is_verified'] == 1) {
                  $('#client_type_is_verified').iCheck('check'); 
                }    
                if(data['client_type']['is_active'] == 1) {
                  $('#client_type_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#client_type_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#client_type_table').on('click', '.delete-client-type', function(e){
            client_type_id = $(this).parents('tr').attr('data-id');
            delete_client_type(client_type_id);
          })

          function delete_client_type(client_type_id){
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
                  url: "{{ route('client_type.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : client_type_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    client_type_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}