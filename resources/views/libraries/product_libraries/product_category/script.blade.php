
      {{-- table start --}}
        var product_category_table = $('#product_category_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('product_category.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'product_category', name: 'product_category'}, 
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
        var product_category_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#product_category_modal').on('hidden.bs.modal', function(){       
            init_view_product_category();
           clear_fields()
            product_category_table.ajax.reload()
          });  

          $('#product_category_modal').on('shown.bs.modal', function () {
            $('#product_category_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_product_category(){
            $('.product-category-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_product_category(product_category_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('product_category.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : product_category_id
              }
            });
            return request;
          }

          $('#product_category_table').on('click', '.view-product-category', function(e){     
            $('#product_category_modal_header').html("View Field of Specialization");     
            product_category_id = $(this).parents('tr').attr('data-id');
            init_view_product_category();   
            var request = view_product_category(product_category_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#product_category_name').val(data['product_category']['product_category'])  
                $('#municipality_id').val(data['product_category']['municipality_id'])                  
                $('#product_category_tags').val(data['product_category']['tags']) 
                if(data['product_category']['is_verified'] == 1) {
                  $('#product_category_is_verified').iCheck('check'); 
                }    
                if(data['product_category']['is_active'] == 1) {
                  $('#product_category_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#product_category_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_product_category(){
            init_view_product_category();
            $('.product-category-field')
              .attr('disabled', false);

            $('#add_product_category.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_product_category(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('product_category.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'product_category' : $('#product_category_name').val(),
                'product_category_group_id' : $('#product_category_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#product_category_tags').val(),
                'is_verified' :  ($('#product_category_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#product_category_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_product_category').on('click', function(e){ 
           clear_fields();
            init_add_product_category();          
            $('#product_category_modal_header').html("Add Field of Specialization");
            $('#product_category_modal').modal('toggle')
          })

          $('#add_product_category').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#product_category_id)')) --}}
            var request = add_product_category();
            request.then(function(data) {
              $('#product_category_modal').modal('toggle')
              product_category_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_product_category(){
            init_view_product_category()
            $('.product-category-field')
              .attr('disabled', false);

            $('#update_product_category.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_product_category(product_category_id){  
            // error_checking($('.product-category-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('product_category.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : product_category_id,
                'product_category' : $('#cproduct_categoryname').val(),
                'product_category_group_id' : $('#product_category_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#product_category_tags').val(),
                'is_verified' :  ($('#product_category_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#product_category_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_product_category').on('click', function(e){
            var request = update_product_category(product_category_id);
            request.then(function(data) {
              $('#product_category_modal').modal('toggle')
              product_category_table.ajax.reload()             
            })
          })

          $('#product_category_table').on('click', '.update-product-category', function(e){
            $('#product_category_modal_header').html("Update Field of Specialization");         
            init_update_product_category();
            product_category_id = $(this).parents('tr').attr('data-id');
            var request = view_product_category(product_category_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#product_category_name').val(data['product_category']['product_category'])  
                $('#product_category_group_id').val(data['product_category']['product_category_group_id'])                  
                $('#sector_id').val(data['product_category']['sector_id']) 
                $('#product_category_tags').val(data['product_category']['tags']) 
                if(data['product_category']['is_verified'] == 1) {
                  $('#product_category_is_verified').iCheck('check'); 
                }    
                if(data['product_category']['is_active'] == 1) {
                  $('#product_category_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#product_category_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#product_category_table').on('click', '.delete-product-category', function(e){
            product_category_id = $(this).parents('tr').attr('data-id');
            delete_product_category(product_category_id);
          })

          function delete_product_category(product_category_id){
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
                  url: "{{ route('product_category.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : product_category_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    product_category_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}