
      {{-- table start --}}
        var consortium_type_table = $('#consortium_type_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('consortium_type.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'consortium_type', name: 'consortium_type'}, 
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
        var consortium_type_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#consortium_type_modal').on('hidden.bs.modal', function(){       
            init_view_consortium_type();
           clear_fields()
            consortium_type_table.ajax.reload()
          });  

          $('#consortium_type_modal').on('shown.bs.modal', function () {
            $('#consortium_type_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_consortium_type(){
            $('.consortium-type-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_consortium_type(consortium_type_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('consortium_type.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : consortium_type_id
              }
            });
            return request;
          }

          $('#consortium_type_table').on('click', '.view-consortium-type', function(e){     
            $('#consortium_type_modal_header').html("View Field of Specialization");     
            consortium_type_id = $(this).parents('tr').attr('data-id');
            init_view_consortium_type();   
            var request = view_consortium_type(consortium_type_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#consortium_type_name').val(data['consortium_type']['consortium_type'])  
                $('#municipality_id').val(data['consortium_type']['municipality_id'])                  
                $('#consortium_type_tags').val(data['consortium_type']['tags']) 
                if(data['consortium_type']['is_verified'] == 1) {
                  $('#consortium_type_is_verified').iCheck('check'); 
                }    
                if(data['consortium_type']['is_active'] == 1) {
                  $('#consortium_type_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#consortium_type_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_consortium_type(){
            init_view_consortium_type();
            $('.consortium-type-field')
              .attr('disabled', false);

            $('#add_consortium_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_consortium_type(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('consortium_type.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'consortium_type' : $('#consortium_type_name').val(),
                'consortium_type_group_id' : $('#consortium_type_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#consortium_type_tags').val(),
                'is_verified' :  ($('#consortium_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#consortium_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_consortium_type').on('click', function(e){ 
           clear_fields();
            init_add_consortium_type();          
            $('#consortium_type_modal_header').html("Add Field of Specialization");
            $('#consortium_type_modal').modal('toggle')
          })

          $('#add_consortium_type').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#consortium_type_id)')) --}}
            var request = add_consortium_type();
            request.then(function(data) {
              $('#consortium_type_modal').modal('toggle')
              consortium_type_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_consortium_type(){
            init_view_consortium_type()
            $('.consortium-type-field')
              .attr('disabled', false);

            $('#update_consortium_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_consortium_type(consortium_type_id){  
            // error_checking($('.consortium-type-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('consortium_type.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : consortium_type_id,
                'consortium_type' : $('#cconsortium_typename').val(),
                'consortium_type_group_id' : $('#consortium_type_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#consortium_type_tags').val(),
                'is_verified' :  ($('#consortium_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#consortium_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_consortium_type').on('click', function(e){
            var request = update_consortium_type(consortium_type_id);
            request.then(function(data) {
              $('#consortium_type_modal').modal('toggle')
              consortium_type_table.ajax.reload()             
            })
          })

          $('#consortium_type_table').on('click', '.update-consortium-type', function(e){
            $('#consortium_type_modal_header').html("Update Field of Specialization");         
            init_update_consortium_type();
            consortium_type_id = $(this).parents('tr').attr('data-id');
            var request = view_consortium_type(consortium_type_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#consortium_type_name').val(data['consortium_type']['consortium_type'])  
                $('#consortium_type_group_id').val(data['consortium_type']['consortium_type_group_id'])                  
                $('#sector_id').val(data['consortium_type']['sector_id']) 
                $('#consortium_type_tags').val(data['consortium_type']['tags']) 
                if(data['consortium_type']['is_verified'] == 1) {
                  $('#consortium_type_is_verified').iCheck('check'); 
                }    
                if(data['consortium_type']['is_active'] == 1) {
                  $('#consortium_type_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#consortium_type_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#consortium_type_table').on('click', '.delete-consortium-type', function(e){
            consortium_type_id = $(this).parents('tr').attr('data-id');
            delete_consortium_type(consortium_type_id);
          })

          function delete_consortium_type(consortium_type_id){
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
                  url: "{{ route('consortium_type.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : consortium_type_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    consortium_type_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}