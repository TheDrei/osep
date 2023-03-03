
      {{-- table start --}}
        var location_type_table = $('#location_type_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('location_type.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'location_type', name: 'location_type'},             
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

        var location_type_id;
     
      {{-- table end --}}

      {{-- START --}}
        {{-- modal start --}}
          $('#location_type_modal').on('hidden.bs.modal', function(){       
            init_view_location_type();
           clear_fields()
            location_type_table.ajax.reload()
          });  

          $('#location_type_modal').on('shown.bs.modal', function () {
            $('#location_type_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_location_type(){
            $('.location-type-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_location_type(location_type_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('location_type.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_type_id
              }
            });
            return request;
          }

          $('#location_type_table').on('click', '.view-location-type', function(e){     
            $('#location_type_modal_header').html("View Location Type");     
            location_type_id = $(this).parents('tr').attr('data-id');
            init_view_location_type();   
            var request = view_location_type(location_type_id);   
            request.then(function(data) {
              if(data['status'] == 1){         
                $('#location_type_name').val(data['location_type']['type'])  
                $('#region_id').val(data['location_type']['region_id'])                  
                $('#area_code').val(data['location_type']['area_code'])    
                $('#location_type_tags').val(data['location_type']['tags'])    
                if(data['location_type']['is_verified'] == 1) {
                  $('#location_type_is_verified').iCheck('check'); 
                }    
                if(data['location_type']['is_active'] == 1) {
                  $('#location_type_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_type_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_location_type(){
            init_view_location_type();
            $('.location-type-field')
              .attr('disabled', false);

            $('#add_location_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_location_type(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('location_type.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'type' : $('#location_type_name').val(),            
                'region_id' : $('#region_id').val(),            
                'area_code' : $('#area_code').val(),            
                'tags' : $('#location_type_tags').val(),
                'is_verified' :  ($('#location_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_location_type').on('click', function(e){ 
           clear_fields();
            init_add_location_type();          
            $('#location_type_modal_header').html("Add Location Type");
            $('#location_type_modal').modal('toggle')
          })

          $('#add_location_type').on('click', function(e){            
            var request = add_location_type();
            request.then(function(data) {
              $('#location_type_modal').modal('toggle')
              location_type_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_location_type(){
            init_view_location_type()
            $('.location-type-field')
              .attr('disabled', false);

            $('#update_location_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_location_type(location_type_id){  
            // error_checking($('.location-type-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('location_type.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_type_id,
                'type' : $('#location_type_name').val(),            
                'region_id' : $('#region_id').val(),            
                'area_code' : $('#area_code').val(),                  
                'tags' : $('#location_type_tags').val(),
                'is_verified' :  ($('#location_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_location_type').on('click', function(e){
            var request = update_location_type(location_type_id);
            request.then(function(data) {
              $('#location_type_modal').modal('toggle')
              location_type_table.ajax.reload()             
            })
          })

          $('#location_type_table').on('click', '.update-location-type', function(e){
            $('#location_type_modal_header').html("Update Location Type");         
            init_update_location_type();
            location_type_id = $(this).parents('tr').attr('data-id');
            var request = view_location_type(location_type_id);

            request.then(function(data) {
              if(data['status'] == 1){
                $('#location_type_name').val(data['location_type']['type'])  
                $('#region_id').val(data['location_type']['region_id'])                  
                $('#area_code').val(data['location_type']['area_code'])    
                $('#location_type_tags').val(data['location_type']['tags'])         
                if(data['location_type']['is_verified'] == 1) {
                  $('#location_type_is_verified').iCheck('check'); 
                }    
                if(data['location_type']['is_active'] == 1) {
                  $('#location_type_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_type_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#location_type_table').on('click', '.delete-location-type', function(e){
            location_type_id = $(this).parents('tr').attr('data-id');
            delete_location_type(location_type_id);
          })

          function delete_location_type(location_type_id){
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
                  url: "{{ route('location_type.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : location_type_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Barangay has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    location_type_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}    
      {{-- END --}}
  
