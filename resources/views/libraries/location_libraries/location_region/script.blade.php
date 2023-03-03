
      {{-- table start --}}
        var location_region_table = $('#location_region_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('location_region.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'region', name: 'region'},
              {data: 'region_number', name: 'region_number'},
              {data: 'cluster', name: 'cluster'},
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

        var location_region_id;
     
      {{-- table end --}}

      {{-- START --}}
        {{-- modal start --}}
          $('#location_region_modal').on('hidden.bs.modal', function(){       
            init_view_location_region();
           clear_fields()
            location_region_table.ajax.reload()
          });  

          $('#location_region_modal').on('shown.bs.modal', function () {
            $('#location_region_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_location_region(){
            $('.location-region-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_location_region(location_region_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('location_region.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_region_id
              }
            });
            return request;
          }

          $('#location_region_table').on('click', '.view-location-region', function(e){     
            $('#location_region_modal_header').html("View Region");     
            location_region_id = $(this).parents('tr').attr('data-id');
            init_view_location_region();   
            var request = view_location_region(location_region_id);   
            request.then(function(data) {
              if(data['status'] == 1){         
                $('#location_region_name').val(data['location_region']['region'])  
                $('#region_id').val(data['location_region']['region_id'])                  
                $('#area_code').val(data['location_region']['area_code'])    
                $('#location_region_tags').val(data['location_region']['tags'])    
                if(data['location_region']['is_verified'] == 1) {
                  $('#location_region_is_verified').iCheck('check'); 
                }    
                if(data['location_region']['is_active'] == 1) {
                  $('#location_region_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_region_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_location_region(){
            init_view_location_region();
            $('.location-region-field')
              .attr('disabled', false);

            $('#add_location_region.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_location_region(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('location_region.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'region' : $('#location_region_name').val(),            
                'region_id' : $('#region_id').val(),            
                'area_code' : $('#area_code').val(),            
                'tags' : $('#location_region_tags').val(),
                'is_verified' :  ($('#location_region_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_region_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_location_region').on('click', function(e){ 
           clear_fields();
            init_add_location_region();          
            $('#location_region_modal_header').html("Add Region");
            $('#location_region_modal').modal('toggle')
          })

          $('#add_location_region').on('click', function(e){            
            var request = add_location_region();
            request.then(function(data) {
              $('#location_region_modal').modal('toggle')
              location_region_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_location_region(){
            init_view_location_region()
            $('.location-region-field')
              .attr('disabled', false);

            $('#update_location_region.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_location_region(location_region_id){  
            // error_checking($('.location-region-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('location_region.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_region_id,
                'region' : $('#location_region_name').val(),            
                'region_id' : $('#region_id').val(),            
                'area_code' : $('#area_code').val(),                  
                'tags' : $('#location_region_tags').val(),
                'is_verified' :  ($('#location_region_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_region_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_location_region').on('click', function(e){
            var request = update_location_region(location_region_id);
            request.then(function(data) {
              $('#location_region_modal').modal('toggle')
              location_region_table.ajax.reload()             
            })
          })

          $('#location_region_table').on('click', '.update-location-region', function(e){
            $('#location_region_modal_header').html("Update Region");         
            init_update_location_region();
            location_region_id = $(this).parents('tr').attr('data-id');
            var request = view_location_region(location_region_id);

            request.then(function(data) {
              if(data['status'] == 1){
                $('#location_region_name').val(data['location_region']['region'])  
                $('#region_id').val(data['location_region']['region_id'])                  
                $('#area_code').val(data['location_region']['area_code'])    
                $('#location_region_tags').val(data['location_region']['tags'])         
                if(data['location_region']['is_verified'] == 1) {
                  $('#location_region_is_verified').iCheck('check'); 
                }    
                if(data['location_region']['is_active'] == 1) {
                  $('#location_region_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_region_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#location_region_table').on('click', '.delete-location-region', function(e){
            location_region_id = $(this).parents('tr').attr('data-id');
            delete_location_region(location_region_id);
          })

          function delete_location_region(location_region_id){
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
                  url: "{{ route('location_region.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : location_region_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Barangay has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    location_region_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}    
      {{-- END --}}
  
