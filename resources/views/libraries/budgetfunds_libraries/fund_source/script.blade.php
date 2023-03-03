
    {{-- table start --}}
      var fund_source_table = $('#fund_source_table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: {
          url: "{{ route('fund_source.table') }}",
          method: "GET",
          data : {
            '_token': '{{ csrf_token() }}'
          }
        },
        columns: [      
            {data: 'id', name: 'id'},
            {data: 'fund_source', name: 'fund_source'},
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

      var fund_source_id;
    {{-- table end --}}      

    {{-- START --}}
      {{-- modal start --}}
        $('#fund_source_modal').on('hidden.bs.modal', function(){       
          {{-- init_view_fund_source();
          clear_fields()
          clear_attributes() --}}
          fund_source_table.ajax.reload()
        });  

        $('#fund_source_modal').on('shown.bs.modal', function () {
          $('#fund_source_name').focus();
        })  
      {{-- modal end --}}

      {{-- view start --}}
        function init_view_fund_source(){
          $('.fund-source-field')
            .val('')
            .attr('disabled', true);

          $('.save-buttons')
            .removeClass('d-inline')
            .addClass('d-none')
            .attr('disabled', true);
        }

        function view_fund_source(fund_source_id){
          var request = $.ajax({
            method: "GET",
            url: "{{ route('fund_source.show') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'id' : fund_source_id
            }
          });
          return request;
        }

        $('#fund_source_table').on('click', '.view-fund-source', function(e){     
          $('#fund_source_modal_header').html("View Fund Source");     
          fund_source_id = $(this).parents('tr').attr('data-id');
          init_view_fund_source();   
          var request = view_fund_source(fund_source_id);   
          request.then(function(data) {
            if(data['status'] == 1){          
              $('#fund_source_name').val(data['fund_source']['fund_source'])               
              $('#fund_source_tags').val(data['fund_source']['tags'])                  
              $.each($('#fund_source_type_id option'),function(){
                if($('#fund_source_type_id').val() == data['fund_source']['fund_source_type_id']){
                   $('#fund_source_type_id').attr('selected',true)
                }
              });
              if(data['fund_source']['is_verified'] == 1) {
                $('#fund_source_is_verified').iCheck('check'); 
              }    
              if(data['fund_source']['is_active'] == 1) {
                $('#fund_source_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#fund_source_modal').modal('toggle');
        })
      {{-- view end --}}

      {{-- add start --}}
        function init_add_fund_source(){
          init_view_fund_source();
          $('.fund-source-field')
            .attr('disabled', false);

          $('#add_fund_source.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        $('#add_fund_source').on('click', function(event){   
          event.prevenDefault;         
          clear_attributes()   
          $.ajax({
            method: "POST",
            url: "{{ route('fund_source.store') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'fund_source' : $('#fund_source_name').val(),   
              'fund_source_type_id' : $('#fund_source_type_id').val(),         
              'tags' : $('#fund_source_tags').val(),
              'is_verified' :  ($('#fund_source_is_verified').iCheck('update')[0].checked ? 1  : 0),
              'is_active' :  ($('#fund_source_is_active').iCheck('update')[0].checked ? 1  : 0)
            },
            success:function(data) {
              console.log(data);
              if(data.errors) {         
                if(data.errors.fund_source){
                  $('#fund_source_name').addClass('is-invalid');
                  $('#fund-source-name-error').html(data.errors.fund_source[0]);
                }                   
              }
              if(data.success) {
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Fund source has been successfully added.',
                  showConfirmButton: false,
                  timer: 1500
                }) 
                $('#fund_source_modal').modal('toggle')
                fund_source_table.ajax.reload();
              }
            },
          });
        })

        $('#add_new_fund_source').on('click', function(e){ 
          clear_fields()
          clear_attributes()
          init_add_fund_source();   
          $('#fund_source_modal_header').html("Add Fund Source");
          $('#fund_source_modal').modal('toggle')
        })
      {{-- add end --}}
      
      {{-- update start --}}
        function init_update_fund_source(){
          init_view_fund_source()
          $('.fund-source-field')
            .attr('disabled', false);

          $('#update_fund_source.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        $('#update_fund_source').on('click', function(event){
          event.preventDefault();
          clear_attributes()
          Swal.fire({
            title: 'Are you sure you want to save changes?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes'
          })
          .then((result) => {
            if (result.value) {
              var request = $.ajax({
                method: "PATCH",
                url: "{{ route('fund_source.update') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : fund_source_id,
                  'fund_source' : $('#fund_source_name').val(),          
                  'fund_source_type_id' : $('#fund_source_type_id').val(),              
                  'tags' : $('#fund_source_tags').val(),
                  'is_verified' :  ($('#fund_source_is_verified').iCheck('update')[0].checked ? 1  : 0),
                  'is_active' :  ($('#fund_source_is_active').iCheck('update')[0].checked ? 1  : 0)
                },
                success:function(data) {
                  console.log(data);
                  if(data.errors) {         
                    if(data.errors.fund_source){
                      $('#fund_source_name').addClass('is-invalid');
                      $('#fund-source-name-error').html(data.errors.fund_source[0]);
                    }                   
                  }
                  if(data.success) {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Fund source has been successfully edited.',
                      showConfirmButton: false,
                      timer: 1500
                    })                        
                    $('#fund_source_modal').modal('toggle')  
                    fund_source_table.ajax.reload(); 
                  }                      
                }                             
              });                                
            }       
          })   
        })

        $('#fund_source_table').on('click', '.update-fund-source', function(e){
          $('#fund_source_modal_header').html("Update Fund Source");         
          init_update_fund_source();
          fund_source_id = $(this).parents('tr').attr('data-id');
          var request = view_fund_source(fund_source_id);

          request.then(function(data) {
            if(data['status'] == 1){            
              $('#fund_source_name').val(data['fund_source']['fund_source'])                 
              $('#fund_source_tags').val(data['fund_source']['tags'])                  
              $.each($('#fund_source_id option'),function(){
                if($('#fund_source_type_id').val() == data['fund_source_type_id']['fund_source_type_id']){
                   $('#fund_source_type_id').attr('selected',true)
                }
              });
              if(data['fund_source']['is_verified'] == 1) {
                $('#fund_source_is_verified').iCheck('check'); 
              }    
              if(data['fund_source']['is_active'] == 1) {
                $('#fund_source_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#fund_source_modal').modal('toggle')            
        })
      {{-- update end --}}

      {{-- delete start --}}
        $('#fund_source_table').on('click', '.delete-fund-source', function(e){
          fund_source_id = $(this).parents('tr').attr('data-id');
          delete_fund_source(fund_source_id);
        })

        function delete_fund_source(fund_source_id){
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
                url: "{{ route('fund_source.delete') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : fund_source_id
                },
                success: function(data) {      
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Fund source has been successfully deleted.',
                    showConfirmButton: false,
                    timer: 1500
                  }) 
                  fund_source_table.ajax.reload();          
                }             
              })    
            }       
          })
        }
      {{-- delete end --}}
    {{-- END --}}