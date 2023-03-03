
      {{-- table start --}}
        var document_type_table = $('#document_type_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('document_type.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'document_type', name: 'document_type'}, 
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
        var document_type_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#document_type_modal').on('hidden.bs.modal', function(){       
            init_view_document_type();
           clear_fields()
            document_type_table.ajax.reload()
          });  

          $('#document_type_modal').on('shown.bs.modal', function () {
            $('#document_type_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_document_type(){
            $('.document-type-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_document_type(document_type_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('document_type.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : document_type_id
              }
            });
            return request;
          }

          $('#document_type_table').on('click', '.view-document-type', function(e){     
            $('#document_type_modal_header').html("View Field of Specialization");     
            document_type_id = $(this).parents('tr').attr('data-id');
            init_view_document_type();   
            var request = view_document_type(document_type_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#document_type_name').val(data['document_type']['document_type'])  
                $('#municipality_id').val(data['document_type']['municipality_id'])                  
                $('#document_type_tags').val(data['document_type']['tags']) 
                if(data['document_type']['is_verified'] == 1) {
                  $('#document_type_is_verified').iCheck('check'); 
                }    
                if(data['document_type']['is_active'] == 1) {
                  $('#document_type_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#document_type_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_document_type(){
            init_view_document_type();
            $('.document-type-field')
              .attr('disabled', false);

            $('#add_document_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_document_type(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('document_type.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'document_type' : $('#document_type_name').val(),
                'document_type_group_id' : $('#document_type_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#document_type_tags').val(),
                'is_verified' :  ($('#document_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#document_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_document_type').on('click', function(e){ 
           clear_fields();
            init_add_document_type();          
            $('#document_type_modal_header').html("Add Field of Specialization");
            $('#document_type_modal').modal('toggle')
          })

          $('#add_document_type').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#document_type_id)')) --}}
            var request = add_document_type();
            request.then(function(data) {
              $('#document_type_modal').modal('toggle')
              document_type_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_document_type(){
            init_view_document_type()
            $('.document-type-field')
              .attr('disabled', false);

            $('#update_document_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_document_type(document_type_id){  
            // error_checking($('.document-type-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('document_type.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : document_type_id,
                'document_type' : $('#cdocument_typename').val(),
                'document_type_group_id' : $('#document_type_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#document_type_tags').val(),
                'is_verified' :  ($('#document_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#document_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_document_type').on('click', function(e){
            var request = update_document_type(document_type_id);
            request.then(function(data) {
              $('#document_type_modal').modal('toggle')
              document_type_table.ajax.reload()             
            })
          })

          $('#document_type_table').on('click', '.update-document-type', function(e){
            $('#document_type_modal_header').html("Update Field of Specialization");         
            init_update_document_type();
            document_type_id = $(this).parents('tr').attr('data-id');
            var request = view_document_type(document_type_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#document_type_name').val(data['document_type']['document_type'])  
                $('#document_type_group_id').val(data['document_type']['document_type_group_id'])                  
                $('#sector_id').val(data['document_type']['sector_id']) 
                $('#document_type_tags').val(data['document_type']['tags']) 
                if(data['document_type']['is_verified'] == 1) {
                  $('#document_type_is_verified').iCheck('check'); 
                }    
                if(data['document_type']['is_active'] == 1) {
                  $('#document_type_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#document_type_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#document_type_table').on('click', '.delete-document-type', function(e){
            document_type_id = $(this).parents('tr').attr('data-id');
            delete_document_type(document_type_id);
          })

          function delete_document_type(document_type_id){
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
                  url: "{{ route('document_type.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : document_type_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    document_type_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}