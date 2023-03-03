
      {{-- table start --}}
        var area_concern_table = $('#area_concern_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('area_concern.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'area_concern', name: 'area_concern'}, 
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
        var area_concern_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#area_concern_modal').on('hidden.bs.modal', function(){       
            init_view_area_concern();
           clear_fields()
            area_concern_table.ajax.reload()
          });  

          $('#area_concern_modal').on('shown.bs.modal', function () {
            $('#area_concern_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_area_concern(){
            $('.area-concern-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_area_concern(area_concern_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('area_concern.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : area_concern_id
              }
            });
            return request;
          }

          $('#area_concern_table').on('click', '.view-area-concern', function(e){     
            $('#area_concern_modal_header').html("View Field of Specialization");     
            area_concern_id = $(this).parents('tr').attr('data-id');
            init_view_area_concern();   
            var request = view_area_concern(area_concern_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#area_concern_name').val(data['area_concern']['area_concern'])  
                $('#municipality_id').val(data['area_concern']['municipality_id'])                  
                $('#area_concern_tags').val(data['area_concern']['tags']) 
                if(data['area_concern']['is_verified'] == 1) {
                  $('#area_concern_is_verified').iCheck('check'); 
                }    
                if(data['area_concern']['is_active'] == 1) {
                  $('#area_concern_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#area_concern_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_area_concern(){
            init_view_area_concern();
            $('.area-concern-field')
              .attr('disabled', false);

            $('#add_area_concern.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_area_concern(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('area_concern.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'area_concern' : $('#area_concern_name').val(),
                'area_concern_group_id' : $('#area_concern_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#area_concern_tags').val(),
                'is_verified' :  ($('#area_concern_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#area_concern_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_area_concern').on('click', function(e){ 
           clear_fields();
            init_add_area_concern();          
            $('#area_concern_modal_header').html("Add Field of Specialization");
            $('#area_concern_modal').modal('toggle')
          })

          $('#add_area_concern').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#area_concern_id)')) --}}
            var request = add_area_concern();
            request.then(function(data) {
              $('#area_concern_modal').modal('toggle')
              area_concern_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_area_concern(){
            init_view_area_concern()
            $('.area-concern-field')
              .attr('disabled', false);

            $('#update_area_concern.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_area_concern(area_concern_id){  
            // error_checking($('.area-concern-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('area_concern.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : area_concern_id,
                'area_concern' : $('#carea_concernname').val(),
                'area_concern_group_id' : $('#area_concern_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#area_concern_tags').val(),
                'is_verified' :  ($('#area_concern_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#area_concern_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_area_concern').on('click', function(e){
            var request = update_area_concern(area_concern_id);
            request.then(function(data) {
              $('#area_concern_modal').modal('toggle')
              area_concern_table.ajax.reload()             
            })
          })

          $('#area_concern_table').on('click', '.update-area-concern', function(e){
            $('#area_concern_modal_header').html("Update Field of Specialization");         
            init_update_area_concern();
            area_concern_id = $(this).parents('tr').attr('data-id');
            var request = view_area_concern(area_concern_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#area_concern_name').val(data['area_concern']['area_concern'])  
                $('#area_concern_group_id').val(data['area_concern']['area_concern_group_id'])                  
                $('#sector_id').val(data['area_concern']['sector_id']) 
                $('#area_concern_tags').val(data['area_concern']['tags']) 
                if(data['area_concern']['is_verified'] == 1) {
                  $('#area_concern_is_verified').iCheck('check'); 
                }    
                if(data['area_concern']['is_active'] == 1) {
                  $('#area_concern_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#area_concern_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#area_concern_table').on('click', '.delete-area-concern', function(e){
            area_concern_id = $(this).parents('tr').attr('data-id');
            delete_area_concern(area_concern_id);
          })

          function delete_area_concern(area_concern_id){
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
                  url: "{{ route('area_concern.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : area_concern_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    area_concern_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}