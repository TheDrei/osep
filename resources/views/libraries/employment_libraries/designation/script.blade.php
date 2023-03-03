

      {{-- table start --}}
        var designation_table = $('#designation_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('designation.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'designation', name: 'designation'},      
              {data: 'abbreviation', name: 'abbreviation'},      
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
        var designation_id;       
      {{-- table end     --}}
      
      {{-- START --}}
        {{-- modal start --}}
          $('#designation_modal').on('hidden.bs.modal', function(){       
            init_view_designation();
           clear_fields()
            designation_table.ajax.reload()
          });  

          $('#designation_modal').on('shown.bs.modal', function () {
            $('#designation_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_designation(){
            $('.designation-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_designation(designation_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('designation.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : designation_id
              }
            });
            return request;
          }

          $('#designation_table').on('click', '.view-designation', function(e){     
            $('#designation_modal_header').html("View designation");     
            designation_id = $(this).parents('tr').attr('data-id');
            init_view_designation();   
            var request = view_designation(designation_id);   
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#designation_name').val(data['designation']['designation'])              
                $('#designation_abbreviation').val(data['designation']['abbreviation'])              
                $('#designation_type_id').val(data['designation']['designation_type_id'])              
                $('#designation_tags').val(data['designation']['tags'])    
                if(data['designation']['is_verified'] == 1) {
                  $('#designation_is_verified').iCheck('check'); 
                }    
                if(data['designation']['is_active'] == 1) {
                  $('#designation_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#designation_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_designation(){
            init_view_designation();
            $('.designation-field')
              .attr('disabled', false);

            $('#add_designation.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_designation(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('designation.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'designation' : $('#designation_name').val(),            
                'abbreviation' : $('#designation_abbreviation').val(),            
                'designation_type_id' : $('#designation_type_id').val(),            
                'tags' : $('#designation_tags').val(),
                'is_verified' :  ($('#designation_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#designation_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_designation').on('click', function(e){           
           clear_fields();
            init_add_designation();          
            $('#designation_modal_header').html("Add designation");
            $('#designation_modal').modal('toggle')
          })

          $('#add_designation').on('click', function(e){            
            var request = add_designation();
            request.then(function(data) {
              $('#designation_modal').modal('toggle')
              designation_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_designation(){
            init_view_designation()
            $('.designation-field')
              .attr('disabled', false);

            $('#update_designation.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_designation(designation_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('designation.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : designation_id,
                'designation' : $('#designation_name').val(),            
                'abbreviation' : $('#designation_abbreviation').val(),            
                'designation_type_id' : $('#designation_type_id').val(),            
                'tags' : $('#designation_tags').val(),
                'is_verified' :  ($('#designation_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#designation_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_designation').on('click', function(e){
            var request = update_designation(designation_id);
            request.then(function(data) {
              $('#designation_modal').modal('toggle')
              designation_table.ajax.reload()             
            })
          })

          $('#designation_table').on('click', '.update-designation', function(e){
            $('#designation_modal_header').html("Update designation");         
            init_update_designation();
            designation_id = $(this).parents('tr').attr('data-id');
            var request = view_designation(designation_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#designation_name').val(data['designation']['designation'])              
                $('#designation_abbreviation').val(data['designation']['abbreviation'])              
                $('#designation_type_id').val(data['designation']['designation_type_id'])                            
                $('#designation_tags').val(data['designation']['tags'])    
                if(data['designation']['is_verified'] == 1) {
                  $('#designation_is_verified').iCheck('check'); 
                }    
                if(data['designation']['is_active'] == 1) {
                  $('#designation_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#designation_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#designation_table').on('click', '.delete-designation', function(e){
            designation_id = $(this).parents('tr').attr('data-id');
            delete_designation(designation_id);
          })

          function delete_designation(designation_id){
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
                  url: "{{ route('designation.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : designation_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    designation_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}    
      {{-- END --}}

  
   