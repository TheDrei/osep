
      {{-- table start --}}
        var location_barangay_table = $('#location_barangay_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('location_barangay.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'barangay', name: 'barangay'},
              {data: 'municipality', name: 'municipality'},
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

        var location_barangay_id;
     
      {{-- table end --}}

     {{-- START --}}
      {{-- modal start --}}
        $('#location_barangay_modal').on('hidden.bs.modal', function(){       
          init_view_location_barangay();
          clear_fields()
          clear_attributes()
          location_barangay_table.ajax.reload()
        });  

        $('#location_barangay_modal').on('shown.bs.modal', function () {
          $('#location_barangay_name').focus();
        })  
      {{-- modal end --}}

      {{-- view start --}}
        function init_view_location_barangay(){
          $('.location-barangay-field')
            .val('')
            .attr('disabled', true);

          $('.save-buttons')
            .removeClass('d-inline')
            .addClass('d-none')
            .attr('disabled', true);
        }

        function view_location_barangay(location_barangay_id){
          var request = $.ajax({
            method: "GET",
            url: "{{ route('location_barangay.show') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'id' : location_barangay_id
            }
          });
          return request;
        }

        $('#location_barangay_table').on('click', '.view-location-barangay', function(e){     
          $('#location_barangay_modal_header').html("View Barangay");     
          location_barangay_id = $(this).parents('tr').attr('data-id');
          init_view_location_barangay();   
          var request = view_location_barangay(location_barangay_id);   
          request.then(function(data) {
            if(data['status'] == 1){         
              $('#location_barangay_name').val(data['location_barangay']['barangay'])  
              $('#municipality_id').val(data['location_barangay']['municipality_id'])                  
              $('#location_barangay_tags').val(data['location_barangay']['tags'])    
              if(data['location_barangay']['is_verified'] == 1) {
                $('#location_barangay_is_verified').iCheck('check'); 
              }    
              if(data['location_barangay']['is_active'] == 1) {
                $('#location_barangay_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#location_barangay_modal').modal('toggle');
        })
      {{-- view end --}}

      {{-- add start --}}
        function init_add_location_barangay(){
          init_view_location_barangay();
          $('.location-barangay-field')
            .attr('disabled', false);

          $('#add_location_barangay.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }          

        $('#add_new_location_barangay').on('click', function(){  
          clear_attributes() 
          init_add_location_barangay();          
          $('#location_barangay_modal_header').html("Add Barangay");
          $('#location_barangay_modal').modal('toggle')
        })

        $('#add_location_barangay').on('click', function(event){   
          event.prevenDefault;      
          clear_attributes()      
          $.ajax({
            method: "POST",
            url: "{{ route('location_barangay.store') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'barangay' : $('#location_barangay_name').val(),   
              'municipality_id' : $('#municipality_id').val(),   
              'tags' : $('#location_barangay_tags').val(),
              'is_verified' :  ($('#location_barangay_is_verified').iCheck('update')[0].checked ? 1  : 0),
              'is_active' :  ($('#location_barangay_is_active').iCheck('update')[0].checked ? 1  : 0)
            },
            success:function(data) {
              console.log(data);
              if(data.errors) {   
                if(data.errors.barangay){
                  $('#location_barangay_name').addClass('is-invalid');
                  $('#barangay-name-error').html(data.errors.barangay[0]);
                }    
                if(data.errors.municipality_id){
                  $('#municipality_id').addClass('is-invalid');
                  $('#municipality-error').html(data.errors.municipality_id[0]);
                }                 
              }
              if(data.success) {
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Brangay class has been successfully added.',
                  showConfirmButton: false,
                  timer: 1500
                }) 
                $('#location_barangay_modal').modal('toggle')
                location_barangay_table.ajax.reload();
              }
            },
          });
        })
      {{-- add end --}}

      {{-- update start --}}
        function init_update_location_barangay(){
          init_view_location_barangay()
          $('.location-barangay-field')
            .attr('disabled', false);

          $('#update_location_barangay.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        $('#update_location_barangay').on('click', function(event){
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
                url: "{{ route('location_barangay.update') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : location_barangay_id,
                  'barangay' : $('#location_barangay_name').val(),          
                  'municipality_id' : $('#municipality_id').val(),          
                  'tags' : $('#location_barangay_tags').val(),
                  'is_verified' :  ($('#location_barangay_is_verified').iCheck('update')[0].checked ? 1  : 0),
                  'is_active' :  ($('#location_barangay_is_active').iCheck('update')[0].checked ? 1  : 0)
                },
                success:function(data) {
                  console.log(data);
                  if(data.errors) {         
                    if(data.errors.barangay){
                      $('#location_barangay_name').addClass('is-invalid');
                      $('#barangay-name-error').html(data.errors.barangay[0]);
                    }                   
                  }
                  if(data.success) {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Barangay class has been successfully edited.',
                      showConfirmButton: false,
                      timer: 1500
                    })                        
                    $('#location_barangay_modal').modal('toggle')  
                    location_barangay_table.ajax.reload(); 
                  }                      
                }                             
              });                                
            }       
          })   
        })

        $('#location_barangay_table').on('click', '.update-location-barangay', function(e){
          $('#location_barangay_modal_header').html("Update Barangay");         
          init_update_location_barangay();
          location_barangay_id = $(this).parents('tr').attr('data-id');
          var request = view_location_barangay(location_barangay_id);

          request.then(function(data) {
            if(data['status'] == 1){
              $('#location_barangay_name').val(data['location_barangay']['barangay'])               
              $('#location_barangay_tags').val(data['location_barangay']['tags'])         
              $.each($('#municipality_id option'),function(){
                if($('#municipality_id').val() == data['location_barangay']['municipality_id']){
                  $('#municipality_id').attr('selected',true)
                }
              });
              if(data['location_barangay']['is_verified'] == 1) {
                $('#location_barangay_is_verified').iCheck('check'); 
              }    
              if(data['location_barangay']['is_active'] == 1) {
                $('#location_barangay_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#location_barangay_modal').modal('toggle')            
        })
      {{-- update end --}}

      {{-- delete start --}}
        $('#location_barangay_table').on('click', '.delete-location-barangay', function(e){
          location_barangay_id = $(this).parents('tr').attr('data-id');
          delete_location_barangay(location_barangay_id);
        })

        function delete_location_barangay(location_barangay_id){
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
                url: "{{ route('location_barangay.delete') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : location_barangay_id
                },
                success: function(data) {      
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Barangay has been successfully deleted.',
                    showConfirmButton: false,
                    timer: 1500
                  }) 
                  location_barangay_table.ajax.reload();          
                }             
              })    
            }       
          })
        }
      {{-- delete end --}}    
        
    {{-- END --}}
  
