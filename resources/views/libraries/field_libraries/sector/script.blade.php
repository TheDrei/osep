
      {{-- table start --}}
        var sector_table = $('#sector_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('sector.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
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
        var sector_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#sector_modal').on('hidden.bs.modal', function(){       
            init_view_sector();
           clear_fields()
            sector_table.ajax.reload()
          });  

          $('#sector_modal').on('shown.bs.modal', function () {
            $('#sector_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_sector(){
            $('.sector-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_sector(sector_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('sector.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : sector_id
              }
            });
            return request;
          }

          $('#sector_table').on('click', '.view-sector', function(e){     
            $('#sector_modal_header').html("View Field of Specialization");     
            sector_id = $(this).parents('tr').attr('data-id');
            init_view_sector();   
            var request = view_sector(sector_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#sector_name').val(data['sector']['sector'])  
                $('#municipality_id').val(data['sector']['municipality_id'])                  
                $('#sector_tags').val(data['sector']['tags']) 
                if(data['sector']['is_verified'] == 1) {
                  $('#sector_is_verified').iCheck('check'); 
                }    
                if(data['sector']['is_active'] == 1) {
                  $('#sector_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#sector_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_sector(){
            init_view_sector();
            $('.sector-field')
              .attr('disabled', false);

            $('#add_sector.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_sector(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('sector.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'sector' : $('#sector_name').val(),
                'sector_group_id' : $('#sector_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#sector_tags').val(),
                'is_verified' :  ($('#sector_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#sector_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_sector').on('click', function(e){ 
           clear_fields();
            init_add_sector();          
            $('#sector_modal_header').html("Add Field of Specialization");
            $('#sector_modal').modal('toggle')
          })

          $('#add_sector').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#sector_id)')) --}}
            var request = add_sector();
            request.then(function(data) {
              $('#sector_modal').modal('toggle')
              sector_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_sector(){
            init_view_sector()
            $('.sector-field')
              .attr('disabled', false);

            $('#update_sector.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_sector(sector_id){  
            // error_checking($('.sector-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('sector.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : sector_id,
                'sector' : $('#csectorname').val(),
                'sector_group_id' : $('#sector_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#sector_tags').val(),
                'is_verified' :  ($('#sector_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#sector_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_sector').on('click', function(e){
            var request = update_sector(sector_id);
            request.then(function(data) {
              $('#sector_modal').modal('toggle')
              sector_table.ajax.reload()             
            })
          })

          $('#sector_table').on('click', '.update-sector', function(e){
            $('#sector_modal_header').html("Update Field of Specialization");         
            init_update_sector();
            sector_id = $(this).parents('tr').attr('data-id');
            var request = view_sector(sector_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#sector_name').val(data['sector']['sector'])  
                $('#sector_group_id').val(data['sector']['sector_group_id'])                  
                $('#sector_id').val(data['sector']['sector_id']) 
                $('#sector_tags').val(data['sector']['tags']) 
                if(data['sector']['is_verified'] == 1) {
                  $('#sector_is_verified').iCheck('check'); 
                }    
                if(data['sector']['is_active'] == 1) {
                  $('#sector_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#sector_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#sector_table').on('click', '.delete-sector', function(e){
            sector_id = $(this).parents('tr').attr('data-id');
            delete_sector(sector_id);
          })

          function delete_sector(sector_id){
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
                  url: "{{ route('sector.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : sector_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    sector_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}