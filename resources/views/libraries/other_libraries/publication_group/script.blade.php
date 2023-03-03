
      {{-- table start --}}
        var publication_group_table = $('#publication_group_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('publication_group.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'publication_group', name: 'publication_group'}, 
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
        var publication_group_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#publication_group_modal').on('hidden.bs.modal', function(){       
            init_view_publication_group();
           clear_fields()
            publication_group_table.ajax.reload()
          });  

          $('#publication_group_modal').on('shown.bs.modal', function () {
            $('#publication_group_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_publication_group(){
            $('.publication-group-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_publication_group(publication_group_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('publication_group.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : publication_group_id
              }
            });
            return request;
          }

          $('#publication_group_table').on('click', '.view-publication-group', function(e){     
            $('#publication_group_modal_header').html("View Field of Specialization");     
            publication_group_id = $(this).parents('tr').attr('data-id');
            init_view_publication_group();   
            var request = view_publication_group(publication_group_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#publication_group_name').val(data['publication_group']['publication_group'])  
                $('#municipality_id').val(data['publication_group']['municipality_id'])                  
                $('#publication_group_tags').val(data['publication_group']['tags']) 
                if(data['publication_group']['is_verified'] == 1) {
                  $('#publication_group_is_verified').iCheck('check'); 
                }    
                if(data['publication_group']['is_active'] == 1) {
                  $('#publication_group_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#publication_group_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_publication_group(){
            init_view_publication_group();
            $('.publication-group-field')
              .attr('disabled', false);

            $('#add_publication_group.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_publication_group(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('publication_group.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'publication_group' : $('#publication_group_name').val(),
                'publication_group_group_id' : $('#publication_group_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#publication_group_tags').val(),
                'is_verified' :  ($('#publication_group_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#publication_group_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_publication_group').on('click', function(e){ 
           clear_fields();
            init_add_publication_group();          
            $('#publication_group_modal_header').html("Add Field of Specialization");
            $('#publication_group_modal').modal('toggle')
          })

          $('#add_publication_group').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#publication_group_id)')) --}}
            var request = add_publication_group();
            request.then(function(data) {
              $('#publication_group_modal').modal('toggle')
              publication_group_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_publication_group(){
            init_view_publication_group()
            $('.publication-group-field')
              .attr('disabled', false);

            $('#update_publication_group.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_publication_group(publication_group_id){  
            // error_checking($('.publication-group-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('publication_group.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : publication_group_id,
                'publication_group' : $('#cpublication_groupname').val(),
                'publication_group_group_id' : $('#publication_group_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#publication_group_tags').val(),
                'is_verified' :  ($('#publication_group_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#publication_group_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_publication_group').on('click', function(e){
            var request = update_publication_group(publication_group_id);
            request.then(function(data) {
              $('#publication_group_modal').modal('toggle')
              publication_group_table.ajax.reload()             
            })
          })

          $('#publication_group_table').on('click', '.update-publication-group', function(e){
            $('#publication_group_modal_header').html("Update Field of Specialization");         
            init_update_publication_group();
            publication_group_id = $(this).parents('tr').attr('data-id');
            var request = view_publication_group(publication_group_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#publication_group_name').val(data['publication_group']['publication_group'])  
                $('#publication_group_group_id').val(data['publication_group']['publication_group_group_id'])                  
                $('#sector_id').val(data['publication_group']['sector_id']) 
                $('#publication_group_tags').val(data['publication_group']['tags']) 
                if(data['publication_group']['is_verified'] == 1) {
                  $('#publication_group_is_verified').iCheck('check'); 
                }    
                if(data['publication_group']['is_active'] == 1) {
                  $('#publication_group_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#publication_group_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#publication_group_table').on('click', '.delete-publication-group', function(e){
            publication_group_id = $(this).parents('tr').attr('data-id');
            delete_publication_group(publication_group_id);
          })

          function delete_publication_group(publication_group_id){
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
                  url: "{{ route('publication_group.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : publication_group_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    publication_group_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}