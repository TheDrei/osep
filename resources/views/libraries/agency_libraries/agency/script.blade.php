
    {{-- table start --}}
      var agency_table = $('#agency_table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: {
          url: "{{ route('agency.table') }}",
          method: "GET",
          data : {
            '_token': '{{ csrf_token() }}'
          }
        },
        columns: [      
            {{-- {data: 'id', name: 'id'}, --}}
            {data: 'agency', name: 'agency'},
            {data: 'acronym', name: 'acronym'},
            {data: 'barangay', name: 'barangay'},
            {data: 'municipality', name: 'municipality'},
            {data: 'province', name: 'province'},
            {data: 'telno', name: 'telno'},
            {data: 'email', name: 'email'},
            {data: 'website', name: 'website'},
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

      var agency_id;
   
    {{-- table end --}}

    {{-- START --}}
      {{-- modal start --}}
        $('#agency_modal').on('hidden.bs.modal', function(){       
          init_view_agency();
          clear_fields()
          clear_attributes()
          agency_table.ajax.reload()
        });  
        $('#agency_modal').on('shown.bs.modal', function () {
          $('#agency_name').focus();
        })  
      {{-- modal end --}}

      {{-- view start --}}
        function init_view_agency(){
          $('.agency-field')
            .val('')
            .attr('disabled', true);

          $('.save-buttons')
            .removeClass('d-inline')
            .addClass('d-none')
            .attr('disabled', true);
        }

        function view_agency(agency_id){
          var request = $.ajax({
            method: "GET",
            url: "{{ route('agency.show') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'id' : agency_id
            }
          });
          return request;
        }

        $('#agency_table').on('click', '.view-agency', function(e){     
          $('#agency_modal_header').html("View Agency");     
          agency_id = $(this).parents('tr').attr('data-id');
          init_view_agency();   
          var request = view_agency(agency_id);   
          request.then(function(data) {
            if(data['status'] == 1){
              $('.agency-field').each(function() {
                $(this).val(data['agency'][$(this).attr('id')]).change();
              });                
              $('#agency_name').val(data['agency']['agency'])  
              $('#agency_acronym').val(data['agency']['acronym'])                  
              $('#agency_tags').val(data['agency']['tags'])                  
              $.each($('#municipality_id option'),function(){
                if($('#municipality_id').val() == data['agency']['municipality_id']){
                   $('#municipality_id').attr('selected',true)
                }
              });
              if(data['agency']['is_verified'] == 1) {
                $('#agency_is_verified').iCheck('check'); 
              }    
              if(data['agency']['is_active'] == 1) {
                $('#agency_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#agency_modal').modal('toggle');
        })
      {{-- view end --}}

      {{-- add start --}}
        function init_add_agency(){
          init_view_agency();
          $('.agency-field')
            .attr('disabled', false);

          $('#add_agency.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        $('#add_new_agency').on('click', function(){ 
          clear_fields();
          init_add_agency();          
          $('#agency_modal_header').html("Add Agency");
          $('#agency_modal').modal('toggle')
        })

        $('#add_agency').on('click', function(event){   
          event.prevenDefault;         
          clear_attributes()              
          $.ajax({
            method: "POST",
            url: "{{ route('agency.store') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'agency' : $('#agency_name').val(),
              'acronym' : $('#agency_acronym').val(),
              'street' : $('#street').val(),              
              'barangay_id' : $('#barangay_id').val(),
              'municipality_id' : $('#municipality_id').val(),
              'province_id' : $('#province_id').val(),
              'telno' : $('#telno').val(),
              'faxno' : $('#faxno').val(),
              'email' : $('#email').val(),
              'website' : $('#website').val(),
              'head_agency_id' : $('#head_agency_id').val(),               
              'consortium_type_id' : $('#consortium_type_id').val(),
              'agency_category_id' : $('#agency_category_id').val(),
              'agency_class_id' : $('#agency_class_id').val(),                
              'agency_group_id' : $('#agency_group_id').val(),
              'agency_subgroup_id' : $('#agency_subgroup_id').val(),
              'agency_type_id' : $('#agency_type_id').val(),
              'tags' : $('#agency_tags').val(),
              'is_verified' :  ($('#agency_is_verified').iCheck('update')[0].checked ? 1  : 0),
              'is_active' :  ($('#agency_is_active').iCheck('update')[0].checked ? 1  : 0)
            },
            success:function(data) {
              console.log(data);
              if(data.errors) {         
                if(data.errors.agency){
                  $('#agency_name').addClass('is-invalid');
                  $('#agency-name-error').html(data.errors.agency[0]);
                } 
                if(data.errors.barangay_id){
                  $('#barangay_id').addClass('is-invalid');           
                  $('#barangay-error').html(data.errors.barangay_id[0]);
                }  
                if(data.errors.municipality_id){
                  $('#municipality_id').addClass('is-invalid');           
                  $('#municipality-error').html(data.errors.municipality_id[0]);
                }  
                if(data.errors.province_id){
                  $('#province_id').addClass('is-invalid');         
                  $('#province-error').html(data.errors.province_id[0]);
                }    
                if(data.errors.telno){
                  $('#telno').addClass('is-invalid');   
                  $('#telno-error').html(data.errors.telno[0]);
                } 
                if(data.errors.email){
                  $('#email').addClass('is-invalid');
                  $('#email-error').html(data.errors.email[0]);
                }                
              }
              if(data.success) {
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Agency has been successfully added.',
                  showConfirmButton: false,
                  timer: 1500
                }) 
                $('#agency_modal').modal('toggle')
                agency_table.ajax.reload();
              }
            },
          });
        })
      {{-- add end --}}
    
      {{-- update start --}}
        function init_update_agency(){
          init_view_agency()
          $('.agency-field')
            .attr('disabled', false);

          $('#update_agency.save-buttons')
            .addClass('d-inline')
            .removeClass('d-none')
            .attr('disabled', false);
        }

        $('#update_agency').on('click', function(event){
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
            url: "{{ route('agency.update') }}",
            data: {
              '_token': '{{ csrf_token() }}',
              'id' : agency_id,
              'agency' : $('#agency_name').val(),
              'acronym' : $('#agency_acronym').val(),
              'street' : $('#street').val(),              
              'barangay_id' : $('#barangay_id').val(),
              'municipality_id' : $('#municipality_id').val(),
              'province_id' : $('#province_id').val(),
              'telno' : $('#telno').val(),
              'faxno' : $('#faxno').val(),
              'email' : $('#email').val(),
              'website' : $('#website').val(),
              'head_agency_id' : $('#head_agency_id').val(),
              'consortium_type_id' : $('#consortium_type_id').val(),
              'agency_category_id' : $('#agency_category_id').val(),
              'agency_class_id' : $('#agency_class_id').val(),                
              'agency_group_id' : $('#agency_group_id').val(),
              'agency_subgroup_id' : $('#agency_subgroup_id').val(),
              'agency_type_id' : $('#agency_type_id').val(),
              'tags' : $('#agency_tags').val(),
              'is_verified' :  ($('#agency_is_verified').iCheck('update')[0].checked ? 1  : 0),
              'is_active' :  ($('#agency_is_active').iCheck('update')[0].checked ? 1  : 0)
            },
            success:function(data) {
              console.log(data);
              if(data.errors) {         
                if(data.errors.agency){
                  $('#agency_name').addClass('is-invalid');
                  $('#agency-name-error').html(data.errors.agency[0]);
                } 
                if(data.errors.barangay_id){
                  $('#barangay_id').addClass('is-invalid');           
                  $('#barangay-error').html(data.errors.barangay_id[0]);
                }  
                if(data.errors.municipality_id){
                  $('#municipality_id').addClass('is-invalid');           
                  $('#municipality-error').html(data.errors.municipality_id[0]);
                }  
                if(data.errors.province_id){
                  $('#province_id').addClass('is-invalid');         
                  $('#province-error').html(data.errors.province_id[0]);
                }    
                if(data.errors.telno){
                  $('#telno').addClass('is-invalid');   
                  $('#telno-error').html(data.errors.telno[0]);
                } 
                if(data.errors.email){
                  $('#email').addClass('is-invalid');
                  $('#email-error').html(data.errors.email[0]);
                }                
              }
              if(data.success) {
                
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Agency has been successfully edited.',
                  showConfirmButton: false,
                  timer: 1500
                }) 
              $('#agency_modal').modal('toggle')  
              agency_table.ajax.reload(); 
              }                      
              }                             
            });                                
            }       
          })   
        })

        $('#agency_table').on('click', '.update-agency', function(e){
          $('#agency_modal_header').html("Update Agency");         
          init_update_agency();
          agency_id = $(this).parents('tr').attr('data-id');
          var request = view_agency(agency_id);
          request.then(function(data) {
            if(data['status'] == 1){
              $('.agency-field').each(function() {
                $(this).val(data['agency'][$(this).attr('id')]).change();
              });                
              $('#agency_name').val(data['agency']['agency'])  
              $('#agency_acronym').val(data['agency']['acronym'])                  
              $('#agency_tags').val(data['agency']['tags'])                  
              $.each($('#municipality_id option'),function(){
                if($('#municipality_id').val() == data['agency']['municipality_id']){
                  $('#municipality_id').attr('selected',true)
                }
              });
              $.each($('#barangay_id option'),function(){
                if($('#barangay_id').val() == data['agency']['barangay_id']){
                  $('#barangay_id').attr('selected',true)
                }
              });
              if(data['agency']['is_verified'] == 1) {
                $('#agency_is_verified').iCheck('check'); 
              }    
              if(data['agency']['is_active'] == 1) {
                $('#agency_is_active').iCheck('check'); 
              }  
            }
                          
          })
          $('#agency_modal').modal('toggle')            
        })
      {{-- update end --}}

      {{-- delete start --}}
        $('#agency_table').on('click', '.delete-agency', function(e){
          agency_id = $(this).parents('tr').attr('data-id');
          delete_agency(agency_id);
        })

        function delete_agency(agency_id){
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
                url: "{{ route('agency.delete') }}",
                data: {
                  '_token': '{{ csrf_token() }}',
                  'id' : agency_id
                },
                success: function(data) {      
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Agency has been successfully deleted.',
                    showConfirmButton: false,
                    timer: 1500
                  }) 
                  agency_table.ajax.reload();          
                }             
              })    
            }       
          })
        }
      {{-- delete end --}}      
    {{-- END --}}