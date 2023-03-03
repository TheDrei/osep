
      {{-- table start --}}
        var gender_table = $('#gender_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('gender.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'gender', name: 'gender'}, 
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
        var gender_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#gender_modal').on('hidden.bs.modal', function(){       
            init_view_gender();
           clear_fields()
            gender_table.ajax.reload()
          });  

          $('#gender_modal').on('shown.bs.modal', function () {
            $('#gender_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_gender(){
            $('.gender-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_gender(gender_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('gender.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : gender_id
              }
            });
            return request;
          }

          $('#gender_table').on('click', '.view-gender', function(e){     
            $('#gender_modal_header').html("View Field of Specialization");     
            gender_id = $(this).parents('tr').attr('data-id');
            init_view_gender();   
            var request = view_gender(gender_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#gender_name').val(data['gender']['gender'])  
                $('#municipality_id').val(data['gender']['municipality_id'])                  
                $('#gender_tags').val(data['gender']['tags']) 
                if(data['gender']['is_verified'] == 1) {
                  $('#gender_is_verified').iCheck('check'); 
                }    
                if(data['gender']['is_active'] == 1) {
                  $('#gender_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#gender_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_gender(){
            init_view_gender();
            $('.gender-field')
              .attr('disabled', false);

            $('#add_gender.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_gender(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('gender.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'gender' : $('#gender_name').val(),
                'gender_group_id' : $('#gender_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#gender_tags').val(),
                'is_verified' :  ($('#gender_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#gender_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_gender').on('click', function(e){ 
           clear_fields();
            init_add_gender();          
            $('#gender_modal_header').html("Add Field of Specialization");
            $('#gender_modal').modal('toggle')
          })

          $('#add_gender').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#gender_id)')) --}}
            var request = add_gender();
            request.then(function(data) {
              $('#gender_modal').modal('toggle')
              gender_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_gender(){
            init_view_gender()
            $('.gender-field')
              .attr('disabled', false);

            $('#update_gender.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_gender(gender_id){  
            // error_checking($('.gender-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('gender.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : gender_id,
                'gender' : $('#cgendername').val(),
                'gender_group_id' : $('#gender_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#gender_tags').val(),
                'is_verified' :  ($('#gender_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#gender_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_gender').on('click', function(e){
            var request = update_gender(gender_id);
            request.then(function(data) {
              $('#gender_modal').modal('toggle')
              gender_table.ajax.reload()             
            })
          })

          $('#gender_table').on('click', '.update-gender', function(e){
            $('#gender_modal_header').html("Update Field of Specialization");         
            init_update_gender();
            gender_id = $(this).parents('tr').attr('data-id');
            var request = view_gender(gender_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#gender_name').val(data['gender']['gender'])  
                $('#gender_group_id').val(data['gender']['gender_group_id'])                  
                $('#sector_id').val(data['gender']['sector_id']) 
                $('#gender_tags').val(data['gender']['tags']) 
                if(data['gender']['is_verified'] == 1) {
                  $('#gender_is_verified').iCheck('check'); 
                }    
                if(data['gender']['is_active'] == 1) {
                  $('#gender_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#gender_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#gender_table').on('click', '.delete-gender', function(e){
            gender_id = $(this).parents('tr').attr('data-id');
            delete_gender(gender_id);
          })

          function delete_gender(gender_id){
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
                  url: "{{ route('gender.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : gender_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    gender_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}