

      {{-- table start --}}
        var occupation_table = $('#occupation_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('occupation.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'occupation', name: 'occupation'},             
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
        var occupation_id;       
      {{-- table end --}}
      
      {{-- START --}}
        {{-- modal start --}}
          $('#occupation_modal').on('hidden.bs.modal', function(){       
            init_view_occupation();
           clear_fields()
            occupation_table.ajax.reload()
          });  

          $('#occupation_modal').on('shown.bs.modal', function () {
            $('#occupation_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_occupation(){
            $('.occupation-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_occupation(occupation_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('occupation.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : occupation_id
              }
            });
            return request;
          }

          $('#occupation_table').on('click', '.view-occupation', function(e){     
            $('#occupation_modal_header').html("View occupation");     
            occupation_id = $(this).parents('tr').attr('data-id');
            init_view_occupation();   
            var request = view_occupation(occupation_id);   
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#occupation_name').val(data['occupation']['occupation'])                        
                $('#occupation_tags').val(data['occupation']['tags'])    
                if(data['occupation']['is_verified'] == 1) {
                  $('#occupation_is_verified').iCheck('check'); 
                }    
                if(data['occupation']['is_active'] == 1) {
                  $('#occupation_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#occupation_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_occupation(){
            init_view_occupation();
            $('.occupation-field')
              .attr('disabled', false);

            $('#add_occupation.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_occupation(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('occupation.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'occupation' : $('#occupation_name').val(),                
                'tags' : $('#occupation_tags').val(),
                'is_verified' :  ($('#occupation_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#occupation_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_occupation').on('click', function(e){           
           clear_fields();
            init_add_occupation();          
            $('#occupation_modal_header').html("Add occupation");
            $('#occupation_modal').modal('toggle')
          })

          $('#add_occupation').on('click', function(e){            
            var request = add_occupation();
            request.then(function(data) {
              $('#occupation_modal').modal('toggle')
              occupation_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_occupation(){
            init_view_occupation()
            $('.occupation-field')
              .attr('disabled', false);

            $('#update_occupation.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_occupation(occupation_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('occupation.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : occupation_id,
                'occupation' : $('#occupation_name').val(),                
                'tags' : $('#occupation_tags').val(),
                'is_verified' :  ($('#occupation_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#occupation_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_occupation').on('click', function(e){
            var request = update_occupation(occupation_id);
            request.then(function(data) {
              $('#occupation_modal').modal('toggle')
              occupation_table.ajax.reload()             
            })
          })

          $('#occupation_table').on('click', '.update-occupation', function(e){
            $('#occupation_modal_header').html("Update occupation");         
            init_update_occupation();
            occupation_id = $(this).parents('tr').attr('data-id');
            var request = view_occupation(occupation_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#occupation_name').val(data['occupation']['occupation'])                                      
                $('#occupation_tags').val(data['occupation']['tags'])    
                if(data['occupation']['is_verified'] == 1) {
                  $('#occupation_is_verified').iCheck('check'); 
                }    
                if(data['occupation']['is_active'] == 1) {
                  $('#occupation_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#occupation_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#occupation_table').on('click', '.delete-occupation', function(e){
            occupation_id = $(this).parents('tr').attr('data-id');
            delete_occupation(occupation_id);
          })

          function delete_occupation(occupation_id){
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
                  url: "{{ route('occupation.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : occupation_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    occupation_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}    
      {{-- END --}}

  
   