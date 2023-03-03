
    {{-- table start --}}
      var budget_type_table = $('#budget_type_table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: {
          url: "{{ route('budget_type.table') }}",
          method: "GET",
          data : {
            '_token': '{{ csrf_token() }}'
          }
        },
        columns: [      
            {data: 'id', name: 'id'},
            {data: 'budget_type', name: 'budget_type'},           
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
      var budget_type_id;
    {{-- table end --}}      

    {{-- START --}}
      {{-- modal start --}}
        $('#budget_type_modal').on('hidden.bs.modal', function(){       
          init_view_budget_type();
          clear_fields()
          clear_attributes()
          budget_type_table.ajax.reload()
        });  

        $('#budget_type_modal').on('shown.bs.modal', function () {
          $('#budget_type_name').focus();
        })  
      {{-- modal end --}}
      
      {{-- view start --}}
        function init_view_budget_type(){
          $('.budget-type-field')
            .val('')
            .attr('disabled', true);

          $('.save-buttons')
            .removeClass('d-inline')
            .addClass('d-none')
            .attr('disabled', true);
        }

        function view_budget_type(budget_type_id){
          var request = $.ajax({
            method: "GET",
            url: "{{ route('budget_type.show') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'id' : budget_type_id
            }
          });
          return request;
        }

        $('#budget_type_table').on('click', '.view-budget-type', function(e){     
          $('#budget_type_modal_header').html("View Budget Type");     
          budget_type_id = $(this).parents('tr').attr('data-id');
          init_view_budget_type();   
          var request = view_budget_type(budget_type_id);   
          request.then(function(data) {
            if(data['status'] == 1){              
              $('#budget_type_name').val(data['budget_type']['budget_type'])                 
              $('#budget_type_tags').val(data['budget_type']['tags'])         
              if(data['budget_type']['is_verified'] == 1) {
                $('#budget_type_is_verified').iCheck('check'); 
              }    
              if(data['budget_type']['is_active'] == 1) {
                $('#budget_type_is_active').iCheck('check'); 
              }  
            }                            
          })
          $('#budget_type_modal').modal('toggle');
        })
      {{-- view end --}}

      {{-- add start --}}
        function init_add_budget_type(){
          init_view_budget_type();
          $('.budget-type-field')
            .attr('disabled', false);

          $('#add_budget_type.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }          

        $('#add_new_budget_type').on('click', function(){ 
          {{-- clear_fields(); --}}
          init_add_budget_type();          
          $('#budget_type_modal_header').html("Add Budget Type");
          $('#budget_type_modal').modal('toggle')
        })

        $('#add_budget_type').on('click', function(event){   
          event.prevenDefault;         
          clear_attributes()   
          $.ajax({
            method: "POST",
            url: "{{ route('budget_type.store') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'budget_type' : $('#budget_type_name').val(),   
              'tags' : $('#budget_type_tags').val(),
              'is_verified' :  ($('#budget_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
              'is_active' :  ($('#budget_type_is_active').iCheck('update')[0].checked ? 1  : 0)
            },
            success:function(data) {
              console.log(data);
              if(data.errors) {   
                if(data.errors.budget_type){
                  $('#budget_type_name').addClass('is-invalid');
                  $('#budget-type-name-error').html(data.errors.budget_type[0]);
                }                   
              }
              if(data.success) {
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Budget type has been successfully added.',
                  showConfirmButton: false,
                  timer: 1500
                }) 
                $('#budget_type_modal').modal('toggle')
                budget_type_table.ajax.reload();
              }
            },
          });
        })
      {{-- add end --}}
      
      {{-- update start --}}
        function init_update_budget_type(){
          init_view_budget_type()
          $('.budget-type-field')
            .attr('disabled', false);

          $('#update_budget_type.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        function update_budget_type(budget_type_id){  
          var request = $.ajax({
            method: "PATCH",
            url: "{{ route('budget_type.update') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'id' : budget_type_id,
              'budget_type' : $('#budget_type_name').val(),              
              'tags' : $('#budget_type_tags').val(),
              'is_verified' :  ($('#budget_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
              'is_active' :  ($('#budget_type_is_active').iCheck('update')[0].checked ? 1  : 0)
            }
          });
          return request;
        }

        $('#update_budget_type').on('click', function(event){
          event.preventDefault();
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
                url: "{{ route('budget_type.update') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : budget_type_id,
                  'budget_type' : $('#budget_type_name').val(),       
                  'tags' : $('#budget_type_tags').val(),
                  'is_verified' :  ($('#budget_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                  'is_active' :  ($('#budget_type_is_active').iCheck('update')[0].checked ? 1  : 0)
                },
                success:function(data) {
                  console.log(data);
                  if(data.errors) {         
                    if(data.errors.budget_type){
                      $('#budget_type_name').addClass('is-invalid');
                      $('#budget-type-name-error').html(data.errors.budget_type[0]);
                    }                   
                  }
                  if(data.success) {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Budget type has been successfully edited.',
                      showConfirmButton: false,
                      timer: 1500
                    })                        
                    $('#budget_type_modal').modal('toggle')  
                    budget_type_table.ajax.reload(); 
                  }                      
                }                             
              });                                
            }       
          })   
        })

        $('#budget_type_table').on('click', '.update-budget-type', function(e){
          $('#budget_type_modal_header').html("Update Budget Type");         
          init_update_budget_type();
          budget_type_id = $(this).parents('tr').attr('data-id');
          var request = view_budget_type(budget_type_id);

          request.then(function(data) {
            if(data['status'] == 1){              
              $('#budget_type_name').val(data['budget_type']['budget_type'])                 
              $('#budget_type_tags').val(data['budget_type']['tags'])         
              if(data['budget_type']['is_verified'] == 1) {
                $('#budget_type_is_verified').iCheck('check'); 
              }    
              if(data['budget_type']['is_active'] == 1) {
                $('#budget_type_is_active').iCheck('check'); 
              }  
            }                            
          })
          $('#budget_type_modal').modal('toggle')            
        })
      {{-- update end --}}

      {{-- delete start --}}
        $('#budget_type_table').on('click', '.delete-budget-type', function(e){
          budget_type_id = $(this).parents('tr').attr('data-id');
          delete_budget_type(budget_type_id);
        })

        function delete_budget_type(budget_type_id){
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
                url: "{{ route('budget_type.delete') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : budget_type_id
                },
                success: function(data) {      
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Budget type has been successfully deleted.',
                    showConfirmButton: false,
                    timer: 1500
                  }) 
                  budget_type_table.ajax.reload();          
                }             
              })    
            }       
          })
        }
      {{-- delete end --}}
    {{-- END --}}