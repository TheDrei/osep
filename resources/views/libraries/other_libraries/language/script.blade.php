
      {{-- table start --}}
        var language_table = $('#language_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('language.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'language', name: 'language'}, 
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
        var language_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#language_modal').on('hidden.bs.modal', function(){       
            init_view_language();
           clear_fields()
            language_table.ajax.reload()
          });  

          $('#language_modal').on('shown.bs.modal', function () {
            $('#language_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_language(){
            $('.language-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_language(language_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('language.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : language_id
              }
            });
            return request;
          }

          $('#language_table').on('click', '.view-language', function(e){     
            $('#language_modal_header').html("View Field of Specialization");     
            language_id = $(this).parents('tr').attr('data-id');
            init_view_language();   
            var request = view_language(language_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#language_name').val(data['language']['language'])  
                $('#municipality_id').val(data['language']['municipality_id'])                  
                $('#language_tags').val(data['language']['tags']) 
                if(data['language']['is_verified'] == 1) {
                  $('#language_is_verified').iCheck('check'); 
                }    
                if(data['language']['is_active'] == 1) {
                  $('#language_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#language_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_language(){
            init_view_language();
            $('.language-field')
              .attr('disabled', false);

            $('#add_language.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_language(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('language.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'language' : $('#language_name').val(),
                'language_group_id' : $('#language_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#language_tags').val(),
                'is_verified' :  ($('#language_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#language_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_language').on('click', function(e){ 
           clear_fields();
            init_add_language();          
            $('#language_modal_header').html("Add Field of Specialization");
            $('#language_modal').modal('toggle')
          })

          $('#add_language').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#language_id)')) --}}
            var request = add_language();
            request.then(function(data) {
              $('#language_modal').modal('toggle')
              language_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_language(){
            init_view_language()
            $('.language-field')
              .attr('disabled', false);

            $('#update_language.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_language(language_id){  
            // error_checking($('.language-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('language.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : language_id,
                'language' : $('#clanguagename').val(),
                'language_group_id' : $('#language_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#language_tags').val(),
                'is_verified' :  ($('#language_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#language_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_language').on('click', function(e){
            var request = update_language(language_id);
            request.then(function(data) {
              $('#language_modal').modal('toggle')
              language_table.ajax.reload()             
            })
          })

          $('#language_table').on('click', '.update-language', function(e){
            $('#language_modal_header').html("Update Field of Specialization");         
            init_update_language();
            language_id = $(this).parents('tr').attr('data-id');
            var request = view_language(language_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#language_name').val(data['language']['language'])  
                $('#language_group_id').val(data['language']['language_group_id'])                  
                $('#sector_id').val(data['language']['sector_id']) 
                $('#language_tags').val(data['language']['tags']) 
                if(data['language']['is_verified'] == 1) {
                  $('#language_is_verified').iCheck('check'); 
                }    
                if(data['language']['is_active'] == 1) {
                  $('#language_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#language_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#language_table').on('click', '.delete-language', function(e){
            language_id = $(this).parents('tr').attr('data-id');
            delete_language(language_id);
          })

          function delete_language(language_id){
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
                  url: "{{ route('language.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : language_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    language_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}