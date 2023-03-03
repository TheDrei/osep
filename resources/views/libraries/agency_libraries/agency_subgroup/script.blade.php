
      {{-- table start --}}
      var agency_subgroup_table = $('#agency_subgroup_table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: {
          url: "{{ route('agency_subgroup.table') }}",
          method: "GET",
          data : {
            '_token': '{{ csrf_token() }}'
          }
        },
        columns: [      
            {data: 'id', name: 'id'},
            {data: 'agency_subgroup', name: 'agency_subgroup'},
            {data: 'agency_group', name: 'agency_group'},
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
      var agency_subgroup_id;
    {{-- table end --}}      
    
    {{-- START --}}
      {{-- modal start --}}
        $('#agency_subgroup_modal').on('hidden.bs.modal', function(){       
          init_view_agency_subgroup();
          clear_fields()
    clear_attributes()
          agency_subgroup_table.ajax.reload()
        });  

        $('#agency_subgroup_modal').on('shown.bs.modal', function () {
          $('#agency_subgroup_name').focus();
        })  
      {{-- modal end --}}

      {{-- view start --}}
        function init_view_agency_subgroup(){
          $('.agency-subgroup-field')
            .val('')
            .attr('disabled', true);

          $('.save-buttons')
            .removeClass('d-inline')
            .addClass('d-none')
            .attr('disabled', true);
        }

        function view_agency_subgroup(agency_subgroup_id){
          var request = $.ajax({
            method: "GET",
            url: "{{ route('agency_subgroup.show') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'id' : agency_subgroup_id
            }
          });
          return request;
        }

        $('#agency_subgroup_table').on('click', '.view-agency-subgroup', function(e){                 
          $('#agency_subgroup_modal_header').html("View Agency Subgroup");     
          agency_subgroup_id = $(this).parents('tr').attr('data-id');
          init_view_agency_subgroup();   
          var request = view_agency_subgroup(agency_subgroup_id);  
          request.then(function(data) {
            if(data['status'] == 1){             
              $('#agency_subgroup_name').val(data['agency_subgroup']['agency_subgroup'])              
              $('#agency_subgroup_tags').val(data['agency_subgroup']['tags'])                  
              $.each($('#agency_sub_group_id option'),function(){
                if($('#agency_sub_group_id').val() == data['agency_subgroup']['agency_group_id']){
                   $('#agency_sub_group_id').attr('selected',true)
                }
              });
              if(data['agency_subgroup']['is_verified'] == 1) {
                $('#agency_subgroup_is_verified').iCheck('check'); 
              }    
              if(data['agency_subgroup']['is_active'] == 1) {
                $('#agency_subgroup_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#agency_subgroup_modal').modal('toggle');
        })
      {{-- view end --}}

      {{-- add start --}}
        function init_add_agency_subgroup(){
          init_view_agency_subgroup();
          $('.agency-subgroup-field')
            .attr('disabled', false);

          $('#add_agency_subgroup.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        $('#add_agency_subgroup').on('click', function(event){   
          event.prevenDefault;         
          clear_attributes()   
          $.ajax({
            method: "POST",
            url: "{{ route('agency_subgroup.store') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'agency_subgroup' : $('#agency_subgroup_name').val(),  
              'agency_group_id' : $('#agency_sub_group_id').val(),         
              'tags' : $('#agency_subgroup_tags').val(),
              'is_verified' :  ($('#agency_subgroup_is_verified').iCheck('update')[0].checked ? 1  : 0),
              'is_active' :  ($('#agency_subgroup_is_active').iCheck('update')[0].checked ? 1  : 0)
            },
            success:function(data) {
              console.log(data);
              if(data.errors) {         
                if(data.errors.agency_subgroup){
                  $('#agency_subgroup_name').addClass('is-invalid');
                  $('#agency-subgroup-name-error').html(data.errors.agency_subgroup[0]);
                }                   
              }
              if(data.success) {
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Agency subgroup has been successfully added.',
                  showConfirmButton: false,
                  timer: 1500
                }) 
                $('#agency_subgroup_modal').modal('toggle')
                agency_subgroup_table.ajax.reload();
              }
            },
          });
        })

        $('#add_new_agency_subgroup').on('click', function(e){ 
          clear_fields()
          clear_attributes()
          init_add_agency_subgroup();   
          $('#agency_subgroup_modal_header').html("Add Agency Subgroup");
          $('#agency_subgroup_modal').modal('toggle')
        })
      {{-- add end --}}
      
      {{-- update start --}}
        function init_update_agency_subgroup(){
          init_view_agency_subgroup()
          $('.agency-subgroup-field')
            .attr('disabled', false);

          $('#update_agency_subgroup.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        $('#update_agency_subgroup').on('click', function(event){
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
                url: "{{ route('agency_subgroup.update') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : agency_subgroup_id,
                  'agency_subgroup' : $('#agency_subgroup_name').val(),         
                  'agency_group_id' : $('#agency_sub_group_id').val(),              
                  'tags' : $('#agency_subgroup_tags').val(),
                  'is_verified' :  ($('#agency_subgroup_is_verified').iCheck('update')[0].checked ? 1  : 0),
                  'is_active' :  ($('#agency_subgroup_is_active').iCheck('update')[0].checked ? 1  : 0)
                },
                success:function(data) {
                  console.log(data);
                  if(data.errors) {         
                    if(data.errors.agency_subgroup){
                      $('#agency_subgroup_name').addClass('is-invalid');
                      $('#agency-subgroup-name-error').html(data.errors.agency_subgroup[0]);
                    }                   
                  }
                  if(data.success) {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency subgroupy has been successfully edited.',
                      showConfirmButton: false,
                      timer: 1500
                    })                        
                    $('#agency_subgroup_modal').modal('toggle')  
                    agency_subgroup_table.ajax.reload(); 
                  }                      
                }                             
              });                                
            }       
          })   
        })

        $('#agency_subgroup_table').on('click', '.update-agency-subgroup', function(e){
          $('#agency_subgroup_modal_header').html("Update Agency Subgroup");         
          init_update_agency_subgroup();
          agency_subgroup_id = $(this).parents('tr').attr('data-id');
          var request = view_agency_subgroup(agency_subgroup_id);

          request.then(function(data) {
            if(data['status'] == 1){               
              $('#agency_subgroup_name').val(data['agency_subgroup']['agency_subgroup'])                
              $('#agency_subgroup_tags').val(data['agency_subgroup']['tags'])                
              $.each($('#agency_sub_group_id option'),function(){
                if($('#agency_sub_group_id').val() == data['agency_subgroup']['agency_group_id']){
                   $('#agency_sub_group_id').attr('selected',true)
                }
              });
              if(data['agency_subgroup']['is_verified'] == 1) {
                $('#agency_subgroup_is_verified').iCheck('check'); 
              }    
              if(data['agency_subgroup']['is_active'] == 1) {
                $('#agency_subgroup_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#agency_subgroup_modal').modal('toggle')            
        })
      {{-- update end --}}

      {{-- delete start --}}
        $('#agency_subgroup_table').on('click', '.delete-agency-subgroup', function(e){
          agency_subgroup_id = $(this).parents('tr').attr('data-id');
          delete_agency_subgroup(agency_subgroup_id);
        })

        function delete_agency_subgroup(agency_subgroup_id){
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
                url: "{{ route('agency_subgroup.delete') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : agency_subgroup_id
                },
                success: function(data) {      
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Agency has been successfully deleted.',
                    showConfirmButton: false,
                    timer: 1500
                  }) 
                  agency_subgroup_table.ajax.reload();          
                }             
              })    
            }       
          })
        }
      {{-- delete end --}}
    {{-- END --}}