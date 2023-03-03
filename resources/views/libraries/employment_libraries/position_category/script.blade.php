

      {{-- table start --}}
        var position_category_table = $('#position_category_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('position_category.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'position_category', name: 'position_category'},      
              {data: 'abbreviation', name: 'abbreviation'},       
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
        var position_category_id;       
      {{-- table end --}}
      
      {{-- START --}}
        {{-- modal start --}}
          $('#position_category_modal').on('hidden.bs.modal', function(){       
            init_view_position_category();
           clear_fields()
            position_category_table.ajax.reload()
          });  

          $('#position_category_modal').on('shown.bs.modal', function () {
            $('#position_category_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_position_category(){
            $('.position-category-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_position_category(position_category_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('position_category.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : position_category_id
              }
            });
            return request;
          }

          $('#position_category_table').on('click', '.view-position-category', function(e){     
            $('#position_category_modal_header').html("View Position Category");     
            position_category_id = $(this).parents('tr').attr('data-id');
            init_view_position_category();   
            var request = view_position_category(position_category_id);   
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#position_category_name').val(data['position_category']['position_category'])              
                $('#position_category_abbreviation').val(data['position_category']['abbreviation'])                  
                $('#position_category_tags').val(data['position_category']['tags'])    
                if(data['position_category']['is_verified'] == 1) {
                  $('#position_category_is_verified').iCheck('check'); 
                }    
                if(data['position_category']['is_active'] == 1) {
                  $('#position_category_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#position_category_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_position_category(){
            init_view_position_category();
            $('.position-category-field')
              .attr('disabled', false);

            $('#add_position_category.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_position_category(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('position_category.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'position_category' : $('#position_category_name').val(),            
                'abbreviation' : $('#position_category_abbreviation').val(),             
                'tags' : $('#position_category_tags').val(),
                'is_verified' :  ($('#position_category_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#position_category_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_position_category').on('click', function(e){           
           clear_fields();
            init_add_position_category();          
            $('#position_category_modal_header').html("Add Position Category");
            $('#position_category_modal').modal('toggle')
          })

          $('#add_position_category').on('click', function(e){            
            var request = add_position_category();
            request.then(function(data) {
              $('#position_category_modal').modal('toggle')
              position_category_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_position_category(){
            init_view_position_category()
            $('.position-category-field')
              .attr('disabled', false);

            $('#update_position_category.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_position_category(position_category_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('position_category.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : position_category_id,
                'position_category' : $('#position_category_name').val(),            
                'abbreviation' : $('#position_category_abbreviation').val(),              
                'tags' : $('#position_category_tags').val(),
                'is_verified' :  ($('#position_category_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#position_category_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_position_category').on('click', function(e){
            var request = update_position_category(position_category_id);
            request.then(function(data) {
              $('#position_category_modal').modal('toggle')
              position_category_table.ajax.reload()             
            })
          })

          $('#position_category_table').on('click', '.update-position-category', function(e){
            $('#position_category_modal_header').html("Update Position Category");         
            init_update_position_category();
            position_category_id = $(this).parents('tr').attr('data-id');
            var request = view_position_category(position_category_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#position_category_name').val(data['position_category']['position_category'])              
                $('#position_category_abbreviation').val(data['position_category']['abbreviation'])                             
                $('#position_category_tags').val(data['position_category']['tags'])    
                if(data['position_category']['is_verified'] == 1) {
                  $('#position_category_is_verified').iCheck('check'); 
                }    
                if(data['position_category']['is_active'] == 1) {
                  $('#position_category_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#position_category_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#position_category_table').on('click', '.delete-position-category', function(e){
            position_category_id = $(this).parents('tr').attr('data-id');
            delete_position_category(position_category_id);
          })

          function delete_position_category(position_category_id){
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
                  url: "{{ route('position_category.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : position_category_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    position_category_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}    
      {{-- END --}}

  
   