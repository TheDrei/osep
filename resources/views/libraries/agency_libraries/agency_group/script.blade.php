
      {{-- table start --}}
        var agency_group_table = $('#agency_group_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('agency_group.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'agency_group', name: 'agency_group'},
              {data: 'agency_group_description', name: 'agency_group_description'},
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
        var agency_group_id;
      {{-- table end --}}      
  
      {{-- START --}}
        {{-- modal start --}}
          $('#agency_group_modal').on('hidden.bs.modal', function(){       
            init_view_agency_group();
            clear_fields()
            clear_attributes()
            agency_group_table.ajax.reload()
          });  

          $('#agency_group_modal').on('shown.bs.modal', function () {
            $('#group_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_agency_group(){
            $('.agency-group-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_agency_group(agency_group_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('agency_group.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : agency_group_id
              }
            });
            return request;
          }

          $('#agency_group_table').on('click', '.view-agency-group', function(e){     
            $('#agency_group_modal_header').html("View Agency Group");     
            agency_group_id = $(this).parents('tr').attr('data-id');
            init_view_agency_group();   
            var request = view_agency_group(agency_group_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#agency_group_name').val(data['agency_group']['agency_group'])  
                $('#agency_group_description').val(data['agency_group']['agency_group_description'])                  
                $('#agency_group_tags').val(data['agency_group']['tags'])  
                if(data['agency_group']['is_verified'] == 1) {
                  $('#agency_group_is_verified').iCheck('check'); 
                }    
                if(data['agency_group']['is_active'] == 1) {
                  $('#agency_group_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#agency_group_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_agency_group(){
            init_view_agency_group();
            $('.agency-group-field')
              .attr('disabled', false);

            $('#add_agency_group.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }
          
          $('#add_new_agency_group').on('click', function(){ 
            clear_fields()
            clear_attributes()
            init_add_agency_group();          
            $('#agency_group_modal_header').html("Add Agency Group");
            $('#agency_group_modal').modal('toggle')
          })

          $('#add_agency_group').on('click', function(event){   
            event.prevenDefault;    
            clear_attributes()   
            $.ajax({
              method: "POST",
              url: "{{ route('agency_group.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'agency_group' : $('#agency_group_name').val(),
                'agency_group_description' : $('#agency_group_description').val(),         
                'tags' : $('#agency_group_tags').val(),
                'is_verified' :  ($('#agency_group_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#agency_group_is_active').iCheck('update')[0].checked ? 1  : 0)
              },
              success:function(data) {
                console.log(data);
                if(data.errors) {         
                  if(data.errors.agency_group){
                    $('#group_name').addClass('is-invalid');
                    $('#group-name-error').html(data.errors.agency_group[0]);
                  }                   
                }
                if(data.success) {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Agency group has been successfully added.',
                    showConfirmButton: false,
                    timer: 1500
                  }) 
                  $('#agency_group_modal').modal('toggle')
                  agency_group_table.ajax.reload();
                }
              },
            });
          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_agency_group(){
            init_view_agency_group()
            $('.agency-group-field')
              .attr('disabled', false);

            $('#update_agency_group.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          $('#update_agency_group').on('click', function(event){
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
                  url: "{{ route('agency_group.update') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : agency_group_id,
                    'agency_group' : $('#agency_group_name').val(),
                    'agency_group_description' : $('#agency_group_description').val(),              
                    'tags' : $('#agency_group_tags').val(),
                    'is_verified' :  ($('#agency_group_is_verified').iCheck('update')[0].checked ? 1  : 0),
                    'is_active' :  ($('#agency_group_is_active').iCheck('update')[0].checked ? 1  : 0)
                  },
                  success:function(data) {
                    console.log(data);
                    if(data.errors) {         
                      if(data.errors.agency_group){
                        $('#group_name').addClass('is-invalid');
                        $('#group-name-error').html(data.errors.agency_group[0]);
                      }                   
                    }
                    if(data.success) {
                      Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Agency group has been successfully edited.',
                        showConfirmButton: false,
                        timer: 1500
                      })                        
                      $('#agency_group_modal').modal('toggle')  
                      agency_group_table.ajax.reload(); 
                    }                      
                  }                             
                });                                
              }       
            })   
          })

          $('#agency_group_table').on('click', '.update-agency-group', function(e){
            $('#agency_group_modal_header').html("Update Agency Group");         
            init_update_agency_group();
            agency_group_id = $(this).parents('tr').attr('data-id');
            var request = view_agency_group(agency_group_id);
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#agency_group_name').val(data['agency_group']['agency_group'])  
                $('#agency_group_description').val(data['agency_group']['agency_group_description'])                  
                $('#agency_group_tags').val(data['agency_group']['tags'])  
                if(data['agency_group']['is_verified'] == 1) {
                  $('#agency_group_is_verified').iCheck('check'); 
                }    
                if(data['agency_group']['is_active'] == 1) {
                  $('#agency_group_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#agency_group_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#agency_group_table').on('click', '.delete-agency-group', function(e){
            agency_group_id = $(this).parents('tr').attr('data-id');
            delete_agency_group(agency_group_id);
          })

          function delete_agency_group(agency_group_id){
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
                  url: "{{ route('agency_group.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : agency_group_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    agency_group_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}
      {{-- END --}}
