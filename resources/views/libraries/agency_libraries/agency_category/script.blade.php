
      {{-- table start --}}
        var agency_category_table = $('#agency_category_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('agency_category.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'agency_category', name: 'agency_category'},
              {data: 'agency_category_acronym', name: 'agency_category_acronym'},             
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
        var agency_category_id;
      {{-- table end --}}  
    
      {{-- START --}}
        {{-- modal start --}}
          $('#agency_category_modal').on('hidden.bs.modal', function(){       
            init_view_agency_category();
            clear_fields()
            clear_attributes()
            agency_category_table.ajax.reload()
          });  

          $('#agency_category_modal').on('shown.bs.modal', function () {
            $('#category_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_agency_category(){
            $('.agency-category-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_agency_category(agency_category_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('agency_category.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : agency_category_id
              }
            });
            return request;
          }

          $('#agency_category_table').on('click', '.view-agency-category', function(e){     
            $('#agency_category_modal_header').html("View Agency Category");     
            agency_category_id = $(this).parents('tr').attr('data-id');
            init_view_agency_category();   
            var request = view_agency_category(agency_category_id);   
            request.then(function(data) {
              if(data['status'] == 1){
                $('.agency-category-field').each(function() {
                  $(this).val(data['agency_category'][$(this).attr('id')]).change();
                });                
                $('#agency_category_name').val(data['agency_category']['agency_category'])  
                $('#agency_category_acronym').val(data['agency_category']['agency_category_acronym'])                  
                $('#agency_category_tags').val(data['agency_category']['tags']) 
                if(data['agency_category']['is_verified'] == 1) {
                  $('#agency_category_is_verified').iCheck('check'); 
                }    
                if(data['agency_category']['is_active'] == 1) {
                  $('#agency_category_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#agency_category_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_agency_category(){
            init_view_agency_category();
            $('.agency-category-field')
              .attr('disabled', false);

            $('#add_agency_category.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          $('#add_new_agency_category').on('click', function(){       
            clear_fields();
            init_add_agency_category();          
            $('#agency_category_modal_header').html("Add Agency Category");
            $('#agency_category_modal').modal('toggle')
          })

          $('#add_agency_category').on('click', function(event){   
            event.prevenDefault;         
            clear_attributes()   
            $.ajax({
              method: "POST",
              url: "{{ route('agency_category.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'agency_category' : $('#agency_category_name').val(),
                'agency_category_acronym' : $('#agency_category_acronym').val(),         
                'tags' : $('#agency_category_tags').val(),
                'is_verified' :  ($('#agency_category_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#agency_category_is_active').iCheck('update')[0].checked ? 1  : 0)
              },
              success:function(data) {
                console.log(data);
                if(data.errors) {         
                  if(data.errors.agency_category){
                    $('#category_name').addClass('is-invalid');
                    $('#category-name-error').html(data.errors.agency_category[0]);
                  }                   
                }
                if(data.success) {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Agency category has been successfully added.',
                    showConfirmButton: false,
                    timer: 1500
                  }) 
                  $('#agency_category_modal').modal('toggle')
                  agency_category_table.ajax.reload();
                }
              },
            });
          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_agency_category(){
            init_view_agency_category()
            $('.agency-category-field')
              .attr('disabled', false);

            $('#update_agency_category.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          $('#update_agency_category').on('click', function(event){
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
                  url: "{{ route('agency_category.update') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : agency_category_id,
                    'agency_category' : $('#agency_category_name').val(),
                    'agency_category_acronym' : $('#agency_category_acronym').val(),              
                    'tags' : $('#agency_category_tags').val(),
                    'is_verified' :  ($('#agency_category_is_verified').iCheck('update')[0].checked ? 1  : 0),
                    'is_active' :  ($('#agency_category_is_active').iCheck('update')[0].checked ? 1  : 0)
                  },
                  success:function(data) {
                    console.log(data);
                    if(data.errors) {         
                      if(data.errors.agency_category){
                        $('#category_name').addClass('is-invalid');
                        $('#category-name-error').html(data.errors.agency_category[0]);
                      }                   
                    }
                    if(data.success) {
                      Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Agency category has been successfully edited.',
                        showConfirmButton: false,
                        timer: 1500
                      })                        
                      $('#agency_category_modal').modal('toggle')  
                      agency_category_table.ajax.reload(); 
                    }                      
                  }                             
                });                                
              }       
            })   
          })

          $('#agency_category_table').on('click', '.update-agency-category', function(){
            $('#agency_category_modal_header').html("Update Agency Category");         
            init_update_agency_category();
            agency_category_id = $(this).parents('tr').attr('data-id');
            var request = view_agency_category(agency_category_id);
            request.then(function(data) {
              if(data['status'] == 1){
                $('.agency-category-field').each(function() {
                  $(this).val(data['agency_category'][$(this).attr('id')]).change();
                });                
                $('#agency_category_name').val(data['agency_category']['agency_category'])  
                $('#agency_category_acronym').val(data['agency_category']['agency_category_acronym'])                  
                $('#agency_category_tags').val(data['agency_category']['tags']) 
                if(data['agency_category']['is_verified'] == 1) {
                  $('#agency_category_is_verified').iCheck('check'); 
                }    
                if(data['agency_category']['is_active'] == 1) {
                  $('#agency_category_is_active').iCheck('check'); 
                }  
              }                            
            })
            $('#agency_category_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#agency_category_table').on('click', '.delete-agency-category', function(e){
            agency_category_id = $(this).parents('tr').attr('data-id');
            delete_agency_category(agency_category_id);
          })

          function delete_agency_category(agency_category_id){
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
                  url: "{{ route('agency_category.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : agency_category_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    agency_category_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}
      {{-- END --}}