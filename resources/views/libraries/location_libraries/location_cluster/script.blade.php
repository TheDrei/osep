
      {{-- table start --}}
        var location_cluster_table = $('#location_cluster_table').DataTable({
          processing: true,
          serverSide: true,
          deferRender: true,
          ajax: {
            url: "{{ route('location_cluster.table') }}",
            method: "GET",
            data : {
              '_token': '{{ csrf_token() }}'
            }
          },
          columns: [      
              {data: 'id', name: 'id'},
              {data: 'cluster', name: 'cluster'},            
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

        var location_cluster_id;
     
      {{-- table end --}}

      {{-- START --}}
        {{-- modal start --}}
          $('#location_cluster_modal').on('hidden.bs.modal', function(){       
            init_view_location_cluster();
           clear_fields()
            location_cluster_table.ajax.reload()
          });  

          $('#location_cluster_modal').on('shown.bs.modal', function () {
            $('#location_cluster_name').focus();
          })  
        {{-- modal end --}}

        {{-- view start --}}
          function init_view_location_cluster(){
            $('.location-cluster-field')
              .val('')
              .attr('disabled', true);

            $('.save-buttons')
              .removeClass('d-inline')
              .addClass('d-none')
              .attr('disabled', true);
          }

          function view_location_cluster(location_cluster_id){
            var request = $.ajax({
              method: "GET",
              url: "{{ route('location_cluster.show') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_cluster_id
              }
            });
            return request;
          }

          $('#location_cluster_table').on('click', '.view-location-cluster', function(e){     
            $('#location_cluster_modal_header').html("View Location Cluster");     
            location_cluster_id = $(this).parents('tr').attr('data-id');
            init_view_location_cluster();   
            var request = view_location_cluster(location_cluster_id);   
            request.then(function(data) {
              if(data['status'] == 1){         
                $('#location_cluster_name').val(data['location_cluster']['cluster'])  
                $('#region_id').val(data['location_cluster']['region_id'])                  
                $('#area_code').val(data['location_cluster']['area_code'])    
                $('#location_cluster_tags').val(data['location_cluster']['tags'])    
                if(data['location_cluster']['is_verified'] == 1) {
                  $('#location_cluster_is_verified').iCheck('check'); 
                }    
                if(data['location_cluster']['is_active'] == 1) {
                  $('#location_cluster_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_cluster_modal').modal('toggle');
          })
        {{-- view end --}}

        {{-- add start --}}
          function init_add_location_cluster(){
            init_view_location_cluster();
            $('.location-cluster-field')
              .attr('disabled', false);

            $('#add_location_cluster.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function add_location_cluster(){
            var request = $.ajax({
              method: "POST",
              url: "{{ route('location_cluster.store') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'cluster' : $('#location_cluster_name').val(),            
                'region_id' : $('#region_id').val(),            
                'area_code' : $('#area_code').val(),            
                'tags' : $('#location_cluster_tags').val(),
                'is_verified' :  ($('#location_cluster_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_cluster_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#add_new_location_cluster').on('click', function(e){ 
           clear_fields();
            init_add_location_cluster();          
            $('#location_cluster_modal_header').html("Add Location Cluster");
            $('#location_cluster_modal').modal('toggle')
          })

          $('#add_location_cluster').on('click', function(e){            
            var request = add_location_cluster();
            request.then(function(data) {
              $('#location_cluster_modal').modal('toggle')
              location_cluster_table.ajax.reload()
            })

          })
        {{-- add end --}}
        
        {{-- update start --}}
          function init_update_location_cluster(){
            init_view_location_cluster()
            $('.location-cluster-field')
              .attr('disabled', false);

            $('#update_location_cluster.save-buttons')
              .addClass('d-inline')
              .removeClass('d-none')
              .attr('disabled', false);
          }

          function update_location_cluster(location_cluster_id){  
            // error_checking($('.location-cluster-field'))
            var request = $.ajax({
              method: "PATCH",
              url: "{{ route('location_cluster.update') }}",
              data: {
                '_token': '{{ csrf_token() }}',
                'id' : location_cluster_id,
                'cluster' : $('#location_cluster_name').val(),            
                'region_id' : $('#region_id').val(),            
                'area_code' : $('#area_code').val(),                  
                'tags' : $('#location_cluster_tags').val(),
                'is_verified' :  ($('#location_cluster_is_verified').iCheck('update')[0].checked ? 1  : 0),
                'is_active' :  ($('#location_cluster_is_active').iCheck('update')[0].checked ? 1  : 0)
              }
            });
            return request;
          }

          
          $('#update_location_cluster').on('click', function(e){
            var request = update_location_cluster(location_cluster_id);
            request.then(function(data) {
              $('#location_cluster_modal').modal('toggle')
              location_cluster_table.ajax.reload()             
            })
          })

          $('#location_cluster_table').on('click', '.update-location-cluster', function(e){
            $('#location_cluster_modal_header').html("Update Location Cluster");         
            init_update_location_cluster();
            location_cluster_id = $(this).parents('tr').attr('data-id');
            var request = view_location_cluster(location_cluster_id);

            request.then(function(data) {
              if(data['status'] == 1){
                $('#location_cluster_name').val(data['location_cluster']['cluster'])  
                $('#region_id').val(data['location_cluster']['region_id'])                  
                $('#area_code').val(data['location_cluster']['area_code'])    
                $('#location_cluster_tags').val(data['location_cluster']['tags'])         
                if(data['location_cluster']['is_verified'] == 1) {
                  $('#location_cluster_is_verified').iCheck('check'); 
                }    
                if(data['location_cluster']['is_active'] == 1) {
                  $('#location_cluster_is_active').iCheck('check'); 
                }  
              }
                            
            })
            $('#location_cluster_modal').modal('toggle')            
          })
        {{-- update end --}}

        {{-- delete start --}}
          $('#location_cluster_table').on('click', '.delete-location-cluster', function(e){
            location_cluster_id = $(this).parents('tr').attr('data-id');
            delete_location_cluster(location_cluster_id);
          })

          function delete_location_cluster(location_cluster_id){
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
                  url: "{{ route('location_cluster.delete') }}",
                  data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : location_cluster_id
                  },
                  success: function(data) {      
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Barangay has been successfully deleted.',
                      showConfirmButton: false,
                      timer: 1500
                    }) 
                    location_cluster_table.ajax.reload();          
                  }             
                })    
              }       
            })
          }
        {{-- delete end --}}    
      {{-- END --}}
  
