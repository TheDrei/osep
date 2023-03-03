
      {{-- table start --}}
        var product_table = $('#product_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('product.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
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
        var product_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#product_modal').on('hidden.bs.modal', function(){       
            init_view_product();
           clear_fields()
            product_table.ajax.reload()
          });  

          $('#product_modal').on('shown.bs.modal', function () {
            $('#product_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_product(){
            $('.product-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_product(product_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('product.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : product_id
              }
            });
            return request;
          }

          $('#product_table').on('click', '.view-product', function(e){     
            $('#product_modal_header').html("View Field of Specialization");     
            product_id = $(this).parents('tr').attr('data-id');
            init_view_product();   
            var request = view_product(product_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#product_name').val(data['product']['product'])  
                $('#municipality_id').val(data['product']['municipality_id'])                  
                $('#product_tags').val(data['product']['tags']) 
                if(data['product']['is_verified'] == 1) {
                  $('#product_is_verified').iCheck('check'); 
                }    
                if(data['product']['is_active'] == 1) {
                  $('#product_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#product_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_product(){
            init_view_product();
            $('.product-field')
              .attr('disabled', false);

            $('#add_product.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_product(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('product.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'product' : $('#product_name').val(),
                'product_group_id' : $('#product_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#product_tags').val(),
                'is_verified' :  ($('#product_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#product_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_product').on('click', function(e){ 
           clear_fields();
            init_add_product();          
            $('#product_modal_header').html("Add Field of Specialization");
            $('#product_modal').modal('toggle')
          })

          $('#add_product').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#product_id)')) --}}
            var request = add_product();
            request.then(function(data) {
              $('#product_modal').modal('toggle')
              product_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_product(){
            init_view_product()
            $('.product-field')
              .attr('disabled', false);

            $('#update_product.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_product(product_id){  
            // error_checking($('.product-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('product.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : product_id,
                'product' : $('#cproductname').val(),
                'product_group_id' : $('#product_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#product_tags').val(),
                'is_verified' :  ($('#product_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#product_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_product').on('click', function(e){
            var request = update_product(product_id);
            request.then(function(data) {
              $('#product_modal').modal('toggle')
              product_table.ajax.reload()             
            })
          })

          $('#product_table').on('click', '.update-product', function(e){
            $('#product_modal_header').html("Update Field of Specialization");         
            init_update_product();
            product_id = $(this).parents('tr').attr('data-id');
            var request = view_product(product_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#product_name').val(data['product']['product'])  
                $('#product_group_id').val(data['product']['product_group_id'])                  
                $('#sector_id').val(data['product']['sector_id']) 
                $('#product_tags').val(data['product']['tags']) 
                if(data['product']['is_verified'] == 1) {
                  $('#product_is_verified').iCheck('check'); 
                }    
                if(data['product']['is_active'] == 1) {
                  $('#product_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#product_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#product_table').on('click', '.delete-product', function(e){
            product_id = $(this).parents('tr').attr('data-id');
            delete_product(product_id);
          })

          function delete_product(product_id){
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
                  url: "{{ route('product.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : product_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    product_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}