      {{-- table start --}}
        var commodity_group_table = $('#commodity_group_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('commodity_group.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'commodity_group', name: 'commodity_group'},
              {data: 'project_sector', name: 'project_sector'},             
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
        var commodity_group_id;   
      {{-- table end --}}
  
      {{-- START --}}
        {{-- modal start --}}
          $('#commodity_group_modal').on('hidden.bs.modal', function(){       
            init_view_commodity_group();
           clear_fields()
            commodity_group_table.ajax.reload()
          });  

          $('#commodity_group_modal').on('shown.bs.modal', function () {
            $('#commodity_group_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_commodity_group(){
            $('.commodity-group-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_commodity_group(commodity_group_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('commodity_group.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : commodity_group_id
              }
            });
            return request;
          }

          $('#commodity_group_table').on('click', '.view-commodity-group', function(e){     
            $('#commodity_group_modal_header').html("View Commodity Group");     
            commodity_group_id = $(this).parents('tr').attr('data-id');
            init_view_commodity_group();   
            var request = view_commodity_group(commodity_group_id);   
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#commodity_group_name').val(data['commodity_group']['commodity_group'])                              
                $('#project_sector_id').val(data['commodity_group']['project_sector_id'])                  
                $('#commodity_tags').val(data['commodity_group']['tags'])    
                if(data['commodity_group']['is_verified'] == 1) {
                  $('#commodity_group_is_verified').iCheck('check'); 
                }    
                if(data['commodity_group']['is_active'] == 1) {
                  $('#commodity_group_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#commodity_group_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_commodity_group(){
            init_view_commodity_group();
            $('.commodity-group-field')
              .attr('disabled', false);

            $('#add_commodity_group.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_commodity_group(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('commodity_group.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'commodity_group' : $('#commodity_group_name').val(),                       
                'project_sector_id' : $('#project_sector_id').val(),              
                'tags' : $('#commodity_tags').val(),
                'is_verified' :  ($('#commodity_group_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#commodity_group_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_commodity_group').on('click', function(e){ 
           clear_fields();
            init_add_commodity_group();          
            $('#commodity_group_modal_header').html("Add Commodity Group");
            $('#commodity_group_modal').modal('toggle')
          })

          $('#add_commodity_group').on('click', function(e){            
            var request = add_commodity_group();
            request.then(function(data) {
              $('#commodity_group_modal').modal('toggle')
              commodity_group_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_commodity_group(){
            init_view_commodity_group()
            $('.commodity-group-field')
              .attr('disabled', false);

            $('#update_commodity_group.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_commodity_group(commodity_group_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('commodity_group.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : commodity_group_id,
                'commodity_group' : $('#commodity_group_name').val(),                         
                'project_sector_id' : $('#project_sector_id').val(),              
                'tags' : $('#commodity_tags').val(),
                'is_verified' :  ($('#commodity_group_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#commodity_group_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_commodity_group').on('click', function(e){
            var request = update_commodity_group(commodity_group_id);
            request.then(function(data) {
              $('#commodity_group_modal').modal('toggle')
              commodity_group_table.ajax.reload()             
            })
          })

          $('#commodity_group_table').on('click', '.update-commodity-group', function(e){
            $('#commodity_group_modal_header').html("Update Commodity Group");         
            init_update_commodity_group();
            commodity_group_id = $(this).parents('tr').attr('data-id');
            var request = view_commodity_group(commodity_group_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#commodity_group_name').val(data['commodity_group']['commodity_group'])                              
                $('#project_sector_id').val(data['commodity_group']['project_sector_id'])                  
                $('#commodity_tags').val(data['commodity_group']['tags'])    
                if(data['commodity_group']['is_verified'] == 1) {
                  $('#commodity_group_is_verified').iCheck('check'); 
                }    
                if(data['commodity_group']['is_active'] == 1) {
                  $('#commodity_group_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#commodity_group_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#commodity_group_table').on('click', '.delete-commodity-group', function(e){
            commodity_group_id = $(this).parents('tr').attr('data-id');
            delete_commodity_group(commodity_group_id);
          })

          function delete_commodity_group(commodity_group_id){
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
                  url: "{{ route('commodity_group.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : commodity_group_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    commodity_group_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}      
      {{-- END --}}
