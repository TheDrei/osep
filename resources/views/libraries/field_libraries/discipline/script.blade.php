
      {{-- table start --}}
        var discipline_table = $('#discipline_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('discipline.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'discipline', name: 'discipline'}, 
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
        var discipline_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#discipline_modal').on('hidden.bs.modal', function(){       
            init_view_discipline();
           clear_fields()
            discipline_table.ajax.reload()
          });  

          $('#discipline_modal').on('shown.bs.modal', function () {
            $('#discipline_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_discipline(){
            $('.discipline-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_discipline(discipline_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('discipline.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : discipline_id
              }
            });
            return request;
          }

          $('#discipline_table').on('click', '.view-discipline', function(e){     
            $('#discipline_modal_header').html("View Field of Specialization");     
            discipline_id = $(this).parents('tr').attr('data-id');
            init_view_discipline();   
            var request = view_discipline(discipline_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#discipline_name').val(data['discipline']['discipline'])  
                $('#municipality_id').val(data['discipline']['municipality_id'])                  
                $('#discipline_tags').val(data['discipline']['tags']) 
                if(data['discipline']['is_verified'] == 1) {
                  $('#discipline_is_verified').iCheck('check'); 
                }    
                if(data['discipline']['is_active'] == 1) {
                  $('#discipline_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#discipline_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_discipline(){
            init_view_discipline();
            $('.discipline-field')
              .attr('disabled', false);

            $('#add_discipline.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_discipline(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('discipline.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'discipline' : $('#discipline_name').val(),
                'discipline_group_id' : $('#discipline_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#discipline_tags').val(),
                'is_verified' :  ($('#discipline_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#discipline_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_discipline').on('click', function(e){ 
           clear_fields();
            init_add_discipline();          
            $('#discipline_modal_header').html("Add Field of Specialization");
            $('#discipline_modal').modal('toggle')
          })

          $('#add_discipline').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#discipline_id)')) --}}
            var request = add_discipline();
            request.then(function(data) {
              $('#discipline_modal').modal('toggle')
              discipline_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_discipline(){
            init_view_discipline()
            $('.discipline-field')
              .attr('disabled', false);

            $('#update_discipline.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_discipline(discipline_id){  
            // error_checking($('.discipline-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('discipline.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : discipline_id,
                'discipline' : $('#cdisciplinename').val(),
                'discipline_group_id' : $('#discipline_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#discipline_tags').val(),
                'is_verified' :  ($('#discipline_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#discipline_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_discipline').on('click', function(e){
            var request = update_discipline(discipline_id);
            request.then(function(data) {
              $('#discipline_modal').modal('toggle')
              discipline_table.ajax.reload()             
            })
          })

          $('#discipline_table').on('click', '.update-discipline', function(e){
            $('#discipline_modal_header').html("Update Field of Specialization");         
            init_update_discipline();
            discipline_id = $(this).parents('tr').attr('data-id');
            var request = view_discipline(discipline_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#discipline_name').val(data['discipline']['discipline'])  
                $('#discipline_group_id').val(data['discipline']['discipline_group_id'])                  
                $('#sector_id').val(data['discipline']['sector_id']) 
                $('#discipline_tags').val(data['discipline']['tags']) 
                if(data['discipline']['is_verified'] == 1) {
                  $('#discipline_is_verified').iCheck('check'); 
                }    
                if(data['discipline']['is_active'] == 1) {
                  $('#discipline_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#discipline_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#discipline_table').on('click', '.delete-discipline', function(e){
            discipline_id = $(this).parents('tr').attr('data-id');
            delete_discipline(discipline_id);
          })

          function delete_discipline(discipline_id){
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
                  url: "{{ route('discipline.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : discipline_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    discipline_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}