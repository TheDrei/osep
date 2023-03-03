
      {{-- table start --}}
        var award_table = $('#award_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('award.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'award', name: 'award'}, 
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
        var award_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#award_modal').on('hidden.bs.modal', function(){       
            init_view_award();
           clear_fields()
            award_table.ajax.reload()
          });  

          $('#award_modal').on('shown.bs.modal', function () {
            $('#award_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_award(){
            $('.award-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_award(award_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('award.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : award_id
              }
            });
            return request;
          }

          $('#award_table').on('click', '.view-award', function(e){     
            $('#award_modal_header').html("View Field of Specialization");     
            award_id = $(this).parents('tr').attr('data-id');
            init_view_award();   
            var request = view_award(award_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#award_name').val(data['award']['award'])  
                $('#municipality_id').val(data['award']['municipality_id'])                  
                $('#award_tags').val(data['award']['tags']) 
                if(data['award']['is_verified'] == 1) {
                  $('#award_is_verified').iCheck('check'); 
                }    
                if(data['award']['is_active'] == 1) {
                  $('#award_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#award_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_award(){
            init_view_award();
            $('.award-field')
              .attr('disabled', false);

            $('#add_award.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_award(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('award.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'award' : $('#award_name').val(),
                'award_group_id' : $('#award_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#award_tags').val(),
                'is_verified' :  ($('#award_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#award_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_award').on('click', function(e){ 
           clear_fields();
            init_add_award();          
            $('#award_modal_header').html("Add Field of Specialization");
            $('#award_modal').modal('toggle')
          })

          $('#add_award').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#award_id)')) --}}
            var request = add_award();
            request.then(function(data) {
              $('#award_modal').modal('toggle')
              award_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_award(){
            init_view_award()
            $('.award-field')
              .attr('disabled', false);

            $('#update_award.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_award(award_id){  
            // error_checking($('.award-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('award.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : award_id,
                'award' : $('#cawardname').val(),
                'award_group_id' : $('#award_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#award_tags').val(),
                'is_verified' :  ($('#award_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#award_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_award').on('click', function(e){
            var request = update_award(award_id);
            request.then(function(data) {
              $('#award_modal').modal('toggle')
              award_table.ajax.reload()             
            })
          })

          $('#award_table').on('click', '.update-award', function(e){
            $('#award_modal_header').html("Update Field of Specialization");         
            init_update_award();
            award_id = $(this).parents('tr').attr('data-id');
            var request = view_award(award_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#award_name').val(data['award']['award'])  
                $('#award_group_id').val(data['award']['award_group_id'])                  
                $('#sector_id').val(data['award']['sector_id']) 
                $('#award_tags').val(data['award']['tags']) 
                if(data['award']['is_verified'] == 1) {
                  $('#award_is_verified').iCheck('check'); 
                }    
                if(data['award']['is_active'] == 1) {
                  $('#award_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#award_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#award_table').on('click', '.delete-award', function(e){
            award_id = $(this).parents('tr').attr('data-id');
            delete_award(award_id);
          })

          function delete_award(award_id){
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
                  url: "{{ route('award.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : award_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    award_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}