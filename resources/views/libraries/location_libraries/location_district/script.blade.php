
      {{-- table start --}}
        var location_district_table = $('#location_district_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('location_district.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'district', name: 'district'},
              {data: 'district_number', name: 'district_number'},
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

        var location_district_id;
     
      {{-- table end --}}

      {{-- START --}}
        {{-- modal start --}}
          $('#location_district_modal').on('hidden.bs.modal', function(){       
            init_view_location_district();
           clear_fields()
            location_district_table.ajax.reload()
          });  

          $('#location_district_modal').on('shown.bs.modal', function () {
            $('#location_district_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_location_district(){
            $('.location-district-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_location_district(location_district_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('location_district.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_district_id
              }
            });
            return request;
          }

          $('#location_district_table').on('click', '.view-location-district', function(e){     
            $('#location_district_modal_header').html("View District");     
            location_district_id = $(this).parents('tr').attr('data-id');
            init_view_location_district();   
            var request = view_location_district(location_district_id);   
            request.then(function(data) {
              if(data['status'] == 1){         
                $('#location_district_name').val(data['location_district']['district'])  
                $('#region_id').val(data['location_district']['region_id'])                  
                $('#area_code').val(data['location_district']['area_code'])    
                $('#location_district_tags').val(data['location_district']['tags'])    
                if(data['location_district']['is_verified'] == 1) {
                  $('#location_district_is_verified').iCheck('check'); 
                }    
                if(data['location_district']['is_active'] == 1) {
                  $('#location_district_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_district_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_location_district(){
            init_view_location_district();
            $('.location-district-field')
              .attr('disabled', false);

            $('#add_location_district.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_location_district(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('location_district.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'district' : $('#location_district_name').val(),            
                'region_id' : $('#region_id').val(),            
                'area_code' : $('#area_code').val(),            
                'tags' : $('#location_district_tags').val(),
                'is_verified' :  ($('#location_district_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_district_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_location_district').on('click', function(e){ 
           clear_fields();
            init_add_location_district();          
            $('#location_district_modal_header').html("Add District");
            $('#location_district_modal').modal('toggle')
          })

          $('#add_location_district').on('click', function(e){            
            var request = add_location_district();
            request.then(function(data) {
              $('#location_district_modal').modal('toggle')
              location_district_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_location_district(){
            init_view_location_district()
            $('.location-district-field')
              .attr('disabled', false);

            $('#update_location_district.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_location_district(location_district_id){  
            // error_checking($('.location-district-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('location_district.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_district_id,
                'district' : $('#location_district_name').val(),            
                'region_id' : $('#region_id').val(),            
                'area_code' : $('#area_code').val(),                  
                'tags' : $('#location_district_tags').val(),
                'is_verified' :  ($('#location_district_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_district_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_location_district').on('click', function(e){
            var request = update_location_district(location_district_id);
            request.then(function(data) {
              $('#location_district_modal').modal('toggle')
              location_district_table.ajax.reload()             
            })
          })

          $('#location_district_table').on('click', '.update-location-district', function(e){
            $('#location_district_modal_header').html("Update District");         
            init_update_location_district();
            location_district_id = $(this).parents('tr').attr('data-id');
            var request = view_location_district(location_district_id);

            request.then(function(data) {
              if(data['status'] == 1){
                $('#location_district_name').val(data['location_district']['district'])  
                $('#region_id').val(data['location_district']['region_id'])                  
                $('#area_code').val(data['location_district']['area_code'])    
                $('#location_district_tags').val(data['location_district']['tags'])         
                if(data['location_district']['is_verified'] == 1) {
                  $('#location_district_is_verified').iCheck('check'); 
                }    
                if(data['location_district']['is_active'] == 1) {
                  $('#location_district_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_district_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#location_district_table').on('click', '.delete-location-district', function(e){
            location_district_id = $(this).parents('tr').attr('data-id');
            delete_location_district(location_district_id);
          })

          function delete_location_district(location_district_id){
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
                  url: "{{ route('location_district.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : location_district_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Barangay has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    location_district_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}    
      {{-- END --}}
 
