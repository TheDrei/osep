

      {{-- table start--}}
        var commodity_table = $('#commodity_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('commodity.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'commodity', name: 'commodity'},
              {data: 'project_sector', name: 'project_sector'},
              {data: 'commodity_group', name: 'commodity_group'},
              {data: 'commodity_individual', name: 'commodity_individual'},
              {data: 'commodity_specific', name: 'commodity_specific'},           
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
        var commodity_id;       
      {{-- table end       --}}
  
      {{-- START --}}
        {{-- modal start --}}
          $('#commodity_modal').on('hidden.bs.modal', function(){       
            init_view_commodity();
           clear_fields()
            commodity_table.ajax.reload()
          });  

          $('#commodity_modal').on('shown.bs.modal', function () {
            $('#commodity_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_commodity(){
            $('.commodity-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_commodity(commodity_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('commodity.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : commodity_id
              }
            });
            return request;
          }

          $('#commodity_table').on('click', '.view-commodity', function(e){     
            $('#commodity_modal_header').html("View Commodity");     
            commodity_id = $(this).parents('tr').attr('data-id');
            init_view_commodity();   
            var request = view_commodity(commodity_id);   
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#commodity_name').val(data['commodity']['commodity'])  
                $('#commodity_group_id').val(data['commodity']['commodity_group_id'])  
                $('#commodity_individual_id').val(data['commodity']['commodity_individual_id'])  
                $('#commodity_specific_id').val(data['commodity']['commodity_specific_id'])                  
                $('#commodity_indicator').val(data['commodity']['commodity_indicator'])                  
                $('#commodity_status').val(data['commodity']['commodity_status'])                  
                $('#commodity_tags').val(data['commodity']['tags'])    
                if(data['commodity']['is_verified'] == 1) {
                  $('#commodity_is_verified').iCheck('check'); 
                }    
                if(data['commodity']['is_active'] == 1) {
                  $('#commodity_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#commodity_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_commodity(){
            init_view_commodity();
            $('.commodity-field')
              .attr('disabled', false);

            $('#add_commodity.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_commodity(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('commodity.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'commodity' : $('#commodity_name').val(),
                'commodity_group_id' : $('#commodity_group_id').val(),
                'commodity_individual_id' : $('#commodity_individual_id').val(),              
                'commodity_specific_id' : $('#commodity_specific_id').val(),               
                'project_sector_id' : $('#project_sector_id').val(),
                'indicator' : $('#commodity_indicator').val(),
                'status' : $('#commodity_status').val(),
                'tags' : $('#commodity_tags').val(),
                'is_verified' :  ($('#commodity_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#commodity_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_commodity').on('click', function(e){ 
            
           clear_fields();
            init_add_commodity();          
            $('#commodity_modal_header').html("Add Commodity");
            $('#commodity_modal').modal('toggle')
          })

          $('#add_commodity').on('click', function(e){            
            var request = add_commodity();
            request.then(function(data) {
              $('#commodity_modal').modal('toggle')
              commodity_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_commodity(){
            init_view_commodity()
            $('.commodity-field')
              .attr('disabled', false);

            $('#update_commodity.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_commodity(commodity_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('commodity.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : commodity_id,
                'commodity' : $('#commodity_name').val(),
                'commodity_group_id' : $('#commodity_group_id').val(),
                'commodity_individual_id' : $('#commodity_individual_id').val(),              
                'commodity_specific_id' : $('#commodity_specific_id').val(),               
                'project_sector_id' : $('#project_sector_id').val(),
                'indicator' : $('#commodity_indicator').val(),
                'status' : $('#commodity_status').val(),
                'tags' : $('#commodity_tags').val(),
                'is_verified' :  ($('#commodity_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#commodity_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_commodity').on('click', function(e){
            var request = update_commodity(commodity_id);
            request.then(function(data) {
              $('#commodity_modal').modal('toggle')
              commodity_table.ajax.reload()             
            })
          })

          $('#commodity_table').on('click', '.update-commodity', function(e){
            $('#commodity_modal_header').html("Update Commodity");         
            init_update_commodity();
            commodity_id = $(this).parents('tr').attr('data-id');
            var request = view_commodity(commodity_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#commodity_name').val(data['commodity']['commodity'])  
                $('#commodity_group_id').val(data['commodity']['commodity_group_id'])  
                $('#commodity_individual_id').val(data['commodity']['commodity_individual_id'])  
                $('#commodity_specific_id').val(data['commodity']['commodity_specific_id'])                  
                $('#commodity_indicator').val(data['commodity']['commodity_indicator'])                  
                $('#commodity_status').val(data['commodity']['commodity_status'])                  
                $('#commodity_tags').val(data['commodity']['tags'])    
                if(data['commodity']['is_verified'] == 1) {
                  $('#commodity_is_verified').iCheck('check'); 
                }    
                if(data['commodity']['is_active'] == 1) {
                  $('#commodity_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#commodity_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#commodity_table').on('click', '.delete-commodity', function(e){
            commodity_id = $(this).parents('tr').attr('data-id');
            delete_commodity(commodity_id);
          })

          function delete_commodity(commodity_id){
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
                  url: "{{ route('commodity.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : commodity_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    commodity_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}      
      {{-- END --}}
 