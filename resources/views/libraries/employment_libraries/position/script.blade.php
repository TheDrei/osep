

      {{-- table start --}}
        var position_table = $('#position_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('position.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'position', name: 'position'},      
              {data: 'description', name: 'description'},      
              {data: 'acronym', name: 'acronym'},      
              {data: 'abbreviation', name: 'abbreviation'},      
              {data: 'salary_grade', name: 'salary_grade'},      
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
        var position_id;       
      {{-- table end --}}
      
      {{-- STARt --}}
        {{-- modal start --}}
          $('#position_modal').on('hidden.bs.modal', function(){       
            init_view_position();
           clear_fields()
            position_table.ajax.reload()
          });  

          $('#position_modal').on('shown.bs.modal', function () {
            $('#position_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_position(){
            $('.position-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_position(position_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('position.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : position_id
              }
            });
            return request;
          }

          $('#position_table').on('click', '.view-position', function(e){     
            $('#position_modal_header').html("View position");     
            position_id = $(this).parents('tr').attr('data-id');
            init_view_position();   
            var request = view_position(position_id);   
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#position_name').val(data['position']['position'])              
                $('#position_description').val(data['position']['description'])              
                $('#position_acronym').val(data['position']['acronym'])              
                $('#position_abbreviation').val(data['position']['abbreviation'])              
                $('#salary_grade').val(data['position']['salary_grade'])              
                $('#position_tags').val(data['position']['tags'])    
                if(data['position']['is_verified'] == 1) {
                  $('#position_is_verified').iCheck('check'); 
                }    
                if(data['position']['is_active'] == 1) {
                  $('#position_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#position_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_position(){
            init_view_position();
            $('.position-field')
              .attr('disabled', false);

            $('#add_position.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_position(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('position.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'position' : $('#position_name').val(),            
                'description' : $('#position_description').val(),            
                'acronym' : $('#position_acronym').val(),            
                'abbreviation' : $('#position_abbreviation').val(),            
                'salary_grade' : $('#salary_grade').val(),            
                'tags' : $('#position_tags').val(),
                'is_verified' :  ($('#position_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#position_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_position').on('click', function(e){           
           clear_fields();
            init_add_position();          
            $('#position_modal_header').html("Add position");
            $('#position_modal').modal('toggle')
          })

          $('#add_position').on('click', function(e){            
            var request = add_position();
            request.then(function(data) {
              $('#position_modal').modal('toggle')
              position_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_position(){
            init_view_position()
            $('.position-field')
              .attr('disabled', false);

            $('#update_position.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_position(position_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('position.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : position_id,
                'position' : $('#position_name').val(),            
                'description' : $('#position_description').val(),            
                'acronym' : $('#position_acronym').val(),            
                'abbreviation' : $('#position_abbreviation').val(),            
                'salary_grade' : $('#salary_grade').val(),            
                'tags' : $('#position_tags').val(),
                'is_verified' :  ($('#position_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#position_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_position').on('click', function(e){
            var request = update_position(position_id);
            request.then(function(data) {
              $('#position_modal').modal('toggle')
              position_table.ajax.reload()             
            })
          })

          $('#position_table').on('click', '.update-position', function(e){
            $('#position_modal_header').html("Update position");         
            init_update_position();
            position_id = $(this).parents('tr').attr('data-id');
            var request = view_position(position_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#position_name').val(data['position']['position'])              
                $('#position_description').val(data['position']['description'])              
                $('#position_acronym').val(data['position']['acronym'])              
                $('#position_abbreviation').val(data['position']['abbreviation'])              
                $('#salary_grade').val(data['position']['salary_grade'])                            
                $('#position_tags').val(data['position']['tags'])    
                if(data['position']['is_verified'] == 1) {
                  $('#position_is_verified').iCheck('check'); 
                }    
                if(data['position']['is_active'] == 1) {
                  $('#position_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#position_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#position_table').on('click', '.delete-position', function(e){
            position_id = $(this).parents('tr').attr('data-id');
            delete_position(position_id);
          })

          function delete_position(position_id){
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
                  url: "{{ route('position.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : position_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    position_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}      
      {{-- END --}}

  
   