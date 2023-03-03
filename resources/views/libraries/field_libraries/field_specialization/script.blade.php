
      {{-- table start --}}
        var field_of_specialization_table = $('#field_of_specialization_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('field_of_specialization.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'field_of_specialization', name: 'field_of_specialization'},
              {data: 'field_of_specialization_group', name: 'field_of_specialization_group'},         
              {data: 'sector', name: 'sector'},         
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
        var field_of_specialization_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#field_of_specialization_modal').on('hidden.bs.modal', function(){       
            init_view_field_of_specialization();
           clear_fields()
            field_of_specialization_table.ajax.reload()
          });  

          $('#field_of_specialization_modal').on('shown.bs.modal', function () {
            $('#field_of_specialization_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_field_of_specialization(){
            $('.field-of-specialization-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_field_of_specialization(field_of_specialization_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('field_of_specialization.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : field_of_specialization_id
              }
            });
            return request;
          }

          $('#field_of_specialization_table').on('click', '.view-field-of-specialization', function(e){     
            $('#field_of_specialization_modal_header').html("View Field of Specialization");     
            field_of_specialization_id = $(this).parents('tr').attr('data-id');
            init_view_field_of_specialization();   
            var request = view_field_of_specialization(field_of_specialization_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#field_of_specialization_name').val(data['field_of_specialization']['field_of_specialization'])  
                $('#municipality_id').val(data['field_of_specialization']['municipality_id'])                  
                $('#field_of_specialization_tags').val(data['field_of_specialization']['tags']) 
                if(data['field_of_specialization']['is_verified'] == 1) {
                  $('#field_of_specialization_is_verified').iCheck('check'); 
                }    
                if(data['field_of_specialization']['is_active'] == 1) {
                  $('#field_of_specialization_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#field_of_specialization_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_field_of_specialization(){
            init_view_field_of_specialization();
            $('.field-of-specialization-field')
              .attr('disabled', false);

            $('#add_field_of_specialization.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_field_of_specialization(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('field_of_specialization.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'field_of_specialization' : $('#field_of_specialization_name').val(),
                'field_of_specialization_group_id' : $('#field_of_specialization_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#field_of_specialization_tags').val(),
                'is_verified' :  ($('#field_of_specialization_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#field_of_specialization_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_field_of_specialization').on('click', function(e){ 
           clear_fields();
            init_add_field_of_specialization();          
            $('#field_of_specialization_modal_header').html("Add Field of Specialization");
            $('#field_of_specialization_modal').modal('toggle')
          })

          $('#add_field_of_specialization').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#field_of_specialization_id)')) --}}
            var request = add_field_of_specialization();
            request.then(function(data) {
              $('#field_of_specialization_modal').modal('toggle')
              field_of_specialization_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_field_of_specialization(){
            init_view_field_of_specialization()
            $('.field-of-specialization-field')
              .attr('disabled', false);

            $('#update_field_of_specialization.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_field_of_specialization(field_of_specialization_id){  
            // error_checking($('.field-of-specialization-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('field_of_specialization.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : field_of_specialization_id,
                'field_of_specialization' : $('#cfield_of_specializationname').val(),
                'field_of_specialization_group_id' : $('#field_of_specialization_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#field_of_specialization_tags').val(),
                'is_verified' :  ($('#field_of_specialization_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#field_of_specialization_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_field_of_specialization').on('click', function(e){
            var request = update_field_of_specialization(field_of_specialization_id);
            request.then(function(data) {
              $('#field_of_specialization_modal').modal('toggle')
              field_of_specialization_table.ajax.reload()             
            })
          })

          $('#field_of_specialization_table').on('click', '.update-field-of-specialization', function(e){
            $('#field_of_specialization_modal_header').html("Update Field of Specialization");         
            init_update_field_of_specialization();
            field_of_specialization_id = $(this).parents('tr').attr('data-id');
            var request = view_field_of_specialization(field_of_specialization_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#field_of_specialization_name').val(data['field_of_specialization']['field_of_specialization'])  
                $('#field_of_specialization_group_id').val(data['field_of_specialization']['field_of_specialization_group_id'])                  
                $('#sector_id').val(data['field_of_specialization']['sector_id']) 
                $('#field_of_specialization_tags').val(data['field_of_specialization']['tags']) 
                if(data['field_of_specialization']['is_verified'] == 1) {
                  $('#field_of_specialization_is_verified').iCheck('check'); 
                }    
                if(data['field_of_specialization']['is_active'] == 1) {
                  $('#field_of_specialization_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#field_of_specialization_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#field_of_specialization_table').on('click', '.delete-field-of-specialization', function(e){
            field_of_specialization_id = $(this).parents('tr').attr('data-id');
            delete_field_of_specialization(field_of_specialization_id);
          })

          function delete_field_of_specialization(field_of_specialization_id){
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
                  url: "{{ route('field_of_specialization.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : field_of_specialization_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    field_of_specialization_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}