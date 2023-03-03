

      {{-- table start --}}
        var commodity_product_table = $('#commodity_product_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('commodity_product.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'commodity', name: 'commodity'},            
              {data: 'product', name: 'product'},           
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
        var commodity_product_id;       
      {{-- table end --}}
  
      {{-- START --}}
        {{-- modal start --}}
          $('#commodity_product_modal').on('hidden.bs.modal', function(){       
            init_view_commodity_product();
           clear_fields()
            commodity_product_table.ajax.reload()
          });  

          $('#commodity_product_modal').on('shown.bs.modal', function () {
            $('#commodity_id').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_commodity_product(){
            $('.commodity-product-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_commodity_producty(commodity_product_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('commodity_product.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : commodity_product_id
              }
            });
            return request;
          }

          $('#commodity_product_table').on('click', '.view-commodity-product', function(e){             
            $('#commodity_product_modal_header').html("View Commodity Product");      
            commodity_product_id = $(this).parents('tr').attr('data-id');
            init_view_commodity_product();  
            var request = view_commodity_product(commodity_product_id);   
            alert('this')  
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#commodity_id').val(data['commodity_product']['commodity_id'])                  
                $('#product_id').val(data['commodity_product']['product_id'])                  
                $('#commodity_tags').val(data['commodity_product']['tags'])    
                if(data['commodity_product']['is_verified'] == 1) {
                  $('#commodity_product_is_verified').iCheck('check'); 
                }    
                if(data['commodity_product']['is_active'] == 1) {
                  $('#commodity_product_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#commodity_product_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_commodity_product(){
            init_view_commodity_product();
            $('.commodity-product-field')
              .attr('disabled', false);

            $('#add_commodity_product.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_commodity_product(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('commodity_product.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'commodity_id' : $('#commodity_id').val(),               
                'product_id' : $('#product_id').val(),
                'tags' : $('#-').val(),
                'is_verified' :  ($('#commodity_product_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#commodity_product_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_commodity_product').on('click', function(e){             
           clear_fields();            
            init_add_commodity_product();          
            $('#commodity_product_modal_header').html("Add Commodity Product");
            $('#commodity_product_modal').modal('toggle')
          })

          $('#add_commodity_product').on('click', function(e){            
            var request = add_commodity_product();
            request.then(function(data) {
              $('#commodity_product_modal').modal('toggle')
              commodity_product_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_commodity_product(){
            init_view_commodity_product()
            $('.commodity-product-field')
              .attr('disabled', false);

            $('#update_commodity_product.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_commodity_product(commodity_product_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('commodity_product.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : commodity_product_id,
                'commodity_id' : $('#commodity_id').val(),               
                'product_id' : $('#product_id').val(),
                'tags' : $('#commodity_product_tags').val(),
                'is_verified' :  ($('#commodity_product_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#commodity_product_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_commodity_product').on('click', function(e){
            var request = update_commodity_product(commodity_product_id);
            request.then(function(data) {
              $('#commodity_product_modal').modal('toggle')
              commodity_product_table.ajax.reload()             
            })
          })

          $('#commodity_product_table').on('click', '.update-commodity-product', function(e){
            $('#commodity_product_modal_header').html("Update Commodity Product");         
            init_update_commodity_product();
            commodity_product_id = $(this).parents('tr').attr('data-id');
            var request = view_commodity_product(commodity_product_id);
            request.then(function(data) {
              if(data['status'] == 1){             
                $('#commodity_id').val(data['commodity_product']['commodity_id'])                       
                $('#product_id').val(data['commodity_product']['product_id'])                       
                $('#commodity_product_tags').val(data['commodity_product']['tags'])    
                if(data['commodity_product']['is_verified'] == 1) {
                  $('#commodity_product_is_verified').iCheck('check'); 
                }    
                if(data['commodity_product']['is_active'] == 1) {
                  $('#commodity_product_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#commodity_product_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#commodity_product_table').on('click', '.delete-commodity-product', function(e){
            commodity_product_id = $(this).parents('tr').attr('data-id');
            delete_commodity_product(commodity_product_id);
          })

          function delete_commodity_product(commodity_product_id){
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
                  url: "{{ route('commodity_product.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : commodity_product_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    commodity_product_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}      
      {{-- END --}}
 