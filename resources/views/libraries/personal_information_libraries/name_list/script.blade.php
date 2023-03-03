
      {{-- table start --}}
        var name_list_table = $('#name_list_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('name_list.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'first_name', name: 'first_name'}, 
              {data: 'middle_name', name: 'middle_name'}, 
              {data: 'last_name', name: 'last_name'}, 
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
        var name_list_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#name_list_modal').on('hidden.bs.modal', function(){       
            init_view_name_list();
           clear_fields()
            name_list_table.ajax.reload()
          });  

          $('#name_list_modal').on('shown.bs.modal', function () {
            $('#name_list_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_name_list(){
            $('.name-list-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_name_list(name_list_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('name_list.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : name_list_id
              }
            });
            return request;
          }

          $('#name_list_table').on('click', '.view-name-list', function(e){     
            $('#name_list_modal_header').html("View Field of Specialization");     
            name_list_id = $(this).parents('tr').attr('data-id');
            init_view_name_list();   
            var request = view_name_list(name_list_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#name_list_name').val(data['name_list']['name_list'])  
                $('#municipality_id').val(data['name_list']['municipality_id'])                  
                $('#name_list_tags').val(data['name_list']['tags']) 
                if(data['name_list']['is_verified'] == 1) {
                  $('#name_list_is_verified').iCheck('check'); 
                }    
                if(data['name_list']['is_active'] == 1) {
                  $('#name_list_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#name_list_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_name_list(){
            init_view_name_list();
            $('.name-list-field')
              .attr('disabled', false);

            $('#add_name_list.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_name_list(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('name_list.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'name_list' : $('#name_list_name').val(),
                'name_list_group_id' : $('#name_list_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#name_list_tags').val(),
                'is_verified' :  ($('#name_list_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#name_list_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_name_list').on('click', function(e){ 
           clear_fields();
            init_add_name_list();          
            $('#name_list_modal_header').html("Add Field of Specialization");
            $('#name_list_modal').modal('toggle')
          })

          $('#add_name_list').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#name_list_id)')) --}}
            var request = add_name_list();
            request.then(function(data) {
              $('#name_list_modal').modal('toggle')
              name_list_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_name_list(){
            init_view_name_list()
            $('.name-list-field')
              .attr('disabled', false);

            $('#update_name_list.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_name_list(name_list_id){  
            // error_checking($('.name-list-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('name_list.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : name_list_id,
                'name_list' : $('#cname_listname').val(),
                'name_list_group_id' : $('#name_list_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#name_list_tags').val(),
                'is_verified' :  ($('#name_list_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#name_list_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_name_list').on('click', function(e){
            var request = update_name_list(name_list_id);
            request.then(function(data) {
              $('#name_list_modal').modal('toggle')
              name_list_table.ajax.reload()             
            })
          })

          $('#name_list_table').on('click', '.update-name-list', function(e){
            $('#name_list_modal_header').html("Update Field of Specialization");         
            init_update_name_list();
            name_list_id = $(this).parents('tr').attr('data-id');
            var request = view_name_list(name_list_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#name_list_name').val(data['name_list']['name_list'])  
                $('#name_list_group_id').val(data['name_list']['name_list_group_id'])                  
                $('#sector_id').val(data['name_list']['sector_id']) 
                $('#name_list_tags').val(data['name_list']['tags']) 
                if(data['name_list']['is_verified'] == 1) {
                  $('#name_list_is_verified').iCheck('check'); 
                }    
                if(data['name_list']['is_active'] == 1) {
                  $('#name_list_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#name_list_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#name_list_table').on('click', '.delete-name-list', function(e){
            name_list_id = $(this).parents('tr').attr('data-id');
            delete_name_list(name_list_id);
          })

          function delete_name_list(name_list_id){
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
                  url: "{{ route('name_list.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : name_list_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    name_list_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}