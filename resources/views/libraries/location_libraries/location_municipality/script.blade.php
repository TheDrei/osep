
      {{-- table start --}}
        var location_municipality_table = $('#location_municipality_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('location_municipality.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'municipality', name: 'municipality'},
              {data: 'district', name: 'district'},
              {data: 'province', name: 'province'},
              {data: 'full_name', name: 'full_name'},
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

        var locatoin_municipality_id;
     
      {{-- table end --}}

      {{-- START --}}
        {{-- modal start --}}
          $('#location_municipality_modal').on('hidden.bs.modal', function(){       
            init_view_location_municipality();
           clear_fields()
            location_municipality_table.ajax.reload()
          });  

          $('#location_municipality_modal').on('shown.bs.modal', function () {
            $('#location_municipality_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_location_municipality(){
            $('.location-municipality-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_location_municipality(location_municipality_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('location_municipality.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_municipality_id
              }
            });
            return request;
          }

          $('#location_municipality_table').on('click', '.view-location-municipality', function(e){     
            $('#location_municipality_modal_header').html("View Municipality");     
            location_municipality_id = $(this).parents('tr').attr('data-id');
            init_view_location_municipality();   
            var request = view_location_municipality(location_municipality_id);   
            request.then(function(data) {
              if(data['status'] == 1){         
                $('#location_municipality_name').val(data['location_municipality']['municipality'])  
                $('#district_id').val(data['location_municipality']['district_id'])                  
                $('#province_id').val(data['location_municipality']['province_id'])    
                $('#location_municipality_tags').val(data['location_municipality']['tags'])    
                if(data['location_municipality']['is_verified'] == 1) {
                  $('#location_municipality_is_verified').iCheck('check'); 
                }    
                if(data['location_municipality']['is_active'] == 1) {
                  $('#location_municipality_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_municipality_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_location_municipality(){
            init_view_location_municipality();
            $('.location-municipality-field')
              .attr('disabled', false);

            $('#add_location_municipality.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          $('#add_new_location_municipality').on('click', function(){  
            init_add_location_municipality();          
            $('#location_municipality_modal_header').html("Add Municipality");
            $('#location_municipality_modal').modal('toggle')
          })

          $('#add_location_municipality').on('click', function(event){   
            event.prevenDefault;      
            clear_attributes()      
            $.ajax({
              method: "POST",
              url: "{{ route('location_municipality.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'municipality' : $('#location_municipality_name').val(),   
                'province_id' : $('#province_id').val(),   
                'tags' : $('#location_municipality_tags').val(),
                'is_verified' :  ($('#location_municipality_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_municipality_is_active').iCheck('update')[0].checked ? 1  : 0)
              },
              success:function(data) {
                console.log(data);
                if(data.errors) {   
                  if(data.errors.municipality){
                    $('#location_municipality_name').addClass('is-invalid');
                    $('#municipality-name-error').html(data.errors.municipality[0]);
                  }    
                  if(data.errors.province_id){
                    $('#province_id').addClass('is-invalid');
                    $('#province-error').html(data.errors.province_id[0]);
                  }                 
                }
                if(data.success) {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Municipality has been successfully added.',
                    showConfirmButton: false,
                    timer: 1500
                  }) 
                  $('#location_municipality_modal').modal('toggle')
                  location_municipality_table.ajax.reload();
                }
              },
            });
          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_location_municipality(){
            init_view_location_municipality()
            $('.location-municipality-field')
              .attr('disabled', false);

            $('#update_location_municipality.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_location_municipality(location_municipality_id){  
            // error_checking($('.location-municipality-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('location_municipality.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_municipality_id,
                'municipality' : $('#location_municipality_name').val(),            
                'district_id' : $('#district_id').val(),            
                'province_id' : $('#province_id').val(),                  
                'tags' : $('#location_municipality_tags').val(),
                'is_verified' :  ($('#location_municipality_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_municipality_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_location_municipality').on('click', function(e){
            var request = update_location_municipality(location_municipality_id);
            request.then(function(data) {
              $('#location_municipality_modal').modal('toggle')
              location_municipality_table.ajax.reload()             
            })
          })

          $('#location_municipality_table').on('click', '.update-location-municipality', function(e){
            $('#location_municipality_modal_header').html("Update Municipality");         
            init_update_location_municipality();
            location_municipality_id = $(this).parents('tr').attr('data-id');
            var request = view_location_municipality(location_municipality_id);

            request.then(function(data) {
              if(data['status'] == 1){
                $('#location_municipality_name').val(data['location_municipality']['municipality'])  
                $('#district_id').val(data['location_municipality']['district_id'])                  
                $('#province_id').val(data['location_municipality']['province_id'])    
                $('#location_municipality_tags').val(data['location_municipality']['tags'])         
                if(data['location_municipality']['is_verified'] == 1) {
                  $('#location_municipality_is_verified').iCheck('check'); 
                }    
                if(data['location_municipality']['is_active'] == 1) {
                  $('#location_municipality_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_municipality_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#location_municipality_table').on('click', '.delete-location-municipality', function(e){
            location_municipality_id = $(this).parents('tr').attr('data-id');
            delete_location_municipality(location_municipality_id);
          })

          function delete_location_municipality(location_municipality_id){
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
                  url: "{{ route('location_municipality.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : location_municipality_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'municipality has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    location_municipality_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}    
      {{-- END --}}
  
