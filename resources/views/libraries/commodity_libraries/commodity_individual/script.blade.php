

      {{-- table start--}}
        var commodity_individual_table = $('#commodity_individual_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('commodity_individual.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'commodity_individual', name: 'commodity_individual'},             
              {data: 'commodity_group', name: 'commodity_group'},      
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
        var commodity_individual_id;       
      {{-- table end --}}
  
      {{-- STARt --}}
        {{-- modal start --}}
          $('#commodity_individual_modal').on('hidden.bs.modal', function(){       
            init_view_commodity_individual();
           clear_fields()
            commodity_individual_table.ajax.reload()
          });  

          $('#commodity_individual_modal').on('shown.bs.modal', function () {
            $('#commodity_individual_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_commodity_individual(){
            $('.commodity-individual-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_commodity_individual(commodity_individual_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('commodity_individual.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : commodity_individual_id
              }
            });
            return request;
          }

          $('#commodity_individual_table').on('click', '.view-commodity-individual', function(e){     
            $('#commodity_individual_modal_header').html("View Commodity Individual");     
            commodity_individual_id = $(this).parents('tr').attr('data-id');
            init_view_commodity_individual();   
            var request = view_commodity_individual(commodity_individual_id);   
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#commodity_individual_name').val(data['commodity_individual']['commodity_individual'])  
                $('#commodity_group_id').val(data['commodity_individual']['commodity_group_id'])                             
                $('#commodity_tags').val(data['commodity_individual']['tags'])    
                if(data['commodity_individual']['is_verified'] == 1) {
                  $('#commodity_individual_is_verified').iCheck('check'); 
                }    
                if(data['commodity_individual']['is_active'] == 1) {
                  $('#commodity_individual_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#commodity_individual_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_commodity_individual(){
            init_view_commodity_individual();
            $('.commodity-individual-field')
              .attr('disabled', false);

            $('#add_commodity_individual.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_commodity_individual(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('commodity_individual.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'commodity_individual' : $('#commodity_individual_name').val(),
                'commodity_group_id' : $('#commodity_group_id').val(),               
                'tags' : $('#commodity_individual_tags').val(),
                'is_verified' :  ($('#commodity_individual_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#commodity_individual_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_commodity_individual').on('click', function(e){ 
            
           clear_fields();
            init_add_commodity_individual();          
            $('#commodity_individual_modal_header').html("Add Commodity Individual");
            $('#commodity_individual_modal').modal('toggle')
          })

          $('#add_commodity_individual').on('click', function(e){            
            var request = add_commodity_individual();
            request.then(function(data) {
              $('#commodity_individual_modal').modal('toggle')
              commodity_individual_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_commodity_individual(){
            init_view_commodity_individual()
            $('.commodity-individual-field')
              .attr('disabled', false);

            $('#update_commodity_individual.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_commodity_individual(commodity_individual_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('commodity_individual.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : commodity_individual_id,
                'commodity_individual' : $('#commodity_individual_name').val(),
                'commodity_group_id' : $('#commodity_group_id').val(),
                'tags' : $('#commodity_tags').val(),
                'is_verified' :  ($('#commodity_individual_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#commodity_individual_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_commodity_individual').on('click', function(e){
            var request = update_commodity_individual(commodity_individual_id);
            request.then(function(data) {
              $('#commodity_individual_modal').modal('toggle')
              commodity_individual_table.ajax.reload()             
            })
          })

          $('#commodity_individual_table').on('click', '.update-commodity-individual', function(e){
            $('#commodity_individual_modal_header').html("Update Commodity");         
            init_update_commodity_individual();
            commodity_individual_id = $(this).parents('tr').attr('data-id');
            var request = view_commodity_individual(commodity_individual_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#commodity_individual_name').val(data['commodity_individual']['commodity_individual'])  
                $('#commodity_group_id').val(data['commodity_individual']['commodity_group_id'])       
                $('#commodity_individual_tags').val(data['commodity_individual']['tags'])    
                if(data['commodity_individual']['is_verified'] == 1) {
                  $('#commodity_individual_is_verified').iCheck('check'); 
                }    
                if(data['commodity_individual']['is_active'] == 1) {
                  $('#commodity_individual_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#commodity_individual_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#commodity_individual_table').on('click', '.delete-commodity-individual', function(e){
            commodity_individual_id = $(this).parents('tr').attr('data-id');
            delete_commodity_individual(commodity_individual_id);
          })

          function delete_commodity_individual(commodity_individual_id){
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
                  url: "{{ route('commodity_individual.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : commodity_individual_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    commodity_individual_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}      
      {{-- END --}}
 