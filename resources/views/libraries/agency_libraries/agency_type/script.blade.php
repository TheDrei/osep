
    {{-- table start --}}
      var agency_type_table = $('#agency_type_table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: {
          url: "{{ route('agency_type.table') }}",
          method: "GET",
          data : {
            '_token': '{{ csrf_token() }}'
          }
        },
        columns: [      
            {data: 'id', name: 'id'},
            {data: 'agency_type', name: 'agency_type'},
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

      var agency_type_id;
    {{-- table end --}}      

    {{-- START --}}
      {{-- modal start --}}
        $('#agency_type_modal').on('hidden.bs.modal', function(){       
          init_view_agency_type();
          clear_fields()
          clear_attributes()
          agency_type_table.ajax.reload()
        });  

        $('#agency_type_modal').on('shown.bs.modal', function () {
          $('#agency_type_name').focus();
        })  
      {{-- modal end --}}

      {{-- view start --}}
        function init_view_agency_type(){
          $('.agency-type-field')
            .val('')
            .attr('disabled', true);

          $('.save-buttons')
            .removeClass('d-inline')
            .addClass('d-none')
            .attr('disabled', true);
        }

        function view_agency_type(agency_type_id){
          var request = $.ajax({
            method: "GET",
            url: "{{ route('agency_type.show') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'id' : agency_type_id
            }
          });
          return request;
        }

        $('#agency_type_table').on('click', '.view-agency-type', function(e){     
          $('#agency_type_modal_header').html("View Agency Type");     
          agency_type_id = $(this).parents('tr').attr('data-id');
          init_view_agency();   
          var request = view_agency_type(agency_type_id);   
          request.then(function(data) {
            if(data['status'] == 1){          
              $('#agency_type_name').val(data['agency_type']['agency_type'])                  
              $('#agency_type_tags').val(data['agency_type']['tags'])  
              if(data['agency_type']['is_verified'] == 1) {
                $('#agency_type_is_verified').iCheck('check'); 
              }    
              if(data['agency_type']['is_active'] == 1) {
                $('#agency_type_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#agency_type_modal').modal('toggle');
        })
      {{-- view end --}}

      {{-- add start --}}
        function init_add_agency_type(){
          init_view_agency_type();
          $('.agency-type-field')
            .attr('disabled', false);

          $('#add_agency_type.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        $('#add_agency_type').on('click', function(event){   
          event.prevenDefault;         
          clear_attributes()   
          $.ajax({
            method: "POST",
            url: "{{ route('agency_type.store') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'agency_type' : $('#agency_type_name').val(),            
              'tags' : $('#agency_type_tags').val(),
              'is_verified' :  ($('#agency_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
              'is_active' :  ($('#agency_type_is_active').iCheck('update')[0].checked ? 1  : 0)
            },
            success:function(data) {
              console.log(data);
              if(data.errors) {         
                if(data.errors.agency_type){
                  $('#agency_type_name').addClass('is-invalid');
                  $('#agency-type-name-error').html(data.errors.agency_type[0]);
                }                   
              }
              if(data.success) {
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Agency type has been successfully added.',
                  showConfirmButton: false,
                  timer: 1500
                }) 
                $('#agency_type_modal').modal('toggle')
                agency_type_table.ajax.reload();
              }
            },
          });
        })

        $('#add_new_agency_type').on('click', function(e){ 
          clear_fields()
          clear_attributes()
          init_add_agency_type();   
          $('#agency_type_modal_header').html("Add Agency Type");
          $('#agency_type_modal').modal('toggle')
        })
      {{-- add end --}}
      
      {{-- update start --}}
        function init_update_agency_type(){
          init_view_agency_type()
          $('.agency-type-field')
            .attr('disabled', false);

          $('#update_agency_type.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        $('#update_agency_type').on('click', function(event){
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
                url: "{{ route('agency_type.update') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : agency_type_id,
                  'agency_type' : $('#agency_type_name').val(),             
                  'tags' : $('#agency_type_tags').val(),
                  'is_verified' :  ($('#agency_type_is_verified').iCheck('update')[0].checked ? 1  : 0),
                  'is_active' :  ($('#agency_type_is_active').iCheck('update')[0].checked ? 1  : 0)
                },
                success:function(data) {
                  console.log(data);
                  if(data.errors) {         
                    if(data.errors.agency_type){
                      $('#agency_type_name').addClass('is-invalid');
                      $('#agency-type-name-error').html(data.errors.agency_type[0]);
                    }                   
                  }
                  if(data.success) {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency type has been successfully edited.',
                      showConfirmButton: false,
                      timer: 1500
                    })                        
                    $('#agency_type_modal').modal('toggle')  
                    agency_type_table.ajax.reload(); 
                  }                      
                }                             
              });                                
            }       
          })   
        })

        $('#agency_type_table').on('click', '.update-agency-type', function(e){
          $('#agency_type_modal_header').html("Update Agency Type");         
          init_update_agency_type();
          agency_type_id = $(this).parents('tr').attr('data-id');
          var request = view_agency_type(agency_type_id);

          request.then(function(data) {
            if(data['status'] == 1){            
              $('#agency_type_name').val(data['agency_type']['agency_type'])                
              $('#agency_type_tags').val(data['agency_type']['tags'])  
              if(data['agency_type']['is_verified'] == 1) {
                $('#agency_type_is_verified').iCheck('check'); 
              }    
              if(data['agency_type']['is_active'] == 1) {
                $('#agency_type_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#agency_type_modal').modal('toggle')            
        })
      {{-- update end --}}

      {{-- delete start --}}
        $('#agency_type_table').on('click', '.delete-agency-type', function(e){
          agency_type_id = $(this).parents('tr').attr('data-id');
          delete_agency_type(agency_type_id);
        })

        function delete_agency_type(agency_type_id){
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
                url: "{{ route('agency_type.delete') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : agency_type_id
                },
                success: function(data) {      
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Agency type has been successfully deleted.',
                    showConfirmButton: false,
                    timer: 1500
                  }) 
                  agency_type_table.ajax.reload();          
                }             
              })    
            }       
          })
        }
      {{-- delete end --}}
    {{-- END --}}