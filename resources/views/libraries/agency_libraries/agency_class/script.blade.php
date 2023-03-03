
    {{-- table start --}}
      var agency_class_table = $('#agency_class_table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: {
          url: "{{ route('agency_class.table') }}",
          method: "GET",
          data : {
            '_token': '{{ csrf_token() }}'
          }
        },
        columns: [      
            {data: 'id', name: 'id'},
            {data: 'agency_class', name: 'agency_class'},           
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
      var agency_class_id;
    {{-- table end --}}      

    {{-- START --}}
      {{-- modal start --}}
        $('#agency_class_modal').on('hidden.bs.modal', function(){       
          init_view_agency_class();
          clear_fields()
          clear_attributes()
          agency_class_table.ajax.reload()
        });  

        $('#agency_class_modal').on('shown.bs.modal', function () {
          $('#class_name').focus();
        })  
      {{-- modal end --}}
      
      {{-- view start --}}
        function init_view_agency_class(){
          $('.agency-class-field')
            .val('')
            .attr('disabled', true);

          $('.save-buttons')
            .removeClass('d-inline')
            .addClass('d-none')
            .attr('disabled', true);
        }

        function view_agency_class(agency_class_id){
          var request = $.ajax({
            method: "GET",
            url: "{{ route('agency_class.show') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'id' : agency_class_id
            }
          });
          return request;
        }

        $('#agency_class_table').on('click', '.view-agency-class', function(e){     
          $('#agency_class_modal_header').html("View Agency Class");     
          agency_class_id = $(this).parents('tr').attr('data-id');
          init_view_agency_class();   
          var request = view_agency_class(agency_class_id);   
          request.then(function(data) {
            if(data['status'] == 1){              
              $('#class_name').val(data['agency_class']['agency_class'])                 
              $('#agency_class_tags').val(data['agency_class']['tags'])         
              if(data['agency_class']['is_verified'] == 1) {
                $('#agency_class_is_verified').iCheck('check'); 
              }    
              if(data['agency_class']['is_active'] == 1) {
                $('#agency_class_is_active').iCheck('check'); 
              }  
            }                            
          })
          $('#agency_class_modal').modal('toggle');
        })
      {{-- view end --}}

      {{-- add start --}}
        function init_add_agency_class(){
          init_view_agency_class();
          $('.agency-class-field')
            .attr('disabled', false);

          $('#add_agency_class.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }          

        $('#add_new_agency_class').on('click', function(){ 
          clear_fields();
          init_add_agency_class();          
          $('#agency_class_modal_header').html("Add Agency Class");
          $('#agency_class_modal').modal('toggle')
        })

        $('#add_agency_class').on('click', function(event){   
          event.prevenDefault;         
          clear_attributes()   
          $.ajax({
            method: "POST",
            url: "{{ route('agency_class.store') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'agency_class' : $('#class_name').val(),   
              'tags' : $('#agency_class_tags').val(),
              'is_verified' :  ($('#agency_class_is_verified').iCheck('update')[0].checked ? 1  : 0),
              'is_active' :  ($('#agency_class_is_active').iCheck('update')[0].checked ? 1  : 0)
            },
            success:function(data) {
              console.log(data);
              if(data.errors) {   
                if(data.errors.agency_class){
                  $('#class_name').addClass('is-invalid');
                  $('#class-name-error').html(data.errors.agency_class[0]);
                }                   
              }
              if(data.success) {
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Agency class has been successfully added.',
                  showConfirmButton: false,
                  timer: 1500
                }) 
                $('#agency_class_modal').modal('toggle')
                agency_class_table.ajax.reload();
              }
            },
          });
        })
      {{-- add end --}}
      
      {{-- update start --}}
        function init_update_agency_class(){
          init_view_agency_class()
          $('.agency-class-field')
            .attr('disabled', false);

          $('#update_agency_class.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        $('#update_agency_class').on('click', function(event){
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
                url: "{{ route('agency_class.update') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : agency_class_id,
                  'agency_class' : $('#class_name').val(),          
                  'tags' : $('#agency_class_tags').val(),
                  'is_verified' :  ($('#agency_class_is_verified').iCheck('update')[0].checked ? 1  : 0),
                  'is_active' :  ($('#agency_class_is_active').iCheck('update')[0].checked ? 1  : 0)
                },
                success:function(data) {
                  console.log(data);
                  if(data.errors) {         
                    if(data.errors.agency_class){
                      $('#class_name').addClass('is-invalid');
                      $('#class-name-error').html(data.errors.agency_class[0]);
                    }                   
                  }
                  if(data.success) {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency class has been successfully edited.',
                      showConfirmButton: false,
                      timer: 1500
                    })                        
                    $('#agency_class_modal').modal('toggle')  
                    agency_class_table.ajax.reload(); 
                  }                      
                }                             
              });                                
            }       
          })   
        })

        $('#agency_class_table').on('click', '.update-agency-class', function(){
          $('#agency_class_modal_header').html("Update Agency Class");         
          init_update_agency_class();
          agency_class_id = $(this).parents('tr').attr('data-id');
          var request = view_agency_class(agency_class_id);

          request.then(function(data) {
            if(data['status'] == 1){              
              $('#class_name').val(data['agency_class']['agency_class'])                 
              $('#agency_class_tags').val(data['agency_class']['tags'])         
              if(data['agency_class']['is_verified'] == 1) {
                $('#agency_class_is_verified').iCheck('check'); 
              }    
              if(data['agency_class']['is_active'] == 1) {
                $('#agency_class_is_active').iCheck('check'); 
              }  
            }                            
          })
          $('#agency_class_modal').modal('toggle')            
        })
      {{-- update end --}}

      {{-- delete start --}}
        $('#agency_class_table').on('click', '.delete-agency-class', function(e){
          agency_class_id = $(this).parents('tr').attr('data-id');
          delete_agency_class(agency_class_id);
        })

        function delete_agency_class(agency_class_id){
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
                url: "{{ route('agency_class.delete') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : agency_class_id
                },
                success: function(data) {      
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Agency has been successfully deleted.',
                    showConfirmButton: false,
                    timer: 1500
                  }) 
                  agency_class_table.ajax.reload();          
                }             
              })    
            }       
          })
        }
      {{-- delete end --}}
    {{-- END --}}