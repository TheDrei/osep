

      {{-- table start --}}
        var education_degree_table = $('#education_degree_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('education_degree.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'education_degree', name: 'education_degree'},       
              {data: 'acronym', name: 'acronym'},       
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
        var education_degree_id;       
      {{-- table end --}}
  
      {{-- START --}}
        {{-- modal start --}}
          $('#education_degree_modal').on('hidden.bs.modal', function(){       
            init_view_education_degree();
           clear_fields()
            education_degree_table.ajax.reload()
          });  

          $('#education_degree_modal').on('shown.bs.modal', function () {
            $('#education_degree_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_education_degree(){
            $('.education-degree-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_education_degree(education_degree_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('education_degree.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : education_degree_id
              }
            });
            return request;
          }

          $('#education_degree_table').on('click', '.view-education-degree', function(e){     
            $('#education_degree_modal_header').html("View Education Degree");     
            education_degree_id = $(this).parents('tr').attr('data-id');
            init_view_education_degree();   
            var request = view_education_degree(education_degree_id);   
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#education_degree_name').val(data['education_degree']['education_degree'])    
                $('#education_degree_acronym').val(data['education_degree']['acronym'])    
                $('#education_degree_tags').val(data['education_degree']['tags'])    
                if(data['education_degree']['is_verified'] == 1) {
                  $('#education_degree_is_verified').iCheck('check'); 
                }    
                if(data['education_degree']['is_active'] == 1) {
                  $('#education_degree_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#education_degree_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_education_degree(){
            init_view_education_degree();
            $('.education-degree-field')
              .attr('disabled', false);

            $('#add_education_degree.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_education_degree(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('education_degree.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'education_degree' : $('#education_degree_name').val(),
                'acronym' : $('#education_degree_acronym').val(),
                'tags' : $('#education_degree_tags').val(),
                'is_verified' :  ($('#education_degree_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#education_degree_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_education_degree').on('click', function(e){ 
            
           clear_fields();
            init_add_education_degree();          
            $('#education_degree_modal_header').html("Add Education Degree");
            $('#education_degree_modal').modal('toggle')
          })

          $('#add_education_degree').on('click', function(e){            
            var request = add_education_degree();
            request.then(function(data) {
              $('#education_degree_modal').modal('toggle')
              education_degree_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_education_degree(){
            init_view_education_degree()
            $('.education-degree-field')
              .attr('disabled', false);

            $('#update_education_degree.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_education_degree(education_degree_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('education_degree.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : education_degree_id,
                'education_degree' : $('#education_degree_name').val(),
                'acronym' : $('#education_degree_acronym').val(),
                'tags' : $('#education_degree_tags').val(),
                'is_verified' :  ($('#education_degree_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#education_degree_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_education_degree').on('click', function(e){
            var request = update_education_degree(education_degree_id);
            request.then(function(data) {
              $('#education_degree_modal').modal('toggle')
              education_degree_table.ajax.reload()             
            })
          })

          $('#education_degree_table').on('click', '.update-education-degree', function(e){
            $('#education_degree_modal_header').html("Update Education Degree");         
            init_update_education_degree();
            education_degree_id = $(this).parents('tr').attr('data-id');
            var request = view_education_degree(education_degree_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#education_degree_name').val(data['education_degree']['education_degree'])                
                $('#education_degree_acronym').val(data['education_degree']['acronym'])                
                $('#education_degree_tags').val(data['education_degree']['tags'])    
                if(data['education_degree']['is_verified'] == 1) {
                  $('#education_degree_is_verified').iCheck('check'); 
                }    
                if(data['education_degree']['is_active'] == 1) {
                  $('#education_degree_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#education_degree_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#education_degree_table').on('click', '.delete-education-degree', function(e){
            education_degree_id = $(this).parents('tr').attr('data-id');
            delete_education_degree(education_degree_id);
          })

          function delete_education_degree(education_degree_id){
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
                  url: "{{ route('education_degree.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : education_degree_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    education_degree_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}      
      {{-- END --}}
 