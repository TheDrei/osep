
      {{-- table start --}}
        var fund_source_type_table = $('#fund_source_type_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('fund_source_type.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'fund_source_type', name: 'fund_source_type'},
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
        var fund_source_type_id;
      {{-- tabe end --}}

      {{-- START --}}
        {{-- modal start --}}
         $('#fund_source_type_modal').on('hidden.bs.modal', function(){       
            init_view_fund_source_type();
            clear_fields()
            fund_source_type_table.ajax.reload()
          });  

            $('#fund_source_type_modal').on('shown.bs.modal', function () {
            $('#fund_source_type_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_fund_source_type(){
            $('.fund-source-type-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_fund_source_type(fund_source_type_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('fund_source_type.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : fund_source_type_id
              }
            });
            return request;
          }

          $('#fund_source_type_table').on('click', '.view-fund-source-type', function(e){     
            $('#fund_source_type_modal_header').html("View Fund Source Type");     
            fund_source_type_id = $(this).parents('tr').attr('data-id');
            init_view_fund_source_type();   
            var request = view_fund_source_type(fund_source_type_id);   
            request.then(function(data) {
              if(data['status'] == 1){           
                $('#fund_source_type_name').val(data['fund_source_type']['fund_source_type'])                  
                $('#fund_source_type_tags').val(data['fund_source_type']['tags'])  
                if(data['fund_source_type']['is_verified'] == 1) {
                  $('#fund_source_type_is_verified').iCheck('check'); 
                }    
                if(data['fund_source_type']['is_active'] == 1) {
                  $('#fund_source_type_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#fund_source_type_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_fund_source_type(){
            init_view_fund_source_type();
            $('.fund-source-type-field')
              .attr('disabled', false);

            $('#add_fund_source_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_fund_source_type(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('fund_source_type.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'fund_source_type' : $('#fund_source_type_name').val(),               
                'tags' : $('#fund_source_type_tags').val(),
                'is_verified' :  ($('#fund_source_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#fund_source_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_fund_source_type').on('click', function(e){ 
            clear_fields();
            init_add_fund_source_type();          
            $('#fund_source_type_modal_header').html("Add Fund Source Type");
            $('#fund_source_type_modal').modal('toggle')
          })

          $('#add_fund_source_type').on('click', function(e){            
            var request = add_fund_source_type();
            request.then(function(data) {
              $('#fund_source_type_modal').modal('toggle')
              fund_source_type_table.ajax.reload()
            })

          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_fund_source_type(){
            init_view_fund_source_type()
            $('.fund-source-type-field')
              .attr('disabled', false);

            $('#update_fund_source_type.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_fund_source_type(fund_source_type_id){  
            // error_checking($('.agency-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('fund_source_type.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : fund_source_type_id,
                'fund_source_type' : $('#fund_source_type_name').val(),
                'tags' : $('#fund_source_type_tags').val(),
                'is_verified' :  ($('#fund_source_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#fund_source_type_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_fund_source_type').on('click', function(e){
            var request = update_fund_source_type(fund_source_type_id);
            request.then(function(data) {
              $('#fund_source_type_modal').modal('toggle')
              fund_source_type_table.ajax.reload()             
            })
          })

          $('#fund_source_type_table').on('click', '.update-fund-source-type', function(e){
            $('#fund_source_type_modal_header').html("Update Fund Source Type");         
            init_update_fund_source_type();
            fund_source_type_id = $(this).parents('tr').attr('data-id');
            var request = view_fund_source_type(fund_source_type_id);

            request.then(function(data) {
              if(data['status'] == 1){               
                $('#fund_source_type_name').val(data['fund_source_type']['fund_source_type'])                  
                $('#fund_source_type_tags').val(data['fund_source_type']['tags'])    
                if(data['fund_source_type']['is_verified'] == 1) {
                  $('#fund_source_type_is_verified').iCheck('check'); 
                }    
                if(data['fund_source_type']['is_active'] == 1) {
                  $('#fund_source_type_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#fund_source_type_modal').modal('toggle')            
          })    
        {{-- update end --}}

        {{-- delete start --}}
          $('#fund_source_type_table').on('click', '.delete-fund-source-type', function(e){
            fund_source_type_id = $(this).parents('tr').attr('data-id');
            delete_fund_source_type(fund_source_type_id);
          })

          function delete_fund_source_type(fund_source_type_id){
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
                  url: "{{ route('fund_source_type.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : fund_source_type_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Budget type has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    fund_source_type_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}
      {{-- END --}}