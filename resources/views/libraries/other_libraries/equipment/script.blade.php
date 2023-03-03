
      {{-- table start --}}
        var equipment_table = $('#equipment_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('equipment.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'equipment', name: 'equipment'}, 
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
        var equipment_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#equipment_modal').on('hidden.bs.modal', function(){       
            init_view_equipment();
           clear_fields()
            equipment_table.ajax.reload()
          });  

          $('#equipment_modal').on('shown.bs.modal', function () {
            $('#equipment_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_equipment(){
            $('.equipment-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_equipment(equipment_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('equipment.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : equipment_id
              }
            });
            return request;
          }

          $('#equipment_table').on('click', '.view-equipment', function(e){     
            $('#equipment_modal_header').html("View Field of Specialization");     
            equipment_id = $(this).parents('tr').attr('data-id');
            init_view_equipment();   
            var request = view_equipment(equipment_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#equipment_name').val(data['equipment']['equipment'])  
                $('#municipality_id').val(data['equipment']['municipality_id'])                  
                $('#equipment_tags').val(data['equipment']['tags']) 
                if(data['equipment']['is_verified'] == 1) {
                  $('#equipment_is_verified').iCheck('check'); 
                }    
                if(data['equipment']['is_active'] == 1) {
                  $('#equipment_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#equipment_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_equipment(){
            init_view_equipment();
            $('.equipment-field')
              .attr('disabled', false);

            $('#add_equipment.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_equipment(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('equipment.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'equipment' : $('#equipment_name').val(),
                'equipment_group_id' : $('#equipment_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#equipment_tags').val(),
                'is_verified' :  ($('#equipment_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#equipment_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_equipment').on('click', function(e){ 
           clear_fields();
            init_add_equipment();          
            $('#equipment_modal_header').html("Add Field of Specialization");
            $('#equipment_modal').modal('toggle')
          })

          $('#add_equipment').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#equipment_id)')) --}}
            var request = add_equipment();
            request.then(function(data) {
              $('#equipment_modal').modal('toggle')
              equipment_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_equipment(){
            init_view_equipment()
            $('.equipment-field')
              .attr('disabled', false);

            $('#update_equipment.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_equipment(equipment_id){  
            // error_checking($('.equipment-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('equipment.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : equipment_id,
                'equipment' : $('#cequipmentname').val(),
                'equipment_group_id' : $('#equipment_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#equipment_tags').val(),
                'is_verified' :  ($('#equipment_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#equipment_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_equipment').on('click', function(e){
            var request = update_equipment(equipment_id);
            request.then(function(data) {
              $('#equipment_modal').modal('toggle')
              equipment_table.ajax.reload()             
            })
          })

          $('#equipment_table').on('click', '.update-equipment', function(e){
            $('#equipment_modal_header').html("Update Field of Specialization");         
            init_update_equipment();
            equipment_id = $(this).parents('tr').attr('data-id');
            var request = view_equipment(equipment_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#equipment_name').val(data['equipment']['equipment'])  
                $('#equipment_group_id').val(data['equipment']['equipment_group_id'])                  
                $('#sector_id').val(data['equipment']['sector_id']) 
                $('#equipment_tags').val(data['equipment']['tags']) 
                if(data['equipment']['is_verified'] == 1) {
                  $('#equipment_is_verified').iCheck('check'); 
                }    
                if(data['equipment']['is_active'] == 1) {
                  $('#equipment_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#equipment_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#equipment_table').on('click', '.delete-equipment', function(e){
            equipment_id = $(this).parents('tr').attr('data-id');
            delete_equipment(equipment_id);
          })

          function delete_equipment(equipment_id){
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
                  url: "{{ route('equipment.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : equipment_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    equipment_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}