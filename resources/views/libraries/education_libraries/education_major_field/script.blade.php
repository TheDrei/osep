

      {{-- table end --}}
        var education_major_field_table = $('#education_major_field_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('education_major_field.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'education_major_field', name: 'education_major_field'},
              {data: 'sector', name: 'sector'},                  
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
        var education_major_field_id;       
      {{-- table end --}}

        
      {{-- START --}}
        {{-- modal start --}}
          $('#education_major_field_modal').on('hidden.bs.modal', function(){       
            init_view_education_major_field();
           clear_fields()
           education_major_field_table.ajax.reload()
          });  

          $('#education_major_field_modal').on('shown.bs.modal', function () {
            $('#education_major_field_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_education_major_field(){
            $('.education-major-field-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_education_major_field(education_major_field_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('education_major_field.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : education_major_field_id
              }
            });
            return request;
          }

          $('#education_major_field_table').on('click', '.view-education-major-field', function(e){     
            $('#education_major_field_modal_header').html("View Education Major Field");     
            education_major_field_id = $(this).parents('tr').attr('data-id');
            init_view_education_major_field();   
            var request = view_education_major_field(education_major_field_id);   
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#education_major_field_name').val(data['education_major_field']['education_major_field'])  
                $('#education_major_field_sector_id').val(data['education_major_field']['sector_id'])    
                $('#education_major_field_tags').val(data['education_major_field']['tags'])    
                if(data['education_major_field']['is_verified'] == 1) {
                  $('#education_major_field_is_verified').iCheck('check'); 
                }    
                if(data['education_major_field']['is_active'] == 1) {
                  $('#education_major_field_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#education_major_field_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_education_major_field(){
            init_view_education_major_field();
            $('.education-major-field-field')
              .attr('disabled', false);

            $('#add_education_major_field.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_education_major_field(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('education_major_field.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'education_major_field' : $('#education_major_field_name').val(),
                'sector_id' : $('#education_major_field_sector_id').val(),             
                'tags' : $('#education_major_field_tags').val(),
                'is_verified' :  ($('#education_major_field_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#education_major_field_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_education_major_field').on('click', function(e){ 
           clear_fields();
            init_add_education_major_field();          
            $('#education_major_field_modal_header').html("Add Education Major Field");
            $('#education_major_field_modal').modal('toggle')
          })

          $('#add_education_major_field').on('click', function(e){            
            var request = add_education_major_field();
            request.then(function(data) {
              $('#education_major_field_modal').modal('toggle')
             education_major_field_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_education_major_field(){
            init_view_education_major_field()
            $('.education-major-field-field')
              .attr('disabled', false);

            $('#update_education_major_field.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_education_major_field(education_major_field_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('education_major_field.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : education_major_field_id,
                'education_major_field' : $('#education_major_field_name').val(),               
                'sector_id' : $('#education_major_field_sector_id').val(),
                'tags' : $('#education_major_field_tags').val(),
                'is_verified' :  ($('#education_major_field_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#education_major_field_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_education_major_field').on('click', function(e){
            var request = update_education_major_field(education_major_field_id);
            request.then(function(data) {
              $('#education_major_field_modal').modal('toggle')
             education_major_field_table.ajax.reload()             
            })
          })

          $('#education_major_field_table').on('click', '.update-education-major-field', function(e){
            $('#education_major_field_modal_header').html("Update Education Major Field");         
            init_update_education_major_field();
            education_major_field_id = $(this).parents('tr').attr('data-id');
            var request = view_education_major_field(education_major_field_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#education_major_field_name').val(data['education_major_field']['education_major_field'])  
                $('#education_major_field_sector_id').val(data['education_major_field']['sector_id'])                      
                $('#education_major_field_tags').val(data['education_major_field']['tags'])    
                if(data['education_major_field']['is_verified'] == 1) {
                  $('#education_major_field_is_verified').iCheck('check'); 
                }    
                if(data['education_major_field']['is_active'] == 1) {
                  $('#education_major_field_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#education_major_field_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#education_major_field_table').on('click', '.delete-education-major-field', function(e){
            education_major_field_id = $(this).parents('tr').attr('data-id');
            delete_education_major_field(education_major_field_id);
          })

          function delete_education_major_field(education_major_field_id){
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
                  url: "{{ route('education_major_field.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : education_major_field_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                   education_major_field_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}      
      {{-- END --}}
 
