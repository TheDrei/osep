
      {{-- table start --}}
      var agency_subcategory_table = $('#agency_subcategory_table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: {
          url: "{{ route('agency_subcategory.table') }}",
          method: "GET",
          data : {
            '_token': '{{ csrf_token() }}'
          }
        },
        columns: [      
            {data: 'id', name: 'id'},
            {data: 'agency_subcategory', name: 'agency_subcategory'},
            {data: 'agency_subcategory_acronym', name: 'agency_subcategory_acronym'},
            {data: 'agency_category', name: 'agency_category'},
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

      var agency_subcategory_id;
    {{-- table end --}}      

    {{-- START --}}
      {{-- modal start --}}
        $('#agency_subcategory_modal').on('hidden.bs.modal', function(){       
          init_view_agency_subcategory();
          clear_fields()
          clear_attributes()
          agency_subcategory_table.ajax.reload()
        });  

        $('#agency_subcategory_modal').on('shown.bs.modal', function () {
          $('#agency_subcategory_name').focus();
        })  
      {{-- modal end --}}

      {{-- view start --}}
        function init_view_agency_subcategory(){
          $('.agency-subcategory-field')
            .val('')
            .attr('disabled', true);

          $('.save-buttons')
            .removeClass('d-inline')
            .addClass('d-none')
            .attr('disabled', true);
        }

        function view_agency_subcategory(agency_subcategory_id){
          var request = $.ajax({
            method: "GET",
            url: "{{ route('agency_subcategory.show') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'id' : agency_subcategory_id
            }
          });
          return request;
        }

        $('#agency_subcategory_table').on('click', '.view-agency-subcategory', function(e){     
          $('#agency_subcategory_modal_header').html("View Agency Subcategory");     
          agency_subcategory_id = $(this).parents('tr').attr('data-id');
          init_view_agency();   
          var request = view_agency_subcategory(agency_subcategory_id);   
          request.then(function(data) {
            if(data['status'] == 1){          
              $('#agency_subcategory_name').val(data['agency_subcategory']['agency_subcategory'])  
              $('#agency_subcategory_acronym').val(data['agency_subcategory']['agency_subcategory_acronym'])                  
              $('#agency_subcategory_tags').val(data['agency_subcategory']['tags'])                  
              $.each($('#agency_sub_category_id option'),function(){
                if($('#agency_sub_category_id').val() == data['agency_subcategory']['agency_category_id']){
                   $('#agency_sub_category_id').attr('selected',true)
                }
              });
              if(data['agency_subcategory']['is_verified'] == 1) {
                $('#agency_subcategory_is_verified').iCheck('check'); 
              }    
              if(data['agency_subcategory']['is_active'] == 1) {
                $('#agency_subcategory_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#agency_subcategory_modal').modal('toggle');
        })
      {{-- view end --}}

      {{-- add start --}}
        function init_add_agency_subcategory(){
          init_view_agency_subcategory();
          $('.agency-subcategory-field')
            .attr('disabled', false);

          $('#add_agency_subcategory.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        $('#add_agency_subcategory').on('click', function(event){   
          event.prevenDefault;         
          clear_attributes()   
          $.ajax({
            method: "POST",
            url: "{{ route('agency_subcategory.store') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'agency_subcategory' : $('#agency_subcategory_name').val(),
              'agency_subcategory_acronym' : $('#agency_subcategory_acronym').val(),         
              'agency_category_id' : $('#agency_sub_category_id').val(),         
              'tags' : $('#agency_subcategory_tags').val(),
              'is_verified' :  ($('#agency_subcategory_is_verified').iCheck('update')[0].checked ? 1  : 0),
              'is_active' :  ($('#agency_subcategory_is_active').iCheck('update')[0].checked ? 1  : 0)
            },
            success:function(data) {
              console.log(data);
              if(data.errors) {         
                if(data.errors.agency_subcategory){
                  $('#agency_subcategory_name').addClass('is-invalid');
                  $('#agency-subcategory-name-error').html(data.errors.agency_subcategory[0]);
                }                   
              }
              if(data.success) {
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Agency subcategory has been successfully added.',
                  showConfirmButton: false,
                  timer: 1500
                }) 
                $('#agency_subcategory_modal').modal('toggle')
                agency_subcategory_table.ajax.reload();
              }
            },
          });
        })

        $('#add_new_agency_subcategory').on('click', function(e){ 
          clear_fields()
          clear_attributes()
          init_add_agency_subcategory();   
          $('#agency_subcategory_modal_header').html("Add Agency Subcategory");
          $('#agency_subcategory_modal').modal('toggle')
        })
      {{-- add end --}}
      
      {{-- update start --}}
        function init_update_agency_subcategory(){
          init_view_agency_subcategory()
          $('.agency-subcategory-field')
            .attr('disabled', false);

          $('#update_agency_subcategory.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        $('#update_agency_subcategory').on('click', function(event){
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
                url: "{{ route('agency_subcategory.update') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : agency_subcategory_id,
                  'agency_subcategory' : $('#agency_subcategory_name').val(),
                  'agency_subcategory_acronym' : $('#agency_subcategory_acronym').val(),              
                  'agency_category_id' : $('#agency_sub_category_id').val(),              
                  'tags' : $('#agency_subcategory_tags').val(),
                  'is_verified' :  ($('#agency_subcategory_is_verified').iCheck('update')[0].checked ? 1  : 0),
                  'is_active' :  ($('#agency_subcategory_is_active').iCheck('update')[0].checked ? 1  : 0)
                },
                success:function(data) {
                  console.log(data);
                  if(data.errors) {         
                    if(data.errors.agency_subcategory){
                      $('#agency_subcategory_name').addClass('is-invalid');
                      $('#agency-subcategory-name-error').html(data.errors.agency_subcategory[0]);
                    }                   
                  }
                  if(data.success) {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency subcategory has been successfully edited.',
                      showConfirmButton: false,
                      timer: 1500
                    })                        
                    $('#agency_subcategory_modal').modal('toggle')  
                    agency_subcategory_table.ajax.reload(); 
                  }                      
                }                             
              });                                
            }       
          })   
        })

        $('#agency_subcategory_table').on('click', '.update-agency-subcategory', function(e){
          $('#agency_subcategory_modal_header').html("Update Agency Subcategory");         
          init_update_agency_subcategory();
          agency_subcategory_id = $(this).parents('tr').attr('data-id');
          var request = view_agency_subcategory(agency_subcategory_id);

          request.then(function(data) {
            if(data['status'] == 1){            
              $('#agency_subcategory_name').val(data['agency_subcategory']['agency_subcategory'])  
              $('#agency_subcategory_acronym').val(data['agency_subcategory']['agency_subcategory_acronym'])                  
              $('#agency_subcategory_tags').val(data['agency_subcategory']['tags'])                  
              $.each($('#agency_subcategory_id option'),function(){
                if($('#agency_sub_category_id').val() == data['agency_category_id']['agency_category_id']){
                   $('#agency_sub_category_id').attr('selected',true)
                }
              });
              if(data['agency_subcategory']['is_verified'] == 1) {
                $('#agency_subcategory_is_verified').iCheck('check'); 
              }    
              if(data['agency_subcategory']['is_active'] == 1) {
                $('#agency_subcategory_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#agency_subcategory_modal').modal('toggle')            
        })
      {{-- update end --}}

      {{-- delete start --}}
        $('#agency_subcategory_table').on('click', '.delete-agency-subcategory', function(e){
          agency_subcategory_id = $(this).parents('tr').attr('data-id');
          delete_agency_subcategory(agency_subcategory_id);
        })

        function delete_agency_subcategory(agency_subcategory_id){
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
                url: "{{ route('agency_subcategory.delete') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : agency_subcategory_id
                },
                success: function(data) {      
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Agency subcategory has been successfully deleted.',
                    showConfirmButton: false,
                    timer: 1500
                  }) 
                  agency_subcategory_table.ajax.reload();          
                }             
              })    
            }       
          })
        }
      {{-- delete end --}}
    {{-- END --}}