
      {{-- table start --}}
        var work_activity_table = $('#work_activity_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('work_activity.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'work_activity', name: 'work_activity'}, 
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
        var work_activity_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#work_activity_modal').on('hidden.bs.modal', function(){       
            init_view_work_activity();
           clear_fields()
            work_activity_table.ajax.reload()
          });  

          $('#work_activity_modal').on('shown.bs.modal', function () {
            $('#work_activity_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_work_activity(){
            $('.work_activity-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_work_activity(work_activity_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('work_activity.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : work_activity_id
              }
            });
            return request;
          }

          $('#work_activity_table').on('click', '.view-work_activity', function(e){     
            $('#work_activity_modal_header').html("View Field of Specialization");     
            work_activity_id = $(this).parents('tr').attr('data-id');
            init_view_work_activity();   
            var request = view_work_activity(work_activity_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#work_activity_name').val(data['work_activity']['work_activity'])  
                $('#municipality_id').val(data['work_activity']['municipality_id'])                  
                $('#work_activity_tags').val(data['work_activity']['tags']) 
                if(data['work_activity']['is_verified'] == 1) {
                  $('#work_activity_is_verified').iCheck('check'); 
                }    
                if(data['work_activity']['is_active'] == 1) {
                  $('#work_activity_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#work_activity_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_work_activity(){
            init_view_work_activity();
            $('.work_activity-field')
              .attr('disabled', false);

            $('#add_work_activity.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_work_activity(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('work_activity.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'work_activity' : $('#work_activity_name').val(),
                'work_activity_group_id' : $('#work_activity_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#work_activity_tags').val(),
                'is_verified' :  ($('#work_activity_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#work_activity_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_work_activity').on('click', function(e){ 
           clear_fields();
            init_add_work_activity();          
            $('#work_activity_modal_header').html("Add Field of Specialization");
            $('#work_activity_modal').modal('toggle')
          })

          $('#add_work_activity').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#work_activity_id)')) --}}
            var request = add_work_activity();
            request.then(function(data) {
              $('#work_activity_modal').modal('toggle')
              work_activity_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_work_activity(){
            init_view_work_activity()
            $('.work_activity-field')
              .attr('disabled', false);

            $('#update_work_activity.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_work_activity(work_activity_id){  
            // error_checking($('.work_activity-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('work_activity.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : work_activity_id,
                'work_activity' : $('#cwork_activityname').val(),
                'work_activity_group_id' : $('#work_activity_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#work_activity_tags').val(),
                'is_verified' :  ($('#work_activity_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#work_activity_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_work_activity').on('click', function(e){
            var request = update_work_activity(work_activity_id);
            request.then(function(data) {
              $('#work_activity_modal').modal('toggle')
              work_activity_table.ajax.reload()             
            })
          })

          $('#work_activity_table').on('click', '.update-work_activity', function(e){
            $('#work_activity_modal_header').html("Update Field of Specialization");         
            init_update_work_activity();
            work_activity_id = $(this).parents('tr').attr('data-id');
            var request = view_work_activity(work_activity_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#work_activity_name').val(data['work_activity']['work_activity'])  
                $('#work_activity_group_id').val(data['work_activity']['work_activity_group_id'])                  
                $('#sector_id').val(data['work_activity']['sector_id']) 
                $('#work_activity_tags').val(data['work_activity']['tags']) 
                if(data['work_activity']['is_verified'] == 1) {
                  $('#work_activity_is_verified').iCheck('check'); 
                }    
                if(data['work_activity']['is_active'] == 1) {
                  $('#work_activity_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#work_activity_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#work_activity_table').on('click', '.delete-work_activity', function(e){
            work_activity_id = $(this).parents('tr').attr('data-id');
            delete_work_activity(work_activity_id);
          })

          function delete_work_activity(work_activity_id){
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
                  url: "{{ route('work_activity.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : work_activity_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    work_activity_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}