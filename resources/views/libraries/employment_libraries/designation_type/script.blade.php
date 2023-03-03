

      {{-- table start --}}
        var designation_type_table = $('#designation_type_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('designation_type.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'designation_type', name: 'designation_type'},                     
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
        var designation_type_id;       
      {{-- table end --}}
      
      {{-- START --}}
        {{-- modal start --}}
          $('#designation_type_modal').on('hidden.bs.modal', function(){       
            init_view_designation_type();
           clear_fields()
            designation_type_table.ajax.reload()
          });  

          $('#designation_type_modal').on('shown.bs.modal', function () {
            $('#designation_type_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_designation_type(){
            $('.designation-type-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_designation_type(designation_type_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('designation_type.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : designation_type_id
              }
            });
            return request;
          }

          $('#designation_type_table').on('click', '.view-designation-type', function(e){     
            $('#designation_type_modal_header').html("View Designation Type");     
            designation_type_id = $(this).parents('tr').attr('data-id');
            init_view_designation_type();   
            var request = view_designation_type(designation_type_id);   
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#designation_type_name').val(data['designation_type']['designation_type'])                        
                $('#designation_type_tags').val(data['designation_type']['tags'])    
                if(data['designation_type']['is_verified'] == 1) {
                  $('#designation_type_is_verified').iCheck('check'); 
                }    
                if(data['designation_type']['is_active'] == 1) {
                  $('#designation_type_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#designation_type_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_designation_type(){
            init_view_designation_type();
            $('.designation-type-field')
              .attr('disabled', false);

            $('#add_designation_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_designation_type(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('designation_type.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'designation_type' : $('#designation_type_name').val(),                      
                'tags' : $('#designation_type_tags').val(),
                'is_verified' :  ($('#designation_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#designation_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_designation_type').on('click', function(e){         
           clear_fields();
            init_add_designation_type();          
            $('#designation_type_modal_header').html("Add Designation Type");
            $('#designation_type_modal').modal('toggle')
          })

          $('#add_designation_type').on('click', function(e){            
            var request = add_designation_type();
            request.then(function(data) {
              $('#designation_type_modal').modal('toggle')
              designation_type_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_designation_type(){
            init_view_designation_type()
            $('.designation-type-field')
              .attr('disabled', false);

            $('#update_designation_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_designation_type(designation_type_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('designation_type.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : designation_type_id,
                'designation_type' : $('#designation_type_name').val(),                      
                'tags' : $('#designation_type_tags').val(),
                'is_verified' :  ($('#designation_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#designation_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_designation_type').on('click', function(e){
            var request = update_designation_type(designation_type_id);
            request.then(function(data) {
              $('#designation_type_modal').modal('toggle')
              designation_type_table.ajax.reload()             
            })
          })

          $('#designation_type_table').on('click', '.update-designation-type', function(e){
            $('#designation_type_modal_header').html("Update Designation Type");         
            init_update_designation_type();
            designation_type_id = $(this).parents('tr').attr('data-id');
            var request = view_designation_type(designation_type_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#designation_type_name').val(data['designation_type']['designation_type'])              
                $('#designation_type_abbreviation').val(data['designation_type']['abbreviation'])              
                $('#designation_type_type_id').val(data['designation_type']['designation_type_type_id'])                            
                $('#designation_type_tags').val(data['designation_type']['tags'])    
                if(data['designation_type']['is_verified'] == 1) {
                  $('#designation_type_is_verified').iCheck('check'); 
                }    
                if(data['designation_type']['is_active'] == 1) {
                  $('#designation_type_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#designation_type_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#designation_type_table').on('click', '.delete-designation-type', function(e){
            designation_type_id = $(this).parents('tr').attr('data-id');
            delete_designation_type(designation_type_id);
          })

          function delete_designation_type(designation_type_id){
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
                  url: "{{ route('designation_type.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : designation_type_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    designation_type_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}    
      {{-- END --}}

  
   