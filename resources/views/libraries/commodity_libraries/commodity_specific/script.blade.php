

      {{-- table start--}}
        var commodity_specific_table = $('#commodity_specific_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('commodity_specific.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'commodity_specific', name: 'commodity_specific'},             
              {data: 'commodity_individual', name: 'commodity_individual'},     
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
        var commodity_specific_id;       
      {{-- table end --}}
  
      {{-- START --}}
        {{-- modal start --}}
          $('#commodity_specific_modal').on('hidden.bs.modal', function(){       
            init_view_commodity_specific();
           clear_fields()
            commodity_specific_table.ajax.reload()
          });  

          $('#commodity_specific_modal').on('shown.bs.modal', function () {
            $('#commodity_specific_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_commodity_specific(){
            $('.commodity-specific-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_commodity_specific(commodity_specific_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('commodity_specific.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : commodity_specific_id
              }
            });
            return request;
          }

          $('#commodity_specific_table').on('click', '.view-commodity-specific', function(e){     
            $('#commodity_specific_modal_header').html("View Commodity Specific");     
            commodity_specific_id = $(this).parents('tr').attr('data-id');
            init_view_commodity_specific();   
            var request = view_commodity_specific(commodity_specific_id);   
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#commodity_specific_name').val(data['commodity_specific']['commodity_specific'])                 
                $('#commodity_individual_id').val(data['commodity_specific']['commodity_individual_id'])        
                $('#commodity_specific_tags').val(data['commodity_specific']['tags'])    
                if(data['commodity_specific']['is_verified'] == 1) {
                  $('#commodity_specific_is_verified').iCheck('check'); 
                }    
                if(data['commodity_specific']['is_active'] == 1) {
                  $('#commodity_specific_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#commodity_specific_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_commodity_specific(){
            init_view_commodity_specific();
            $('.commodity-specific-field')
              .attr('disabled', false);

            $('#add_commodity_specific.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_commodity_specific(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('commodity_specific.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'commodity_specific' : $('#commodity_specific_name').val(),                
                'commodity_individual_id' : $('#commodity_individual_id').val(),   
                'tags' : $('#commodity_specific_tags').val(),
                'is_verified' :  ($('#commodity_specific_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#commodity_specific_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_commodity_specific').on('click', function(e){
           clear_fields();
            init_add_commodity_specific();          
            $('#commodity_specific_modal_header').html("Add Commodity Specific");
            $('#commodity_specific_modal').modal('toggle')
          })

          $('#add_commodity_specific').on('click', function(e){            
            var request = add_commodity_specific();
            request.then(function(data) {
              $('#commodity_specific_modal').modal('toggle')
              commodity_specific_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_commodity_specific(){
            init_view_commodity_specific()
            $('.commodity-specific-field')
              .attr('disabled', false);

            $('#update_commodity_specific.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_commodity_specific(commodity_specific_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('commodity_specific.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : commodity_specific_id,
                'commodity_specific' : $('#commodity_specific_name').val(),
                'commodity_individual_id' : $('#commodity_individual_id').val(),       
                'tags' : $('#commodity_specific_tags').val(),
                'is_verified' :  ($('#commodity_specific_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#commodity_specific_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_commodity_specific').on('click', function(e){
            var request = update_commodity_specific(commodity_specific_id);
            request.then(function(data) {
              $('#commodity_specific_modal').modal('toggle')
              commodity_specific_table.ajax.reload()             
            })
          })

          $('#commodity_specific_table').on('click', '.update-commodity-specific', function(e){
            $('#commodity_specific_modal_header').html("Update Commodity Specific");         
            init_update_commodity_specific();
            commodity_specific_id = $(this).parents('tr').attr('data-id');
            var request = view_commodity_specific(commodity_specific_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#commodity_specific_name').val(data['commodity_specific']['commodity_specific'])               
                $('#commodity_individual_id').val(data['commodity_specific']['commodity_individual_id'])                
                $('#commodity_specific_tags').val(data['commodity_specific']['tags'])    
                if(data['commodity_specific']['is_verified'] == 1) {
                  $('#commodity_specific_is_verified').iCheck('check'); 
                }    
                if(data['commodity_specific']['is_active'] == 1) {
                  $('#commodity_specific_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#commodity_specific_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#commodity_specific_table').on('click', '.delete-commodity-specific', function(e){
            commodity_specific_id = $(this).parents('tr').attr('data-id');
            delete_commodity_specific(commodity_specific_id);
          })

          function delete_commodity_specific(commodity_specific_id){
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
                  url: "{{ route('commodity_specific.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : commodity_specific_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    commodity_specific_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}      
      {{-- END --}}
 