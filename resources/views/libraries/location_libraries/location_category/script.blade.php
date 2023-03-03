
      {{-- table start --}}
        var location_category_table = $('#location_category_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('location_category.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'category', name: 'category'},
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

        var location_category_id;
     
      {{-- table end --}}

      {{-- START --}}
        {{-- modal start --}}
          $('#location_category_modal').on('hidden.bs.modal', function(){       
            init_view_location_category();
           clear_fields()
            location_category_table.ajax.reload()
          });  

          $('#location_category_modal').on('shown.bs.modal', function () {
            $('#location_category_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_location_category(){
            $('.location-category-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_location_category(location_category_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('location_category.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_category_id
              }
            });
            return request;
          }

          $('#location_category_table').on('click', '.view-location-category', function(e){     
            $('#location_category_modal_header').html("View Location Category");     
            location_category_id = $(this).parents('tr').attr('data-id');
            init_view_location_category();   
            var request = view_location_category(location_category_id);   
            request.then(function(data) {
              if(data['status'] == 1){         
                $('#location_category_name').val(data['location_category']['category'])  
                $('#region_id').val(data['location_category']['region_id'])                  
                $('#area_code').val(data['location_category']['area_code'])    
                $('#location_category_tags').val(data['location_category']['tags'])    
                if(data['location_category']['is_verified'] == 1) {
                  $('#location_category_is_verified').iCheck('check'); 
                }    
                if(data['location_category']['is_active'] == 1) {
                  $('#location_category_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_category_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_location_category(){
            init_view_location_category();
            $('.location-category-field')
              .attr('disabled', false);

            $('#add_location_category.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_location_category(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('location_category.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'category' : $('#location_category_name').val(),            
                'region_id' : $('#region_id').val(),            
                'area_code' : $('#area_code').val(),            
                'tags' : $('#location_category_tags').val(),
                'is_verified' :  ($('#location_category_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_category_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_location_category').on('click', function(e){ 
           clear_fields();
            init_add_location_category();          
            $('#location_category_modal_header').html("Add Location Category");
            $('#location_category_modal').modal('toggle')
          })

          $('#add_location_category').on('click', function(e){            
            var request = add_location_category();
            request.then(function(data) {
              $('#location_category_modal').modal('toggle')
              location_category_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_location_category(){
            init_view_location_category()
            $('.location-category-field')
              .attr('disabled', false);

            $('#update_location_category.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_location_category(location_category_id){  
            // error_checking($('.location-category-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('location_category.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_category_id,
                'category' : $('#location_category_name').val(),            
                'region_id' : $('#region_id').val(),            
                'area_code' : $('#area_code').val(),                  
                'tags' : $('#location_category_tags').val(),
                'is_verified' :  ($('#location_category_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_category_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_location_category').on('click', function(e){
            var request = update_location_category(location_category_id);
            request.then(function(data) {
              $('#location_category_modal').modal('toggle')
              location_category_table.ajax.reload()             
            })
          })

          $('#location_category_table').on('click', '.update-location-category', function(e){
            $('#location_category_modal_header').html("Update Location Category");         
            init_update_location_category();
            location_category_id = $(this).parents('tr').attr('data-id');
            var request = view_location_category(location_category_id);

            request.then(function(data) {
              if(data['status'] == 1){
                $('#location_category_name').val(data['location_category']['category'])  
                $('#region_id').val(data['location_category']['region_id'])                  
                $('#area_code').val(data['location_category']['area_code'])    
                $('#location_category_tags').val(data['location_category']['tags'])         
                if(data['location_category']['is_verified'] == 1) {
                  $('#location_category_is_verified').iCheck('check'); 
                }    
                if(data['location_category']['is_active'] == 1) {
                  $('#location_category_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_category_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#location_category_table').on('click', '.delete-location-category', function(e){
            location_category_id = $(this).parents('tr').attr('data-id');
            delete_location_category(location_category_id);
          })

          function delete_location_category(location_category_id){
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
                  url: "{{ route('location_category.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : location_category_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Barangay has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    location_category_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}    
      {{-- END --}}
  
