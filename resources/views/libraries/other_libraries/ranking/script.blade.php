
      {{-- table start --}}
        var ranking_table = $('#ranking_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('ranking.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'ranking', name: 'ranking'}, 
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
        var ranking_id;
      {{-- table end --}}  
      
      {{-- START --}}
        {{-- modal start --}}
          $('#ranking_modal').on('hidden.bs.modal', function(){       
            init_view_ranking();
           clear_fields()
            ranking_table.ajax.reload()
          });  

          $('#ranking_modal').on('shown.bs.modal', function () {
            $('#ranking_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_ranking(){
            $('.ranking-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_ranking(ranking_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('ranking.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : ranking_id
              }
            });
            return request;
          }

          $('#ranking_table').on('click', '.view-ranking', function(e){     
            $('#ranking_modal_header').html("View Field of Specialization");     
            ranking_id = $(this).parents('tr').attr('data-id');
            init_view_ranking();   
            var request = view_ranking(ranking_id);   
            request.then(function(data) {
              if(data['status'] == 1){               
                $('#ranking_name').val(data['ranking']['ranking'])  
                $('#municipality_id').val(data['ranking']['municipality_id'])                  
                $('#ranking_tags').val(data['ranking']['tags']) 
                if(data['ranking']['is_verified'] == 1) {
                  $('#ranking_is_verified').iCheck('check'); 
                }    
                if(data['ranking']['is_active'] == 1) {
                  $('#ranking_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#ranking_modal').modal('toggle');
          })
        {{-- view end --}}

        {{--add start --}}
          function init_add_ranking(){
            init_view_ranking();
            $('.ranking-field')
              .attr('disabled', false);

            $('#add_ranking.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_ranking(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('ranking.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'ranking' : $('#ranking_name').val(),
                'ranking_group_id' : $('#ranking_group_id').val(),
                'sector_id' : $('#sector_id').val(),         
                'tags' : $('#ranking_tags').val(),
                'is_verified' :  ($('#ranking_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#ranking_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_ranking').on('click', function(e){ 
           clear_fields();
            init_add_ranking();          
            $('#ranking_modal_header').html("Add Field of Specialization");
            $('#ranking_modal').modal('toggle')
          })

          $('#add_ranking').on('click', function(){   
            {{-- error_checking($('.fieldlib-fields:not(#ranking_id)')) --}}
            var request = add_ranking();
            request.then(function(data) {
              $('#ranking_modal').modal('toggle')
              ranking_table.ajax.reload()
            })
          })
        {{-- add end --}}

        {{-- update start --}}
          function init_update_ranking(){
            init_view_ranking()
            $('.ranking-field')
              .attr('disabled', false);

            $('#update_ranking.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_ranking(ranking_id){  
            // error_checking($('.ranking-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('ranking.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : ranking_id,
                'ranking' : $('#crankingname').val(),
                'ranking_group_id' : $('#ranking_group_id').val(),              
                'sector_id' : $('#sector_id').val(),              
                'tags' : $('#ranking_tags').val(),
                'is_verified' :  ($('#ranking_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#ranking_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_ranking').on('click', function(e){
            var request = update_ranking(ranking_id);
            request.then(function(data) {
              $('#ranking_modal').modal('toggle')
              ranking_table.ajax.reload()             
            })
          })

          $('#ranking_table').on('click', '.update-ranking', function(e){
            $('#ranking_modal_header').html("Update Field of Specialization");         
            init_update_ranking();
            ranking_id = $(this).parents('tr').attr('data-id');
            var request = view_ranking(ranking_id);
            request.then(function(data) {
              if(data['status'] == 1){            
                $('#ranking_name').val(data['ranking']['ranking'])  
                $('#ranking_group_id').val(data['ranking']['ranking_group_id'])                  
                $('#sector_id').val(data['ranking']['sector_id']) 
                $('#ranking_tags').val(data['ranking']['tags']) 
                if(data['ranking']['is_verified'] == 1) {
                  $('#ranking_is_verified').iCheck('check'); 
                }    
                if(data['ranking']['is_active'] == 1) {
                  $('#ranking_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#ranking_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#ranking_table').on('click', '.delete-ranking', function(e){
            ranking_id = $(this).parents('tr').attr('data-id');
            delete_ranking(ranking_id);
          })

          function delete_ranking(ranking_id){
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
                  url: "{{ route('ranking.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : ranking_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Agency category has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    ranking_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}       
      {{-- END --}}