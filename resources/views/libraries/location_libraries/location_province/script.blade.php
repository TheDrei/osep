
      {{-- table start --}}
        var location_province_table = $('#location_province_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('location_province.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'province', name: 'province'},
              {data: 'region', name: 'region'},
              {data: 'area_code', name: 'area_code'},
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

        var location_province_id;
     
      {{-- table end --}}

      {{-- START --}}
        {{-- modal start --}}
          $('#location_province_modal').on('hidden.bs.modal', function(){       
            init_view_location_province();
           clear_fields()
            location_province_table.ajax.reload()
          });  

          $('#location_province_modal').on('shown.bs.modal', function () {
            $('#location_province_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_location_province(){
            $('.location-province-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_location_province(location_province_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('location_province.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_province_id
              }
            });
            return request;
          }

          $('#location_province_table').on('click', '.view-location-province', function(e){     
            $('#location_province_modal_header').html("View Province");     
            location_province_id = $(this).parents('tr').attr('data-id');
            init_view_location_province();   
            var request = view_location_province(location_province_id);   
            request.then(function(data) {
              if(data['status'] == 1){         
                $('#location_province_name').val(data['location_province']['province'])  
                $('#region_id').val(data['location_province']['region_id'])                  
                $('#area_code').val(data['location_province']['area_code'])    
                $('#location_province_tags').val(data['location_province']['tags'])    
                if(data['location_province']['is_verified'] == 1) {
                  $('#location_province_is_verified').iCheck('check'); 
                }    
                if(data['location_province']['is_active'] == 1) {
                  $('#location_province_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_province_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_location_province(){
            init_view_location_province();
            $('.location-province-field')
              .attr('disabled', false);

            $('#add_location_province.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_location_province(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('location_province.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'province' : $('#location_province_name').val(),            
                'region_id' : $('#region_id').val(),            
                'area_code' : $('#area_code').val(),            
                'tags' : $('#location_province_tags').val(),
                'is_verified' :  ($('#location_province_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_province_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_location_province').on('click', function(e){ 
           clear_fields();
            init_add_location_province();          
            $('#location_province_modal_header').html("Add Province");
            $('#location_province_modal').modal('toggle')
          })

          $('#add_location_province').on('click', function(e){            
            var request = add_location_province();
            request.then(function(data) {
              $('#location_province_modal').modal('toggle')
              location_province_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_location_province(){
            init_view_location_province()
            $('.location-province-field')
              .attr('disabled', false);

            $('#update_location_province.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_location_province(location_province_id){  
            // error_checking($('.location-province-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('location_province.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_province_id,
                'province' : $('#location_province_name').val(),            
                'region_id' : $('#region_id').val(),            
                'area_code' : $('#area_code').val(),                  
                'tags' : $('#location_province_tags').val(),
                'is_verified' :  ($('#location_province_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_province_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_location_province').on('click', function(e){
            var request = update_location_province(location_province_id);
            request.then(function(data) {
              $('#location_province_modal').modal('toggle')
              location_province_table.ajax.reload()             
            })
          })

          $('#location_province_table').on('click', '.update-location-province', function(e){
            $('#location_province_modal_header').html("Update Province");         
            init_update_location_province();
            location_province_id = $(this).parents('tr').attr('data-id');
            var request = view_location_province(location_province_id);

            request.then(function(data) {
              if(data['status'] == 1){
                $('#location_province_name').val(data['location_province']['province'])  
                $('#region_id').val(data['location_province']['region_id'])                  
                $('#area_code').val(data['location_province']['area_code'])    
                $('#location_province_tags').val(data['location_province']['tags'])         
                if(data['location_province']['is_verified'] == 1) {
                  $('#location_province_is_verified').iCheck('check'); 
                }    
                if(data['location_province']['is_active'] == 1) {
                  $('#location_province_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_province_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#location_province_table').on('click', '.delete-location-province', function(e){
            location_province_id = $(this).parents('tr').attr('data-id');
            delete_location_province(location_province_id);
          })

          function delete_location_province(location_province_id){
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
                  url: "{{ route('location_province.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : location_province_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Barangay has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    location_province_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}    
      {{-- END --}}
  
