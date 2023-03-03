
      {{-- table start --}}
        var consortium_table = $('#consortium_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('consortium.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'consortium', name: 'consortium'}, 
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
        var consortium_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#consortium_modal').on('hidden.bs.modal', function(){       
            init_view_consortium();
           clear_fields()
            consortium_table.ajax.reload()
          });  

          $('#consortium_modal').on('shown.bs.modal', function () {
            $('#consortium_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_consortium(){
            $('.consortium-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_consortium(consortium_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('consortium.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : consortium_id
              }
            });
            return request;
          }

          $('#consortium_table').on('click', '.view-consortium', function(e){     
            $('#consortium_modal_header').html("View Field of Specialization");     
            consortium_id = $(this).parents('tr').attr('data-id');
            init_view_consortium();   
            var request = view_consortium(consortium_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#consortium_name').val(data['consortium']['consortium'])  
                $('#municipality_id').val(data['consortium']['municipality_id'])                  
                $('#consortium_tags').val(data['consortium']['tags']) 
                if(data['consortium']['is_verified'] == 1) {
                  $('#consortium_is_verified').iCheck('check'); 
                }    
                if(data['consortium']['is_active'] == 1) {
                  $('#consortium_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#consortium_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_consortium(){
            init_view_consortium();
            $('.consortium-field')
              .attr('disabled', false);

            $('#add_consortium.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_consortium(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('consortium.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'consortium' : $('#consortium_name').val(),
                'consortium_group_id' : $('#consortium_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#consortium_tags').val(),
                'is_verified' :  ($('#consortium_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#consortium_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_consortium').on('click', function(e){ 
           clear_fields();
            init_add_consortium();          
            $('#consortium_modal_header').html("Add Field of Specialization");
            $('#consortium_modal').modal('toggle')
          })

          $('#add_consortium').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#consortium_id)')) --}}
            var request = add_consortium();
            request.then(function(data) {
              $('#consortium_modal').modal('toggle')
              consortium_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_consortium(){
            init_view_consortium()
            $('.consortium-field')
              .attr('disabled', false);

            $('#update_consortium.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_consortium(consortium_id){  
            // error_checking($('.consortium-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('consortium.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : consortium_id,
                'consortium' : $('#cconsortiumname').val(),
                'consortium_group_id' : $('#consortium_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#consortium_tags').val(),
                'is_verified' :  ($('#consortium_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#consortium_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_consortium').on('click', function(e){
            var request = update_consortium(consortium_id);
            request.then(function(data) {
              $('#consortium_modal').modal('toggle')
              consortium_table.ajax.reload()             
            })
          })

          $('#consortium_table').on('click', '.update-consortium', function(e){
            $('#consortium_modal_header').html("Update Field of Specialization");         
            init_update_consortium();
            consortium_id = $(this).parents('tr').attr('data-id');
            var request = view_consortium(consortium_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#consortium_name').val(data['consortium']['consortium'])  
                $('#consortium_group_id').val(data['consortium']['consortium_group_id'])                  
                $('#sector_id').val(data['consortium']['sector_id']) 
                $('#consortium_tags').val(data['consortium']['tags']) 
                if(data['consortium']['is_verified'] == 1) {
                  $('#consortium_is_verified').iCheck('check'); 
                }    
                if(data['consortium']['is_active'] == 1) {
                  $('#consortium_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#consortium_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#consortium_table').on('click', '.delete-consortium', function(e){
            consortium_id = $(this).parents('tr').attr('data-id');
            delete_consortium(consortium_id);
          })

          function delete_consortium(consortium_id){
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
                  url: "{{ route('consortium.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : consortium_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    consortium_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}